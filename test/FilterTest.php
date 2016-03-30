<?php
namespace UrlParamParser\Test;

use URLParamParser\Filter;

class FilterTest extends \PHPUnit_Framework_TestCase {

    public function testCanGetSimpleQuery()
    {
        $query = 'foo=bar';
        $filters = new Filter($query);
        $this->assertEquals(
            $filters,
            [
                Filter::EQUAL =>
                [
                    'foo' => 'bar'
                ]
            ]
        );
    }
    public function testCanHandleMultipleQueryParams()
    {
        $query = 'foo=bar&fooz=baz';
        $filters = new Filter($query);
        $this->assertEquals(
            $filters,
            [
                Filter::EQUAL => [
                        'foo' => 'bar',
                        'fooz' => 'bar'
                ]
            ]
        );
    }

    public function testCanHandleMultipleQueryParamsWithDifferentSigns()
    {
        $query = 'foo=bar&fooz=baz&goo>gar&loo<lar&rar≥raz&tar≤taz';
        $filters = new Filters($query);
        $this->assertEquals(
            $filters,
            [
                Filter::EQUAL => [
                    'foo' => 'bar',
                    'fooz' => 'bar'
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
