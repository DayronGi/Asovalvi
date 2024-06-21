<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'observations',
        'created_by',
        'creation_date',
        'reviewed_by',
        'review_date',
        'status'
    ];

    public function meeting_id(): BelongsTo
    {
        return $this->belongsTo(Meeting::class, 'meeting_id', 'meeting_id');
    }

    public function created_by(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'created_by', 'person_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(State::class, 'status', 'status');
    }

    public function assigned_to(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'assigned_to', 'person_id');
    }
}