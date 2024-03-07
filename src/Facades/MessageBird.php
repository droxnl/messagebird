<?php

declare(strict_types=1);

namespace src\Facades;

use Illuminate\Support\Facades\Facade;

class MessageBird extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'messagebird';
    }
}