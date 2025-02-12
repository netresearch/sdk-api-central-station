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
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\RequestBuilder\People\IndexRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class IndexRequestBuilderTest.
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
     *
     * @throws RequestValidatorException
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
                'first_name',
                Constants::FILTER_EQUAL,
                'Daniel'
            )
            ->addFilter(
                'created_at',
                Constants::FILTER_SMALLER_THAN,
                '2022-10-25'
            )
            ->addInclude(Constants::INCLUDE_TAGS)
            ->addInclude(Constants::INCLUDE_ADDRESSES)
            ->setTagRestriction(null, 'TAG-NAME');

        $request    = $requestBuilder->create();
        $requestUrl = http_build_query($request->jsonSerialize());

        self::assertSame(
            'perpage=10&page=2&order=name-desc&filter[first_name][equal]=Daniel&filter[created_at][smaller_than]=2022-10-25&includes=tags addrs&tag_name=TAG-NAME',
            urldecode($requestUrl)
        );
    }

    /**
     * @test
     */
    public function throwExceptionOnUnsupportedInclude(): void
    {
        $this->expectException(RequestValidatorException::class);
        $this->expectExceptionMessage('The provided include parameter "INDEX-INCLUDE" is not allowed');

        $requestBuilder = new IndexRequestBuilder();
        $requestBuilder
            ->addInclude('INDEX-INCLUDE')
            ->create();
    }

    /**
     * @test
     */
    public function throwExceptionOnUnsupportedFilter(): void
    {
        $this->expectException(RequestValidatorException::class);
        $this->expectExceptionMessage('The provided filter parameter "INDEX-FILTER" is not allowed');

        $requestBuilder = new IndexRequestBuilder();
        $requestBuilder
            ->addInclude(Constants::INCLUDE_TAGS)
            ->addFilter('INDEX-FILTER', Constants::FILTER_EQUAL, '123')
            ->create();
    }

    /**
     * @test
     */
    public function throwExceptionOnTagIdAndTagName(): void
    {
        $this->expectException(RequestValidatorException::class);
        $this->expectExceptionMessage('Please provide either the tag ID or the tag name');

        $requestBuilder = new IndexRequestBuilder();
        $requestBuilder
            ->addInclude(Constants::INCLUDE_TAGS)
            ->addFilter('name', Constants::FILTER_EQUAL, '')
            ->setTagRestriction(123456, 'TAG-NAME')
            ->create();
    }
}
