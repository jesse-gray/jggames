<?php
  class Checkout extends Controller {
    public function __construct(){
      // this makes all forums only for logged in users
      if(!isLoggedIn()){
        redirect('users/login');
      }
      
      $this->productModel = $this->model('Product');
      $this->orderModel = $this->model('Order');
    }

    public function index(){
      // Get products
      $products = $this->productModel->getCartProducts($_SESSION['user_id']);

      // set data as products
      $data = [
        'products' => $products
      ];

      $this->view('cart/checkout', $data);
    }

    public function placeOrder(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'street_number' => trim($_POST['inputStreetNumber']),
          'street_name' => trim($_POST['inputStreetName']),
          'suburb' => trim($_POST['inputSuburb']),
          'city' => trim($_POST['inputCity']),
          'region' => trim($_POST['inputRegion']),
          'postcode' => trim($_POST['inputPostcode']),
          'street_number_err' => '',
          'street_name_err' => '',
          'city_err' => '',
          'region_err' => '',
          'postcode_err' => ''
        ];

        // Validate data
        if(empty($data['street_number'])){
          $data['street_number_err'] = 'Please enter street number';
        }
        if(empty($data['street_name'])){
          $data['street_name_err'] = 'Please enter street name';
        }
        if(empty($data['city'])){
          $data['city_err'] = 'Please enter city';
        }
        if(empty($data['region'])){
          $data['region_err'] = 'Please enter region';
        }
        if(empty($data['postcode'])){
          $data['postcode_err'] = 'Please enter postcode';
        }

        // Make sure no errors
        if(empty($data['street_number_err']) && empty($data['street_name_err']) && empty($data['city_err']) && empty($data['region_err']) && empty($data['postcode_err'])){
          // Validated

          $newAddress = [
            'street_number' => $data['street_number'],
            'street_name' => $data['street_name'],
            'suburb' => $data['suburb'],
            'city' => $data['city'],
            'region' => $data['region'],
            'postcode' => $data['postcode']
          ];
          if($this->orderModel->addNewOrder($newAddress)){
            flash('post_message', 'Order placed successfully');
            redirect('checkout/summary');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('cart/checkout', $data);
        }

      } else {
        $data = [
          'street_number' => '',
          'street_name' => '',
          'suburb' => '',
          'city' => '',
          'region' => '',
          'postcode' => ''
        ];
  
        $this->view('cart/checkout', $data);
      }

	}
  }