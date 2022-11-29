<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Tags;

use Netresearch\Sdk\CentralStation\Api\RequestInterface;
use Netresearch\Sdk\CentralStation\Request\Tags\Common\Tag;

/**
 * A batch request used to send multiple hits in a single request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Update implements RequestInterface
{
    /**
     * @var int
     */
    private $tagId;

    /**
     * @var null|Tag
     */
    private $tag;

    /**
     * Constructor.
     *
     * @param int $tagId
     */
    public function __construct(int $tagId)
    {
        $this->tagId = $tagId;
    }

    /**
     * @return int
     */
    public function getTagId(): int
    {
        return $this->tagId;
    }

    /**
     * @param Tag $tag
     *
     * @return Update
     */
    public function setTag(Tag $tag): Update
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return array<string, array<string, null|int|string>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->tag) {
            $data['tag'] = $this->tag->jsonSerialize();
        }

        return $data;
    }
}
