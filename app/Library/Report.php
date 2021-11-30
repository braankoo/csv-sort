<?php

namespace App\Library;

use App\Library\Traits\FilterTrait;

abstract class Report implements ValidateInterface, FilterInterface {

    use FilterTrait;

    abstract public function findBestMatch();

}
