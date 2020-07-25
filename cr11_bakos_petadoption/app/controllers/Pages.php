<?php
    class Pages extends Controller {
        public function __construct() {

        }

        public function index() {

            if (isLoggedIn()) {
                redirect('animals');
            }

            $data = [
                'title' => 'Pet Adoption Site', 
                'description' => 'This is the Pet Adoption Site build in MVC Pattern with pure PHP.'
            ];

            $this->view('pages/index', $data);
        }

        public function about() {
            $data = [
                'title' => 'About Us', 
                'description' => 'App for Pet Adoption'];
            $this->view('pages/about', $data);
        }
    }
