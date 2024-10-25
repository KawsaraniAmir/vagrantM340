<?php

use models\UserProject;
use models\User;
use models\Type;
use models\Project;
use models\Activity;
use Carbon\Carbon;

class QueryType
{

    public static function modifyName($currentName, $newName)
    {
        // Trova il progetto per ID e aggiorna la descrizione
        $type = Type::find($currentName);
        if ($type) {
            $type->name = $newName;
            $type->save();
        }
    }

    public static function modifyDescription($name, $newDescription)
    {
        // Trova il progetto per ID e aggiorna la descrizione
        $type = Type::find($name);
        if ($type) {
            $type->description = $newDescription;
            $type->save();
        }
    }

}