<?php
namespace UrlParamParser\Test;

use UrlParamParser\Sort;

class SortTest extends \PHPUnit_Framework_TestCase {

    public function testSortsCorrectlyParsesSingleInput()
    {
        $rawSort = ['foo'];
        $sorts = new Sort($rawSort);
        $this->assertEquals(['foo'=> Sort::DIRECTION_ASCENDING], $sorts->getSorts());
    }
    public function testSortsCorrectlyParsesMultipleInputs()
    {
        $rawSort = ['foo', '-' . 'bar', 'baz'];
        $sorts = new Sort($rawSort);
        $this->assertEquals(
            [
                $rawSort[0]=>Sort::DIRECTION_ASCENDING,
                substr($rawSort[1], 1)=>Sort::DIRECTION_DESCENDING,
                $rawSort[2]=>Sort::DIRECTION_ASCENDING,
            ], $sorts->getSorts());
    }
    public function testSortsMaintainsSortOrder()
    {
        $rawSort = ['foo', '-' . 'bar', 'baz'];
        $sorts = new Sort($rawSort);
        $i = 0;
        foreach($sorts as $sort => $direction) {
            $expectedSort = $direction === Sort::DIRECTION_DESCENDING ? substr($rawSort[$i], 1) : $rawSort[$i];
            $this->assertEquals($expectedSort, $sort);
            $i++;
        }
    }
}
