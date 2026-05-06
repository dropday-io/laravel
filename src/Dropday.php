<?php

namespace Dropday\Dropday;

use Dropday\Dropday\Exceptions\DropdayException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Dropday
{
    public function __construct(
        protected string $apiKey,
        protected string $accountId,
        protected string $baseUrl,
    ) {}

    protected function client(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl)
            ->withHeaders([
                'api-key'      => $this->apiKey,
                'account-id'   => $this->accountId,
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ]);
    }

    // -------------------------------------------------------------------------
    // Orders
    // -------------------------------------------------------------------------

    /**
     * Create a new order.
     *
     * Pass `"test": true` in $data during development to avoid real supplier
     * routing. If an order with the same `external_id` already exists, Dropday
     * returns 200 with `"Order already exists"` instead of an error — check the
     * returned `message` key if you need to distinguish new vs. duplicate.
     *
     * @throws DropdayException on 422 validation errors
     * @throws \Illuminate\Http\Client\RequestException on other HTTP errors
     */
    public function createOrder(array $data): array
    {
        $response = $this->client()->post('/orders', $data);

        if ($response->status() === 422) {
            throw new DropdayException(
                'Dropday validation error: '.$response->body(),
                422
            );
        }

        $response->throw();

        return $response->json();
    }

    /**
     * List orders, optionally filtered.
     *
     * Available filter keys: statuses (comma-separated), per_page, page,
     * date_from, date_to, external_id, source.
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getOrders(array $filters = []): array
    {
        return $this->client()->get('/orders', $filters)->throw()->json();
    }

    /**
     * Retrieve a single order by its Dropday reference ID.
     *
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getOrder(string $reference): array
    {
        return $this->client()->get("/orders/{$reference}")->throw()->json();
    }

}
