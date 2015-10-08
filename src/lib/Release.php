<?php

namespace ReleaseName;

class Release
{
    use \ReleaseName\check;
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
    public function __construct(String $name)
    {
        self::check();

        list($adjective, $noun) = explode('-', $name);
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