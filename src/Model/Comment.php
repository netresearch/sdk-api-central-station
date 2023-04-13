<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model;

/**
 * A comment.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Comment extends AbstractEntity
{
    /**
     * ID of the linked object, for example the protocol ID.
     *
     * @var int
     */
    public int $attachableId;

    /**
     * Type of linked object, e.g. Protocol.
     *
     * @var string
     */
    public string $attachableType;

    /**
     * ID of the user which created the comment.
     *
     * @var int
     */
    public int $userId;

    /**
     * The comment.
     *
     * @var string
     */
    public string $name;
}
