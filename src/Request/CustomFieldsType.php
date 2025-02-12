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
 * A custom field type object used to create/update a record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class CustomFieldsType implements JsonSerializable
{
    /**
     * The display position of the individual field type.
     *
     * @var int|null
     */
    private ?int $position = null;

    /**
     * The name of the custom field type.
     *
     * @var string|null
     */
    private ?string $name = null;

    /**
     * The category (one of Constants::CUSTOM_FIELDS_TYPE_CATEGORY_*).
     *
     * @var string|null
     */
    private ?string $category = null;

    /**
     * The type of the custom field (one of Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE_*).
     *
     * @var string|null
     */
    private ?string $type = null;

    /**
     * The options for field type "select".
     *
     * @var string[]|null
     */
    private ?array $options = null;

    /**
     * @param int|null $position
     *
     * @return CustomFieldsType
     */
    public function setPosition(?int $position): CustomFieldsType
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @param string|null $name
     *
     * @return CustomFieldsType
     */
    public function setName(?string $name): CustomFieldsType
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $category
     *
     * @return CustomFieldsType
     */
    public function setCategory(?string $category): CustomFieldsType
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @param string|null $type
     *
     * @return CustomFieldsType
     */
    public function setType(?string $type): CustomFieldsType
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string ...$options
     *
     * @return CustomFieldsType
     */
    public function setOptions(string ...$options): CustomFieldsType
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return array<string, int|string|string[]|null>
     */
    public function jsonSerialize(): array
    {
        return [
            'name'     => $this->name,
            'category' => $this->category,
            'ftype'    => $this->type,
            'options'  => $this->options,
            'position' => $this->position,
        ];
    }
}
