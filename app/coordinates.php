<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Malhal\Geographical\Geographical;

class Coordinates extends Model
{
    use Geographical;
    protected $table = 'coordinates';
}
