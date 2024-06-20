<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obligation extends Model
{
    use HasFactory;

    protected $table = 'obligations';

    protected $primaryKey = 'obligation_id';

    public $timestamps = false;

    protected $fillable = [
        'obligation_id',
        'obligation_description',
        'type_id',
        'category_id',
        'server_name',
        'quantity',
        'period',
        'alert_time',
        'department_id',
        'created_by',
        'last_payment',
        'expiration_date',
        'observations',
        'internal_reference',
        'reviewed_by',
        'review_date',
        'status'
    ];
}
