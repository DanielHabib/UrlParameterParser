<?php
class SortsTest extends \PHPUnit_Framework_TestCase {
    use GeneratorTrait;
    public function testSortsCorrectlyParsesSingleInput()
    {
        $faker = $this->getFaker();
        $rawSort = [$faker->word];
        $sorts = new Sorts($rawSort);
        $this->assertEquals([Sorts::DIRECTION_ASCENDING=>$rawSort], $sorts);
    }
    public function testSortsCorrectlyParsesMultipleInputs()
    {
        $faker = $this->getFaker();
        $rawSort = [$faker->word, '-' . $faker->word, $faker->word];
        $sorts = new Sorts($rawSort);
        $this->assertEquals(
            [
                Sorts::DIRECTION_ASCENDING=>$rawSort[0],
                Sorts::DIRECTION_DESCENDING=>$rawSort[1],
                Sorts::DIRECTION_ASCENDING=>$rawSort[2],
            ], $sorts);
    }
    public function testSortsMaintainsSortOrder()
    {
        $faker = $this->getFaker();
        $rawSort = [$faker->word, '-' . $faker->word, $faker->word];
        $sorts = new Sorts($rawSort);
        $this->assertEquals(
            [
                Sorts::DIRECTION_ASCENDING=>$rawSort[0],
            ], $sorts[0]);
        $this->assertEquals(
            [
                Sorts::DIRECTION_DESCENDING=>$rawSort[1],
            ], $sorts[1]);
        $this->assertEquals(
            [
                Sorts::DIRECTION_ASCENDING=>$rawSort[2],
            ], $sorts[2]);
    }
}
