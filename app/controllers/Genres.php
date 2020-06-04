<?php
  class Genres extends Controller {
    public function __construct(){
      // this makes all forums only for logged in users
      if(!isLoggedIn()){
        redirect('users/login');
      }

        // Check for admin
        if(!$_SESSION['admin'] > 0){
            redirect('pages');
        }

      // instantiate genre
      $this->genreModel = $this->model('Genre');
    }

    public function index(){
      // Get genres
      $genres = $this->genreModel->getGenres();

      // set data as genre
      $data = [
        'genres' => $genres
      ];

      $this->view('genres/index', $data);
    }

    // add new genre
    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim($_POST['name']),
          'name_err' => ''

        ];

        // Validate data
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name';
        }


        // Make sure no errors
        if(empty($data['name_err'])){
          // Validated
          if($this->genreModel->addGenre($data)){
            flash('post_message', 'Genre Added');
            redirect('genres');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('genres/add', $data);
        }

      } else {
        $data = [
          'name' => '',
        ];
  
        $this->view('genres/add', $data);
      }
    }

    // very similar to add
    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
      // Sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'id' => $id,
        'name' => trim($_POST['name']),
        'name_err' => ''

      ];

      // Validate data
      if(empty($data['name'])){
        $data['name_err'] = 'Please enter name';
      }


        // Make sure no errors
        if(empty($data['name_err'])){
            // Validated
            if($this->genreModel->updateGenre($data)){
              flash('post_message', 'Genre edited');
              redirect('genres');
            } else {
              die('Something went wrong');
            }
          } else {
            // Load view with errors
            $this->view('genres/edit', $data);
          }

      // show edit page. not a post request
      } else {
        // Get existing genre from model
        $genre = $this->genreModel->getGenreById($id);


        $data = [
          'id' => $id,
          'name' => $genre->name,
        ];
  
        $this->view('genres/edit', $data);
      }
    }

    public function show($id){
      $genre = $this->genreModel->getGenreById($id);

      $data = [
        'genre' => $genre,
      ];

      $this->view('genres/show', $data);
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

          // Check for admin
        if(!$_SESSION['admin'] > 0){
            redirect('pages/index');
        }


        if($this->genreModel->deleteGenre($id)){
          flash('post_message', 'Genre Removed');
          redirect('genres');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('genres');
      }
    }

  }