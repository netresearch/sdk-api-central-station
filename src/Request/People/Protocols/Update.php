<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\People\Protocols;

use Netresearch\Sdk\CentralStation\Request\Protocol;
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
    /**
     * @var null|Protocol
     */
    private $protocol;

    /**
     * @param Protocol $protocol
     *
     * @return Update
     */
    public function setProtocol(Protocol $protocol): Update
    {
        $this->protocol = $protocol;
        return $this;
    }

    /**
     * @return array<string, array<string, null|bool|string|int[]>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->protocol) {
            $data['protocol'] = $this->protocol->jsonSerialize();
        }

        return $data;
    }
}
