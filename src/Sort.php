<?php

namespace UrlParamParser;

class Sort {

    const DIRECTION_ASCENDING = 'asc';
    const DIRECTION_DESCENDING = 'desc';
    private $sorts;
    /**
     * @return mixed
     */
    public function getSorts()
    {
        return $this->sorts;
    }
    /**
     * @param mixed $sorts
     */
    public function setSorts($sorts)
    {
        $this->sorts = $sorts;
    }
    public function __construct(array $sorts = [])
    {
        foreach ($sorts as $sort) {
            $direction = $sort[0] === '-' ? $this::DIRECTION_DESCENDING : $this::DIRECTION_ASCENDING;
            $column = $direction === $this::DIRECTION_DESCENDING ? substr($sort, 1) : $sort;
            array_push($this->sorts, [$column => $direction]);
        }
    }
}
