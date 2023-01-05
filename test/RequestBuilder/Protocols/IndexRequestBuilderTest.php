<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\Protocols;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\RequestBuilder\Protocols\IndexRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class IndexRequestBuilderTest
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class IndexRequestBuilderTest extends RequestBuilderTestCase
{
    /**
     * Tests creating an "index" request URL.
     *
     * @test
     * @throws RequestValidatorException
     */
    public function index(): void
    {
        $requestBuilder = new IndexRequestBuilder();
        $requestBuilder
            ->setLimit(5)
            ->setOrder('name')
            ->setIncludeComments(true);

        $request    = $requestBuilder->create();
        $requestUrl = http_build_query($request->jsonSerialize());

        self::assertSame(
            'perpage=5&page=1&order=name-asc&includes=comments',
            urldecode($requestUrl)
        );
    }
}
