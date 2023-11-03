<?php

namespace App\Models;

use Glhd\Bits\Database\HasSnowflakes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thunk\Verbs\FromState;

class Quote extends Model
{
    use FromState;
    use HasSnowflakes;
    use HasFactory;

    protected $guarded = [];
}
