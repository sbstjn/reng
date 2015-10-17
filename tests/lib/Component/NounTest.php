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

    public function testGetRandom()
    {
        $noun = (string)\ReleaseName\Component\Noun::random();
    }

    /**
     * @dataProvider alphabetProvider
     */
    public function testGetRandomForCharacter($char)
    {
        $this->assertNotFalse(
            \ReleaseName\Component\Noun::randomFor($char)
        );

        $this->assertStringStartsWith($char, (string)\ReleaseName\Component\Noun::randomFor($char));
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

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Invalid first character
     */
    public function testInvalidFirstCharacter()
    {
        new \ReleaseName\Component\Noun('4dogs');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Word not in known list of words: dangerous
     */
    public function testUnknownWord()
    {
        new \ReleaseName\Component\Noun('dangerous');
    }
}
