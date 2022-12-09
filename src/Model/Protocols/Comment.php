<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\Protocols;

use DateTime;

/**
 * A protocol comment.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Comment
{
    /**
     * ID of comment.
     *
     * @var int
     */
    public $id;

    /**
     * ID of the linked object, for example the protocol ID.
     *
     * @var int
     */
    public $attachableId;

    /**
     * Type of linked object, e.g. Protocol.
     *
     * @var string
     */
    public $attachableType;

    /**
     * ID of the user which created the comment.
     *
     * @var int
     */
    public $userId;

    /**
     * The comment.
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
