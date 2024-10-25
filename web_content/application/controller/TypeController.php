<?php
use models\Activity;
use models\UserProject;
use models\Project;
use models\Type;
use models\User;
class TypeController
{
    public function add() {
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
            if (isset($_POST['typeName'])) {
                // Create a new type
                $type = new Type();
                $type->name = $_POST['typeName'];
                $type->description = "Default";
                $type->save();

                echo json_encode(['success' => true, 'type' => $type]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid input']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
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
            if (isset($_POST['newName']) && isset($_POST['name'])) {
                $name = $_POST['name'];
                $newName = $_POST['newName'];

                // Call the method to update the user's name
                QueryType::modifyName($name, $newName);

                // Get a new updated table to use in the js code
                $types = Type::all();

                // Return a response
                echo json_encode(['success' => true, 'types' => $types]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            }
        }
    }

    public function modifyDescription()
    {
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

        // In your controller or a specific API endpoint
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['name']) && isset($_POST['newDescription'])) {
                $name = $_POST['name'];
                $newDescription = $_POST['newDescription'];

                // Call the method to update the user's name
                QueryType::modifyDescription($name, $newDescription);

                // Get a new updated table to use in the js code
                $types = Type::all();

                // Return a response
                echo json_encode(['success' => true, 'types' => $types]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            }
        }
    }
}