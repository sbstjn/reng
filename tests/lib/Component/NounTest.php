<?php

namespace ReleaseName\Test\Component;

class NounTest extends \PHPUnit_Framework_TestCase
{
    public function testForDataFolder()
    {
        $this->assertEquals(RELEASE_NAME_DATA . '/nouns', \ReleaseName\Component\Noun::getDataFolder());
    }

    public function testRandomCharaterFromList()
    {
        $this->assertNotFalse(
            stristr(
                \ReleaseName\Component\Base::CHARACTER_LIST,
                \ReleaseName\Component\Noun::randomCharacter()
            )
        );
    }

    /**
     * @dataProvider alphabetProvider
     */
    public function testGetRandomForCharacter($char)
    {
        $this->assertNotFalse(
            \ReleaseName\Component\Noun::randomFor($char)
        );

        $this->assertStringStartsWith($char, \ReleaseName\Component\Noun::randomFor($char));
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
}
