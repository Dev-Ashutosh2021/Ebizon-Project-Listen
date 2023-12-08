<?php
session_start();
require_once PROJECT_ROOT_PATH . "./model/Database.php";

class MusicModel extends Database
{
    
    public function addArtist($params)
    {
        return $this->executeStatement("INSERT INTO artists (name, thumbnail) VALUES (?, ?)", "ss", $params);
    }



    public function addGenre($params)
    {
        return $this->executeStatement("INSERT INTO genres (name) VALUES (?)", "s", $params);
    }



    public function getArtist()
    {
        return $this->select("SELECT * FROM artists");
    }




    public function getGenre()
    {
        return $this->select("SELECT * FROM genres");
    }



    public function addSong($params)
    {
        return $this->executeStatement("INSERT INTO songs (title, duration, artist_id, file_path, thumbnail, genre_id) VALUES (?,?,?,?,?,?)","ssissi",$params);
    }



    public function getSongsAll()
    {
        return $this->select("SELECT * FROM songs");
    }



    public function getArtistAll()
    {
        return $this->select("SELECT * FROM artists");
    }



    public function getGenreAll()
    {
        return $this->select("SELECT * FROM genres");
    }


    public function getUserAll()
    {
        return $this->select("SELECT * FROM users");
    }


    public function editSong($params)
    {
        return $this->executeStatement("UPDATE songs SET title=?, duration=?, artist_id=?, file_path=?, thumbnail=?, genre_id=? WHERE song_id=?","ssissii",$params);
    }



    public function deleteSong($params)
    {
        return $this->executeStatement("DELETE FROM songs WHERE song_id=?","i",$params);
    }



    public function getUsersAll()
    {
        return $this->select("SELECT * FROM users");
    }



    public function editUser($params)
    {
        return $this->executeStatement("UPDATE users SET first_name=?, last_name=?, username=?, email=? WHERE user_id=?","ssssi",$params);
    }



    public function deleteUser($params)
    {
        return $this->executeStatement("DELETE FROM users WHERE user_id=?","i",$params);
    }


    public function getAlbumAll()
    {
        return $this->select("SELECT * FROM albums LIMIT 5");
    }


    public function getSongsCount()
    {
        return $this->select("SELECT * FROM `songs` ORDER BY `play_count` DESC LIMIT 6");
    }


    public function getSongsReleases()
    {
        return $this->select("SELECT * FROM `songs` ORDER BY uploaded_at DESC LIMIT 6");
    }


    public function addCount($params)
    {
        return $this->executeStatement("UPDATE songs SET play_count=play_count+1 WHERE song_id=?","i",$params);
    }



    public function addRecent($params)
    {
        return $this->executeStatement("INSERT INTO recently_played (song_id,user_id) VALUES (?,?)", "ii", $params);
    }



    public function getRecentsFive($id)
    {
        return $this->select("SELECT song_id, MAX(play_time) AS max_play_time FROM recently_played WHERE user_id = ? GROUP BY song_id ORDER BY max_play_time DESC LIMIT 6","i",$id);
    }


    public function register($params)
    {
        return $this->executeStatement("INSERT INTO users (email,first_name,last_name,password_hash) VALUES (?,?,?,?)","ssss",$params);
    }



    public function checkUserExists($email)
    {
        $stmt= $this->executeStatement("SELECT * from users where email=?","s",$email);
        if($stmt->get_result()->num_rows > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }



    public function login($email, $password)
    {
        $userData = $this->getUserByEmail($email);

        if ($userData) {
            // Verify the password
            if (password_verify($password, $userData['password_hash'])) {
                // Password is correct, return user data
                $_SESSION['first']=$userData['first_name'];
                $_SESSION['last']=$userData['last_name'];
                $_SESSION['id']=$userData['user_id'];
                return ['result' => 'Login successful', 'user_data' => $userData];
            } else {
                // Incorrect password
                return ['result' => 'Incorrect password'];
            }
        } else {
            // User not found
            return ['result' => 'User not found'];
        }
    }


    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = ?";
        $types = "s";
        $params = [$email];

        try {
            $result = $this->select($query, $types, $params);

            // Check if there is at least one row in the result set
            if (!empty($result)) {
                // Return the first row (assuming email is unique)
                return $result[0];
            } else {
                // User not found
                return null;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }


    public function searchSongs($text)
    {
        return $this->select("SELECT * FROM songs WHERE title LIKE '$text%'");
    }


    public function searchAlbums($text)
    {
        return $this->select("SELECT * FROM albums WHERE title LIKE '$text%'");
    }


    public function searchArtists($text)
    {
        return $this->select("SELECT * FROM artists WHERE name LIKE '$text%'");
    }
    

    public function getRecentsAll($id)
    {
        return $this->select("SELECT song_id, MAX(play_time) AS max_play_time FROM recently_played WHERE user_id = ? GROUP BY song_id ORDER BY max_play_time DESC","i",$id);
    }


    public function deleteAllRecents($userId)
    {
        return $this->executeStatement("DELETE FROM recently_played WHERE user_id = ?", "i", [$userId]);
    }


    public function addFavAlbum($params)
    {
        return $this->executeStatement("INSERT into user_favorites_albums(user_id,album_id) VALUES (?,?)","ii",$params);
    }


    public function isAlbumFavourited($params)
    {
        $result = $this->select("SELECT COUNT(*) as count FROM user_favorites_albums WHERE user_id = ? AND album_id = ?", "ii", $params);

        if ($result && isset($result[0]['count'])) {
            return ($result[0]['count'] > 0);
        } else {
            // Handle the case where the query did not return the expected result
            return false;
        }
    }


    public function removeFavAlbum($params)
    {
        return $this->executeStatement("DELETE FROM user_favorites_albums WHERE user_id = ? AND album_id = ?", "ii", $params);
    }


    public function getfavAlbumAll($userid)
    {
        return $this->select("SELECT * FROM user_favorites_albums WHERE user_id='$userid'");
    }



    
    public function addFavRecent($params)
    {
        return $this->executeStatement("INSERT into user_favorites_songs(user_id,song_id) VALUES (?,?)","ii",$params);
    }


    public function isRecentFavourited($params)
    {
        $result = $this->select("SELECT COUNT(*) as count FROM user_favorites_songs WHERE user_id = ? AND song_id = ?", "ii", $params);

        if ($result && isset($result[0]['count'])) {
            return ($result[0]['count'] > 0);
        } else {
            // Handle the case where the query did not return the expected result
            return false;
        }
    }


    public function removeFavRecent($params)
    {
        return $this->executeStatement("DELETE FROM user_favorites_songs WHERE user_id = ? AND song_id = ?", "ii", $params);
    }


    public function getfavRecentAll($userid)
    {
        return $this->select("SELECT * FROM user_favorites_songs WHERE user_id='$userid'");
    }


    public function createPlaylist($params)
    {
        return $this->executeStatement("INSERT INTO playlists (title,user_id) VALUES (?,?)", "si", $params);
    }


    public function showPlaylist($params)
    {
        return $this->select("SELECT * FROM playlists where user_id=?","i",$params);
    }



    public function deletePlaylist($params)
    {
        return $this->executeStatement("DELETE FROM playlists WHERE playlist_id=?","i",$params);
    }


    public function getplaylistAll()
    {
        return $this->select("SELECT * FROM playlists");
    }


    public function getplaylistAllSongs()
    {
        return $this->select("SELECT * FROM playlist_songs");
    }


    public function addToPlaylist($params)
    {
        return $this->executeStatement("INSERT INTO playlist_songs (playlist_id,song_id) VALUES (?,?)", "ii", $params);
    }


    public function getPlaylistSongs($params)
    {
        return $this->select("SELECT * FROM playlist_songs where playlist_id=?","i",$params);
    }
}
?>