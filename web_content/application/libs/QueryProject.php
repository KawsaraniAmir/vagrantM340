<?php

use models\UserProject;
use models\User;
use models\Type;
use models\Project;
use models\Activity;
use Carbon\Carbon;

class QueryProject
{
    public static function getUsersByProject($projectId)
    {
        return User::join('UserProject', 'User.username', '=', 'UserProject.userName')
            ->where('UserProject.projectId', $projectId)
            ->get(['User.*']);
    }
    public static function modifyDescription($projectId, $newDescription)
    {
        // Trova il progetto per ID e aggiorna la descrizione
        $project = Project::find($projectId);
        if ($project) {
            $project->description = $newDescription;
            $project->save();
        }
    }

    public static function modifyState($projectId, $newState)
    {
        // Trova il progetto per ID e aggiorna lo stato
        $project = Project::find($projectId);
        if ($project) {
            $project->state = $newState;
            $project->save();
        }
    }


    public static function modifyType($projectId, $newType)
    {
        // Trova il progetto per ID e aggiorna il tipo
        $project = Project::find($projectId);
        if ($project) {
            $project->type = $newType;
            $project->save();
        }
    }

    public static function getActivitiesByProjectAndUser($projectId, $username)
    {
        // Trova tutte le attività associate a questo progetto e fatte dall'utente specificato
        $activities = Activity::where('projectId', $projectId)
            ->where('author', $username)
            ->get();

        return $activities;
    }
}