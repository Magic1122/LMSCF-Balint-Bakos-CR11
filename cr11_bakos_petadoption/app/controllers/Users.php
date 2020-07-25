<?php 
    class Users extends Controller {
        public function __construct(){

            $this->userModel = $this->model('User');

        }

        public function register() {
            // Check for POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init data
                $data = [
                    'name' => trim($_POST['name']), 
                    'email' => trim($_POST['email']), 
                    'password' => trim($_POST['password']), 
                    'confirm_password' => trim($_POST['confirm_password']), 
                    'name_err' => '', 
                    'email_err' => '', 
                    'password_err' => '', 
                    'confirm_password_err' => ''
                ];

                // Validate Email
                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter an email address';
                } else {
                    if ($this->userModel->findUserByEmail($data['email'])) {
                        $data['email_err'] = 'Email is already taken';
                    }
                    
                }



                // Validate Name 
                if (empty($data['name'])) {
                    $data['name_err'] = 'Please enter your name';
                }

                // Validate Password
                if (empty($data['password'])) {
                    $data['password_err'] = 'Please enter your password';
                } elseif (strlen($data['password']) < 6) {
                    $data['password_err'] = 'Password must be at least 6 characters';
                }

                // Validate Confirm Password

                if (empty($data['confirm_password'])) {
                    $data['confirm_password_err'] = 'Please confirm password';
                } else {
                    if ($data['password'] != $data['confirm_password']) {
                        $data['confirm_password_err'] = 'Passwords do not match';
                    }
                }

                // Make sure errors are empty
                if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                    // Validated
                    
                    // Hash password

                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Register user
                    if ($this->userModel->register($data)) {
                        flash('register_success', 'You are registered and can log in');
                        redirect('users/login');
                    } else {
                        die('Something went wrong');
                    };


                    
                } else {
                    // Load view with errors
                    $this->view('users/register', $data);
                }



                
            

            } else {
                // Load form
                // Init data
                $data = [
                    'name' => '', 
                    'email' => '', 
                    'password' => '', 
                    'confirm_password' => '', 
                    'name_err' => '', 
                    'email_err' => '', 
                    'password_err' => '', 
                    'confirm_password_err' => ''
                ];

                // Load view
                $this->view('users/register', $data);
            }
        }

        public function login() {

             // Check for POST
             if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Process form

                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init data
                $data = [
                    'email' => trim($_POST['email']), 
                    'password' => trim($_POST['password']), 
                    'email_err' => '', 
                    'password_err' => '', 
                ];

                // Validate Email
                if (empty($data['email'])) {
                    $data['email_err'] = 'Please enter an email address';
                }

                // Validate Password
                if (empty($data['password'])) {
                    $data['password_err'] = 'Please enter your password';
                }


                // Check for user/email

                if ($this->userModel->findUserByEmail($data['email'])) {
                    // User found
                } else {
                    // User not found
                    $data['email_err'] = 'No user found';
                }


                // Make sure errors are empty

                if (empty($data['email_err']) && empty($data['password_err'])) {
                    // Validated
                    // Check and set logged in user

                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                    if ($loggedInUser) {
                        // Create Session
                        $this->createUserSession($loggedInUser);
                    } else {
                        $data['password_err'] = 'Password incorrect';
                        $this->view('users/login', $data);
                    }

                } else {
                    // Load view with errors
                    $this->view('users/login', $data);
                }




            } else {
                // Load form
                // Init data
                $data = [
                    'email' => '', 
                    'password' => '', 
                    'email_err' => '', 
                    'password_err' => '', 
                ];

                // Load view
                $this->view('users/login', $data);
            }
        }

        public function createUserSession($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['admin'] = $user->admin;
            $_SESSION['root'] = $user->root;
            redirect('animals');
        }
        
        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            unset($_SESSION['admin']);
            unset($_SESSION['root']);

            session_destroy();

            redirect('users/login');

        }

        // Loads the root page if the user has root privileges

        public function root() {

            if (isRoot()) {

                $this->view('users/root');
            } else {
                redirect('animals');
            }
        }

        // Delete a user by its id

        public function delete($id) {

            if (isRoot()) {
                if ($this->userModel->deleteUser($id)) {
                    flash('users_message', 'User deleted successfully');
                    redirect('users/root');
                } else {
                    flash('users_message', 'User not found');
                    redirect('users/root');
                }

            } else {
                redirect('animals');
            }
        }
    }
?>

