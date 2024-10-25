<?php

use models\UserProject;
use models\User;
use models\Type;
use models\Project;
use models\Activity;
use Carbon\Carbon;

class Query
{
    public static function calculateUserStats($username)
    {
        $username = $_SESSION["username"];
        $totalHours = 0;
        $totalHoursThisMonth = 0;
        $numActivitiesThisMonth = 0;

        // Trova tutti i progetti associati all'utente
        $userProjects = UserProject::where('userName', $username)->get();

        // Ottieni il primo e l'ultimo giorno del mese corrente
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

        foreach ($userProjects as $userProject) {
            $projectId = $userProject->projectId;

            // Ottieni le attività associate a questo progetto con stato "Completed" o "InProgress"
            $activities = Activity::where('projectId', $projectId)
                ->whereIn('state', ['Completed', 'InProgress'])
                ->where('author', $username) // Filtra per l'utente autore dell'attività
                ->get();

            // Somma le ore di lavoro di ciascuna attività
            foreach ($activities as $activity) {
                $totalHours += $activity->hours;

                // Verifica se l'attività è stata svolta nel mese corrente
                if ($activity->startingDate >= $startOfMonth && $activity->startingDate <= $endOfMonth) {
                    $totalHoursThisMonth += $activity->hours;
                    $numActivitiesThisMonth++;
                }
            }
        }

        return [
            'totalHours' => $totalHours,
            'totalHoursThisMonth' => $totalHoursThisMonth,
            'numActivitiesThisMonth' => $numActivitiesThisMonth
        ];
    }

    public static function calculateAdminStats($username)
    {
        $numActivitiesCompletedThisMonth = 0;
        $numUsers = 0;
        $numProjectsCompletedThisMonth = 0;

        // Ottieni il primo e l'ultimo giorno del mese corrente
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

        // Trova tutte le attività completate fatte questo mese
        $numActivitiesCompletedThisMonth = Activity::where('state', 'Completed')
            ->whereBetween('endingDate', [$startOfMonth, $endOfMonth])
            ->count();

        // Trova tutti gli utenti
        $numUsers = User::count() -1 ;

        // Trova tutti i progetti completati questo mese
        $numProjectsCompletedThisMonth = Project::where('state', 'Finished')
            ->whereBetween('endingDate', [$startOfMonth, $endOfMonth])
            ->count();

        return [
            'numActivitiesCompletedThisMonth' => $numActivitiesCompletedThisMonth,
            'numUsers' => $numUsers,
            'numProjectsCompletedThisMonth' => $numProjectsCompletedThisMonth
        ];
    }
    public static function getStats($username){
        if($_SESSION["role"] == "Admin"){
            // Calcola le statistiche dell'utente
            return Query::calculateAdminStats($username);
        }else{
            // Calcola le statistiche dell'utente
            return Query::calculateUserStats($username);
        }

    }
}