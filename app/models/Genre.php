<?php
  class Genre {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getGenres(){
      $this->db->query('SELECT * FROM genre');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addGenre($data){
      $this->db->query('INSERT INTO genre (name) VALUES(:name)');
      // Bind values
      $this->db->bind(':name', $data['name']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateGenre($data){
      $this->db->query('UPDATE genre SET name = :name WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['name']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getGenreById($id){
      $this->db->query('SELECT * FROM genre WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function getGenreByName($name){
      $this->db->query('SELECT * FROM genre WHERE name = :name');
      $this->db->bind(':name', $name);

      $row = $this->db->single();

      return $row;
    }


    public function deleteGenre($id){
      $this->db->query('DELETE FROM genre WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    
  }