<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\People\Addresses;

use JsonException;
use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\RequestBuilder\People\Addresses\UpdateRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\Provider\People\AddressesProvider;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class UpdateRequestBuilderTest.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class UpdateRequestBuilderTest extends RequestBuilderTestCase
{
    /**
     * @return string[][]
     */
    public static function updateRequestDataProvider(): array
    {
        return [
            'Request' => [
                file_get_contents(AddressesProvider::updateRequest()) ?: '',
            ],
        ];
    }

    /**
     * Tests updating an existing address.
     *
     * @dataProvider updateRequestDataProvider
     *
     * @test
     *
     * @param string $expectedJson
     *
     * @throws RequestValidatorException
     * @throws JsonException
     */
    public function update(string $expectedJson): void
    {
        $requestBuilder = new UpdateRequestBuilder();
        $requestBuilder
            ->setAddress(
                null,
                '98765',
                'Musterstadt'
            )
            ->setType(Constants::ADDRESS_TYPE_OTHER)
            ->setPrimary(false);

        $request     = $requestBuilder->create();
        $requestJson = $this->serializer->encode($request);

        self::assertSameJson($expectedJson, $requestJson);
    }

    /**
     * @test
     */
    public function throwExceptionOnUnsupportedType(): void
    {
        $this->expectException(RequestValidatorException::class);
        $this->expectExceptionMessage('The provided address type parameter "UPDATED-TYPE" is not allowed');

        $requestBuilder = new UpdateRequestBuilder();
        $requestBuilder
            ->setType('UPDATED-TYPE')
            ->create();
    }
}
