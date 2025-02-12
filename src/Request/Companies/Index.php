<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Companies;

use Netresearch\Sdk\CentralStation\Request\CustomFieldRequestInterface;
use Netresearch\Sdk\CentralStation\Request\FilterRequestInterface;
use Netresearch\Sdk\CentralStation\Request\IncludesRequestInterface;
use Netresearch\Sdk\CentralStation\Request\PaginationRequestInterface;
use Netresearch\Sdk\CentralStation\Request\SortRequestInterface;
use Netresearch\Sdk\CentralStation\Request\Traits\CustomFieldTrait;
use Netresearch\Sdk\CentralStation\Request\Traits\FilterTrait;
use Netresearch\Sdk\CentralStation\Request\Traits\IncludesTrait;
use Netresearch\Sdk\CentralStation\Request\Traits\PaginationTrait;
use Netresearch\Sdk\CentralStation\Request\Traits\SortTrait;

/**
 * A "index" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Index implements FilterRequestInterface, IncludesRequestInterface, PaginationRequestInterface, SortRequestInterface, CustomFieldRequestInterface
{
    use CustomFieldTrait;
    use FilterTrait;
    use IncludesTrait;
    use PaginationTrait;
    use SortTrait;

    private ?int $tagId = null;

    private ?string $tagName = null;

    /**
     * @param int|null $tagId
     *
     * @return Index
     */
    public function setTagId(?int $tagId): Index
    {
        $this->tagId = $tagId;

        return $this;
    }

    /**
     * @param string|null $tagName
     *
     * @return Index
     */
    public function setTagName(?string $tagName): Index
    {
        $this->tagName = $tagName;

        return $this;
    }

    /**
     * @return array<string, int|string|string[][]>
     */
    public function jsonSerialize(): array
    {
        $data = [];
        $data = $this->addPaginationToSerializedData($data);
        $data = $this->addSortToSerializedData($data);
        $data = $this->addFilterToSerializedData($data);
        $data = $this->addIncludesToSerializedData($data);
        $data = $this->addCustomFieldToSerializedData($data);

        if (!empty($this->tagId)) {
            $data['tag_id'] = $this->tagId;
        }

        if (!empty($this->tagName)) {
            $data['tag_name'] = $this->tagName;
        }

        return $data;
    }
}
