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
      $this->db->query('INSERT INTO products (name, quantity, price, description, brand_id, category_id) VALUES(:name, :quantity, :price, :description, :brand_id, :category_id)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':quantity', $data['quantity']);
      $this->db->bind(':price', $data['price']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':brand_id', $data['brand_id']);
      $this->db->bind(':category_id', $data['category_id']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateProduct($data){
      $this->db->query('UPDATE products SET name = :name, quantity = :quantity, price = :price, description = :description, brand_id = :brand_id, category_id = :category_id WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':quantity', $data['quantity']);
      $this->db->bind(':price', $data['price']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':brand_id', $data['brand_id']);
      $this->db->bind(':category_id', $data['category_id']);

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

    public function getProductByCategoryId($id){
      $this->db->query('SELECT * FROM products WHERE category_id = :id');
      $this->db->bind(':id', $id);

      $results = $this->db->resultSet();

      return $results;
    }

    public function getProductByBrandId($id){
      $this->db->query('SELECT * FROM products WHERE brand_id = :id');
      $this->db->bind(':id', $id);

      $results = $this->db->resultSet();

      return $results;
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
    

    public function getCartProducts($id){
      $this->db->query('SELECT * FROM products JOIN cart_line ON products.id = cart_line.product_id JOIN cart ON cart_line.id = cart.id WHERE cart.user_id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      $results = $this->db->resultSet();

      return $results;
    }


    public function removeProductFromCart($id){
      $this->db->query('DELETE FROM cart_line WHERE id = :id');
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