<?php /** @noinspection PhpIncludeInspection */
namespace models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'Project';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Relazione uno-a-molti con la tabella Type
    public function type()
    {
        return $this->belongsTo(Type::class, 'type', 'name');
    }

    // Relazione uno-a-molti con la tabella User (autore)
    public function author()
    {
        return $this->belongsTo(User::class, 'author', 'username');
    }

    // Relazione molti-a-molti con la tabella User (partecipanti)
    public function users()
    {
        return $this->belongsToMany(User::class, 'UserProject', 'projectId', 'userName');
    }

    // Relazione uno-a-molti con la tabella Activity
    public function activities()
    {
        return $this->hasMany(Activity::class, 'projectId', 'id');
    }
}