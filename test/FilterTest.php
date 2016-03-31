<?php
namespace UrlParamParser\Test;

use URLParamParser\Filter;

class FilterTest extends \PHPUnit_Framework_TestCase {

    public function testCanGetSimpleQuery()
    {
        $query = 'foo=bar';
        $filters = new Filter($query);
        $this->assertEquals(
            $filters->getFilters()[Filter::EQUAL],
            [
                'foo' => 'bar'
            ]
        );
    }
    public function testCanHandleMultipleQueryParams()
    {
        $query = 'foo=bar&fooz=baz';
        $filters = new Filter($query);
        $this->assertEquals(
            $filters->getFilters()[Filter::EQUAL],

            [
                'foo' => 'bar',
                'fooz' => 'baz'
             ]

        );
    }

    public function testCanHandleMultipleQueryParamsWithDifferentSigns()
    {
        $query = 'foo=bar&fooz=baz&goo>gar&loo<lar&rar≥raz&tar≤taz';
        $filters = new Filter($query);
        $this->assertEquals(
            $filters->getFilters(),
            [
                Filter::EQUAL => [
                    'foo' => 'bar',
                    'fooz' => 'baz'
                ],
                Filter::GREATER_THAN => [
                    'goo' => 'gar'
                ],
                Filter::LESS_THAN => [
                    'loo' => 'lar'
                ],
                Filter::GREATER_OR_EQUAL_THAN => [
                    'rar' => 'raz'
                ],
                Filter::LESS_OR_EQUAL_THAN => [
                    'tar' => 'taz'
                ]
            ]
        );
    }
}
