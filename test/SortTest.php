<?php
namespace UrlParamParser\Test;

use UrlParamParser\Sort;

class SortTest extends \PHPUnit_Framework_TestCase {

    public function testSortsCorrectlyParsesSingleInput()
    {
        $rawSort = ['foo'];
        $sorts = new Sort($rawSort);
        $this->assertEquals([Sort::DIRECTION_ASCENDING=>$rawSort], $sorts);
    }
    public function testSortsCorrectlyParsesMultipleInputs()
    {
        $rawSort = ['foo', '-' . 'bar', 'baz'];
        $sorts = new Sorts($rawSort);
        $this->assertEquals(
            [
                Sort::DIRECTION_ASCENDING=>$rawSort[0],
                Sort::DIRECTION_DESCENDING=>$rawSort[1],
                Sort::DIRECTION_ASCENDING=>$rawSort[2],
            ], $sorts);
    }
    public function testSortsMaintainsSortOrder()
    {
        $rawSort = ['foo', '-' . 'bar', 'baz'];
        $sorts = new Sort($rawSort);
        $this->assertEquals(
            [
                Sort::DIRECTION_ASCENDING=>$rawSort[0],
            ], $sorts[0]);
        $this->assertEquals(
            [
                Sort::DIRECTION_DESCENDING=>$rawSort[1],
            ], $sorts[1]);
        $this->assertEquals(
            [
                Sort::DIRECTION_ASCENDING=>$rawSort[2],
            ], $sorts[2]);
    }
}
