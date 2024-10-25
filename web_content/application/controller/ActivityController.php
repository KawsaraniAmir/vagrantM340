<?php
use models\Activity;
use models\UserProject;
use models\Project;
use models\Type;
use models\User;
class ActivityController
{
    public function add()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Check if user is logged in
        if (!isset($_SESSION["username"])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            exit();
        }

        if (isset($_POST['projectId']) && isset($_SESSION['username']) && isset($_POST['endingDate'])) {
            $projectId = Security::filterField($_POST['projectId']);
            $username = Security::filterField($_SESSION['username']);
            $endingDate = Security::filterField($_POST['endingDate']);

            if (!isset($_SESSION["username"])) {
                echo json_encode(['success' => false, 'message' => 'User not logged in']);
                exit();
            }

            // Controlla lo stato del progetto
            $project = Project::find($projectId);
            if ($project->state === 'Finished' || $project->state === 'Stopped') {
                echo json_encode(['success' => false, 'message' => 'Cannot create activity for a project in "Finished" or "Stopped" state']);
                exit();
            }


            // Create a new activity with default values
            $activity = new Activity();
            $activity->startingDate = date('Y-m-d'); // Current date as the starting date
            $activity->endingDate = $endingDate;
            $activity->hours = 0; // Default hours
            $activity->description = 'Default description'; // Default description
            $activity->state = 'InProgress'; // Default state
            $activity->author = $username; // The user assigned to the activity
            $activity->projectId = $projectId; // The project to which the activity belongs
            $activity->save();

            $activities = Activity::where('author', $_SESSION['username'])
                ->where('projectId', $activity->projectId)
                ->get();

            echo json_encode(['success' => true, 'activities' => $activities]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid input']);
        }
    }

    public function modifyEndingDate()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (!isset($_SESSION["username"])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            exit();
        }

        // Check if user is user
        if ($_SESSION["role"] != "User") {
            echo json_encode(['success' => false, 'message' => 'User is not User']);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['activityId']) && isset($_POST['newEndingDate'])) {
                $activityId = $_POST['activityId'];
                $newEndingDate = $_POST['newEndingDate'];

                // Update the ending date of the activity
                $activity = Activity::find($activityId);
                if ($activity) {
                    $activity->endingDate = $newEndingDate;
                    $activity->save();

                    $activities = Activity::where('author', $_SESSION['username'])
                            ->where('projectId', $activity->projectId)
                            ->get();

                    // Return updated activity
                    echo json_encode(['success' => true, 'activities' => $activities]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Activity not found']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            }
        }
    }

    public function modifyHours()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (!isset($_SESSION["username"])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            exit();
        }

        // Check if user is user
        if ($_SESSION["role"] != "User") {
            echo json_encode(['success' => false, 'message' => 'User is not administrator']);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['activityId']) && isset($_POST['newHours'])) {
                $activityId = $_POST['activityId'];
                $newHours = $_POST['newHours'];

                // Update the ending date of the activity
                $activity = Activity::find($activityId);
                if ($activity) {
                    $activity->hours = $newHours;
                    $activity->save();

                    $activities = Activity::where('author', $_SESSION['username'])
                        ->where('projectId', $activity->projectId)
                        ->get();

                    // Return updated activity
                    echo json_encode(['success' => true, 'activities' => $activities]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Activity not found']);
                }
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

        // Check if user is user
        if ($_SESSION["role"] != "User") {
            echo json_encode(['success' => false, 'message' => 'User is not administrator']);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['activityId']) && isset($_POST['newDescription'])) {
                $activityId = $_POST['activityId'];
                $newDescription = $_POST['newDescription'];

                // Update the ending date of the activity
                $activity = Activity::find($activityId);
                if ($activity) {
                    $activity->description = $newDescription;
                    $activity->save();

                    $activities = Activity::where('author', $_SESSION['username'])
                        ->where('projectId', $activity->projectId)
                        ->get();

                    // Return updated activity
                    echo json_encode(['success' => true, 'activities' => $activities]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Activity not found']);
                }
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

        // Check if user is user
        if ($_SESSION["role"] != "User") {
            echo json_encode(['success' => false, 'message' => 'User is not administrator']);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['activityId']) && isset($_POST['newState'])) {
                $activityId = $_POST['activityId'];
                $newState = $_POST['newState'];

                if (!($newState == "InProgress" ||
                    $newState == "Deleted" ||
                    $newState == "Completed")) {
                    echo json_encode(['success' => false, 'message' => "$newState is not a valid state."]);
                    exit();
                }

                // Update the ending date of the activity
                $activity = Activity::find($activityId);
                if ($activity) {
                    $activity->state = $newState;
                    $activity->save();

                    $activities = Activity::where('author', $_SESSION['username'])
                        ->where('projectId', $activity->projectId)
                        ->get();

                    // Return updated activity
                    echo json_encode(['success' => true, 'activities' => $activities]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Activity not found']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            }
        }
    }
}