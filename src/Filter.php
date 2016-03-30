<?php

namespace UrlParamParser;

class Filter {

    const EQUAL = 'eq';
    const LESS_THAN = 'lt';
    const GREATER_THAN = 'gt';
    const LESS_OR_EQUAL_THAN = 'ge';
    const GREATER_OR_EQUAL_THAN = 'le';

    const ACCEPTED_SIGNS = [
        '≤' => Filter::LESS_OR_EQUAL_THAN,
        '≥' => Filter::GREATER_OR_EQUAL_THAN,
        '>' => Filter::GREATER_THAN,
        '<' => Filter::LESS_THAN,
        '=' => Filter::EQUAL
    ];

    private $filters;
    /**
     * @return mixed
     */
    public function getFilters()
    {
        return $this->filters;
    }
    /**
     * @param mixed $filters
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
    }
    public function __construct($query)
    {
        foreach (array_values($this::ACCEPTED_SIGNS) as $sign){
            $this->filters[$sign] = [];
        }
        $params = explode("&", $query);
        foreach ($params as $paramPair) {
            foreach (array_keys($this::ACCEPTED_SIGNS) as $sign) {
                if (strpos($paramPair, $sign) !== false) {
                    $arr = explode($sign, $paramPair);
                    $column = $arr[0];
                    $value = $arr[1];
                    $this->filters[$this::ACCEPTED_SIGNS[$sign]][$column] = $value;
                }
            }
        }
    }
}
