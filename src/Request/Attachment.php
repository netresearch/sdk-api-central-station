<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request;

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
     * @var string|null
     */
    private ?string $filename = null;

    /**
     * @var string|null
     */
    private ?string $contentType = null;

    /**
     * @var string|null
     */
    private ?string $data = null;

    /**
     * @var int|null
     */
    private ?int $attachableId = null;

    /**
     * @var string|null
     */
    private ?string $attachableType = null;

    /**
     * @var int|null
     */
    private ?int $attachmentCategoryId = null;

    /**
     * @var string|null
     */
    private ?string $attachmentCategoryName = null;

    /**
     * @param string|null $filename
     *
     * @return Attachment
     */
    public function setFilename(?string $filename): Attachment
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * @param string|null $contentType
     *
     * @return Attachment
     */
    public function setContentType(?string $contentType): Attachment
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * @param string|null $data
     *
     * @return Attachment
     */
    public function setData(?string $data): Attachment
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param int|null $attachableId
     *
     * @return Attachment
     */
    public function setAttachableId(?int $attachableId): Attachment
    {
        $this->attachableId = $attachableId;

        return $this;
    }

    /**
     * @param string|null $attachableType
     *
     * @return Attachment
     */
    public function setAttachableType(?string $attachableType): Attachment
    {
        $this->attachableType = $attachableType;

        return $this;
    }

    /**
     * @param int|null $attachmentCategoryId
     *
     * @return Attachment
     */
    public function setAttachmentCategoryId(?int $attachmentCategoryId): Attachment
    {
        $this->attachmentCategoryId = $attachmentCategoryId;

        return $this;
    }

    /**
     * @param string|null $attachmentCategoryName
     *
     * @return Attachment
     */
    public function setAttachmentCategoryName(?string $attachmentCategoryName): Attachment
    {
        $this->attachmentCategoryName = $attachmentCategoryName;

        return $this;
    }

    /**
     * @return array<string, int|string|null>
     */
    public function jsonSerialize(): array
    {
        return [
            'filename'                 => $this->filename,
            'content_type'             => $this->contentType,
            'data'                     => $this->data,
            'attachable_id'            => $this->attachableId,
            'attachable_type'          => $this->attachableType,
            'attachment_category_id'   => $this->attachmentCategoryId,
            'attachment_category_name' => $this->attachmentCategoryName,
        ];
    }
}
