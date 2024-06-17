<?php

namespace GearDev\Coroutines\Interfaces;

use Closure;

abstract class AbstractCo
{
    protected static bool $fake = false;
    protected string $name;
    protected array $args = [];
    protected int $delaySeconds = 0;
    protected \Closure $function;
    /**
     * @var true
     */
    protected bool $needCloneDiContainer = false;

    /**
     * @var true
     */
    protected bool $sync = false;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function fake() {
        static::$fake = true;
    }

    public static function define(string $name) {
        return new static($name);
    }

    public function charge(Closure $function) {
        $this->function = $function;
        return $this;
    }


    public function delaySeconds(int $seconds) {
        $this->delaySeconds = $seconds;
        return $this;
    }

    public function args(...$args) {
        $this->args = $args;
        return $this;
    }

    public function sync() {
        $this->sync = true;
        return $this;
    }

    public static $fakeCoroutines = [];

    protected function addToFakeCoroutines() {
        static::$fakeCoroutines[$this->name] = [
            'name'=>$this->name,
            'function' => $this->function,
            'args' => $this->args,
            'delaySeconds' => $this->delaySeconds,
            'needCloneDiContainer' => $this->needCloneDiContainer,
            'sync' => $this->sync
        ];
    }

    public function run() {
        if (static::$fake) {
            $this->addToFakeCoroutines();
        } else {
            $this->runCoroutine(sync: $this->sync);
        }
    }

    public function runWithClonedDiContainer() {
        if (static::$fake) {
            $this->addToFakeCoroutines();
        } else {
            $this->needCloneDiContainer = true;
            $this->runCoroutine(sync: $this->sync);
        }
    }

    abstract protected function runCoroutine(bool $sync = false);
}