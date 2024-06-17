<?php

namespace GearDev\Coroutines\Interfaces;

interface ChannelInterface
{
    public function __construct(int $capacity = 0);

    public function push(mixed $data, int $timeout = -1): static;

    public function pop(int $timeout = -1): mixed;

    public function close(): void;

    public function getCapacity(): int;

    public function getLength(): int;

    public function isAvailable(): bool;

    public function hasProducers(): bool;

    public function hasConsumers(): bool;

    public function isEmpty(): bool;

    public function isFull(): bool;

    public function isReadable(): bool;

    public function isWritable(): bool;

    public function __debugInfo(): array;
}