<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\People;

use JsonException;
use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\RequestBuilder\People\CreateRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\Provider\PeopleProvider;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class CreateRequestBuilderTest.
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
    public static function createRequestDataProvider(): array
    {
        return [
            'Request' => [
                file_get_contents(PeopleProvider::createRequest()) ?: '',
            ],
        ];
    }

    /**
     * Tests creating a new person.
     *
     * @dataProvider createRequestDataProvider
     *
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
            ->setPerson(
                'Miller',
                'Marian',
                Constants::GENDER_MALE,
                'Dr. Dr.',
                'Herr'
            )
            ->setBackground('background')
            ->setLanguage('de')
            ->addPosition('CEO', 'Company 1')
            ->addPosition('HoS', 'Company 2', true)
            ->addTag('TAG-1')
            ->addTag('TAG-2')
            ->addTag('TAG-3')
            ->addTelephone(Constants::CONTACT_DETAILS_TYPE_MOBILE, '000-0000000')
            ->addEmailAddress(Constants::CONTACT_DETAILS_TYPE_OFFICE, 'marian.miller@example.org')
            ->addAddress(
                Constants::ADDRESS_TYPE_WORK_HQ,
                'Nowhere 1',
                '12345',
                'City name',
                'DE'
            )
            ->addCustomField('MY-CUSTOM-FIELD-VALUE-1', 1_234_567)
            ->addCustomField('MY-CUSTOM-FIELD-VALUE-2', 1_234_568);

        $request     = $requestBuilder->create();
        $requestJson = $this->serializer->encode($request);

        self::assertSameJson($expectedJson, $requestJson);
    }
}
