<?php

use Dropday\Dropday\Dropday;
use Dropday\Dropday\Exceptions\DropdayException;
use Illuminate\Support\Facades\Http;

it('resolves from the container', function () {
    expect(app(Dropday::class))->toBeInstanceOf(Dropday::class);
});

it('creates an order', function () {
    Http::fake([
        '*/orders' => Http::response(['id' => 'ORD-1', 'status' => 'pending'], 200),
    ]);

    $result = app(Dropday::class)->createOrder([
        'external_id' => 'my-order-1',
        'test'        => true,
    ]);

    expect($result)->toMatchArray(['id' => 'ORD-1', 'status' => 'pending']);
});

it('throws DropdayException on 422', function () {
    Http::fake([
        '*/orders' => Http::response(['message' => 'Validation failed'], 422),
    ]);

    app(Dropday::class)->createOrder([]);
})->throws(DropdayException::class);

it('lists orders', function () {
    Http::fake([
        '*/orders*' => Http::response(['data' => [['id' => 'ORD-1']]], 200),
    ]);

    $result = app(Dropday::class)->getOrders(['statuses' => 'pending']);

    expect($result['data'])->toHaveCount(1);
});

it('gets a single order', function () {
    Http::fake([
        '*/orders/ORD-1' => Http::response(['id' => 'ORD-1', 'status' => 'shipped'], 200),
    ]);

    $result = app(Dropday::class)->getOrder('ORD-1');

    expect($result)->toMatchArray(['id' => 'ORD-1', 'status' => 'shipped']);
});

