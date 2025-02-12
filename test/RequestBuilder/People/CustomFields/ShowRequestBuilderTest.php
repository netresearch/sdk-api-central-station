<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\People\CustomFields;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\RequestBuilder\People\CustomFields\ShowRequestBuilder;
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
        $requestBuilder->setIncludeCustomFieldsType(true);

        $request    = $requestBuilder->create();
        $requestUrl = http_build_query($request->jsonSerialize());

        self::assertSame('includes=custom_fields_type', $requestUrl);
    }
}
