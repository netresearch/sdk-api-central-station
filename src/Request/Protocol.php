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
 * A protocol object used to create/update a record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Protocol implements JsonSerializable
{
    /**
     * IDs of the linked persons.
     *
     * @var null|int[]
     */
    private ?array $personIds = null;

    /**
     * IDs of the linked companies.
     *
     * @var null|int[]
     */
    private ?array $companyIds = null;

    /**
     * The sketch of the note.
     *
     * @var null|string
     */
    private ?string $name = null;

    /**
     * The content of the note.
     *
     * @var null|string
     */
    private ?string $content = null;

    /**
     * Whether if the note is confidential or not.
     *
     * @var bool
     */
    private bool $confidential = false;

    /**
     * The format of the note (one of Constants::PROTOCOL_FORMAT_*).
     *
     * @var null|string
     */
    private ?string $format = null;

    /**
     * The badge of the note (one of Constants::PROTOCOL_BADGE_*).
     *
     * @var null|string
     */
    private ?string $badge = null;

    /**
     * @param null|string $name
     *
     * @return Protocol
     */
    public function setName(?string $name): Protocol
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param null|string $content
     *
     * @return Protocol
     */
    public function setContent(?string $content): Protocol
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param bool $confidential
     *
     * @return Protocol
     */
    public function setConfidential(bool $confidential): Protocol
    {
        $this->confidential = $confidential;
        return $this;
    }

    /**
     * @param null|string $format
     *
     * @return Protocol
     */
    public function setFormat(?string $format): Protocol
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @param null|string $badge
     *
     * @return Protocol
     */
    public function setBadge(?string $badge): Protocol
    {
        $this->badge = $badge;
        return $this;
    }

    /**
     * @param int ...$personIds
     *
     * @return Protocol
     */
    public function setPersonIds(int ...$personIds): Protocol
    {
        $this->personIds = $personIds;
        return $this;
    }

    /**
     * @param int ...$companyIds
     *
     * @return Protocol
     */
    public function setCompanyIds(int ...$companyIds): Protocol
    {
        $this->companyIds = $companyIds;
        return $this;
    }

    /**
     * @return array<string, null|bool|string|int[]>
     */
    public function jsonSerialize(): array
    {
        return [
            'person_ids'   => $this->personIds,
            'company_ids'  => $this->companyIds,
            'name'         => $this->name,
            'content'      => $this->content,
            'confidential' => $this->confidential,
            'format'       => $this->format,
            'badge'        => $this->badge,
        ];
    }
}
