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
class Create implements RequestInterface
{
    /**
     * @var Tag
     */
    private $tag;

    /**
     * Constructor.
     *
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        $data['tag'] = $this->tag->jsonSerialize();

        return $data;
    }
}
