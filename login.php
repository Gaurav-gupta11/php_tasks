<?php
session_start();

/**
 * Class LoginController
 * Handles the login functionality of the application.
 */
class LoginController
{
    /**
     * Authenticates the user and logs them in.
     * 
     * @param string $username The username entered by the user.
     * @param string $password The password entered by the user.
     * 
     * @return void
     */
    public function authenticateUser(string $username, string $password): void
    {
        if ($username == 'gaurav' && $password == 'gaurav') {
            $_SESSION['logged_in'] = true;
            header('Location: pager_index.php');
            exit;
        } else {
            header('Location: index.php?error=invalid_id_password');
           
        }
    }
}

// Create an instance of the LoginController class
$login_controller = new LoginController();

// Authenticate the user
$login_controller->authenticateUser($_POST['username'], $_POST['password']);

?>