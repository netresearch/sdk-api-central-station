<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Provider;

/**
 * Class CompaniesProvider
 *
 * @author Rico Sonntag <rico.sonntag@netresearch.de>
 * @link   https://www.netresearch.de/
 */
class CompaniesProvider
{
    /**
     * @return string
     */
    public static function indexResponseSuccess(): string
    {
        return __DIR__ . '/_files/Response/Companies/index.json';
    }

    /**
     * @return string
     */
    public static function showResponseSuccess(): string
    {
        return __DIR__ . '/_files/Response/Companies/show.json';
    }

    /**
     * @return string
     */
    public static function createResponseSuccess(): string
    {
        return __DIR__ . '/_files/Response/Companies/create.json';
    }

    /**
     * @return string
     */
    public static function searchResponseSuccess(): string
    {
        return __DIR__ . '/_files/Response/Companies/search.json';
    }

    /**
     * @return string
     */
    public static function statsResponseSuccess(): string
    {
        return __DIR__ . '/_files/Response/Companies/stats.json';
    }

    /**
     * @return string
     */
    public static function createRequest(): string
    {
        return __DIR__ . '/_files/Request/Companies/create.json';
    }

    /**
     * @return string
     */
    public static function updateRequest(): string
    {
        return __DIR__ . '/_files/Request/Companies/update.json';
    }
}
