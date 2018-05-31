<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Clubes extends Eloquent {

    public $timestamps = false;

    protected $collection = 'clubs';

}
