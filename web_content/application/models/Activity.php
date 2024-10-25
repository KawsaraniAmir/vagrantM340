<?php /** @noinspection PhpIncludeInspection */
namespace models;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'Activity';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Relazione uno-a-molti con la tabella Project
    public function project()
    {
        return $this->belongsTo('App\Project', 'projectId', 'id');
    }

    // Relazione uno-a-molti con la tabella User
    public function user()
    {
        return $this->belongsTo('App\User', 'username', 'username');
    }
}
