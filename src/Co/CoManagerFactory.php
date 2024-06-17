<?php

namespace GearDev\Coroutines\Co;

use GearDev\Coroutines\Interfaces\CoManagerInterface;

class CoManagerFactory
{
    public static function getCoroutineManager(): CoManagerInterface
    {
        $extensionName = config('gear.coroutines.extension', 'swow');
        if ($extensionName === 'swow') {
            if (!extension_loaded('swow')) {
                throw new \Exception('Extension "swow" not loaded');
            }
            if (class_exists(\GearDev\Swow\CoManager\SwowCoManager::class)) {
                return \GearDev\Swow\CoManager\SwowCoManager::getInstance();
            } else {
                throw new \Exception('Class GearDev\Swow\CoManager\SwowCoManager not found');
            }
        }
        throw new \Exception('Unknown gear.coroutines.extension name. Can be in: [swow]');
    }
}