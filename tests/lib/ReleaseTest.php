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

        $release = (string)\ReleaseName\Release::randomFor($char);
        list(, $noun) = explode('-', $release);

        $this->assertEquals(2, count(explode('-', $release)));

        $this->assertStringMatchesFormat('%s-%s', $release);
        $this->assertStringStartsWith($char, $release);
        $this->assertStringStartsWith($char, $noun);
    }

    public function testGetRandom()
    {
        $release = (string)\ReleaseName\Release::random();
        list($adjective, $noun) = explode('-', $release);

        $this->assertEquals(2, count(explode('-', $release)));

        $this->assertStringMatchesFormat('%s-%s', $release);
        $this->assertEquals($adjective[0], $noun[0]);
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
        $this->assertInstanceOf('\ReleaseName\Release', $release);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Release must include a hyphen
     */
    public function testFailWithoutHyphen()
    {
        new \ReleaseName\Release('funny');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Hyphen cannot be last character
     */
    public function testFailWithoutNoun()
    {
        new \ReleaseName\Release('funny-');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Hyphen cannot be first character
     */
    public function testFailWithoutAdjective()
    {
        new \ReleaseName\Release('-fox');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Invalid combination of release name: funny-dog
     */
    public function testFailWithInvalidCombinationOne()
    {
        new \ReleaseName\Release('funny-dog');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Invalid first character: 4
     */
    public function testFailWithInvalidCharacters()
    {
        new \ReleaseName\Release('4life-4dogs');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Word not in known list of words: dangerously
     */
    public function testFailWithUnknownAdjective()
    {
        new \ReleaseName\Release('dangerously-dog');
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Word not in known list of words: doggy
     */
    public function testFailWithUnknownNoun()
    {
        new \ReleaseName\Release('dangerous-doggy');
    }
}
