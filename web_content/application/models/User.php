<?php /** @noinspection PhpIncludeInspection */
namespace models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'User';
    protected $primaryKey = 'username';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    // Relazione uno-a-molti con la tabella Project (come autore)
    public function authoredProjects()
    {
        return $this->hasMany(Project::class, 'author', 'username');
    }

    // Relazione molti-a-molti con la tabella Project (come partecipante)
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'UserProject', 'userName', 'projectId');
    }

    // Relazione molti-a-molti con la tabella Activity (come partecipante)
    public function activity()
    {
        return $this->hasMany(Activity::class, 'username', 'username');
    }

}
