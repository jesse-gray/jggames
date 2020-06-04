<?php
// Default Controller
class Pages extends Controller
{
    public function __construct()
    {

        // instantiate models
        $this->categoryModel = $this->model('Category');
        $this->genreModel = $this->model('Genre');
        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        // Get categories
        $categories = $this->categoryModel->getCategories();

        // Get genres
        $genres = $this->genreModel->getGenres();

        // Get Products
        $products = $this->productModel->getProducts();



        $data = [
            'title' => 'JG Games',
            'description' => 'Your one stop shop for gaming',
            'categories' => $categories,
            'genres' => $genres,
            'products' => $products
          ];
        // pass view
        $this->view('pages/index', $data);
    }

    public function dashboard()
    {
        $data = ['title' => 'Dashboard',
        'description' => 'Admin Dashboard'];
        // pass view
        $this->view('pages/dashboard', $data);
    }
}
