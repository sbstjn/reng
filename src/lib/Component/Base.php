<?php

namespace ReleaseName\Component;

class Base
{
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
        $this->validate();
    }

    /**
     * Validate word against list of allowed characters and words
     *
     * @throws \Exception
     */
    private function validate()
    {
        if (!stristr(self::CHARACTER_LIST, $this->value[0])) {
            throw new \Exception('Invalid first character: ' . $this->value[0]);
        }

        if (!in_array($this->value, self::listForCharacter($this->value[0]))) {
            throw new \Exception('Word not in known list of words: ' . $this->value);
        }
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
        $list = self::listForCharacter($char);
        $class = get_called_class();
            
        return new $class($list[rand(0, count($list) - 1)]);

    }

    /**
     * Get list of available words for given character
     *
     * @param $char Needed character
     * @return array
     */
    public static function listForCharacter($char)
    {
        $file = self::getDataFolder() . '/' . $char;
        $data = strtolower(file_get_contents($file));
        return explode("\n", $data);
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
        $list = self::CHARACTER_LIST;
        return $list[rand(0, strlen($list) - 1)];
    }
}