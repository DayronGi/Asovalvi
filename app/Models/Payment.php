<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'obligation_payments';

    protected $primaryKey = 'obligation_id';

    public $timestamps = false;
}
