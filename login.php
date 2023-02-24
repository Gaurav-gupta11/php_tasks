<?php
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
        $stored_password = 'gaurav';
        $stored_username = 'gaurav';

        if ($username == $stored_username && $password == $stored_password) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $stored_username;
            header('Location: pager.php');
            exit;
        } else {
            header('Location: index.html?error=invalid_id_password');
        }
    }
}

session_start();

// Create an instance of the LoginController class
$login_controller = new LoginController();

// Authenticate the user
$login_controller->authenticateUser($_POST['username'], $_POST['password']);

?>