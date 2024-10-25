<?php

use models\UserProject;
use models\User;
use models\Type;
use models\Project;
use models\Activity;
use Carbon\Carbon;

class QueryUser
{
    public static function modifyUsername($username, $newUsername)
    {
        // Trova il progetto per ID e aggiorna la descrizione
        $user = User::find($username);
        if ($user) {
            $user->username = $newUsername;
            $user->save();
        }
    }

    public static function modifyName($username, $newName)
    {
        // Trova il progetto per ID e aggiorna la descrizione
        $user = User::find($username);
        if ($user) {
            $user->name = $newName;
            $user->save();
        }
    }

    public static function modifySurname($username, $newSurname)
    {
        // Trova il progetto per ID e aggiorna la descrizione
        $user = User::find($newSurname);
        if ($user) {
            $user->description = $newSurname;
            $user->save();
        }
    }

    public static function modifyCity($username, $newCity)
    {
        // Trova il progetto per ID e aggiorna la descrizione
        $user = User::find($newCity);
        if ($user) {
            $user->city = $newCity;
            $user->save();
        }
    }

    public static function modifyRole($username, $newRole)
    {
        // Trova il progetto per ID e aggiorna la descrizione
        $user = User::find($newRole);
        if ($user) {
            $user->role = $newRole;
            $user->save();
        }
    }
}