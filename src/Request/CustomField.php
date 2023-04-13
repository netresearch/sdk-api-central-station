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
 * A custom field object used to create/update a record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class CustomField implements JsonSerializable
{
    /**
     * The content of the field.
     *
     * @var null|string
     */
    private ?string $content = null;

    /**
     * @var null|int
     */
    private ?int $attachableId = null;

    /**
     * @var null|string
     */
    private ?string $attachableType = null;

    /**
     * The ID of the underlying custom fields type.
     *
     * @var null|int
     */
    private ?int $customFieldsTypeId = null;

    /**
     * @param null|string $content
     *
     * @return CustomField
     */
    public function setContent(?string $content): CustomField
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param null|int $attachableId
     *
     * @return CustomField
     */
    public function setAttachableId(?int $attachableId): CustomField
    {
        $this->attachableId = $attachableId;
        return $this;
    }

    /**
     * @param null|string $attachableType
     *
     * @return CustomField
     */
    public function setAttachableType(?string $attachableType): CustomField
    {
        $this->attachableType = $attachableType;
        return $this;
    }

    /**
     * @param null|int $customFieldsTypeId
     *
     * @return CustomField
     */
    public function setCustomFieldsTypeId(?int $customFieldsTypeId): CustomField
    {
        $this->customFieldsTypeId = $customFieldsTypeId;
        return $this;
    }

    /**
     * @return array<string, null|int|string>
     */
    public function jsonSerialize(): array
    {
        return [
            // The content/value is stored under the "name" field in the API
            'name'                  => $this->content,
            'attachable_id'         => $this->attachableId,
            'attachable_type'       => $this->attachableType,
            'custom_fields_type_id' => $this->customFieldsTypeId,
        ];
    }
}
