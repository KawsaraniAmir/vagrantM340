<?php /** @noinspection PhpIncludeInspection */
namespace models;
use Illuminate\Database\Eloquent\Model;
class UserProject extends Model
{
    protected $table = 'UserProject';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Relazione molti-a-molti con la tabella User
    public function user()
    {
        return $this->belongsTo(User::class, 'userName', 'username');
    }

    // Relazione molti-a-molti con la tabella Project
    public function project()
    {
        return $this->belongsTo(Project::class, 'projectId', 'id');
    }
}