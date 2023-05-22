<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model;

use DateTime;

/**
 * An attachment record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Attachment
{
    /**
     * ID of entity.
     *
     * @var string
     */
    public string $id;

    /**
     * ID of an account.
     *
     * @var int
     */
    public int $accountId;

    /**
     * ID of the user which created the note.
     *
     * @var int
     */
    public int $userId;

    /**
     * ID of the linked object, for example, the protocol ID.
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
     * The attachment category ID.
     *
     * @var null|int
     */
    public ?int $attachmentCategoryId = null;

    /**
     * @var null|User
     */
    public ?User $user = null;

    /**
     * @var null|AttachmentCategory
     */
    public ?AttachmentCategory $attachmentCategory = null;

    /**
     * The list of comments assigned to this attachment.
     *
     * @var Comment[]
     */
    public array $comments = [];

    /**
     * The original filename.
     *
     * @var string
     */
    public string $filename;

    /**
     * The content type.
     *
     * @var string
     */
    public string $contentType;

    /**
     * The file size in byte.
     *
     * @var int
     */
    public int $size;

    /**
     * Time of creation.
     *
     * @var DateTime
     */
    public DateTime $createdAt;

    /**
     * Time of last update.
     *
     * @var DateTime
     */
    public DateTime $updatedAt;
}
