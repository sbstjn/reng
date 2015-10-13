<?php

namespace ReleaseName;

class Release
{
    use \ReleaseName\character;

    /**
     * @var \ReleaseName\Component\Adjective
     */
    private $adjective;

    /**
     * @var \ReleaseName\Component\Noun
     */
    private $noun;

    /**
     * @param String $name Initialize Release object
     * @throws \Exception
     */
    public function __construct($name)
    {
        list($adjective, $noun) = explode('-', $name);
        
        $this->adjective = new \ReleaseName\Component\Adjective($adjective);
        $this->noun = new \ReleaseName\Component\Noun($noun);
    }

    /**
     * Get adjective from release
     *
     * @return Component\Adjective
     */
    public function getAdjective()
    {
        return $this->adjective;
    }

    /**
     * Get noun from release
     *
     * @return Component\Noun
     */
    public function getNoun()
    {
        return $this->noun;
    }

    /**
     * Get random release name for given character
     *
     * @param $char Character
     * @return string
     */
    public static function randomFor($char) {
        return implode('-',
            array(
                \ReleaseName\Component\Adjective::randomFor($char),
                \ReleaseName\Component\Noun::randomFor($char)
            )
        );
    }


}