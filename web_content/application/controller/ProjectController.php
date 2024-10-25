<?php
use models\Activity;
use models\UserProject;
use models\Project;
use models\Type;
use models\User;

class ProjectController
{
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
            if (isset($_POST['projectName'])) {
                // Create a new projects with default values
                $project = new Project();
                $project->name = $_POST['projectName'];
                $project->startingDate = date('Y-m-d');
                $project->author = $_SESSION['username'];
                $project->description = 'Default';
                $project->state = 'Active';
                $project->type = 'Default';

                // Save the new projects to the database
                $project->save();

                echo json_encode(['success' => true, 'project' => $project]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid input']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
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

        //Check if user is admin
        if ($_SESSION["role"] != "Admin") {
            echo json_encode(['success' => false, 'message' => 'User is not administrator']);
            exit();
        }

        // In your controller or a specific API endpoint
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['projectId']) && isset($_POST['newDescription'])) {
                $projectId = $_POST['projectId'];
                $newDescription = $_POST['newDescription'];

                // Call the method to update the projects description
                QueryProject::modifyDescription($projectId, $newDescription);

                // Return a response
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            }
        }
    }

    public function modifyState()
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
            if (isset($_POST['projectId']) && isset($_POST['newState'])) {
                $projectId = $_POST['projectId'];
                $newState = $_POST['newState'];

                //Check if assigned state is valid
                if (!($newState == "Inactive" ||
                    $newState == "Active" ||
                    $newState == "Finished" ||
                    $newState == "Stopped")) {
                    echo json_encode(['success' => false, 'message' => "$newState is not a valid state."]);
                    exit();
                }

                // Call the method to update the projects description
                QueryProject::modifyState($projectId, $newState);

                // Return a response
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            }
        }
    }

    public function addUser()
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

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['projectId']) && isset($_POST['username'])) {
            $projectId = $_POST['projectId'];
            $username = $_POST['username'];

            // Check if the user exists
            $user = User::where('username', $username)->first();
            if (!$user) {
                echo json_encode(['success' => false, 'message' => 'User not found']);
                exit();
            }

            // Check if the user is already assigned to the project
            $existingAssignment = UserProject::where('projectId', $projectId)->where('userName', $username)->first();
            if ($existingAssignment) {
                echo json_encode(['success' => false, 'message' => 'User already assigned to the project']);
                exit();
            }

            // Assign the user to the project
            $userProject = new UserProject();
            $userProject->projectId = $projectId;
            $userProject->userName = $username;  // Assicurati che questo sia il nome del campo corretto
            $userProject->save();

            $users = QueryProject::getUsersByProject($projectId);

            echo json_encode(['success' => true, 'users' => $users]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
        }
    }
    public function removeUser()
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

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['projectId']) && isset($_POST['username'])) {
            $projectId = $_POST['projectId'];
            $username = $_POST['username'];

            try {
                // Check if the user is assigned to the project
                $assignment = UserProject::where('projectId', $projectId)->where('userName', $username)->first();
                if (!$assignment) {
                    throw new \Exception('User is not assigned to the project');
                }

                // Remove the user's assignments from the project
                $assignment->delete();

                // Remove the user's activities associated with the project
                Activity::where('author', $username)->where('projectId', $projectId)->delete();

                // Get all users associated with the project after removal
                $users = QueryProject::getUsersByProject($projectId);

                echo json_encode(['success' => true, 'users' => $users]);
            } catch (\Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
        }
    }



}