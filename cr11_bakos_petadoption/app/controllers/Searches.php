<?php

class Searches extends Controller
{
    public function __construct()
    {
        // This controller is sending back the Data to the Ajax requests

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->animalModel = $this->model('Animal');
        $this->userModel = $this->model('User');
    }

    // Searches on the main, small and large, senior page

    public function index($searchText = '')
    {


        $data = $this->animalModel->searchAnimals($searchText);


        echo json_encode($data);
    }

    // Searches on the admin page

    public function admin($searchText = '') {

        $data = $this->animalModel->searchAdmin($searchText);


        echo json_encode($data);
    }

    // Searches on the root page

    public function root($searchText = '') {

        $data = $this->userModel->getUsers($searchText);


        echo json_encode($data);
    }






}
