<?php
use models\Activity;
use models\UserProject;
use models\Project;
use models\Type;
use models\User;

class UserController
{
    public function modifyUsername()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (!isset($_SESSION["username"])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            exit();
        }

        //Check if user is admin
        if ($_SESSION["role"] != "Admin") {
            echo json_encode(['success' => false, 'message' => 'User is not administrator']);
            exit();
        }

        // In your controller or a specific API endpoint
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['username']) && isset($_POST['newUsername'])) {
                $username = $_POST['username'];
                $newUsername = $_POST['newUsername'];

                if($username == $_SESSION['username']){
                    $_SESSION['username'] = $newUsername;
                }

                // Call the method to update the user's name
                QueryUser::modifyUsername($username, $newUsername);

                // Return a response
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            }
        }
    }

    public function modifyName()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (!isset($_SESSION["username"])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            exit();
        }

        //Check if user is admin
        if ($_SESSION["role"] != "Admin") {
            echo json_encode(['success' => false, 'message' => 'User is not administrator']);
            exit();
        }

        // In your controller or a specific API endpoint
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['username']) && isset($_POST['newName'])) {
                $username = $_POST['username'];
                $newName = $_POST['newName'];

                if($username == $_SESSION['username']){
                    $_SESSION['name'] = $newName;
                }

                // Call the method to update the user's name
                QueryUser::modifyName($username, $newName);

                // Return a response
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            }
        }
    }

    public function modifySurname()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (!isset($_SESSION["username"])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            exit();
        }

        //Check if user is admin
        if ($_SESSION["role"] != "Admin") {
            echo json_encode(['success' => false, 'message' => 'User is not administrator']);
            exit();
        }

        // In your controller or a specific API endpoint
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['username']) && isset($_POST['newSurname'])) {
                $username = $_POST['username'];
                $newSurname = $_POST['newSurname'];

                if($username == $_SESSION['username']){
                    $_SESSION['surname'] = $newSurname;
                }
                // Call the method to update the user's name
                QueryUser::modifySurname($username, $newSurname);

                // Return a response
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            }
        }
    }

    public function modifyCity()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (!isset($_SESSION["username"])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            exit();
        }

        //Check if user is admin
        if ($_SESSION["role"] != "Admin") {
            echo json_encode(['success' => false, 'message' => 'User is not administrator']);
            exit();
        }

        // In your controller or a specific API endpoint
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['username']) && isset($_POST['newCity'])) {
                $username = $_POST['username'];
                $newCity = $_POST['newCity'];

                if($username == $_SESSION['username']){
                    $_SESSION['city'] = $newCity;
                }

                // Call the method to update the user's name
                QueryUser::modifyCity($username, $newCity);

                // Return a response
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            }
        }
    }

    public function modifyRole()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (!isset($_SESSION["username"])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            exit();
        }

        //Check if user is admin
        if ($_SESSION["role"] != "Admin") {
            echo json_encode(['success' => false, 'message' => 'User is not administrator']);
            exit();
        }

        // In your controller or a specific API endpoint
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['username']) && isset($_POST['newRole'])) {
                $username = $_POST['username'];
                $newRole = $_POST['newRole'];

                if(!($newRole == 'Admin' || $newRole == 'User')){
                    echo json_encode(['success' => false, 'message' => "Role $newRole is not valid"]);
                    exit();
                }

                if($newRole == 'User'){
                    $adminCount = User::where('role', 'Admin')->count();
                    $adminCount = 1;
                    if($adminCount == 1){
                        echo json_encode(['success' => false, 'message' => 'You cannot delete the last Admin']);
                        exit();
                    }
                }

                if($username == $_SESSION['username']){
                    $_SESSION['role'] = $newRole;
                }

                // Call the method to update the user's name
                QueryUser::modifyRole($username, $newRole);

                $sessionName = $_SESSION['username'];

                // Return a response
                echo json_encode(['success' => true, 'username' => $sessionName]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            }
        }
    }

    public function add(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

// Check if user is logged in
        if (!isset($_SESSION["username"])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            exit();
        }

// Check if user is admin
        if ($_SESSION["role"] != "Admin") {
            echo json_encode(['success' => false, 'message' => 'User is not administrator']);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['password'])) {
                // Create a new user with default values
                $user = new User();
                $user->username = 'default';
                $user->password = hash('sha256', $_POST['password']);
                $user->name = 'Default';
                $user->surname = 'Default';
                $user->city = 'Bezinlona';
                $user->role = 'User';

                // Salva il nuovo utente nel database
                if ($user->save()) {
                    $users = User::where('username','!=' , 'deleted_user');
                    echo json_encode(['success' => true, 'users' => $users]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to save user to database']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid input']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }

    }

    public function delete(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (!isset($_SESSION["username"])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            exit();
        }

        // Check if user is admin
        if ($_SESSION["role"] != "Admin") {
            echo json_encode(['success' => false, 'message' => 'User is not administrator']);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
            $username = $_POST['username'];

            // Check if the user exists
            $user = User::where('username', $username)->first();
            if (!$user) {
                echo json_encode(['success' => false, 'message' => 'User not found']);
                exit();
            }

            // Delete the user
            $user->delete();

            // Get all users after deletion
            $users = User::all();

            echo json_encode(['success' => true, 'message' => 'User deleted successfully', 'users' => $users]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
        }
    }

}