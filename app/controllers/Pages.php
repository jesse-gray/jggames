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
            'title' => 'WatsonMVC',
        ];
        // pass view
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = ['title' => 'About Us'];
        // pass view
        $this->view('pages/about', $data);
    }
}
