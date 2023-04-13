<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\CalendarEvents;

use Netresearch\Sdk\CentralStation\Request\IncludesRequestInterface;
use Netresearch\Sdk\CentralStation\Request\Traits\IncludesTrait;

/**
 * A "show" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Show implements IncludesRequestInterface
{
    use IncludesTrait;

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        return $this->addIncludesToSerializedData($data);
    }
}
