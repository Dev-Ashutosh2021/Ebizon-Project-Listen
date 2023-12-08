<?php
class MusicController extends BaseController
{

    public function addSong()
    {
        require_once './assets/getid3/getid3.php';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) === 'POST') {
            try {
                // Retrieve form data
                $title = $_POST['title'];
                $artist = $_POST['artist'];
                $genre = $_POST['genre'];

                $getID3 = new getID3; // Initialize getID3
                // Define upload paths
                $audioUploadPath = "uploads/audio/" . basename($_FILES["audio"]["name"]);
                $thumbnailUploadPath = "uploads/thumbnail/" . basename($_FILES["thumbnail"]["name"]);

                // Check if the uploaded files are valid
                $audioFileType = strtolower(pathinfo($audioUploadPath, PATHINFO_EXTENSION));
                $thumbnailFileType = strtolower(pathinfo($thumbnailUploadPath, PATHINFO_EXTENSION));

                // Get audio file duration
                $audioFileInfo = $getID3->analyze($audioUploadPath);
                $audioDurationInSeconds = $audioFileInfo['playtime_seconds'];
                $audioDurationInMinutes = floor($audioDurationInSeconds / 60);
                $audioDurationSeconds = $audioDurationInSeconds % 60;
                $duration = sprintf('%d:%02d', $audioDurationInMinutes, $audioDurationSeconds);

                if ($audioFileType != "mp3" && $audioFileType != "wav" && $thumbnailFileType != "jpg" && $thumbnailFileType != "png" && $thumbnailFileType != "jpeg" && $thumbnailFileType != "gif") {
                    echo "Unsupported file type. Please upload MP3 or WAV audio files and JPEG, JPG, PNG, or GIF images.";
                } else {
                    // Attempt to move the uploaded files to the desired directory
                    if (move_uploaded_file($_FILES["audio"]["tmp_name"], $audioUploadPath) && move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $thumbnailUploadPath)) {
                        // Initialize MySQLi connection
                        $params = [$title, $duration, $artist, $audioUploadPath, $thumbnailUploadPath, $genre];
                        $adminModel = new MusicModel();
                        $result = $adminModel->addSong($params);
                        if ($result) {
                            echo json_encode(['result' => true]);
                            exit;
                        } else {
                            echo json_encode(['error' => 'Error executing query.']);
                            exit;
                        }
                    } else {
                        echo "Error uploading files.";
                    }
                }
            } catch (Exception $e) {
                // Exception handling
                echo json_encode(array('error' => $e->getMessage()));
            }
        } else {
            // Method not supported handling
            echo json_encode(array('error' => 'Method not supported'));
        }
    }



    public function addArtist()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_FILES['thumbnail'])) {
            $name = $_POST['name'];
            $thumbnail = $_FILES['thumbnail'];

            $thumbnailUploadPath = "uploads/artists/" . basename($thumbnail["name"]);
            $thumbnailFileType = strtolower(pathinfo($thumbnailUploadPath, PATHINFO_EXTENSION));

            if ($thumbnailFileType != "jpg" && $thumbnailFileType != "png" && $thumbnailFileType != "jpeg" && $thumbnailFileType != "gif") {
                echo json_encode(['error' => 'Unsupported file type. Please upload JPEG, JPG, PNG, or GIF images.']);
                exit;
            } else {
                if (move_uploaded_file($thumbnail["tmp_name"], $thumbnailUploadPath)) {
                    $params = [$name, $thumbnailUploadPath];

                    try {
                        $adminModel = new MusicModel();
                        $result = $adminModel->addArtist($params);
                        if ($result) {
                            echo json_encode(['result' => true]);
                            exit;
                        } else {
                            echo json_encode(['error' => 'Error executing query.']);
                            exit;
                        }
                    } catch (Exception $e) {
                        echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
                        exit;
                    }
                } else {
                    echo json_encode(['error' => 'Error uploading files.']);
                    exit;
                }
            }
        } else {
            echo json_encode(['error' => 'Invalid request']);
            exit;
        }
    }


    public function addGenre()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['genrename'])) {
            $name = $_POST['genrename'];

            try {
                $adminModel = new MusicModel();
                $result = $adminModel->addGenre([$name]);
                if ($result) {
                    echo json_encode(['result' => true]);
                    exit;
                } else {
                    echo json_encode(['error' => 'Error executing query.']);
                    exit;
                }
            } catch (Exception $e) {
                echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
                exit;
            }
        } else {
            echo json_encode(['error' => 'Invalid request']);
            exit;
        }
    }




    public function getAllArtists()
    {
        try {
            $adminModel = new MusicModel();
            $result = $adminModel->getArtist();

            if ($result !== false) {
                echo json_encode(['result' => $result]);
            } else {
                echo json_encode(['error' => 'Error fetching artists.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }
        exit;
    }


    public function getAllGenres()
    {
        try {
            $adminModel = new MusicModel();
            $result = $adminModel->getGenre();

            if ($result !== false) {
                echo json_encode(['result' => $result]);
            } else {
                echo json_encode(['error' => 'Error fetching artists.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }
        exit;
    }



    public function getAllSongs()
    {
        try {
            $adminModel = new MusicModel();

            $songs = $adminModel->getSongsAll();
            $genres = $adminModel->getGenreAll();
            $artists = $adminModel->getArtistAll();

            if ($songs !== false && $genres !== false && $artists !== false) {
                $result = [
                    'songs' => $songs,
                    'genres' => $genres,
                    'artists' => $artists,
                ];

                echo json_encode($result);
            } else {
                echo json_encode(['error' => 'Error fetching data.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }



    public function saveChangesSong()
    {
        require_once './assets/getid3/getid3.php';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) === 'POST') {
            try {
                // Retrieve form data
                $title = $_POST['editTitle'];
                $artist = $_POST['editArtistSelect'];
                $genre = $_POST['editGenreSelect'];
                $hiddenId = $_POST['songid'];
                $oldthumbnail = $_POST['thumpath'];
                $oldaudio = $_POST['audpath'];
                $oldduration = $_POST['audduration'];

                $adminModel = new MusicModel();

                $getID3 = new getID3; // Initialize getID3


                if (isset($_FILES["editFormFileAudio"]["tmp_name"]) && isset($_FILES["editFormFileThumbnail"]["tmp_name"])) {
                    // Define upload paths
                    $audioUploadPath = "uploads/audio/" . basename($_FILES["editFormFileAudio"]["name"]);
                    $thumbnailUploadPath = "uploads/thumbnail/" . basename($_FILES["editFormFileThumbnail"]["name"]);

                    // Get audio file duration
                    $audioFileInfo = $getID3->analyze($audioUploadPath);
                    $audioDurationInSeconds = $audioFileInfo['playtime_seconds'];
                    $audioDurationInMinutes = floor($audioDurationInSeconds / 60);
                    $audioDurationSeconds = $audioDurationInSeconds % 60;
                    $duration = sprintf('%d:%02d', $audioDurationInMinutes, $audioDurationSeconds);
                    move_uploaded_file($_FILES["editFormFileAudio"]["tmp_name"], $audioUploadPath);
                    move_uploaded_file($_FILES["editFormFileThumbnail"]["tmp_name"], $thumbnailUploadPath);
                    $params = [$title, $duration, $artist, $audioUploadPath, $thumbnailUploadPath, $genre, $hiddenId];
                    $result = $adminModel->editSong($params);
                    if ($result) {
                        echo json_encode(['result' => true]);
                        exit;
                    } else {
                        echo json_encode(['error' => 'Error executing query.']);
                        exit;
                    }
                } elseif (isset($_FILES["editFormFileAudio"]["tmp_name"])) {
                    $audioUploadPath = "uploads/audio/" . basename($_FILES["editFormFileAudio"]["name"]);
                    $audioFileType = strtolower(pathinfo($audioUploadPath, PATHINFO_EXTENSION));
                    // Get audio file duration
                    $audioFileInfo = $getID3->analyze($audioUploadPath);
                    $audioDurationInSeconds = $audioFileInfo['playtime_seconds'];
                    $audioDurationInMinutes = floor($audioDurationInSeconds / 60);
                    $audioDurationSeconds = $audioDurationInSeconds % 60;
                    $duration = sprintf('%d:%02d', $audioDurationInMinutes, $audioDurationSeconds);

                    move_uploaded_file($_FILES["editFormFileAudio"]["tmp_name"], $audioUploadPath);
                    $params = [$title, $duration, $artist, $audioUploadPath, $oldthumbnail, $genre, $hiddenId];
                    $result = $adminModel->editSong($params);
                    if ($result) {
                        echo json_encode(['result' => true]);
                        exit;
                    } else {
                        echo json_encode(['error' => 'Error executing query.']);
                        exit;
                    }
                } elseif (isset($_FILES["editFormFileThumbnail"]["tmp_name"])) {
                    $thumbnailUploadPath = "uploads/thumbnail/" . basename($_FILES["editFormFileThumbnail"]["name"]);
                    move_uploaded_file($_FILES["editFormFileThumbnail"]["tmp_name"], $thumbnailUploadPath);
                    $params = [$title, $oldduration, $artist, $oldaudio, $thumbnailUploadPath, $genre, $hiddenId];
                    $result = $adminModel->editSong($params);
                    if ($result) {
                        echo json_encode(['result' => true]);
                        exit;
                    } else {
                        echo json_encode(['error' => 'Error executing query.']);
                        exit;
                    }
                } else {
                    $params = [$title, $oldduration, $artist, $oldaudio, $oldthumbnail, $genre, $hiddenId];
                    $result = $adminModel->editSong($params);
                    if ($result) {
                        echo json_encode(['result' => true]);
                        exit;
                    } else {
                        echo json_encode(['error' => 'Error executing query.']);
                        exit;
                    }
                }
            } catch (Exception $e) {
                // Exception handling
                echo json_encode(array('error' => $e->getMessage()));
            }
        } else {
            // Method not supported handling
            echo json_encode(array('error' => 'Method not supported'));
        }
    }



    public function deleteSong()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) === 'POST') {
            try {
                // Retrieve form data
                $hiddenId = $_POST['hideId'];

                // Initialize MySQLi connection
                $params = [$hiddenId];
                $adminModel = new MusicModel();
                $result = $adminModel->deleteSong($params);

                if ($result) {
                    echo json_encode(['result' => true]);
                    exit;
                } else {
                    echo json_encode(['error' => 'Error executing query.']);
                    exit;
                }
            } catch (Exception $e) {
                // Exception handling
                echo json_encode(array('error' => $e->getMessage()));
            }
        } else {
            // Method not supported handling
            echo json_encode(array('error' => 'Method not supported'));
        }
    }


    public function getAllUsers()
    {
        try {
            $adminModel = new MusicModel();

            $users = $adminModel->getUsersAll();

            if ($users !== false) {
                $result = ['users' => $users];

                echo json_encode($result);
            } else {
                echo json_encode(['error' => 'Error fetching data.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }


    public function saveUserDetail()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) === 'POST') {
            try {
                // Retrieve form data
                $userid = $_POST['userid'];
                $firstname = $_POST['firstName'];
                $lastname = $_POST['LastName'];
                $username = $_POST['userName'];
                $email = $_POST['userEmail'];

                // Initialize MySQLi connection
                $params = [$firstname, $lastname, $username, $email, $userid];
                $adminModel = new MusicModel();
                $result = $adminModel->editUser($params);
                if ($result) {
                    echo json_encode(['result' => true]);
                    exit;
                } else {
                    echo json_encode(['error' => 'Error executing query.']);
                    exit;
                }
            } catch (Exception $e) {
                // Exception handling
                echo json_encode(array('error' => $e->getMessage()));
            }
        } else {
            // Method not supported handling
            echo json_encode(array('error' => 'Method not supported'));
        }
    }



    public function deleteUser()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) === 'POST') {
            try {
                // Retrieve form data
                $hiddenId = $_POST['deleteUserId'];

                // Initialize MySQLi connection
                $params = [$hiddenId];
                $adminModel = new MusicModel();
                $result = $adminModel->deleteUser($params);

                if ($result) {
                    echo json_encode(['result' => true]);
                    exit;
                } else {
                    echo json_encode(['error' => 'Error executing query.']);
                    exit;
                }
            } catch (Exception $e) {
                // Exception handling
                echo json_encode(array('error' => $e->getMessage()));
            }
        } else {
            // Method not supported handling
            echo json_encode(array('error' => 'Method not supported'));
        }
    }


    public function fetchAll()
    {
        try {
            $adminModel = new MusicModel();

            $songs = $adminModel->getSongsAll();
            $genres = $adminModel->getGenreAll();
            $artists = $adminModel->getArtistAll();
            $users = $adminModel->getUserAll();
            $albums = $adminModel->getAlbumAll();
            $playlists = $adminModel->getplaylistAll();
            $playlistsSongs = $adminModel->getplaylistAllSongs();

            if ($songs !== false && $genres !== false && $artists !== false) {
                $result = [
                    'totalsongs' => $songs,
                    'totalgenres' => $genres,
                    'totalartists' => $artists,
                    'totalusers' => $users,
                    'totalalbums' => $albums,
                    'totalplaylists' => $playlists,
                    'totalplaylistsongs' => $playlistsSongs
                ];

                echo json_encode($result);
            } else {
                echo json_encode(['error' => 'Error fetching data.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }


    public function topCharts()
    {
        try {
            $adminModel = new MusicModel();

            $songs = $adminModel->getSongsCount();

            if ($songs !== false) {
                echo json_encode($songs);
            } else {
                echo json_encode(['error' => 'Error fetching data.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }


    public function newReleases()
    {
        try {
            $adminModel = new MusicModel();

            $songs = $adminModel->getSongsReleases();

            if ($songs !== false) {
                echo json_encode($songs);
            } else {
                echo json_encode(['error' => 'Error fetching data.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }


    public function addCount()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) === 'GET') {
            try {
                $id = $_GET['id'];
                // Initialize MySQLi connection
                $params = [$id];
                $adminModel = new MusicModel();
                $result = $adminModel->addCount($params);
                if ($result) {
                    echo json_encode(['result' => true]);
                    exit;
                } else {
                    echo json_encode(['error' => 'Error executing query.']);
                    exit;
                }
            } catch (Exception $e) {
                // Exception handling
                echo json_encode(array('error' => $e->getMessage()));
            }
        } else {
            // Method not supported handling
            echo json_encode(array('error' => 'Method not supported'));
        }
    }


    public function addRecent()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) === 'GET') {
            try {
                $id = $_GET['songid'];
                // Initialize MySQLi connection
                $params = [$id, $_SESSION['id']];
                $adminModel = new MusicModel();
                $result = $adminModel->addRecent($params);
                if ($result) {
                    echo json_encode(['result' => true]);
                    exit;
                } else {
                    echo json_encode(['error' => 'Error executing query.']);
                    exit;
                }
            } catch (Exception $e) {
                // Exception handling
                echo json_encode(array('error' => $e->getMessage()));
            }
        } else {
            // Method not supported handling
            echo json_encode(array('error' => 'Method not supported'));
        }
    }


    public function getRecentsFive()
    {
        try {
            $adminModel = new MusicModel();

            $songdetails = $adminModel->getRecentsFive([$_SESSION['id']]);

            if ($songdetails !== false) {
                echo json_encode($songdetails);
            } else {
                echo json_encode(['error' => 'Error fetching data.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }


    function register()
    {
        header('Content-Type: application/json');

        try {
            // Sanitize and validate input
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $first_name = htmlspecialchars($_POST['firstName']);
            $last_name = htmlspecialchars($_POST['lastName']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            if (!$email || !$first_name || !$last_name || !$password) {
                throw new Exception('Invalid input data');
            }

            // Check if the user already exists
            $adminModel = new MusicModel();
            $userExists = $adminModel->checkUserExists([$email]);

            if ($userExists) {
                echo json_encode(['result' => 'User already exists']);
            } else {
                // Proceed with registration
                $params = [$email, $first_name, $last_name, $password];
                $result = $adminModel->register($params);

                // Assuming $result is a boolean indicating success or failure
                if ($result) {
                    echo json_encode(['result' => 'Registration successful']);
                } else {
                    echo json_encode(['result' => 'Registration failed']);
                }
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }



    public function login()
    {
        header('Content-Type: application/json');

        try {
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'];

            if (!$email || !$password) {
                throw new Exception('Invalid input data');
            }

            $adminModel = new MusicModel();
            $loginResult = $adminModel->login($email, $password);

            echo json_encode($loginResult);
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }



    public function searchBar()
    {
        try {
            $text = $_GET['text'];
            $adminModel = new MusicModel();

            $songs = $adminModel->searchSongs($text);
            $albums = $adminModel->searchAlbums($text);
            $artists = $adminModel->searchArtists($text);

            if ($songs !== false && $albums !== false && $artists !== false) {
                $result = [
                    'searchsongs' => $songs,
                    'searchartists' => $artists,
                    'searchalbums' => $albums
                ];

                echo json_encode($result);
            } else {
                echo json_encode(['error' => 'Error fetching data.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }



    public function getRecentsAll()
    {
        try {
            $adminModel = new MusicModel();

            $songdetails = $adminModel->getRecentsFive([$_SESSION['id']]);

            if ($songdetails !== false) {
                echo json_encode($songdetails);
            } else {
                echo json_encode(['error' => 'Error fetching data.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }


    public function historyDelete()
    {
        try {
            // Check if the user is logged in
            if (!isset($_SESSION['id'])) {
                echo json_encode(['error' => 'User not logged in.']);
                exit;
            }

            $userId = $_SESSION['id'];
            $adminModel = new MusicModel();

            // Call the deleteAllRecents method to delete all recent songs for the user
            $result = $adminModel->deleteAllRecents($userId);

            if ($result !== false) {
                echo json_encode(['success' => 'All recent songs deleted successfully.']);
            } else {
                echo json_encode(['error' => 'Error deleting recent songs.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }


    function checkAuthentication()
    {
        if (isset($_SESSION['first']) && isset($_SESSION['last']) && isset($_SESSION['id'])) {
            $userInfo = [
                'authenticated' => true,
                'first' => $_SESSION['first'],
                'last' => $_SESSION['last'],
                'id' => $_SESSION['id']
            ];
            echo json_encode($userInfo);
        } else {
            echo json_encode(['authenticated' => false]);
        }
    }


    function logout()
    {
        session_unset();
        session_destroy();
        echo json_encode(['status' => 'successfully logout']);
    }


    public function favAlbum()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) === 'GET') {
            try {
                $albumid = $_GET['albumId'];
                $userid = $_SESSION['id'];

                // Check if the user has already favorited the album
                $adminModel = new MusicModel();
                $isFavorited = $adminModel->isAlbumFavourited([$userid, $albumid]);

                if ($isFavorited) {
                    // User has already favorited the album, so remove it
                    $result = $adminModel->removeFavAlbum([$userid, $albumid]);
                    $response = ['result' => 'removed'];
                } else {
                    // User has not favorited the album, so add it
                    $result = $adminModel->addFavAlbum([$userid, $albumid]);
                    $response = ['result' => 'added'];
                }

                if ($result) {
                    echo json_encode($response);
                    exit;
                } else {
                    echo json_encode(['error' => 'Error executing query.']);
                    exit;
                }
            } catch (Exception $e) {
                // Exception handling
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            // Method not supported handling
            echo json_encode(['error' => 'Method not supported']);
        }
    }



    public function getAllFavAlbum()
    {
        try {
            $adminModel = new MusicModel();

            $favdetails = $adminModel->getfavAlbumAll($_SESSION['id']);

            if ($favdetails !== false) {
                echo json_encode($favdetails);
            } else {
                echo json_encode(['error' => 'Error fetching data.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }



    public function favRecentSix()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) === 'GET') {
            try {
                $songid = $_GET['songId'];
                $userid = $_SESSION['id'];

                // Check if the user has already favorited the album
                $adminModel = new MusicModel();
                $isFavorited = $adminModel->isRecentFavourited([$userid, $songid]);

                if ($isFavorited) {
                    // User has already favorited the album, so remove it
                    $result = $adminModel->removeFavRecent([$userid, $songid]);
                    $response = ['result' => 'removed'];
                } else {
                    // User has not favorited the album, so add it
                    $result = $adminModel->addFavRecent([$userid, $songid]);
                    $response = ['result' => 'added'];
                }

                if ($result) {
                    echo json_encode($response);
                    exit;
                } else {
                    echo json_encode(['error' => 'Error executing query.']);
                    exit;
                }
            } catch (Exception $e) {
                // Exception handling
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            // Method not supported handling
            echo json_encode(['error' => 'Method not supported']);
        }
    }



    public function getAllFavRecent()
    {
        try {
            $adminModel = new MusicModel();

            $favdetails = $adminModel->getfavRecentAll($_SESSION['id']);

            if ($favdetails !== false) {
                echo json_encode($favdetails);
            } else {
                echo json_encode(['error' => 'Error fetching data.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }



    public function favourites()
    {
        try {
            $adminModel = new MusicModel();

            $favsongs = $adminModel->getfavRecentAll($_SESSION['id']);
            $favalbums = $adminModel->getfavAlbumAll($_SESSION['id']);

            if ($favsongs !== false && $favalbums !== false) {
                $result = [
                    'favsongs' => $favsongs,
                    'favalbums' => $favalbums
                ];

                echo json_encode($result);
            } else {
                echo json_encode(['error' => 'Error fetching data.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }

        exit;
    }


    public function createPlaylist()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['playlistName'])) {
            $name = $_POST['playlistName'];

            try {
                $adminModel = new MusicModel();
                $result = $adminModel->createPlaylist([$name, $_SESSION['id']]);
                if ($result) {
                    echo json_encode(['result' => true]);
                    exit;
                } else {
                    echo json_encode(['error' => 'Error executing query.']);
                    exit;
                }
            } catch (Exception $e) {
                echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
                exit;
            }
        } else {
            echo json_encode(['error' => 'Invalid request']);
            exit;
        }
    }


    public function showPlaylist()
    {
        try {
            $adminModel = new MusicModel();
            $result = $adminModel->showPlaylist([$_SESSION['id']]);

            if ($result !== false) {
                echo json_encode($result);
            } else {
                echo json_encode(['error' => 'Error fetching playlists.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }
        exit;
    }



    public function deletePlaylist()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) === 'GET') {
            try {
                // Retrieve form data
                $playlistId = $_GET['playlistId'];

                // Initialize MySQLi connection
                $params = [$playlistId];
                $adminModel = new MusicModel();
                $result = $adminModel->deletePlaylist($params);

                if ($result) {
                    echo json_encode(['result' => true]);
                    exit;
                } else {
                    echo json_encode(['error' => 'Error executing query.']);
                    exit;
                }
            } catch (Exception $e) {
                // Exception handling
                echo json_encode(array('error' => $e->getMessage()));
            }
        } else {
            // Method not supported handling
            echo json_encode(array('error' => 'Method not supported'));
        }
    }


    public function addToPlaylist()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['playlist']) && isset($_POST['song_id'])) {
            $name = $_POST['playlist'];
            $songId = $_POST['song_id']; // Update to match the parameter name

            try {
                $adminModel = new MusicModel();
                $result = $adminModel->addToPlaylist([$name, $songId]);
                if ($result) {
                    echo json_encode(['result' => true]);
                    exit;
                } else {
                    echo json_encode(['error' => 'Error executing query.']);
                    exit;
                }
            } catch (Exception $e) {
                echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
                exit;
            }
        } else {
            echo json_encode(['error' => 'Invalid request']);
            exit;
        }
    }


    public function getPlaylistSongs()
    {
        try {
            $adminModel = new MusicModel();
            $result = $adminModel->getPlaylistSongs([$_GET['playId']]);

            if ($result !== false) {
                echo json_encode($result);
            } else {
                echo json_encode(['error' => 'Error fetching playlists.']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
        }
        exit;
    }

}