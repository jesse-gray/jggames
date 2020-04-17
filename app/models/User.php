<?php
  class User {
    // property of database
    private $db;

    public function __construct(){
      // initialize DB
      $this->db = new Database;
    }

    // Register new User
    public function register($data) {
      // create statement
      $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');

      // bind variables in statement
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);

      // Execute query
      // in if statement so when can check that execute was succsessful
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }

    }

    // Find user by email
    // used to check if email exists in database
    public function findUserByEmail($email){
      // create statement
      $this->db->query('SELECT * FROM users WHERE email = :email');
      // bind variables in statement
      $this->db->bind(':email', $email);
      // return row. only single as we are only querying for one row
      $row = $this->db->single();

      // Check row
      // if row was returned
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }

    
  }