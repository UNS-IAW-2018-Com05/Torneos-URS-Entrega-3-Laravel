<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Fechas extends Eloquent {

    public $timestamps = false;

    protected $collection = 'fechas';

}
