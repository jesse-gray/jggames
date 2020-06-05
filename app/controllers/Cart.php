<?php
class Cart extends Controller
{
    public function __construct()
    {
        // Cart only accessible by logged in users
        if (!isLoggedIn())
        {
            redirect('users/login');
        }
        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        // Get products in cart
        $cartProducts = $this->productModel->getCartProducts($_SESSION['user_id']);

        // Set data as products n cart
        $data = ['products' => $cartProducts];

        $this->view('cart/index', $data);
    }

    public function add($id)
    {
        // Add a product to the users cart
        if ($this->productModel->addProductToCart($_SESSION['user_id'], $id))
        {
            flash('post_message', 'Product Added To Cart');
            redirect('products/shop');
        }
        else
        {
            die('Something went wrong');
        }
        $this->view('products/shop', $data);
    }

    public function remove($id)
    {
        // Remove a product from the cart
        echo "<script>console.log('$id');</script>";
        if ($this->productModel->removeProductFromCart($_SESSION['user_id'], $id))
        {
            flash('post_message', 'Product Removed From Cart');
            redirect('cart');
        }
        else
        {
            die('Something went wrong');
        }
        $this->view('cart/index', $data);
    }
}