<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\People;

use Netresearch\Sdk\CentralStation\Request\RequestInterface;

/**
 * A "merge" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Merge implements RequestInterface
{
    /**
     * @var int
     */
    private int $personId;

    /**
     * A list of person IDs used to merge into the $personId record.
     *
     * @var int[]
     */
    public array $mergeIds;

    /**
     * Constructor.
     *
     * @param int $personId
     */
    public function __construct(int $personId)
    {
        $this->personId = $personId;
    }

    /**
     * @return int
     */
    public function getPersonId(): int
    {
        return $this->personId;
    }

    /**
     * @param int ...$mergeIds
     *
     * @return Merge
     */
    public function setMergeIds(int ...$mergeIds): Merge
    {
        $this->mergeIds = $mergeIds;
        return $this;
    }

    /**
     * @return array<string, int|array<int>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        $data['id']         = $this->personId;
        $data['looser_ids'] = $this->mergeIds;

        return $data;
    }
}
