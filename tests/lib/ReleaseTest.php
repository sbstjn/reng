<?php

namespace ReleaseName\Test;

class ReleaseTest extends \PHPUnit_Framework_TestCase
{
    public function testRandomCharaterFromList()
    {
        $this->assertNotFalse(
            stristr(
                \ReleaseName\Component\Base::CHARACTER_LIST,
                \ReleaseName\Release::randomCharacter()
            )
        );
    }

    /**
     * @dataProvider alphabetProvider
     */
    public function testGetRandomForCharacter($char)
    {
        $this->assertNotFalse(
            \ReleaseName\Release::randomFor($char)
        );

        $release = \ReleaseName\Release::randomFor($char);
        list(, $noun) = explode('-', $release);

        $this->assertEquals(2, count(explode('-', $release)));

        $this->assertStringMatchesFormat('%s-%s', $release);
        $this->assertStringStartsWith($char, $release);
        $this->assertStringStartsWith($char, $noun);
    }

    public function alphabetProvider()
    {
        $list = \ReleaseName\Component\Base::CHARACTER_LIST;
        $data = array();

        for ($i = 0; $i < strlen($list); $i++) {
            array_push($data, array($list[$i]));
        }

        return $data;
    }
    
    public function testConstructor()
    {
        $release = new \ReleaseName\Release('funny-fox');
        
        $this->assertEquals('funny', $release->getAdjective());
        $this->assertEquals('fox', $release->getNoun());
    }
}
