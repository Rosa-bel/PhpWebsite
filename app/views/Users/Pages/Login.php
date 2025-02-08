<?php 

include_once("../app/views/PageView.php");
include_once("../app\controllers\Admin\LoginController.php");

class PageLogin extends PageView { 

    public function afficher() { 


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
        
            $loginController = new LoginController();
            $result = $loginController->connection($username, $password);
        
            if ($result === 0) {
                echo "<script>alert('Vous ne pouvez pas accédez à votre compte actuellment !'); </script>";
            } elseif ($result === null) {
                echo "<script>alert('Veuillez verifier votre username et mot de passe'); </script>";
            }
          
        }
        echo '<html lang="en">';
        
     
        $css = ['Users/Login.css']; 
        $this->entete($css, "Login");

        echo '<body>';
        echo '<div class="login-container">';

        // Login form
        echo '<form id="loginForm" method="POST">';
        echo '<h2>Login</h2>';
        echo '<label for="username">Username:</label>';
        echo '<input type="text" id="username" name="username" required>';
        echo '<label for="password">Password:</label>';
        echo '<input type="password" id="password" name="password" required>';
        echo '<button type="submit">Login</button>';
        echo '</form>';

        echo '</div>';

        echo '</body>';
        echo '</html>';
    }
}
?>
