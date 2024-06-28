<?php

namespace GearDev\Coroutines\Co;

use GearDev\Coroutines\Interfaces\ChannelInterface;

class ChannelFactory
{
    public static function createChannel(int $size = 0): ChannelInterface
    {
        if (extension_loaded('swow') && class_exists(\GearDev\Swow\Channel\SwowChannel::class)) {
            return new \GearDev\Swow\Channel\SwowChannel($size);
        }
        throw new \Exception('No channel implementation found');
    }
}