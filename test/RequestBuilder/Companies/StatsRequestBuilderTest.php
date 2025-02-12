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
use Netresearch\Sdk\CentralStation\RequestBuilder\Companies\StatsRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class StatsRequestBuilderTest.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class StatsRequestBuilderTest extends RequestBuilderTestCase
{
    /**
     * Tests creating "stats" request URL.
     *
     * @test
     *
     * @throws RequestValidatorException
     */
    public function stats(): void
    {
        $requestBuilder = new StatsRequestBuilder();
        $requestBuilder
            ->addFilter(
                'name',
                Constants::FILTER_LIKE,
                '%ABC company%'
            )
            ->addFilter(
                'created_at',
                Constants::FILTER_SMALLER_THAN,
                '2022-10-25'
            );

        $request    = $requestBuilder->create();
        $requestUrl = http_build_query($request->jsonSerialize());

        self::assertSame(
            'filter[name][like]=%ABC company%&filter[created_at][smaller_than]=2022-10-25',
            urldecode($requestUrl)
        );
    }
}
