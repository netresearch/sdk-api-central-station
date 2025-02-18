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
 * A position object.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Position implements JsonSerializable
{
    /**
     * The ID of the record.
     *
     * @var int|null
     */
    private ?int $id = null;

    /**
     * ID of the linked person.
     *
     * @var int|null
     */
    private ?int $personId = null;

    /**
     * ID of the linked company.
     *
     * @var int|null
     */
    private ?int $companyId = null;

    /**
     * Name of the linked company.
     *
     * @var string|null
     */
    private ?string $companyName = null;

    /**
     * Title of the item, e.g., Managing director, HR manager, etc.
     *
     * @var string|null
     */
    private ?string $name = null;

    /**
     * Department in which the person works.
     *
     * @var string|null
     */
    private ?string $department = null;

    /**
     * Only one position may be set to primary. This will mark the primary position the person holds.
     *
     * @var bool
     */
    private bool $primaryFunction = false;

    /**
     * Positions that are no longer active may be marked as former.
     *
     * @var bool
     */
    private bool $former = false;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return Position
     */
    public function setId(?int $id): Position
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param int|null $personId
     *
     * @return Position
     */
    public function setPersonId(?int $personId): Position
    {
        $this->personId = $personId;

        return $this;
    }

    /**
     * @param int|null $companyId
     *
     * @return Position
     */
    public function setCompanyId(?int $companyId): Position
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @param string|null $companyName
     *
     * @return Position
     */
    public function setCompanyName(?string $companyName): Position
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * @param string|null $name
     *
     * @return Position
     */
    public function setName(?string $name): Position
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $department
     *
     * @return Position
     */
    public function setDepartment(?string $department): Position
    {
        $this->department = $department;

        return $this;
    }

    /**
     * @param bool $primaryFunction
     *
     * @return Position
     */
    public function setPrimaryFunction(bool $primaryFunction): Position
    {
        $this->primaryFunction = $primaryFunction;

        return $this;
    }

    /**
     * @param bool $former
     *
     * @return Position
     */
    public function setFormer(bool $former): Position
    {
        $this->former = $former;

        return $this;
    }

    /**
     * @return array<string, int|bool|string|null>
     */
    public function jsonSerialize(): array
    {
        return [
            'id'               => $this->id,
            'person_id'        => $this->personId,
            'company_id'       => $this->companyId,
            'company_name'     => $this->companyName,
            'name'             => $this->name,
            'department'       => $this->department,
            'primary_function' => $this->primaryFunction,
            'former'           => $this->former,
        ];
    }
}
