<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation;

/**
 * URL builder.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class UrlBuilder
{
    /**
     * @var string
     */
    private string $baseUrl;

    /**
     * @var string[]
     */
    private array $paths = [];

    /**
     * @var mixed[]
     */
    private array $parameters = [];

    /**
     * Reset the list of path parts.
     *
     * @return UrlBuilder
     */
    public function reset(): UrlBuilder
    {
        $this->paths = [];

        return $this;
    }

    /**
     * Set the base URL.
     *
     * @param string $baseUrl
     *
     * @return UrlBuilder
     */
    public function setBase(string $baseUrl): UrlBuilder
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * Add a path part.
     *
     * @param string $path
     *
     * @return UrlBuilder
     */
    public function addPath(string $path): UrlBuilder
    {
        $this->paths[] = $path;

        return $this;
    }

    /**
     * Returns the complete assembled URL.
     *
     * @return string
     */
    public function getFullUrl(): string
    {
        $url = $this->baseUrl . implode('', $this->paths);

        if ($this->parameters !== []) {
            $url .= '?' . http_build_query(array_filter($this->parameters));
        }

        return $url;
    }

    /**
     * Set additional query parameters.
     *
     * @param mixed[] $parameters
     *
     * @return UrlBuilder
     */
    public function setParams(array $parameters): UrlBuilder
    {
        $this->parameters = $parameters;

        return $this;
    }
}
