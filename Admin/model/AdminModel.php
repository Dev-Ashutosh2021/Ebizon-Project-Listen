<?php
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

}
?>