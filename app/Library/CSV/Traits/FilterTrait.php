<?php

namespace App\Library\CSV\Traits;

trait FilterTrait {

    /**
     * @var string
     */
    private string $filter;
    /**
     * @var string
     */
    private string $filterValue;
    /**
     * @param string $filter
     * @return $this
     */
    public function setFilter(string $filter): self
    {
        $this->filter = $filter;

        return $this;
    }
    /**
     * @return string
     */
    public function getFilter(): string
    {
        return $this->filter;
    }
    /**
     * @param string $value
     * @return $this
     */
    public function setFilterValue(string $value): self
    {
        $this->filterValue = $value;

        return $this;
    }
    /**
     * @return string
     */
    public function getFilterValue(): string
    {
        return $this->filterValue;
    }

}
