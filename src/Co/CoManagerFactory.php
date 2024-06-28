<?php

namespace GearDev\Coroutines\Co;

use GearDev\Coroutines\Interfaces\CoManagerInterface;

class CoManagerFactory
{
    public static function getCoroutineManager(): CoManagerInterface
    {
        if (extension_loaded('swow') && class_exists(\GearDev\Swow\CoManager\SwowCoManager::class)) {
            return \GearDev\Swow\CoManager\SwowCoManager::getInstance();
        }
        throw new \Exception('No co manager implementation found');
    }
}