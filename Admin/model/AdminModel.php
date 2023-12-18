<?php
session_start();
require_once PROJECT_ROOT_PATH . "./model/Database.php";

class AdminModel extends Database
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


    public function login($email, $password)
    {
        $userData = $this->getUserByEmail($email);

        if ($userData) {
            // Verify the password
            if (password_verify($password, $userData['password'])) {
                // Password is correct, return user data
                $_SESSION['first']=$userData['first_name'];
                $_SESSION['last']=$userData['last_name'];
                $_SESSION['admin_id']=$userData['admin_id'];

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
        $query = "SELECT * FROM admin WHERE email = ?";
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


    public function register($params)
    {
        return $this->executeStatement("INSERT INTO admin (email,first_name,last_name,password) VALUES (?,?,?,?)","ssss",$params);
    }



    public function checkUserExists($email)
    {
        $stmt= $this->executeStatement("SELECT * from admin where email=?","s",$email);
        if($stmt->get_result()->num_rows > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}
?>