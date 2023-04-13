<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Tags;

use Netresearch\Sdk\CentralStation\Request\PaginationRequestInterface;
use Netresearch\Sdk\CentralStation\Request\SortRequestInterface;
use Netresearch\Sdk\CentralStation\Request\Traits\PaginationTrait;
use Netresearch\Sdk\CentralStation\Request\Traits\SortTrait;

/**
 * A "list" request.
 *
 * TODO Keywords as a part of namespace are only allowed since PHP 8.0, so for the meanwhile this class
 *      is named "TagList" instead of "List"
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class TagList implements PaginationRequestInterface, SortRequestInterface
{
    use PaginationTrait;
    use SortTrait;

    /**
     * @var null|string
     */
    private ?string $attachableType = null;

    /**
     * @param null|string $attachableType
     *
     * @return TagList
     */
    public function setAttachableType(?string $attachableType): TagList
    {
        $this->attachableType = $attachableType;
        return $this;
    }

    /**
     * @return array<string, int|string|array<string>|array<array<string>>>
     */
    public function jsonSerialize(): array
    {
        $data = [];
        $data = $this->addPaginationToSerializedData($data);
        $data = $this->addSortToSerializedData($data);

        if ($this->attachableType !== null) {
            $data['attachable_type'] = $this->attachableType;
        }

        return $data;
    }
}
