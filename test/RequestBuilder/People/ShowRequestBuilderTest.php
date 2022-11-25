<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\People;

use Netresearch\Sdk\CentralStation\RequestBuilder\People\ShowRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class ShowRequestBuilderTest
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
     */
    public function show(): void
    {
        $requestBuilder = new ShowRequestBuilder();
        $requestBuilder
            ->setPersonId(123456)
            ->addInclude('tags')
            ->addInclude('addrs');

        $request    = $requestBuilder->create();
        $requestUrl = http_build_query($request->jsonSerialize());

        self::assertSame('includes=tags+addrs', $requestUrl);
    }
}
