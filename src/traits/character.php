<?php

namespace ReleaseName;

Trait character
{
    /**
     * Get random character
     *
     * @return mixed
     */
    public static function randomCharacter()
    {
        $list = \ReleaseName\Component\Base::CHARACTER_LIST;
        return $list[rand(0, strlen($list) - 1)];
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

}