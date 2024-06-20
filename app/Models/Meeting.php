<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $table = 'meetings';

    protected $primaryKey = 'meeting_id';

    public $timestamps = false;

    protected $fillable = [
        'meeting_date',
        'start_hour',
        'department_id',
        'called_by',
        'placement',
        'meeting_description',
        'empty_field',
        'topics',
        'created_by',
        'creation_date',
    ];
}
