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
use Netresearch\Sdk\CentralStation\RequestBuilder\People\UpdateRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\Provider\PeopleProvider;
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
                file_get_contents(PeopleProvider::updateRequest()) ?: '',
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
     */
    public function update(string $expectedJson): void
    {
        $requestBuilder = new UpdateRequestBuilder();
        $requestBuilder
            ->setPerson(
                'Miller Nr 2',
                'Marianne',
                Constants::GENDER_FEMALE,
                'Prof. Dr.',
                'Frau'
            )
            ->setBackground('background')
            ->setLanguage('de');

        $request     = $requestBuilder->create();
        $requestJson = $this->serializer->encode($request);

        self::assertSameJson($expectedJson, $requestJson);
    }
}
