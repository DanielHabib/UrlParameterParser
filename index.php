<?php
require_once __DIR__ . '/vendor/autoload.php';

use DanielHabib\URLParamParser\Filter;
use DanielHabib\URLParamParser\Sort;

$filter = new Filter('fooo');
$sort = new Sort([]);