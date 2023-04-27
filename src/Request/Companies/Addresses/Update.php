<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Companies\Addresses;

use Netresearch\Sdk\CentralStation\Request\Address;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;

/**
 * A "update" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Update implements RequestInterface
{
    private ?Address $address = null;

    /**
     * @param null|Address $address
     *
     * @return Update
     */
    public function setAddress(?Address $address): Update
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return array<string, array<string, null|bool|int|string>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->address instanceof Address) {
            $data['addr'] = $this->address->jsonSerialize();
        }

        return $data;
    }
}
