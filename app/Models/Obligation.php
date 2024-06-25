<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Obligation extends Model
{
    use HasFactory;

    protected $table = 'obligations';

    protected $primaryKey = 'obligation_id';

    public $timestamps = false;

    protected $fillable = [
        'obligation_id',
        'obligation_description',
        'category_id',
        'server_name',
        'quantity',
        'period',
        'alert_time',
        'created_by',
        'last_payment',
        'expiration_date',
        'observations',
        'internal_reference',
        'reviewed_by',
        'review_date',
        'status'
    ];

    public function reviewed_by(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'reviewed_by', 'person_id');
    }

    public function created_by(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'created_by', 'person_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(State::class, 'status', 'status');
    }
}
