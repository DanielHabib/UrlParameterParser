
class FiltersTest extends \PHPUnit_Framework_TestCase {
    use GeneratorTrait;
    public function testCanGetSimpleQuery()
    {
        $query = 'foo=bar';
        $filters = new Filters($query);
        $this->assertEquals(
            $filters,
            [
                Filters::EQUAL =>
                [
                    'foo' => 'bar'
                ]
            ]
        );
    }
    public function testCanHandleMultipleQueryParams()
    {
        $query = 'foo=bar&fooz=baz';
        $filters = new Filters($query);
        $this->assertEquals(
            $filters,
            [
                Filters::EQUAL => [
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
                Filters::EQUAL => [
                    'foo' => 'bar',
                    'fooz' => 'bar'
                ],
                Filters::GREATER_THAN => [
                    'goo' => 'gar'
                ],
                Filters::LESS_THAN => [
                    'loo' => 'lar'
                ],
                Filters::GREATER_OR_EQUAL_THAN => [
                    'rar' => 'raz'
                ],
                Filters::LESS_OR_EQUAL_THAN => [
                    'tar' => 'taz'
                ]
            ]
        );
    }
}
