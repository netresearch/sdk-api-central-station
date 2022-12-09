<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\People\Protocols;

use Netresearch\Sdk\CentralStation\Api\CreateRequestInterface;
use Netresearch\Sdk\CentralStation\Request\Protocols\Common\Protocol;

/**
 * A "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Create implements CreateRequestInterface
{
    /**
     * @var Protocol
     */
    private $protocol;

    /**
     * Constructor.
     *
     * @param Protocol $protocol
     */
    public function __construct(Protocol $protocol)
    {
        $this->protocol = $protocol;
    }

    /**
     * @return array<string, array<string, null|bool|string|int[]>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        $data['protocol'] = $this->protocol->jsonSerialize();

        return $data;
    }
}
