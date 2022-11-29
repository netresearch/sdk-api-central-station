<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Api\Actions;

use Netresearch\Sdk\CentralStation\Api\AbstractApiEndpoint;

/**
 * The /tags endpoint.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Tags extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    public const PATH = 'tags';
}
