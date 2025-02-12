<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\Companies;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\RequestBuilder\Companies\ShowRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class ShowRequestBuilderTest.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class ShowRequestBuilderTest extends RequestBuilderTestCase
{
    /**
     * Tests creating a "show" request URL.
     *
     * @test
     *
     * @throws RequestValidatorException
     */
    public function show(): void
    {
        $requestBuilder = new ShowRequestBuilder();
        $requestBuilder
            ->addInclude(Constants::INCLUDE_TAGS)
            ->addInclude(Constants::INCLUDE_ADDRESSES);

        $request    = $requestBuilder->create();
        $requestUrl = http_build_query($request->jsonSerialize());

        self::assertSame('includes=tags+addrs', $requestUrl);
    }
}
