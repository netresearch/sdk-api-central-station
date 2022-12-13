<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Attachments;

use Netresearch\Sdk\CentralStation\Api\IndexRequestInterface;

/**
 * An "index" request to return all attachments.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Index extends AbstractIndexRequest
{
    /**
     * @var string[]
     */
    private $includes;

    /**
     * @param string ...$includes
     *
     * @return Index
     */
    public function setIncludes(string ...$includes): Index
    {
        $this->includes = $includes;
        return $this;
    }

    /**
     * @return array<string, int|string>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if (!empty($this->perPage)) {
            $data['perpage'] = $this->perPage;
        }

        if (!empty($this->page)) {
            $data['page'] = $this->page;
        }

        if (!empty($this->includes)) {
            $data['includes'] = implode(' ', $this->includes);
        }

        return $data;
    }
}
