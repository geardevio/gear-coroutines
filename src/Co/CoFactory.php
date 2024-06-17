<?php

namespace GearDev\Coroutines\Co;

class CoFactory
{
    public static function createCo(string $name): \GearDev\Coroutines\Interfaces\AbstractCo
    {
        $extensionName = config('gear.coroutines.extension', 'swow');
        if ($extensionName === 'swow') {
            if (!extension_loaded('swow')) {
                throw new \Exception('Extension "swow" not loaded');
            }
            if (class_exists(\GearDev\Swow\Co\Co::class)) {
                return \GearDev\Swow\Co\Co::define($name);
            } else {
                throw new \Exception('Class GearDev\Swow\Co\Co not found');
            }
        }
        throw new \Exception('Unknown gear.coroutines.extension name. Can be in: [swow]');
    }
}