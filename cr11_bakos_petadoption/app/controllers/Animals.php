<?php
class Animals extends Controller
{

    public function __construct()
    {

        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->animalModel = $this->model('Animal');
    }

    // This function loads the view after the login with all the animals (data is coming from the Searches Controller)

    public function index()
    {


        $this->view('animals/index');
    }

    // This function loads the general page (data is coming from the Searches Controller)

    public function general()
    {


        $this->view('animals/general');
    }

    // This function loads the senior page (data is coming from the Searches Controller)

    public function senior()
    {


        $this->view('animals/senior');
    }

    // This function loads the admin page (data is coming from the Searches Controller)

    public function admin()
    {

        if (isAdmin()) {

            $this->view('animals/admin');
        } else {
            redirect('animals');
        }
    }

    
    // This funtion shows a simple animal when clicking the show pet button

    public function show($id = '')
    {

        // Redirects if there is no value in the argument instead of showing error message to the user
        if ($id == '') {
            redirect('animals');
        }

        $animal = $this->animalModel->getAnimalById($id);


        $data = [
            'animal' => $animal,
        ];

        $this->view('animals/show', $data);
    }

    // Adds an animal

    public function add()
    {


        if (isAdmin()) {

            $breeds = $this->animalModel->getBreeds();
            $locations = $this->animalModel->getLocations();
    
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
    
                $data = [
                    'name' => trim($_POST['name']),
                    'age' => trim($_POST['age']),
                    'description' => trim($_POST['description']),
                    'img' => trim($_POST['img']),
                    'hobbies' => trim($_POST['hobbies']), 
                    'date' => $_POST['date'], 
                    'type' => $_POST['type'],
                    'breed' => $_POST['breed'],
                    'location' => $_POST['location'],
                    'name_err' => '',
                    'age_err' => '',
                    'description_err' => '',
                    'genre_err' => '',
                    'img_err' => '',
                    'hobbies_err' => '',
                    'type_err' => '',
                    'breed_err' => '', 
                    'location_err' => '', 
                    'breeds' => $breeds,
                    'locations' => $locations,
                ];
    
                // Validate data
                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter a name';
                }
    
                if (empty($data['age'])) {
                    $data['age_err'] = 'Please enter an age';
                }
    
                if (empty($data['description'])) {
                    $data['description_err'] = 'Please enter a description';
                }
                
                if (empty($data['img'])) {
                    $data['img_err'] = 'Please add an img url';
                } elseif (!validImage($data['img'])) {
                    $data['img_err'] = 'Please add a valid url';
                }

                if (empty($data['hobbies'])) {
                    $data['hobbies_err'] = 'Please add a hobbie';
                }

                if (empty($data['date'])) {
                    $data['date_err'] = 'Please add a date';
                }
    
                if (empty($data['type'])) {
                    $data['type_err'] = 'Please choose a type';
                }
    
                if (empty($data['breed'])) {
                    $data['breed_err'] = 'Please choose a breed';
                }
    
                if (empty($data['location'])) {
                    $data['location_err'] = 'Please choose a location';
                }
    
    
    
                // Make sure no errors
                if (
                    empty($data['name_err'])
                    && empty($data['age_err'])
                    && empty($data['description_err'])
                    && empty($data['img_err'])
                    && empty($data['hobbies_err'])
                    && empty($data['date_err'])
                    && empty($data['type_err'])
                    && empty($data['breed_err'])
                    && empty($data['location_err'])
                ) {
                    // Validated
                    if ($this->animalModel->addAnimal($data)) {
                        flash('animal_message', 'Animal Added');
                        redirect('animals/admin');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    echo var_dump($data['type']) . ' Type ami bemegy errornal';
                    $this->view('animals/add', $data);
                }
            } else {
                $data = [
                    'name' => '',
                    'age' => '',
                    'description' => '',
                    'img' => '',
                    'hobbies' => '', 
                    'type' => '',
                    'breed' => '',
                    'location' => '',
                    'breeds' => $breeds,
                    'locations' => $locations
                ];
    
                $this->view('animals/add', $data);
            }
        } else {
            redirect('animals');
        }

    }

    // adds a breed

    public function addbreed($id = '') {

        if ($id = '') {
            redirect('animals');
        }
        if (isAdmin()) {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);



                $data = [
                    'id' => $id,
                    'breed' => strtolower(trim($_POST['breed'])),
                    'breed_err' => ''
                ];


                // Validate data
                if (empty($data['breed'])) {
                    $data['breed_err'] = 'Please enter a breed';
                }


                // Make sure no errors
                if (
                    empty($data['breed_err'])
                ) {
                    // Validated
                    if ($this->animalModel->addBreed($data)) {
                        if ($id == 0) {
                            flash('animal_message', 'Breed Added');
                            redirect('animals/add');
                        } else {
                            flash('animal_message', 'Breed Added');
                            redirect('animals/edit/' . $id);
                        }
                    } else {
                        flash('animal_message', 'Breed Exists');
                        $this->view('animals/addbreed', $data);
                    }
                } else {
                    // Load view with errors
                    $this->view('animals/addbreed', $data);
                }
            } else {


                $data = [
                    'id' => $id,
                    'breed' => ''
                ];

                $this->view('animals/addbreed', $data);
            }


        } else {
            redirect('animals');
        }
    }

    // adds a location

    public function addlocation($id = '')

    {   if ($id = '') {
        redirect('animals');
    }   
   

            if (isAdmin()) {
    
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Sanitize POST array
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
    
    
                    $data = [
                        'id' => $id,
                        'name' => trim($_POST['name']),
                        'address' => trim($_POST['address']),
                        'city' => trim($_POST['city']),
                        'zip' => trim($_POST['zip']),
                        'img' => trim($_POST['img']),
                        'name_err' => '',
                        'city_err' => '',
                        'zip_err' => '',
                        'img_err' => '',
                    ];
    
    
                    // Validate data
                    if (empty($data['name'])) {
                        $data['name_err'] = 'Please enter a name';
                    }
    
                    if (empty($data['address'])) {
                        $data['address_err'] = 'Please enter an address';
                    }
    
                    if (empty($data['city'])) {
                        $data['city_err'] = 'Please enter a city';
                    }
    
                    if (empty($data['zip'])) {
                        $data['zip_err'] = 'Please enter a zip code';
                    } elseif (!is_int(intval($data['zip']))) {
                        $data['zip_err'] = 'Please enter just digits';
                    }
    
                    if (empty($data['img'])) {
                        $data['img_err'] = 'Please add an img url';
                    } elseif (!validImage($data['img'])) {
                        $data['img_err'] = 'Please add a valid url';
                    }
    
    
    
                    // Make sure no errors
                    if (
                        empty($data['name_err'])
                        && empty($data['city_err'])
                        && empty($data['address_err'])
                        && empty($data['zip_err'])
                        && empty($data['img_err'])
                    ) {
                        // Validated
                        if ($this->animalModel->addLocation($data)) {
                            if ($id == 0) {
                                flash('animal_message', 'Location Added');
                                redirect('animals/add');
                            } else {
                                flash('animal_message', 'Location Added');
                                redirect('animals/edit/' . $id);
                            }
                        } else {
                            flash('animal_message', 'Location Exists');
                            $this->view('animals/addlocation', $data);
                        }
                    } else {
                        // Load view with errors
                        $this->view('animals/addlocation', $data);
                    }
                } else {
    
    
                    $data = [
                        'id' => $id,
                        'name' => '',
                        'city' => '',
                        'address' => '',
                        'zip' => '',
                        'img' => '',
                        'name_err' => '',
                        'city_err' => '',
                        'zip_err' => '',
                        'img_err' => '',
                    ];
    
                    $this->view('animals/addlocation', $data);
                }
            } else {
                redirect('animals');
            }
        
    }

    // edits an animal

    public function edit($id = '')
    {   
        if ($id == '' && isLoggedIn()) {
            redirect('animals');
        }
        if (isAdmin()) {

            $breeds = $this->animalModel->getBreeds();
            $locations = $this->animalModel->getLocations();
    
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    
    
                $data = [
                    'id' => $id, 
                    'name' => trim($_POST['name']),
                    'age' => trim($_POST['age']),
                    'description' => trim($_POST['description']),
                    'img' => trim($_POST['img']),
                    'hobbies' => $_POST['hobbies'], 
                    'date' => $_POST['date'] ? $_POST['date'] : NULL, 
                    'type' => $_POST['type'],
                    'breed' => $_POST['breed'],
                    'location' => $_POST['location'],
                    'name_err' => '',
                    'age_err' => '',
                    'description_err' => '',
                    'genre_err' => '',
                    'img_err' => '',
                    'hobbies_err' => '',
                    'type_err' => '',
                    'breed_err' => '', 
                    'location_err' => '', 
                    'breeds' => $breeds,
                    'locations' => $locations,
                ];
    
                // Validate data
                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter a name';
                }
    
                if (empty($data['age'])) {
                    $data['age_err'] = 'Please enter an age';
                }
    
                if (empty($data['description'])) {
                    $data['description_err'] = 'Please enter a description';
                }
                
                if (empty($data['img'])) {
                    $data['img_err'] = 'Please add an img url';
                } elseif (!validImage($data['img'])) {
                    $data['img_err'] = 'Please add a valid url';
                }
    
                if (empty($data['hobbies'])) {
                    $data['hobbies_err'] = 'Please add a hobbie';
                }

                if (empty($data['date']) && $data['type'] == '3') {
                    $data['date_err'] = 'Please add a date';
                }
    
                if (empty($data['type'])) {
                    $data['type_err'] = 'Please choose a type';
                }
    
                if (empty($data['breed'])) {
                    $data['breed_err'] = 'Please choose a breed';
                }
    
                if (empty($data['location'])) {
                    $data['location_err'] = 'Please choose a location';
                }
    
    
    
                // Make sure no errors
                if (
                    empty($data['name_err'])
                    && empty($data['age_err'])
                    && empty($data['description_err'])
                    && empty($data['img_err'])
                    && empty($data['hobbies_err'])
                    && empty($data['date_err'])
                    && empty($data['type_err'])
                    && empty($data['breed_err'])
                    && empty($data['location_err'])
                ) {
                    // Validated
                    if ($this->animalModel->editAnimal($data)) {
                        flash('animal_message', 'Animal Edited');
                        redirect('animals/admin');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('animals/edit', $data);
                }
            } else {

                $animal = $this->animalModel->getAnimalById($id);

                $data = [
                    'id' => $id, 
                    'name' => $animal->animal_name,
                    'age' => $animal->animal_age,
                    'description' => $animal->animal_desc,
                    'img' => $animal->animal_img,
                    'hobbies' => $animal->animal_hobbies, 
                    'date' => $animal->animal_date, 
                    'type' => $animal->animal_type,
                    'breed' => $animal->animal_breed,
                    'location' => $animal->animal_location, 
                    'breeds' => $breeds,
                    'locations' => $locations
                ];
    
                $this->view('animals/edit', $data);
            }
        } else {
            redirect('animals');
        }
    }

    // Delets an animal

    public function delete($id)
    {
        if (isAdmin()) {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {


                if ($this->animalModel->deleteAnimal($id)) {
                    flash('animal_message', 'Animal Removed');
                    redirect('animals/admin');
                } else {
                    die('Something went wrong');
                }
            } else {
                redirect('animals');
            }
        } else {
            redirect('animals');
        }
    }
}
