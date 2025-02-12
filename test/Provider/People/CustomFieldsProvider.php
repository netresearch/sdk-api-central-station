<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Provider\People;

/**
 * Class CustomFieldsProvider.
 *
 * @author Rico Sonntag <rico.sonntag@netresearch.de>
 * @link   https://www.netresearch.de/
 */
class CustomFieldsProvider
{
    /**
     * @return string
     */
    public static function createRequest(): string
    {
        return __DIR__ . '/../_files/Request/People/CustomFields/create.json';
    }

    /**
     * @return string
     */
    public static function updateRequest(): string
    {
        return __DIR__ . '/../_files/Request/People/CustomFields/update.json';
    }

    /**
     * @return string
     */
    public static function indexResponseSuccess(): string
    {
        return __DIR__ . '/../_files/Response/People/CustomFields/index.json';
    }

    /**
     * @return string
     */
    public static function showResponseSuccess(): string
    {
        return __DIR__ . '/../_files/Response/People/CustomFields/show.json';
    }

    /**
     * @return string
     */
    public static function createResponseSuccess(): string
    {
        return __DIR__ . '/../_files/Response/People/CustomFields/create.json';
    }
}
