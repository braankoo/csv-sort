<?php

namespace App\Library;


interface FilterInterface {

    /**
     * @return array
     */
    public function filterOptions(): array;

    /**
     * @param string $column
     * @return mixed
     */
    public function setFilter(string $column);

    /**
     * @return mixed
     */
    public function getFilter();

}
