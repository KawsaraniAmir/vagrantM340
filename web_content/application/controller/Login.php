<?php
use models\User;
class Login
{
    public function index()
    {
        Security::generateCSRF();
        require 'application/views/login/index.php';
    }

    public function login()
    {
        session_start();
        if (isset($_POST['username']) && isset($_POST['password'])) {
            var_dump($_POST['token']);
            if (Security::isValidToken($_POST['token'])) {
                $username = Security::filterField($_POST['username']);
                $pass = hash('sha256', $_POST['password']);

                var_dump($username);
                var_dump($pass);

                $result = User::where('username', $username)
                    ->where('password', $pass)
                    ->first();


                //se trovo un elemento posso entrare
                if ($result) {
                    $_SESSION["role"] = $result['role'];
                    $_SESSION["username"] = $username;
                    $_SESSION["name"] = $result['name'];
                    $_SESSION["surname"] = $result['surname'];

                    header("Location:" . URL . "home");
                } else {
                    $this->index();
                }
            } else {
                $this->index();
            }
        }
    }
}