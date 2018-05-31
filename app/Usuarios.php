<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Usuarios extends Eloquent {

    protected $collection = 'users';

}
