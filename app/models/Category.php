<?php
  class Category {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getCategories(){
      //$this->db->query('SELECT * FROM posts');
      $this->db->query('SELECT * FROM category');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addCategory($data){
      $this->db->query('INSERT INTO category (name) VALUES(:name)');
      // Bind values
      $this->db->bind(':name', $data['name']);


      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateCategory($data){
      $this->db->query('UPDATE category SET name = :name WHERE id = :id');
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

    public function getCategoryById($id){
      $this->db->query('SELECT * FROM category WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function getCategoryByName($name){
        $this->db->query('SELECT * FROM category WHERE name = :name');
        $this->db->bind(':name', $name);
  
        $row = $this->db->single();
  
        return $row;
      }


    public function deleteCategory($id){
      $this->db->query('DELETE FROM category WHERE id = :id');
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