<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // Check for POST method
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            // Trim clears white space
            $data = ['name' => trim($_POST['name']) , 'email' => trim($_POST['email']) , 'password' => trim($_POST['password']) , 'confirm_password' => trim($_POST['confirm_password']) , 'name_err' => '', 'email_err' => '', 'password_err' => '', 'confirm_password_err' => ''];

            // Validate Email
            // check email is not empty
            if (empty($data['email']))
            {
                $data['email_err'] = 'Please enter email';
            }
            else
            {
                // check email already exists
                if ($this->userModel->findUserByEmail($data['email']))
                {
                    $data['email_err'] = 'Account with this email already exists';
                }
            }

            // Validate Name
            // check name is not empty
            if (empty($data['name']))
            {
                $data['name_err'] = 'Please enter name';
            }

            // Validate Password
            // check password is not empty and it is longer than 6 characters
            if (empty($data['password']))
            {
                $data['password_err'] = 'Please enter password';
            }
            elseif (strlen($data['password']) < 6)
            {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            // check confirm password is not empty and == password
            if (empty($data['confirm_password']))
            {
                $data['confirm_password_err'] = 'Please confirm password';
            }
            else
            {
                if ($data['password'] != $data['confirm_password'])
                {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']))
            {
                // Validated
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                // if for checking it went well
                if ($this->userModel->register($data))
                {
                    flash('register_success', 'You are successfully registered, please check your email for a verification link');
                    redirect('/users/login');
                    
                }
                else
                {
                    die('Something went wrong');
                }
            }
            else
            {
                // Load view with errors
                $this->view('users/register', $data);
            }
        }
        else
        {
            // Init data
            $data = ['name' => '', 'email' => '', 'password' => '', 'confirm_password' => '', 'name_err' => '', 'email_err' => '', 'password_err' => '', 'confirm_password_err' => ''];

            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = ['email' => trim($_POST['email']) , 'password' => trim($_POST['password']) , 'email_err' => '', 'password_err' => '', ];

            // Validate Email
            if (empty($data['email']))
            {
                $data['email_err'] = 'Pleae enter email';
            }

            // Validate Password
            if (empty($data['password']))
            {
                $data['password_err'] = 'Please enter password';
            }

            // Check for user/email
            if ($this->userModel->findUserByEmail($data['email']))
            {
                // User found
                
            }
            else
            {
                // User not found
                $data['email_err'] = 'No user found';
            }

            //Check user is verified
            if ($this->userModel->isUserVerified($data['email']))
            {
                //User verified
                
            }
            else
            {
                //Not verified
                $data['email_err'] = 'Email is not verified, please check your emails';
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err']))
            {
                // Validated
                // Check and set logged in user
                // not hashed password here. that is done inside the model
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                // if user was logged in create session. else render form with error
                if ($loggedInUser)
                {
                    // Create Session
                    // user comes from row returned form model
                    $this->createUserSession($loggedInUser);
                }
                else
                {
                    $data['password_err'] = 'Password incorrect';

                    $this->view('users/login', $data);
                }
            }
            else
            {
                // Load view with errors
                $this->view('users/login', $data);
            }
        }
        else
        {
            // Init data
            $data = ['email' => '', 'password' => '', 'email_err' => '', 'password_err' => '', ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        // Create user session. Takes user as variable
        // Set user details
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['admin'] = $user->admin;
        redirect('pages/index');
    }

    public function logout()
    {
        // Logout function. clears session variables
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['admin']);
        // clears session
        session_destroy();
        redirect('users/login');
    }

    public function manage()
    {
        if (!isLoggedIn())
        {
            redirect('users/login');
        }
        else if ($_SESSION['admin'] > 0)
        {
            $users = $this->userModel->getUsers();

            // set data as users
            $data = ['users' => $users];
            $this->view('users/manage', $data);
        }
        else
        {
            redirect('pages/index');
        }
    }

    public function edit($id)
    {
        //Edit an existing model
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $data = ['id' => $id, 'name' => trim($_POST['name']) , 'email' => trim($_POST['email']) , 'password' => trim($_POST['password']) , 'confirm_password' => trim($_POST['confirm_password']) , 'is_admin' => trim($_POST['is_admin']) , 'name_err' => '', 'email_err' => '', 'password_err' => '', 'confirm_password_err' => ''];

            // Validate data
            if (empty($data['name']))
            {
                $data['name_err'] = 'Please enter name';
            }
            if (empty($data['email']))
            {
                $data['email_err'] = 'Please enter email';
            }
            if (empty($data['password']))
            {
                $data['password_err'] = 'Please enter a valid password';
            }
            if (strlen($data['password']) < 6)
            {
                $data['password_err'] = 'Password must be at least 6 characters long';
            }
            if (($data['confirm_password'] != $data['password']))
            {
                $data['confirm_password_err'] = 'Passwords dont match';
            }

            // Make sure no errors
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']))
            {
                // Validated
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->userModel->updateUser($data))
                {
                    flash('post_message', 'User Updated');
                    // Admin redirect
                    if ($_SESSION['admin'] > 0)
                    {

                        redirect('users/manage');

                    }
                    else
                    {
                        redirect('pages/index');
                    }
                }
                else
                {
                    die('Something went wrong');
                }
            }
            else
            {
                // Load view with errors
                $this->view('users/edit', $data);
            }
        }
        else
        {
            if (!isLoggedIn())
            {
                redirect('users/login');
            }
            else if ($_SESSION['admin'] > 0)
            {

                $user = $this->userModel->getUserById($id);

                $data = ['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'password' => $user->password, 'admin' => $user->admin > 0 ? 'TRUE' : 'FALSE', 'name_err' => '', 'email_err' => '', 'password_err' => '', 'confirm_password_err' => ''];
                $this->view('users/edit', $data);
            }
            else if ($_SESSION['user_id'] === $id)
            {
                $user = $this->userModel->getUserById($id);

                $data = ['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'password' => $user->password, 'admin' => false, 'name_err' => '', 'email_err' => '', 'password_err' => '', 'confirm_password_err' => ''];
                $this->view('users/edit', $data);
            }
            else
            {
                redirect('pages/index');
            }
        }
    }

    public function delete($id)
    {
        // Deletes an existing user
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if (!isLoggedIn())
            {
                redirect('users/login');
            }
            else
            {
                if ($this->userModel->deleteUser($id))
                {
                    flash('post_message', 'user Removed');
                    if($id == $_SESSION['user_id'])
                    {
                      return $this->logout();
                    }
                    else
                    {
                      redirect('users/manage');
                    }
                }
                else
                {
                    die('Something went wrong');
                }
            }
        }
        else
        {
            redirect('users/login');
        }
    }

    public function confirm($token)
    {
        // Vewrifies a users email
        if ($this->userModel->confirmEmail($token))
        {
            flash('post_message', 'Email verified');
            redirect('users/login');
        }
        else
        {
            die('Something went wrong');
        }
    }
}