<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\People;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\RequestBuilder\People\StatsRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class StatsRequestBuilderTest
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class StatsRequestBuilderTest extends RequestBuilderTestCase
{
    /**
     * Tests creating  "stats" request URL.
     *
     * @test
     */
    public function stats(): void
    {
        $requestBuilder = new StatsRequestBuilder();
        $requestBuilder
            ->addFilter(
                'first_name',
                Constants::FILTER_EQUAL,
                'Daniel'
            )
            ->addFilter(
                'created_at',
                Constants::FILTER_SMALLER_THAN,
                '2022-10-25'
            );

        $request    = $requestBuilder->create();
        $requestUrl = http_build_query($request->jsonSerialize());

        self::assertSame(
            'filter[first_name][equal]=Daniel&filter[created_at][smaller_than]=2022-10-25',
            urldecode($requestUrl)
        );
    }
}
