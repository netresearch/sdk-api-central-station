<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\Companies;

use JsonException;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\RequestBuilder\Companies\UpdateRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\Provider\CompaniesProvider;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class UpdateRequestBuilderTest
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
    public function updateRequestDataProvider(): array
    {
        return [
            'Request' => [
                file_get_contents(CompaniesProvider::updateRequest()) ?: '',
            ],
        ];
    }

    /**
     * Tests updating an existing person.
     *
     * @dataProvider updateRequestDataProvider
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
            ->setCompany('DEF company')
            ->setBackground('background');

        $request = $requestBuilder->create();
        $requestJson = $this->serializer->encode($request);

        self::assertSameJson(
            $expectedJson,
            $requestJson
        );
    }
}
