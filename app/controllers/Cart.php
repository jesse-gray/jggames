<?php
  class Cart extends Controller {
    public function __construct(){
      // this makes all forums only for logged in users
      if(!isLoggedIn()){
        redirect('users/login');
      }
      
      $this->productModel = $this->model('Product');
    }

    public function index(){
      // Get products
      $products = $this->productModel->getCartProducts($_SESSION['user_id']);

      // set data as products
      $data = [
        'products' => $products
      ];

      $this->view('cart/index', $data);
    }

    public function add($id){
       echo "<script>console.log('Controller: $id');</script>";

          if($this->productModel->addProductToCart($_SESSION['user_id'], $id)){
            flash('post_message', 'Product Added To Cart');
            redirect('');
          } else {  
            die('Something went wrong');
          }

      $this->view('product/index', $data);
    }

    public function remove($id){
       echo "<script>console.log('$id');</script>";
          if($this->productModel->removeProductFromCart($_SESSION['user_id'], $id)){
            flash('post_message', 'Product Removed From Cart');
            redirect('cart');
          } else {
            die('Something went wrong');
          }


      $this->view('cart/index', $data);
    }
  }