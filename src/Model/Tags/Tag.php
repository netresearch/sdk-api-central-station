<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\Tags;

use DateTime;

/**
 * A tag record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Tag
{
    /**
     * ID of a tag.
     *
     * @var int
     */
    public $id;

    /**
     * ID of account.
     *
     * @var int
     */
    public $accountId;

    /**
     * ID of the linked object, for example person, company, offer or project.
     *
     * @var int
     */
    public $attachableId;

    /**
     * Type of linked object, e.g. Person, Company, Deal or Project.
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
     * Time of creation.
     *
     * @var DateTime
     */
    public $createdAt;

    /**
     * Time of last update.
     *
     * @var DateTime
     */
    public $updatedAt;
}
