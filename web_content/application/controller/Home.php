<?php

use models\Activity;
use models\UserProject;
use models\Project;
use models\Type;
use models\User;

class Home
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        if (!isset($_SESSION["username"])){
            header("Location:" . URL . "Login");
        }

        $username = $_SESSION["username"];
        $userStats = Query::getStats($username);

        // Ottieni i progetti dove l'utente è autore
        $authorProjects = Project::where('author', $username)->get();

        // Ottieni i progetti dove l'utente è un membro
        $userProjects = UserProject::where('username', $username)->get();

        // Inizializza un array per contenere tutti i progetti
        $projects = [];

        // Aggiungi i progetti dove l'utente è autore
        foreach ($authorProjects as $project) {
            // Ottieni il numero di membri associati a questo progetto
            $numMembers = UserProject::where('projectId', $project->id)->count();
            $project->members = $numMembers;
            $projects[] = $project;
        }

        // Aggiungi i progetti dove l'utente è un membro
        foreach ($userProjects as $userProject) {
            $project = Project::find($userProject->projectId);
            if ($project) {
                // Ottieni il numero di membri associati a questo progetto
                $numMembers = UserProject::where('projectId', $project->id)->count();
                $project->members = $numMembers;
                $projects[] = $project;
            }
        }

        // Rimuovi i duplicati nel caso in cui l'utente sia sia autore che membro dello stesso progetto
        $projects = array_unique($projects, SORT_REGULAR);

        // Aggiorna la navbar
        $_SESSION['currentPage'] = 'dashboard';

        require 'application/views/templates/header.php';
        require 'application/views/templates/sidebar.php';
        require 'application/views/home/dashboard.php';
        require 'application/views/templates/footer.php';
    }
    public function types()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["username"])) {
            header("Location:" . URL . "Login");
        }

        if($_SESSION["role"] != "Admin"){
            header("Location:" . URL . "Home");
        }

        $username = $_SESSION["name"];
        $userStats = Query::getStats($username);
        $types = Type::all();

        //Aggiorna la navbar
        $_SESSION['currentPage'] = 'types';

        require 'application/views/templates/header.php';
        require 'application/views/templates/sidebar.php';
        require 'application/views/home/types/types.php';
        require 'application/views/templates/footer.php';
    }

    public function users()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        if (!isset($_SESSION["username"])) {
            header("Location:" . URL . "home");
        }

        if($_SESSION["role"] != "Admin"){
            header("Location:" . URL . "home");
        }

        $username = $_SESSION["name"];
        $userStats = Query::getStats($username);
        $users = User::all();

        //Aggiorna la navbar
        $_SESSION['currentPage'] = 'users';

        require 'application/views/templates/header.php';
        require 'application/views/templates/sidebar.php';
        require 'application/views/home/users/users.php';
        require 'application/views/templates/footer.php';
    }

    public function projects()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["username"]) || $_SESSION["role"] != "Admin") {
            header("Location:" . URL . "Login");
        }

        $username = $_SESSION["name"];
        $userStats = Query::getStats($username);
        $projects = Project::all();

        //Aggiorna la navbar
        $_SESSION['currentPage'] = 'projects';

        require 'application/views/templates/header.php';
        require 'application/views/templates/sidebar.php';
        require 'application/views/home/projects/projects.php';
        require 'application/views/templates/footer.php';
    }

    public function project($projectId)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['role'])){
            // Ottieni il progetto
            $project = Project::where('id', $projectId)->first();

            if($_SESSION['role'] == 'User'){
                $username = $_SESSION["username"];

                $activities = QueryProject::getActivitiesByProjectAndUser($projectId, $username);

                // Aggiorna la navbar
                $_SESSION['currentPage'] = 'dashboard';

                require 'application/views/templates/header.php';
                require 'application/views/templates/sidebar.php';
                require 'application/views/home/projects//projectUser.php';
                require 'application/views/templates/footer.php';
            }else{
                $username = $_SESSION["username"];

                $activities = Activity::where('projectId', $projectId)->get();

                // Ottieni la lista dei membri associati al progetto
                $members = UserProject::where('projectId', $projectId)
                    ->join('User', 'UserProject.username', '=', 'User.username')
                    ->get();

                // Aggiorna la navbar
                $_SESSION['currentPage'] = 'projects';

                require 'application/views/templates/header.php';
                require 'application/views/templates/sidebar.php';
                require 'application/views/home/projects/projectAdmin.php';
                require 'application/views/templates/footer.php';
            }
        }else{
            header("Location:" . URL . "Login");
        }
    }

    public function user($username)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["username"]) || !isset($_SESSION["role"]) || $_SESSION["role"] != "Admin") {
            header("Location:" . URL . "home");
        }

        $user = User::where('username', $username)->first();
        $projects = $user->projects()->get();

        // Aggiorna la navbar
        $_SESSION['currentPage'] = 'users';

        require 'application/views/templates/header.php';
        require 'application/views/templates/sidebar.php';
        require 'application/views/home/users/user.php';
        require 'application/views/templates/footer.php';
    }
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("location: " . URL);
    }
}
