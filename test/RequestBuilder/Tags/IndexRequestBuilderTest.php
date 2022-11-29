<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\Tags;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\RequestBuilder\Tags\IndexRequestBuilder;
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
     */
    public function index(): void
    {
        $requestBuilder = new IndexRequestBuilder();
        $requestBuilder
            ->setLimit(
                10,
                2
            )
            ->setOrder(
                'name',
                Constants::ORDER_DIRECTION_DESC
            )
            ->addFilter(
                'created_at',
                Constants::FILTER_SMALLER_THAN,
                '2022-10-25'
            );

        $request    = $requestBuilder->create();
        $requestUrl = http_build_query($request->jsonSerialize());

        self::assertSame(
            'perpage=10&page=2&order=name-desc&filter[created_at][smaller_than]=2022-10-25',
            urldecode($requestUrl)
        );
    }
}
