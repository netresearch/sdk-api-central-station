<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\People;

use Netresearch\Sdk\CentralStation\Request\FilterRequestInterface;
use Netresearch\Sdk\CentralStation\Request\Traits\FilterRequestTrait;

/**
 * A "stats" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Stats implements FilterRequestInterface
{
    use FilterRequestTrait;

    /**
     * @return array<string, array<array<string>>>
     */
    public function jsonSerialize(): array
    {
        $data = [];
        $data = $this->addFilterToSerializedData($data);

        return $data;
    }
}
