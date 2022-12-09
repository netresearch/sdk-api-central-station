<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model;

use Netresearch\Sdk\CentralStation\Model\Protocols\Protocol;

/**
 * A protocols record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Protocols
{
    /**
     * A note about a person, offer, or project.
     *
     * @var null|Protocol
     */
    public $protocolObjectNote;

    /**
     * A note for status messages from a user.
     *
     * @var null|Protocol
     */
    public $protocolUserNote;
}
