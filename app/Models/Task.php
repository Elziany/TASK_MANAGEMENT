<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks' ;
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class , Assignment::class , 'task_id' , 'user_id');
    }

    public function dependencies()
    {
        return $this->belongsToMany(Task::class,TaskDependencies::class , 'task_id' , 'depends_on_task_id');
    }
}
