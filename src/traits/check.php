<?php

namespace ReleaseName;

Trait check
{
    /**
     * Check for needed configuration of constant
     *
     * @throws \Exception
     */
    public static function check()
    {
        if (!defined('RELEASE_NAME_DATA'))
        {
            throw new \Exception('Please define constant ' . RELEASE_NAME_DATA);
        }
    }
}