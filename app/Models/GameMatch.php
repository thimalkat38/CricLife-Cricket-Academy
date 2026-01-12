<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameMatch extends Model
{
    protected $table = 'matches';

    protected $fillable = [
        'team_1',
        'team_2',
        'date',
        'venue',
        'type',
        'level',
        'note',
    ];
}
