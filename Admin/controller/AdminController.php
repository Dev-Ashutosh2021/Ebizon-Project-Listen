<?php
class AdminController extends BaseController
{

    public function addSong()
    {
        function resizeImage($sourcePath, $destinationPath, $newWidth, $newHeight)
        {
            list($originalWidth, $originalHeight, $type) = getimagesize($sourcePath);

            switch ($type) {
                case IMAGETYPE_JPEG:
                    $sourceImage = imagecreatefromjpeg($sourcePath);
                    break;
                case IMAGETYPE_PNG:
                    $sourceImage = imagecreatefrompng($sourcePath);
                    break;
                case IMAGETYPE_GIF:
                    $sourceImage = imagecreatefromgif($sourcePath);
                    break;
                default:
                    return false;
            }

            $destinationImage = imagecreatetruecolor($newWidth, $newHeight);

            if ($type == IMAGETYPE_PNG || $type == IMAGETYPE_GIF) {
                imagecolortransparent($destinationImage, imagecolorallocatealpha($destinationImage, 0, 0, 0, 127));
                imagealphablending($destinationImage, false);
                imagesavealpha($destinationImage, true);
            }

            imagecopyresampled($destinationImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

            // Use the same name and extension for the resized image
            switch ($type) {
                case IMAGETYPE_JPEG:
                    imagejpeg($destinationImage, $destinationPath, 100);
                    break;
                case IMAGETYPE_PNG:
                    imagepng($destinationImage, $destinationPath);
                    break;
                case IMAGETYPE_GIF:
                    imagegif($destinationImage, $destinationPath);
                    break;
            }

            imagedestroy($sourceImage);
            imagedestroy($destinationImage);

            return true;
        }



        require_once './assets/getid3/getid3.php';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) === 'POST') {
            try {
                // Retrieve form data
                $title = $_POST['title'];
                $artist = $_POST['artist'];
                $genre = $_POST['genre'];


                $originalFileName = basename($_FILES["thumbnail"]["name"]);
                $sourceImagePath = $_FILES["thumbnail"]["tmp_name"];

                // Construct the destination path with the same name and extension
                $destinationImagePath1 = '../Listen/images/cover/large/' . $originalFileName;
                $destinationImagePath2 = '../Listen/images/cover/small/' . $originalFileName;

                resizeImage($sourceImagePath, $destinationImagePath1, 320, 320);

                resizeImage($sourceImagePath, $destinationImagePath2, 128, 128);

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
                        $adminModel = new AdminModel();
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

        function resizeImg($sourcePath, $destinationPath, $newWidth, $newHeight)
        {
            list($originalWidth, $originalHeight, $type) = getimagesize($sourcePath);

            switch ($type) {
                case IMAGETYPE_JPEG:
                    $sourceImage = imagecreatefromjpeg($sourcePath);
                    break;
                case IMAGETYPE_PNG:
                    $sourceImage = imagecreatefrompng($sourcePath);
                    break;
                case IMAGETYPE_GIF:
                    $sourceImage = imagecreatefromgif($sourcePath);
                    break;
                default:
                    return false;
            }

            $destinationImage = imagecreatetruecolor($newWidth, $newHeight);

            if ($type == IMAGETYPE_PNG || $type == IMAGETYPE_GIF) {
                imagecolortransparent($destinationImage, imagecolorallocatealpha($destinationImage, 0, 0, 0, 127));
                imagealphablending($destinationImage, false);
                imagesavealpha($destinationImage, true);
            }

            imagecopyresampled($destinationImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

            // Use the same name and extension for the resized image
            switch ($type) {
                case IMAGETYPE_JPEG:
                    imagejpeg($destinationImage, $destinationPath, 100);
                    break;
                case IMAGETYPE_PNG:
                    imagepng($destinationImage, $destinationPath);
                    break;
                case IMAGETYPE_GIF:
                    imagegif($destinationImage, $destinationPath);
                    break;
            }

            imagedestroy($sourceImage);
            imagedestroy($destinationImage);

            return true;
        }



        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_FILES['thumbnail'])) {

            $original = basename($_FILES["thumbnail"]["name"]);
            $source = $_FILES["thumbnail"]["tmp_name"];

            // Construct the destination path with the same name and extension
            $destinationImagePath = '../Listen/images/artists/' . $original;
            resizeImg($source, $destinationImagePath, 320, 320);

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
                        $adminModel = new AdminModel();
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
                $adminModel = new AdminModel();
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
            $adminModel = new AdminModel();
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
            $adminModel = new AdminModel();
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
            $adminModel = new AdminModel();

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

                $adminModel = new AdminModel();

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
                $adminModel = new AdminModel();
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
            $adminModel = new AdminModel();

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
                $adminModel = new AdminModel();
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
                $adminModel = new AdminModel();
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
            $adminModel = new AdminModel();

            $songs = $adminModel->getSongsAll();
            $genres = $adminModel->getGenreAll();
            $artists = $adminModel->getArtistAll();
            $users = $adminModel->getUserAll();

            if ($songs !== false && $genres !== false && $artists !== false) {
                $result = [
                    'totalsongs' => $songs,
                    'totalgenres' => $genres,
                    'totalartists' => $artists,
                    'totalusers' => $users
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
}
