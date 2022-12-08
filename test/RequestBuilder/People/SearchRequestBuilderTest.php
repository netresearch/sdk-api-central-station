<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\People;

use Netresearch\Sdk\CentralStation\RequestBuilder\People\SearchRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class SearchRequestBuilderTest
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
     */
    public function search(): void
    {
        $requestBuilder = new SearchRequestBuilder();
        $requestBuilder
            ->addQuery('name', 'Mäh')
            ->addQuery('email', 'max.mustermann@example.org');

        $request    = $requestBuilder->create();
        $requestUrl = http_build_query($request->jsonSerialize());

        self::assertSame(
            'name=Mäh&email=max.mustermann@example.org',
            urldecode($requestUrl)
        );
    }
}
