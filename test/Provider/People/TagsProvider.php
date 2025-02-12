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
 * Class TagsProvider.
 *
 * @author Rico Sonntag <rico.sonntag@netresearch.de>
 * @link   https://www.netresearch.de/
 */
class TagsProvider
{
    /**
     * @return string
     */
    public static function createRequest(): string
    {
        return __DIR__ . '/../_files/Request/People/Tags/create.json';
    }

    /**
     * @return string
     */
    public static function updateRequest(): string
    {
        return __DIR__ . '/../_files/Request/People/Tags/update.json';
    }

    /**
     * @return string
     */
    public static function indexResponseSuccess(): string
    {
        return __DIR__ . '/../_files/Response/People/Tags/index.json';
    }

    /**
     * @return string
     */
    public static function showResponseSuccess(): string
    {
        return __DIR__ . '/../_files/Response/People/Tags/show.json';
    }

    /**
     * @return string
     */
    public static function createResponseSuccess(): string
    {
        return __DIR__ . '/../_files/Response/People/Tags/create.json';
    }
}
