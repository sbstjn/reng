<?php

namespace ReleaseName\Test\Component;

class AdjectiveTest extends \PHPUnit_Framework_TestCase
{
    public function testForDataFolder()
    {
        $this->assertEquals(RELEASE_NAME_DATA . '/adjectives', \ReleaseName\Component\Adjective::getDataFolder());
    }

    public function testRandomCharaterFromList()
    {
        $this->assertNotFalse(
            stristr(
                \ReleaseName\Component\Base::CHARACTER_LIST,
                \ReleaseName\Component\Adjective::randomCharacter()
            )
        );
    }

    /**
     * @dataProvider alphabetProvider
     */
    public function testGetRandomForCharacter($char)
    {
        $this->assertNotFalse(
            \ReleaseName\Component\Adjective::randomFor($char)
        );

        $this->assertStringStartsWith($char, (string)\ReleaseName\Component\Adjective::randomFor($char));
    }

    public function alphabetProvider()
    {
        $list = \ReleaseName\Component\Adjective::CHARACTER_LIST;
        $data = array();

        for ($i = 0; $i < strlen($list); $i++) {
            array_push($data, array($list[$i]));
        }

        return $data;
    }

}
