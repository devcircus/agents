<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'goal_id',
        'parent_task_id',
        'assigned_to',
        'title',
        'progress',
        'task_status',
        'task_priority',
    ];

    // set custom collection class
    public function newCollection(array $models = []) {
        return new TaskCollection($models);
    }

    /**
     * Define the relationship for parent task.
     * A task can have one parent.
     */
    public function parent()
    {
        return $this->belongsTo(Task::class, 'parent_task_id');
    }

    /**
     * Define the relationship for child tasks.
     * A task can have many child tasks.
     */
    public function children()
    {
        return $this->hasMany(Task::class, 'parent_task_id');
    }

    /**
     * Get the goal that this task belongs to.
     */
    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    /**
     * Get the agent assigned to this task.
     */
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'assigned_to');
    }

    /**
     * Get the comments associated with this task.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'related_object');
    }

    /**
     * Get the activity logs associated with this task.
     */
    public function activityLogs()
    {
        return $this->morphMany(ActivityLog::class, 'related_object');
    }
}
