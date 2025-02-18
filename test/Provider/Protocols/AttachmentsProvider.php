<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Provider\Protocols;

/**
 * Class AttachmentsProvider.
 *
 * @author Rico Sonntag <rico.sonntag@netresearch.de>
 * @link   https://www.netresearch.de/
 */
class AttachmentsProvider
{
    /**
     * @return string
     */
    public static function createRequest(): string
    {
        return __DIR__ . '/../_files/Request/Protocols/Attachments/create.json';
    }

    /**
     * @return string
     */
    public static function createResponseSuccess(): string
    {
        return __DIR__ . '/../_files/Response/Protocols/Attachments/create.json';
    }
}
