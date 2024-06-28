<?php

namespace GearDev\Coroutines\Co;

class CoFactory
{
    public static function createCo(string $name): \GearDev\Coroutines\Interfaces\AbstractCo
    {
        if (extension_loaded('swow') && class_exists(\GearDev\Swow\Co\Co::class)) {
            return \GearDev\Swow\Co\Co::define($name);
        }
        throw new \Exception('No co implementation found');
    }
}