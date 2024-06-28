<?php

namespace GearDev\Coroutines\Interfaces;

interface CoManagerInterface
{
    public function getCurrentCoroutineId(): int;

    public static function getInstance(): self;

    public static function getCoroutineCount(): int;

}