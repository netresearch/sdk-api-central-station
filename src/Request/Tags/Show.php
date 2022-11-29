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

/**
 * A "show" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Show implements RequestInterface
{
    /**
     * @var int
     */
    private $tagId;

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
     * Returns the tag ID.
     *
     * @return int
     */
    public function getTagId(): int
    {
        return $this->tagId;
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [];
    }
}
