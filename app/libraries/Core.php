<?php
/*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
class Core
{
    // this will change as the url changes. it is set to the current url controller requested
    protected $currentController = 'Pages';
    // this is the view loaded by 
    protected $currentMethod = 'index';
    // list of paramaters on url
    protected $params = [];

    public function __construct()
    {
        // url variable
        $url = $this->getUrl();

        // Look in controllers for first value. New versions of php will get a null reference error if isset is not there. ucwwords capatializes words
        if (isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            // If exists, set as controller
            $this->currentController = ucwords($url[0]);
            // Unset 0 Index
            unset($url[0]);
        }

        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate controller class
        $this->currentController = new $this->currentController;

        // Check for second part of url
        if (isset($url[1])) {
            // Check to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // Unset 1 index
                unset($url[1]);
            }
        }

        // Get params. if theres paramaters they will be added. else it will be empty array
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        // check url exists
        if (isset($_GET['url'])) {
            // strip ending slash. first param is the initial string. second is the char you want to strip out
            $url = rtrim($_GET['url'], '/');
            // Sanaitize as a URL. using php function filter_var. clears any chars a URL shouldnt have
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // break it into an array of each paramaeter. eg: 'pages/about/1' would become ['pages., 'about', '1']
            $url = explode('/', $url);
            return $url;
        }
    }
}
