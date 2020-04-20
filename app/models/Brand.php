<?php
  class Brand {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getBrands(){
      //$this->db->query('SELECT * FROM posts');
      $this->db->query('SELECT * FROM brand');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addBrand($data){
      $this->db->query('INSERT INTO brand (name) VALUES(:name)');
      // Bind values
      $this->db->bind(':name', $data['name']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateBrand($data){
      $this->db->query('UPDATE brand SET name = :name WHERE id = :id');
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

    public function getBrandById($id){
      $this->db->query('SELECT * FROM brand WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function getBrandByName($name){
      $this->db->query('SELECT * FROM brand WHERE name = :name');
      $this->db->bind(':name', $name);

      $row = $this->db->single();

      return $row;
    }


    public function deleteBrand($id){
      $this->db->query('DELETE FROM brand WHERE id = :id');
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