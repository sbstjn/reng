<?php

namespace ReleaseName;

class Release
{
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
        self::validateReleaseFormat($name);

        list($adjective, $noun) = explode('-', $name);
        
        $this->adjective = new \ReleaseName\Component\Adjective($adjective);
        $this->noun = new \ReleaseName\Component\Noun($noun);
    }

    /**
     * Validate given release name for hyphen position
     *
     * @param $name
     * @throws \Exception
     */
    private static function validateReleaseFormatForHyphen($name)
    {
        if (!stristr($name, '-')) {
            throw new \Exception('Release must include a hyphen');
        }

        if (strpos($name, '-') === 0) {
            throw new \Exception('Hyphen cannot be first character');
        }

        if (strpos($name, '-') === (strlen($name) - 1)) {
            throw new \Exception('Hyphen cannot be last character');
        }
    }

    /**
     * Validate format of release name
     *
     * @param $name
     * @throws \Exception
     */
    public static function validateReleaseFormat($name)
    {
        self::validateReleaseFormatForHyphen($name);
        list($adjective, $noun) = explode('-', $name);

        if ($adjective[0] != $noun[0]) {
            throw new \Exception('Invalid combination of release name: ' . $name);
        }
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
    public static function randomFor($char)
    {
        return new Release(implode('-',
            array(
                \ReleaseName\Component\Adjective::randomFor($char),
                \ReleaseName\Component\Noun::randomFor($char)
            )
        ));
    }

    /**
     * Get random string
     *
     * @return mixed
     */
    public static function random()
    {
        return self::randomFor(self::randomCharacter());
    }

    /**
     * Get random character
     *
     * @return mixed
     */
    public static function randomCharacter()
    {
        return \ReleaseName\Component\Base::randomCharacter();
    }

    /**
     * Convert Release object to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getAdjective() . '-' . $this->getNoun();
    }


}