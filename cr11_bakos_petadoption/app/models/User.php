<?php
class User
{
    private $db;

    public function __construct()
    {

        $this->db = new Database;
    }

    // Register User

    public function register($data)
    {
        // Prepare query
        $this->db->query("INSERT INTO users(`name`, `email`, `password`)
            VALUES(:name, :email, :password)");

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Login

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }


    // Find user by email

    public function findUserByEmail($email)
    {

        // Prepare query
        $this->db->query('SELECT * FROM users WHERE email = :email');

        // Bind values
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUsers($searchText)
    {

        $this->db->query("SELECT * FROM users WHERE name LIKE '%$searchText%';");

        $results = $this->db->resultSet();


        return $results;
    }

    // Get the user by its id
    public function getUserById($id)
    {
        // Prepare query
        $this->db->query('SELECT * FROM users WHERE id = :id');

        // Bind values
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function deleteUser($id)
    {

        $this->db->query("DELETE FROM users WHERE id = :id;");

        // Binding value
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
