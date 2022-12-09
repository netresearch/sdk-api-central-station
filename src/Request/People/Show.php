<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\People;

use Netresearch\Sdk\CentralStation\Api\ShowRequestInterface;

/**
 * A "show" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Show implements ShowRequestInterface
{
    /**
     * @var string[]
     */
    private $includes;

    /**
     * @param string ...$includes
     *
     * @return Show
     */
    public function setIncludes(string ...$includes): Show
    {
        $this->includes = $includes;
        return $this;
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if (!empty($this->includes)) {
            $data['includes'] = implode(' ', $this->includes);
        }

        return $data;
    }
}
