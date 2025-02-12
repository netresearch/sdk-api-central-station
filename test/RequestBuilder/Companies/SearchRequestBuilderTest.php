<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\Companies;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\RequestBuilder\Companies\SearchRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class SearchRequestBuilderTest.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class SearchRequestBuilderTest extends RequestBuilderTestCase
{
    /**
     * Tests creating a "search" request URL.
     *
     * @test
     *
     * @throws RequestValidatorException
     */
    public function search(): void
    {
        $requestBuilder = new SearchRequestBuilder();
        $requestBuilder
            ->addQuery('name', 'ABC company')
            ->addQuery('email', 'max.mustermann@example.org');

        $request    = $requestBuilder->create();
        $requestUrl = http_build_query($request->jsonSerialize());

        self::assertSame(
            'name=ABC company&email=max.mustermann@example.org',
            urldecode($requestUrl)
        );
    }
}
