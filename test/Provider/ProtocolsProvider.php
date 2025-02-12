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
 * Class ProtocolsProvider.
 *
 * @author Rico Sonntag <rico.sonntag@netresearch.de>
 * @link   https://www.netresearch.de/
 */
class ProtocolsProvider
{
    /**
     * @return string
     */
    public static function indexResponseSuccess(): string
    {
        return __DIR__ . '/_files/Response/Protocols/index.json';
    }

    /**
     * @return string
     */
    public static function showResponseSuccess(): string
    {
        return __DIR__ . '/_files/Response/Protocols/show.json';
    }
}
