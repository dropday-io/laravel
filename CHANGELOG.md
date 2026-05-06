# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2026-05-06

### Added

- `Dropday::createOrder(array $data)` — submit an order for dropshipping fulfillment.
- `Dropday::getOrders(array $filters = [])` — list orders with optional filters (`statuses`, `per_page`, `page`, `date_from`, `date_to`, `external_id`, `source`).
- `Dropday::getOrder(string $reference)` — retrieve a single order by its Dropday reference ID.
- `DropdayServiceProvider` with automatic Laravel package auto-discovery (service provider + `Dropday` facade alias).
- Publishable `config/dropday.php` supporting `DROPDAY_API_KEY`, `DROPDAY_ACCOUNT_ID`, and `DROPDAY_BASE_URL`.
- `DropdayException` thrown on HTTP 422 validation errors; all other HTTP errors propagate as `Illuminate\Http\Client\RequestException`.
- Test-mode support via `"test" => true` in any order payload.
- Compatibility with Laravel 10, 11, and 12 (PHP 8.1+).
