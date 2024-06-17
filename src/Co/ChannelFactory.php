<?php

namespace GearDev\Coroutines\Co;

use GearDev\Coroutines\Interfaces\ChannelInterface;
use GearDev\Swow\Channel\SwowChannel;

class ChannelFactory
{
    public static function createChannel(int $size = 0): ChannelInterface
    {
        $extensionName = config('gear.coroutines.extension', 'swow');
        if ($extensionName === 'swow') {
            if (!extension_loaded('swow')) {
                throw new \Exception('Extension "swow" not loaded');
            }
            if (class_exists(SwowChannel::class)) {
                return new SwowChannel($size);
            } else {
                throw new \Exception('Class GearDev\Swow\Channel\SwowChannel not found');
            }
        }
        throw new \Exception('Unknown gear.coroutines.extension name. Can be in: [swow]');
    }
}