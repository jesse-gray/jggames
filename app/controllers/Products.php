<?php
  class Products extends Controller {
    public function __construct(){
      // this makes all forums only for logged in users
      if(!isLoggedIn()){
        redirect('users/login');
      }

      // instantiate product
      $this->productModel = $this->model('Product');
    }

    public function index(){
      // Get products
      $products = $this->productModel->getProducts();

      // set data as products
      $data = [
        'products' => $products
      ];

      $this->view('products/index', $data);
    }

    // add new post
    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim($_POST['name']),
          'quantity' => trim($_POST['quantity']),
          'price' => trim($_POST['price']),
          'description' => trim($_POST['description']),
          'name_err' => '',
          'quantity_err' => '',
          'price_err' => '',
          'description_err' => ''
        ];

        // Validate data
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name';
        }
        if(empty($data['quantity'])){
          $data['quantity_err'] = 'Please enter quantity';
        }
        if(empty($data['price'])){
            $data['price_err'] = 'Please enter price';
          }
          if(empty($data['description'])){
            $data['description_err'] = 'Please enter description';
          }

        // Make sure no errors
        if(empty($data['name_err']) && empty($data['quantity_err']) && empty($data['price_err']) && empty($data['description_err'])){
          // Validated
          if($this->productModel->addProduct($data)){
            flash('post_message', 'Product Added');
            redirect('products');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('products/add', $data);
        }

      } else {
        $data = [
          'name' => '',
          'quantity' => '',
          'price' => '',
          'description' => ''
        ];
  
        $this->view('products/add', $data);
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
        'quantity' => trim($_POST['quantity']),
        'price' => trim($_POST['price']),
        'description' => trim($_POST['description']),
        'name_err' => '',
        'quantity_err' => '',
        'price_err' => '',
        'description_err' => ''
      ];

      // Validate data
      if(empty($data['name'])){
        $data['name_err'] = 'Please enter name';
      }
      if(empty($data['quantity'])){
        $data['quantity_err'] = 'Please enter quantity';
      }
      if(empty($data['price'])){
          $data['price_err'] = 'Please enter price';
        }
        if(empty($data['description'])){
          $data['description_err'] = 'Please enter description';
        }

        // Make sure no errors
        if(empty($data['name_err']) && empty($data['quantity_err']) && empty($data['price_err']) && empty($data['description_err'])){
            // Validated
            if($this->productModel->updateProduct($data)){
              flash('post_message', 'Product edited');
              redirect('products');
            } else {
              die('Something went wrong');
            }
          } else {
            // Load view with errors
            $this->view('products/edit', $data);
          }

      // show edit page. not a post request
      } else {
        // Get existing product from model
        $product = $this->productModel->getProductById($id);


        $data = [
          'id' => $id,
          'name' => $product->name,
          'quantity' =>  $product->quantity,
          'price' =>  $product->price,
          'description' =>  $product->description
        ];
  
        $this->view('products/edit', $data);
      }
    }

    public function show($id){
      $product = $this->productModel->getProductById($id);

      $data = [
        'product' => $product,
      ];

      $this->view('products/show', $data);
    }

    public function delete($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

          // Check for admin
        if(!$_SESSION['admin'] > 0){
            redirect('products');
        }


        if($this->productModel->deleteProduct($id)){
          flash('post_message', 'Product Removed');
          redirect('products');
        } else {
          die('Something went wrong');
        }
      } else {
        redirect('products');
      }
    }

  }