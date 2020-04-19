<?php
  class Users extends Controller {
    public function __construct(){
        $this->userModel = $this->model('User');
    }

    public function register(){
      // Check for POST method
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        // trim clears white space
        $data =[
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Validate Email
        // check email is not empty
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter email';
        } else {
            // check email already exists
            if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err'] = 'Account with this email already exists';
            }
        }

        // Validate Name
        // check name is not empty
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name';
        }

        // Validate Password
        // check password is not empty and it is longer than 6 characters
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password';
        } elseif(strlen($data['password']) < 6){
          $data['password_err'] = 'Password must be at least 6 characters';
        }

        // Validate Confirm Password
        // check confirm password is not empty and == password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Please confirm password';
        } else {
          if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Passwords do not match';
          }
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          // Validated
          
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          // if for checking it went well
          if($this->userModel->register($data)){
              flash('register_success', 'You are registered and can log in');
            redirect('/users/login');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('users/register', $data);
        }

      } else {
        // Init data
        $data =[
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Load view
        $this->view('users/register', $data);
      }
    }

    public function login(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Process form
          // Sanitize POST data
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          // Init data
          $data =[
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'email_err' => '',
            'password_err' => '',      
          ];
  
          // Validate Email
          if(empty($data['email'])){
            $data['email_err'] = 'Pleae enter email';
          }
  
          // Validate Password
          if(empty($data['password'])){
            $data['password_err'] = 'Please enter password';
          }
  
          // Check for user/email
          if($this->userModel->findUserByEmail($data['email'])){
            // User found
          } else {
            // User not found
            $data['email_err'] = 'No user found';
          }
  
          // Make sure errors are empty
          if(empty($data['email_err']) && empty($data['password_err'])){
            // Validated
            // Check and set logged in user
            // not hashed password here. that is done inside the model
            $loggedInUser = $this->userModel->login($data['email'], $data['password']);
  
            // if user was logged in create session. else render form with error
            if($loggedInUser){
              // Create Session
              // user comes from row returned form model 
              $this->createUserSession($loggedInUser);
            } else {
              $data['password_err'] = 'Password incorrect';
  
              $this->view('users/login', $data);
            }
          } else {
            // Load view with errors
            $this->view('users/login', $data);
          }
  
  
        } else {
          // Init data
          $data =[    
            'email' => '',
            'password' => '',
            'email_err' => '',
            'password_err' => '',        
          ];
  
          // Load view
          $this->view('users/login', $data);
        }
      }
  
      // create user session. Takes user as variable
      public function createUserSession($user){
        // superblobal variable
        // set user details
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['admin'] = $user->admin;
        // from here redirect to which controller and view you would like. this is currently re directing to home page
        redirect('pages/index');
      }
  
      // logout function. clears session variables
      public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['admin']);
        // clears session
        session_destroy();
        redirect('users/login');
      }
  
      public function manage(){
        if(!isLoggedIn()){
          redirect('users/login');
        } else if (!$_SESSION['admin'] > 0){
          redirect('pages/index');
        }

        $users = $this->userModel->getUsers();

        // set data as users
        $data = [
          'users' => $users
        ];
        $this->view('users/manage', $data);

      }

      public function edit($id){
        if(!isLoggedIn()){
          redirect('users/login');
        } else if ($_SESSION['admin'] > 0){
          
          $user = $this->userModel->getUserById($id);

          $data = [
            'user' => $user
          ];
          $this->view('users/edit', $data);
        } else if($_SESSION['user_id'] === $id){
          $user = $this->userModel->getUserById($id);

          $data = [
            'user' => $user
          ];
          $this->view('users/edit', $data);
        } else {
          redirect('pages/index');
        }

      }
  }