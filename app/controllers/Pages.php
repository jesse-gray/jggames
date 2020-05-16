<?php
// Default Controller
class Pages extends Controller
{
    public function __construct()
    {

        // instantiate models
        $this->categoryModel = $this->model('Category');
        $this->brandModel = $this->model('Brand');
    }

    public function index()
    {
        // Get categories
        $categories = $this->categoryModel->getCategories();

        // Get brands
        $brands = $this->brandModel->getBrands();

        $data = [
            'title' => 'Ecommerce Web App',
            'description' => 'Simple ecommerce web app',
            'categories' => $categories,
            'brands' => $brands
          ];
        // pass view
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = ['title' => 'About Us',
        'description' => 'Store with a forum'];
        // pass view
        $this->view('pages/about', $data);
    }

    public function dashboard()
    {
        $data = ['title' => 'Dashboard',
        'description' => 'Admin Dashboard'];
        // pass view
        $this->view('pages/dashboard', $data);
    }
}
