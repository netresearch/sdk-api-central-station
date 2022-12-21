<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\Tags;

use Netresearch\Sdk\CentralStation\Model\AbstractEntity;

/**
 * A tag record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Tag extends AbstractEntity
{
    /**
     * ID of account.
     *
     * @var int
     */
    public $accountId;

    /**
     * ID of the record the tag belongs to, e.g. person, company, offer or project.
     *
     * @var int
     */
    public $attachableId;

    /**
     * The record type the address belongs to. Must be either "Person", "Company", "Deal" or "Project".
     *
     * @var string
     */
    public $attachableType;

    /**
     * The name of the tag.
     *
     * @var string
     */
    public $name;

    /**
     * States whether the tag has been added via the API or some sort of integration.
     *
     * @var bool
     */
    public $apiInput;
}
