<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $primaryKey = 'task_id';

    public $timestamps = false;

    protected $fillable = [
        'meeting_id',
        'start_date',
        'estimated_time',
        'units',
        'type_id',
        'task_description',
        'assigned_to',
        'department_id',
        'observations',
        'created_by',
        'creation_date',
        'reviewed_by',
        'review_date',
        'status'
    ];
}