<?php
  class Order {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function addNewOrder($data){
        //calculate cost
        $this->db->query('SELECT SUM(price) AS price FROM products JOIN cart_product ON products.id = cart_product.product_id WHERE cart_product.user_id = :user_id;');
        // Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);

        $cost = $this->db->single()->price;

        //create address
        $this->db->query('INSERT INTO address (street_number, street_name, suburb, city, region, postcode) VALUES(:street_number, :street_name, :suburb, :city, :region, :postcode);');
        // Bind values
        $this->db->bind(':street_number', $data['street_number']);
        $this->db->bind(':street_name', $data['street_name']);
        $this->db->bind(':suburb', $data['suburb']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':region', $data['region']);
        $this->db->bind(':postcode', $data['postcode']);
        $this->db->execute();
        
        $this->db->query('SELECT LAST_INSERT_ID() AS id;');
        $address_id = $this->db->single()->id;

        //create order
        $this->db->query('INSERT INTO `"order"`(user_id, address_id, total) VALUES(:user_id, :address_id, :total)');
        // Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':address_id', $address_id);
        $this->db->bind(':total', $cost);
        $this->db->execute();
        
        $this->db->query('SELECT LAST_INSERT_ID() AS id;');
        $order_id = $this->db->single()->id;
        
        //echo "<script>console.log('order_id = $order_id');</script>";

        //create order lines
        $this->db->query('SELECT * FROM cart_product WHERE user_id = :user_id;');
        // Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        
        $results = $this->db->resultSet();

        foreach($results as $result){
            $this->db->query('INSERT INTO order_line( order_id, product_id, quantity) VALUES( :order_id, :product_id, :quantity);');
            
            // Bind values
            $this->db->bind(':order_id', $order_id);
            $this->db->bind(':product_id', $result->product_id);
            $this->db->bind(':quantity', $result->quantity);
            $this->db->execute();
        }
        
        //Remove item from stock
        $this->db->query('SELECT * FROM cart_product WHERE cart_product.user_id = :user_id');

        //Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);

        $results = $this->db->resultSet();

        foreach($results as $result){
          $this->db->query('UPDATE products SET quantity = quantity - :quantity WHERE id = :product_id;');
          
          // Bind values
          $this->db->bind(':quantity', $result->quantity);
          $this->db->bind(':product_id', $result->product_id);
          $this->db->execute();
      }

      

        //Empty shopping cart 
        $this->db->query('DELETE FROM cart_product WHERE user_id = :user_id');
        // Bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
        
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }    
    }
    
    public function getOrdersByUserId($user_id){      
      $this->db->query('SELECT `"order"`.id AS order_id, `"order"`.total, `"order"`.placed_date, `"order"`.shipped_date, address.* FROM `"order"` JOIN address On `"order"`.address_id = address.id WHERE user_id = :user_id');
      $this->db->bind(':user_id', $user_id);

      $results = $this->db->resultSet();

      return $results;
    }

    public function getOrderById($id){
      $this->db->query('SELECT `"order"`.id AS order_id, `"order"`.total, `"order"`.placed_date, `"order"`.shipped_date, address.*, order_line.quantity, products.name AS product_name, products.price, users.email, users.name AS user_name FROM `"order"` JOIN address ON `"order"`.address_id = address.id JOIN order_line ON `"order"`.id = order_line.order_id JOIN products ON order_line.product_id = products.id JOIN users ON `"order"`.user_id = users.id WHERE `"order"`.id = :id');
      $this->db->bind(':id', $id);

      $results = $this->db->resultSet();

      return $results;
    }
  }