<?php
    // App Core Class
    // Creates Url and loads core Controller
    // URL Format - /controller/method/params

    class Core {

        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct()
        {
            // print_r($this->getUrl());
            $url = $this->getUrl();

            // Look in controllers for first value
            if ($url) {
                
                if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                    // If exists, set as current controller
                    $this->currentController = ucwords($url[0]);
                    // Unset 0 index
                    unset($url[0]);
                }
    
            }
            // Require the controller
            require_once '../app/controllers/' . $this->currentController . '.php';

            // Instantiate controller class
            $this->currentController = new $this->currentController;

            // Check for second part of the url
            if (isset($url[1])) {
                // Check to see if method exist in controller
                if (method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    // Unset index 1
                    unset($url[1]);
                }
            }

            // Get params

            $this->params = $url ? array_values($url) : [];
            /* var_dump($url);
            var_dump($this->params); */

            // Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

        }

        public function getUrl() {
            if(isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');                // string the / from the url
                $url = filter_var($url, FILTER_SANITIZE_URL);   // sanitize url
                $url = explode('/', $url);                      // makes an array from the url by splitting them on / character

                return $url;
            }
        }

    }
    