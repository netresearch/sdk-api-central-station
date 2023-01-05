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
use Netresearch\Sdk\CentralStation\RequestBuilder\People\Addresses\CreateRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\Provider\People\AddressesProvider;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class CreateRequestBuilderTest
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CreateRequestBuilderTest extends RequestBuilderTestCase
{
    /**
     * @return string[][]
     */
    public function createRequestDataProvider(): array
    {
        return [
            'Request' => [
                file_get_contents(AddressesProvider::createRequest()) ?: '',
            ],
        ];
    }

    /**
     * Tests creating a new address.
     *
     * @dataProvider createRequestDataProvider
     * @test
     *
     * @param string $expectedJson
     *
     * @throws RequestValidatorException
     * @throws JsonException
     */
    public function create(string $expectedJson): void
    {
        $requestBuilder = new CreateRequestBuilder();
        $requestBuilder
            ->setAddress(
                'Mustergasse 1',
                '12345',
                'Musterhausen',
                'DE',
                'SN'
            )
            ->setType(Constants::ADDRESS_TYPE_PRIVATE)
            ->setPrimary(true);

        $request     = $requestBuilder->create();
        $requestJson = $this->serializer->encode($request);

        self::assertSameJson($expectedJson, $requestJson);
    }

    /**
     * @test
     */
    public function throwExceptionOnEmptyStreetName(): void
    {
        $this->expectException(RequestValidatorException::class);
        $this->expectExceptionMessage('Please provide at least the street name of the address to create');

        $requestBuilder = new CreateRequestBuilder();
        $requestBuilder->create();
    }

    /**
     * @test
     */
    public function throwExceptionOnUnsupportedType(): void
    {
        $this->expectException(RequestValidatorException::class);
        $this->expectExceptionMessage('The provided address type parameter "CREATED-TYPE" is not allowed');

        $requestBuilder = new CreateRequestBuilder();
        $requestBuilder
            ->setAddress('Street name 1')
            ->setType('CREATED-TYPE')
            ->create();
    }
}
