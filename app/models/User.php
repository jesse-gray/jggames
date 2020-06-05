<?php
class User {
  // property of database
  private $db;

  public function __construct(){
    // initialize DB
    $this->db = new Database;
  }

  public function register($data) {
    // Register new user
    // Create activation token
    $token = md5($_POST['email'].time());

    // Create statement
    $this->db->query('INSERT INTO users 
                      (name, email, password, verification_token) 
                      VALUES
                      (:name, :email, :password, :token)');

    // Bind values
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);
    $this->db->bind(':token', $token);

    // Execute query
    if($this->db->execute())
    {
      $this->sendEmail($token, $data['email']);
      return true;
    } 
    else 
    {
      return false;
    }
  }

  public function sendEmail($token, $email){
      // Send verification email when registering
      $msg = "Welcome to JG Games\nPLease verify your email by clicking the following link: " . $URLROOT . "/users/confirm?token=$token";
      $msg = wordwrap($msg,70);
      mail($email,"Validate your email",$msg);
  }

  public function login($email, $password){
    // Login user
    $this->db->query('SELECT * FROM users WHERE email = :email');
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    $hashed_password = $row->password;
    
    if(password_verify($password, $hashed_password)){
      return $row;
    } else {
      return false;
    }
  }

  public function findUserByEmail($email){
    // Find user by email
    // Used to check if email exists in database
    $this->db->query('SELECT * FROM users WHERE email = :email');
    
    // Bind values
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    if($this->db->rowCount() > 0)
    {
      return true;
    } 
    else 
    {
      return false;
    }
  }

    // Get User by ID
    public function getUserById($id){
    $this->db->query('SELECT * FROM users WHERE id = :id');

    // Bind values
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
    $this->db->query('UPDATE users SET 
                      name = :name, 
                      email = :email, 
                      password = :password, 
                      admin = :admin 
                      WHERE id = :id');

    // Bind values
    $this->db->bind(':id', $data['id']);
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':password', $data['password']);
    $this->db->bind(':admin', $data['is_admin'] == 'on' ? 1 : 0);

    // Execute
    if($this->db->execute()){
      return true;
    } 
    else 
    {
      return false;
    }
  }

  public function deleteUser($id){
    $this->db->query('DELETE FROM users WHERE id = :id');

    // Bind values
    $this->db->bind(':id', $id);

    // Execute
    if($this->db->execute())
    {
      return true;
    } 
    else 
    {
      return false;
    }
  }

  public function confirmEmail($token){      
    $this->db->query('UPDATE users SET is_verified = true WHERE verification_token = :token');

    // Bind values
    $this->db->bind(':token', $token);
    if($this->db->execute())
    {
      return true;
    } 
    else 
    {
      return false;
    }
  }

  public function isUserVerified($email){
    $this->db->query('SELECT is_verified FROM users WHERE email = :email AND is_verified = 1');

    // Bind values
    $this->db->bind(':email', $email);

    if($this->db->single())
    {
      return true;
    } 
    else 
    {
      return false;
    }
  }
}