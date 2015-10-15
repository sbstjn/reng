<?php

namespace ReleaseName\Component;

class Base
{
    use \ReleaseName\character;
    
    /**
     * Current value
     *
     * @var string
     */
    private $value;

    /**
     * Character pool for randomizer
     */
    const CHARACTER_LIST = 'abcdefghijklmnopqrstuvwxyz';

    /**
     * Initialize
     *
     * @param string $value Word
     * @throws \Exception
     */
    public function __construct($value)
    {
        $this->value = $value;
    }
    
    /**
     * Convert object to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * Get absolute path to needed data configuration
     *
     * @return string
     */
    public static function getDataFolder()
    {
        $class = get_called_class();
        $strip = explode('\\', $class);

        return RELEASE_NAME_DATA . '/' . strtolower(array_pop($strip)) . 's';
    }

    /**
     * Get random string startign with given character
     *
     * @param $char
     * @return string
     */
    public static function randomFor($char)
    {
        $file = self::getDataFolder() . '/' . $char;

        if (file_exists($file)) {
            $data = file_get_contents($file);
            $list = explode("\n", $data);
            $class = get_called_class();
            
            return new $class(strtolower($list[rand(0, count($list) - 1)]));
        }
    }
}