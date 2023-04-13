<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Traits;

use Netresearch\Sdk\CentralStation\Request\IncludesRequestInterface;

/**
 * The includes trait.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
trait IncludesTrait
{
    /**
     * @var null|string[]
     */
    private ?array $includes = null;

    /**
     * @param string ...$includes
     *
     * @return self
     */
    public function setIncludes(string ...$includes): IncludesRequestInterface
    {
        $this->includes = $includes;
        return $this;
    }

    /**
     * Adds the defined data to the data to be serialized and returns the updated structure.
     *
     * @param mixed[] $data The data to serialize
     *
     * @return mixed[]
     */
    private function addIncludesToSerializedData(array $data): array
    {
        if (!empty($this->includes)) {
            $data['includes'] = implode(' ', $this->includes);
        }

        return $data;
    }
}
