<?php
  class Brands extends Controller {
    public function __construct(){
      // this makes all forums only for logged in users
      if(!isLoggedIn()){
        redirect('users/login');
      }

        // Check for admin
        if(!$_SESSION['admin'] > 0){
            redirect('pages');
        }

      // instantiate brand
      $this->brandModel = $this->model('Brand');
    }

    public function index(){
      // Get brands
      $brands = $this->brandModel->getBrands();

      // set data as brands
      $data = [
        'brands' => $brands
      ];

      $this->view('brands/index', $data);
    }

    // add new post
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
          if($this->brandModel->addBrand($data)){
            flash('post_message', 'Brand Added');
            redirect('brands');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('brands/add', $data);
        }

      } else {
        $data = [
          'name' => '',
        ];
  
        $this->view('brands/add', $data);
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
            if($this->brandModel->updateBrand($data)){
              flash('post_message', 'Brand edited');
              redirect('brands');
            } else {
              die('Something went wrong');
            }
          } else {
            // Load view with errors
            $this->view('brands/edit', $data);
          }

      // show edit page. not a post request
      } else {
        // Get existing brand from model
        $brand = $this->brandModel->getBrandById($id);


        $data = [
          'id' => $id,
          'name' => $brand->name,
        ];
  
        $this->view('brands/edit', $data);
      }
    }

    public function show($id){
      $brand = $this->brandModel->getBrandById($id);

      $data = [
        'brand' => $brand,
      ];

      $this->view('brands/show', $data);
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

          // Check for admin
        if(!$_SESSION['admin'] > 0){
            redirect('pages/index');
        }


        if($this->brandModel->deleteBrand($id)){
          flash('post_message', 'Brand Removed');
          redirect('brands');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('brands');
      }
    }

  }