<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\Attachments;

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
    public $id;

    /**
     * ID of account.
     *
     * @var int
     */
    public $accountId;

    /**
     * ID of the user which created the note.
     *
     * @var int
     */
    public $userId;

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
     * The attachment category ID.
     *
     * @var null|int
     */
    public $attachmentCategoryId;

    /**
     * @var null|User
     */
    public $user;

    /**
     * @var null|AttachmentCategory
     */
    public $attachmentCategory;

    /**
     * The list of comments assigned to this attachment.
     *
     * @var Comment[]
     */
    public $comments = [];

    /**
     * The original filename.
     *
     * @var string
     */
    public $filename;

    /**
     * The content type.
     *
     * @var string
     */
    public $contentType;

    /**
     * The file size in byte.
     *
     * @var int
     */
    public $size;

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
