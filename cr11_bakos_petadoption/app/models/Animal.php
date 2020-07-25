<?php
class Animal
{
    private $db;

    public function __construct()
    {

        $this->db = new Database;
    }

    // Searches in the database
    
    public function searchAnimals($search = '')
    {
        // $search = strval($search);


        $this->db->query("SELECT 
                                animal.animal_id, 
                                animal.animal_name, 
                                animal.animal_age, 
                                animal.animal_img, 
                                type.type, 
                                breed.breed, 
                                location.location_city
                                FROM animal
                                JOIN type ON animal.fk_type_id = type.type_id
                                JOIN breed ON breed.breed_id = fk_breed_id
                                JOIN location ON location.location_id = animal.fk_location_id
                                WHERE breed.breed LIKE '$search%'
                                ORDER BY animal.fk_breed_id AND animal.animal_name;");


        $results = $this->db->resultSet();


        return $results;
    }

    // Searches in the database for the admin page

    public function searchAdmin($search = '')
    {
        // $search = strval($search);


        $this->db->query("SELECT 
                                animal.animal_id, 
                                animal.animal_name, 
                                animal.animal_age, 
                                animal.animal_img, 
                                type.type, 
                                breed.breed, 
                                location.location_city
                                FROM animal
                                JOIN type ON animal.fk_type_id = type.type_id
                                JOIN breed ON breed.breed_id = fk_breed_id
                                JOIN location ON location.location_id = animal.fk_location_id
                                WHERE breed.breed LIKE '$search%'
                                GROUP BY animal.animal_id;");


        $results = $this->db->resultSet();


        return $results;
    }

    // Gets on animal by its id

    public function getAnimalById($id)
    {
        // Query

        $this->db->query("SELECT 
                animal.animal_id, 
                animal.animal_name, 
                animal.animal_age, 
                animal.animal_desc, 
                animal.animal_img, 
                animal.animal_hobbies, 
                animal.animal_date, 
                animal.fk_type_id AS animal_type, 
                animal.fk_location_id AS animal_location, 
                animal.fk_breed_id AS animal_breed,
                breed.breed, 
                type.type, 
                users.name, 
                location.location_name, 
                location.location_address, 
                location.location_city, 
                location.location_zip
                FROM animal
                JOIN type ON animal.fk_type_id = type.type_id
                JOIN breed ON breed.breed_id = fk_breed_id
                JOIN location ON location.location_id = animal.fk_location_id
                JOIN users ON users.id = animal.fk_user_id
                WHERE animal.animal_id = :id
                ");

        // Bind value
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        
        return $row;
    }

    // Adds a new animal to the db

    public function addAnimal($data) {

        $user_id = $_SESSION['user_id'];
        $animal_name = $data['name'];
        $animal_age = $data['age'];
        $animal_desc = $data['description'];
        $animal_img = $data['img'];
        $animal_hobbies = $data['hobbies'];
        $animal_date = $data['date'];
        $fk_type_id = $data['type'];
        $fk_breed_id = $data['breed'];
        $fk_location_id = $data['location'];

        $this->db->query("INSERT INTO animal(
                            animal_name, 
                            animal_age, 
                            animal_desc, 
                            animal_img, 
                            animal_hobbies, 
                            animal_date, 
                            fk_type_id, 
                            fk_breed_id, 
                            fk_location_id, 
                            fk_user_id
                            )
                            VALUES(
                            :animal_name, 
                            :animal_age, 
                            :animal_desc, 
                            :animal_img, 
                            :animal_hobbies, 
                            :animal_date, 
                            :fk_type_id, 
                            :fk_breed_id, 
                            :fk_location_id, 
                            :fk_user_id
                            )
                                            ");
        // Binding the values to the placeholders

        $this->db->bind(':animal_name', $animal_name);
        $this->db->bind(':animal_age', $animal_age); 
        $this->db->bind(':animal_desc', $animal_desc);
        $this->db->bind(':animal_img', $animal_img);
        $this->db->bind(':animal_hobbies', $animal_hobbies);
        $this->db->bind(':animal_date', $animal_date);
        $this->db->bind(':fk_type_id', $fk_type_id);
        $this->db->bind(':fk_breed_id', $fk_breed_id);
        $this->db->bind(':fk_location_id', $fk_location_id); 
        $this->db->bind(':fk_user_id', $user_id);

        if($this->db->execute()){
            return true;
          } else {
            return false;
          }

    }

    // Edits an animal by its id

    public function editAnimal($data) {

        $user_id = $_SESSION['user_id'];
        $animal_id = $data['id'];
        $animal_name = $data['name'];
        $animal_age = $data['age'];
        $animal_desc = $data['description'];
        $animal_img = $data['img'];
        $animal_hobbies = $data['hobbies'];
        $animal_date = $data['date'];
        $fk_type_id = $data['type'];
        $fk_breed_id = $data['breed'];
        $fk_location_id = $data['location'];

        $this->db->query("UPDATE animal
                            SET 
                            animal_name = :animal_name, 
                            animal_age = :animal_age, 
                            animal_desc = :animal_desc, 
                            animal_img = :animal_img, 
                            animal_hobbies = :animal_hobbies, 
                            animal_date = :animal_date, 
                            fk_type_id = :fk_type_id, 
                            fk_breed_id = :fk_breed_id, 
                            fk_location_id = :fk_location_id, 
                            fk_user_id = :fk_user_id
                            WHERE animal_id = :animal_id
                            
                           
                                            ");
        // Binding the values to the placeholders

        $this->db->bind(':animal_id', $animal_id);
        $this->db->bind(':animal_name', $animal_name);
        $this->db->bind(':animal_age', $animal_age); 
        $this->db->bind(':animal_desc', $animal_desc);
        $this->db->bind(':animal_img', $animal_img);
        $this->db->bind(':animal_hobbies', $animal_hobbies);
        $this->db->bind(':animal_date', $animal_date);
        $this->db->bind(':fk_type_id', $fk_type_id);
        $this->db->bind(':fk_breed_id', $fk_breed_id);
        $this->db->bind(':fk_location_id', $fk_location_id); 
        $this->db->bind(':fk_user_id', $user_id);

        if($this->db->execute()){
            return true;
          } else {
            return false;
          }
        }

    // Adds a new breed to the db

    public function addBreed($data) {

        $breed = $data['breed'];

        $this->db->query("
            INSERT INTO breed(breed) 
            VALUES(:breed)
        ");

        $this->db->bind(':breed', $breed);

        if($this->db->execute()){
            return true;
          } else {
            return false;
          }
    }

    // Adds a new location to the db

    public function addLocation($data) {

        $location_name = $data['name'];
        $location_city = $data['city'];
        $location_address = $data['address'];
        $location_zip = $data['zip'];
        $location_img = $data['img'];

        $this->db->query("INSERT INTO location(
            location_name, 
            location_city, 
            location_address, 
            location_zip, 
            location_img 
            )
            VALUES(
            :location_name, 
            :location_city, 
            :location_address, 
            :location_zip, 
            :location_img 
            )
                            ");

        $this->db->bind(':location_name', $location_name);
        $this->db->bind(':location_city', $location_city);
        $this->db->bind(':location_address', $location_address);
        $this->db->bind(':location_zip', $location_zip);
        $this->db->bind(':location_img', $location_img);

        if($this->db->execute()){
            return true;
          } else {
            return false;
          }

    }

    // Gets the breeds from the db

    public function getBreeds() {

        $this->db->query(
            "SELECT *
            FROM breed
            ORDER BY breed
            ");
    
        $results = $this->db->resultSet();
    
        return $results;
    }

    // Gets the locations from the db

    public function getLocations() {

        $this->db->query(
            "SELECT *
            FROM location
            ORDER BY location_name
            ");
    
        $results = $this->db->resultSet();
    
        return $results;
    }

    // Deletes an animal from the db

    public function deleteAnimal($id) {

        $this->db->query("DELETE FROM animal WHERE animal_id = :id");

        // Binding value
        $this->db->bind(':id', $id);

        // Execute
        if($this->db->execute()) {
            return true;
          } else {
            return false;
          }


    }

}

