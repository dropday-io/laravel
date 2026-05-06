<?php

namespace Dropday\Dropday\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array createOrder(array $data)
 * @method static array getOrders(array $filters = [])
 * @method static array getOrder(string $reference)
 *
 * @see \Dropday\Dropday\Dropday
 */
class Dropday extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Dropday\Dropday\Dropday::class;
    }
}
