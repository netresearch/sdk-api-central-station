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
     * ID of the linked person.
     *
     * @var null|int
     */
    private $personId;

    /**
     * ID of the linked company.
     *
     * @var null|int
     */
    private $companyId;

    /**
     * Name of the linked company.
     *
     * @var null|string
     */
    private $companyName;

    /**
     * Title of the item, e.g. Managing director, HR manager, etc.
     *
     * @var null|string
     */
    private $name;

    /**
     * Department in which the person works.
     *
     * @var null|string
     */
    private $department;

    /**
     * Only one position may be set to primary. This will mark the primary position the person holds.
     *
     * @var bool
     */
    private $primaryFunction = false;

    /**
     * Positions that are no longer active may be marked as former.
     *
     * @var bool
     */
    private $former = false;

    /**
     * @param null|int $personId
     *
     * @return Position
     */
    public function setPersonId(?int $personId): Position
    {
        $this->personId = $personId;
        return $this;
    }

    /**
     * @param null|int $companyId
     *
     * @return Position
     */
    public function setCompanyId(?int $companyId): Position
    {
        $this->companyId = $companyId;
        return $this;
    }

    /**
     * @param null|string $companyName
     *
     * @return Position
     */
    public function setCompanyName(?string $companyName): Position
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * @param null|string $name
     *
     * @return Position
     */
    public function setName(?string $name): Position
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param null|string $department
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
     * @return array<string, null|int|bool|string>
     */
    public function jsonSerialize(): array
    {
        return [
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
