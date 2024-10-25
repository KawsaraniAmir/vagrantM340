<?php /** @noinspection PhpIncludeInspection */
namespace models;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'Type';
    protected $primaryKey = 'name';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    // Relazione uno-a-molti con la tabella Project
    public function projects()
    {
        return $this->hasMany(Project::class, 'type', 'name');
    }
}