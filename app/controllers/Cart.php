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
  }