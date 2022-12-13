<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Attachments\Common;

use JsonSerializable;

/**
 * An attachment object used to create/update a record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Attachment implements JsonSerializable
{
    /**
     * The sketch of the note.
     *
     * @var string
     */
    private $filename;

    /**
     * @var null|int
     */
    private $attachableId;

    /**
     * @var null|string
     */
    private $attachableType;

    /**
     * @var string
     */
    private $contentType;

    /**
     * @var null|int
     */
    private $attachmentCategoryId;

    /**
     * @var null|string
     */
    private $attachmentCategoryName;

    /**
     * @var string
     */
    private $data;

    /**
     * @param string $filename
     *
     * @return Attachment
     */
    public function setFilename(string $filename): Attachment
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @param null|int $attachableId
     *
     * @return Attachment
     */
    public function setAttachableId(?int $attachableId): Attachment
    {
        $this->attachableId = $attachableId;
        return $this;
    }

    /**
     * @param null|string $attachableType
     *
     * @return Attachment
     */
    public function setAttachableType(?string $attachableType): Attachment
    {
        $this->attachableType = $attachableType;
        return $this;
    }

    /**
     * @param string $contentType
     *
     * @return Attachment
     */
    public function setContentType(string $contentType): Attachment
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * @param null|int $attachmentCategoryId
     *
     * @return Attachment
     */
    public function setAttachmentCategoryId(?int $attachmentCategoryId): Attachment
    {
        $this->attachmentCategoryId = $attachmentCategoryId;
        return $this;
    }

    /**
     * @param null|string $attachmentCategoryName
     *
     * @return Attachment
     */
    public function setAttachmentCategoryName(?string $attachmentCategoryName): Attachment
    {
        $this->attachmentCategoryName = $attachmentCategoryName;
        return $this;
    }

    /**
     * @param string $data
     *
     * @return Attachment
     */
    public function setData(string $data): Attachment
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array<string, null|int|string>
     */
    public function jsonSerialize(): array
    {
        return [
            'content_type'             => $this->contentType,
            'filename'                 => $this->filename,
            'attachable_id'            => $this->attachableId,
            'attachable_type'          => $this->attachableType,
            'attachment_category_id'   => $this->attachmentCategoryId,
            'attachment_category_name' => $this->attachmentCategoryName,
            'data'                     => $this->data,
        ];
    }
}
