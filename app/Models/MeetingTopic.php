<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeetingTopic extends Model
{
    use HasFactory;

    protected $table = 'meeting_topics';

    protected $primaryKey = 'topic_id';

    public $timestamps = false;

    protected $fillable = [
        'meeting_id',
        'type',
        'topic',
        'created_by',
        'creation_date',
        'status'
    ];

    // Agregar relación con Meeting
    public function meeting(): BelongsTo {
        return $this->belongsTo(Meeting::class, 'meeting_id', 'meeting_id');
    }
}