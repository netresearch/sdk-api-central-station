<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\People;

use Netresearch\Sdk\CentralStation\RequestBuilder\People\CreateRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\Provider\People\CreateProvider;
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
                file_get_contents(CreateProvider::createRequest()) ?: '',
            ],
        ];
    }

    /**
     * Tests creating a new person.
     *
     * @dataProvider createRequestDataProvider
     * @test
     *
     * @param string $expectedXml
     */
    public function create(string $expectedXml): void
    {
        $requestBuilder = new CreateRequestBuilder();
        $requestBuilder
            ->setPerson(
                'Miller',
                'Marian'
            );

        $request    = $requestBuilder->create();
        $requestXml = $this->serializer->encode($request);

        $this->assertSameJson($expectedXml, $requestXml);
    }
}
