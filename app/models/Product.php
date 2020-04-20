<?php
  class Product {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getProducts(){
      //$this->db->query('SELECT * FROM posts');
      $this->db->query('SELECT * FROM products');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addProduct($data){
      $this->db->query('INSERT INTO products (name, quantity, price, description) VALUES(:name, :quantity, :price, :description)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':quantity', $data['quantity']);
      $this->db->bind(':price', $data['price']);
      $this->db->bind(':description', $data['description']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateProduct($data){
      $this->db->query('UPDATE products SET name = :name, quantity = :quantity, price = :price, description = :description WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':quantity', $data['quantity']);
      $this->db->bind(':price', $data['price']);
      $this->db->bind(':description', $data['description']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getProductById($id){
      $this->db->query('SELECT * FROM products WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function deleteProduct($id){
      $this->db->query('DELETE FROM products WHERE id = :id');
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