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
      // create activation token
      $token = md5($_POST['email'].time());

      // create statement
      $this->db->query('INSERT INTO users (name, email, password, verification_token) VALUES(:name, :email, :password, :token)');

      // bind variables in statement
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':token', $token);

      // Execute query
      // in if statement so when can check that execute was succsessful
      if($this->db->execute()){
        $this->sendEmail($token, $data['email']);
        return true;
      } else {
        return false;
      }
    }

    // Send verification email
    public function sendEmail($token, $email){
        var_dump('here');
        $msg = "Welcome to JG Games\nPLease verify your email by clicking the following link: " . $URLROOT . "/users/confirm?token=$token";
        $msg = wordwrap($msg,70);
        mail($email,"Validate your email",$msg);
    }

    // Login User
    public function login($email, $password){
      // get user by email
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      // get hashed password
      $hashed_password = $row->password;
      // password verify will check password entered against hashed password in db
      if(password_verify($password, $hashed_password)){
        return $row;
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

     // Get User by ID
     public function getUserById($id){
      $this->db->query('SELECT * FROM users WHERE id = :id');
      // Bind value
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    // Get all users
    public function getUsers(){
      $this->db->query('SELECT * FROM users');

      $results = $this->db->resultSet();

      return $results;
    }

    public function updateUser($data){
      $this->db->query('UPDATE users SET name = :name, email = :email, password = :password, admin = :admin WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':admin', $data['is_admin'] == 'on' ? 1 : 0);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function deleteUser($id){
      $this->db->query('DELETE FROM users WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function confirmEmail($token){      
      $this->db->query('UPDATE users SET is_verified = true WHERE verification_token = :token');
      // Bind values
      $this->db->bind(':token', $token);
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function isUserVerified($email){
      $this->db->query('SELECT is_verified FROM users WHERE email = :email AND is_verified = 1');
      // Bind values
      $this->db->bind(':email', $email);
      if($this->db->single()){
        return true;
      } else {
        return false;
      }

    }
  }