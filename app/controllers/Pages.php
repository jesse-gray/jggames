<?php
// Default Controller
class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = [
            'title' => 'Ecommerce Web App',
            'description' => 'Simple ecommerce web app'
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
}
