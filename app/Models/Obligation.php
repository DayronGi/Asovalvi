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
}
