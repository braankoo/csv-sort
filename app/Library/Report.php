<?php

namespace App\Library;

use App\Library\CSV\Traits\FilterTrait;

abstract class Report implements ValidateInterface, FilterInterface {

    use FilterTrait;
    
    abstract public function findBestMatch();

}
