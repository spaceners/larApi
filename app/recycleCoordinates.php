<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Malhal\Geographical\Geographical;

class recycleCoordinates extends Model
{
    use Geographical;
    protected $table = 'recycleCoords';
}
