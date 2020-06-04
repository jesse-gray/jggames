<?php
  class Product {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getProducts(){
      $this->db->query('SELECT * FROM products WHERE quantity > 0');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addProduct($data){
      $this->db->query('INSERT INTO products (name, quantity, price, description, image_link, genre_id, category_id, long_description) VALUES(:name, :quantity, :price, :description, :image_link, :genre_id, :category_id, :long_description)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':quantity', $data['quantity']);
      $this->db->bind(':price', $data['price']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':image_link', $data['image_link']);
      $this->db->bind(':genre_id', $data['genre_id']);
      $this->db->bind(':category_id', $data['category_id']);
      $this->db->bind(':long_description', $data['long_description']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateProduct($data){
      $this->db->query('UPDATE products SET name = :name, quantity = :quantity, price = :price, description = :description, image_link = :image_link, genre_id = :genre_id, category_id = :category_id, long_description = :long_description WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':quantity', $data['quantity']);
      $this->db->bind(':price', $data['price']);
      $this->db->bind(':description', $data['description']);
      $this->db->bind(':image_link', $data['image_link']);
      $this->db->bind(':genre_id', $data['genre_id']);
      $this->db->bind(':category_id', $data['category_id']);
      $this->db->bind(':long_description', $data['long_description']);

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

    public function getProductByGenreId($id){
      $this->db->query('SELECT * FROM products WHERE genre_id = :id');
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
      $this->db->query('SELECT * FROM products JOIN cart_product ON products.id = cart_product.product_id WHERE cart_product.user_id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      $results = $this->db->resultSet();

      return $results;
    }

    public function addProductToCart($user_id, $product_id){
      $this->db->query('SELECT * FROM cart_product WHERE user_id = :user_id AND product_id = :product_id');
      // Bind values
      $this->db->bind(':user_id', $user_id);
      $this->db->bind(':product_id', $product_id);

      $result = $this->db->resultSet();

      if(Count($result) == 0){
        $this->db->query('INSERT INTO cart_product(user_id, product_id) VALUES(:user_id, :product_id)');
	  }else{        
        $this->db->query('UPDATE cart_product SET quantity = quantity + 1 WHERE user_id = :user_id AND product_id = :product_id');
	  }
      // Bind values
      $this->db->bind(':user_id', $user_id);
      $this->db->bind(':product_id', $product_id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }        
	}

    public function removeProductFromCart($user_id, $product_id){
      echo "<script>console.log('ProductModel: UserID = $user_id and ProductID = $product_id');</script>";
      $this->db->query('DELETE FROM cart_product WHERE user_id = :user_id AND product_id = :product_id');
      // Bind values
      $this->db->bind(':user_id', $user_id);
      $this->db->bind(':product_id', $product_id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function getProductBySearch($text){


      $this->db->query('SELECT * FROM products WHERE description LIKE :text AND price BETWEEN :min AND :max ');
      $this->db->bind(':text', '%'.$text['text_search'].'%');
      $this->db->bind(':min', $text['min_price_search'] === '' ? 0 : $text['min_price_search']);
      $this->db->bind(':max', $text['max_price_search'] === '' ? 99999999 : $text['max_price_search']);

      $results = $this->db->resultSet();

      return $results;
    }
    
  }