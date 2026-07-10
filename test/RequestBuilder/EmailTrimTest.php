<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder;

use JsonException;
use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\RequestBuilder\Companies\CreateRequestBuilder as CompaniesCreateRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\Companies\UpdateRequestBuilder as CompaniesUpdateRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\People\CreateRequestBuilder as PeopleCreateRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\People\UpdateRequestBuilder as PeopleUpdateRequestBuilder;

/**
 * Class EmailTrimTest.
 *
 * Verifies that every request builder trims the stored e-mail address so it
 * matches the (also trimmed) lookup key and never creates a duplicate contact.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class EmailTrimTest extends RequestBuilderTestCase
{
    /**
     * @return array<string, array{0: callable(string): object, 1: string}>
     */
    public static function builderProvider(): array
    {
        return [
            'people create' => [
                static fn (string $email): object => (new PeopleCreateRequestBuilder())
                    ->setPerson('Miller', 'Marian', Constants::GENDER_MALE)
                    ->addEmailAddress(Constants::CONTACT_DETAILS_TYPE_OFFICE, $email)
                    ->create(),
                'person',
            ],
            'people update' => [
                static fn (string $email): object => (new PeopleUpdateRequestBuilder())
                    ->setPerson('Miller', 'Marian', Constants::GENDER_MALE)
                    ->addEmailAddress(1, Constants::CONTACT_DETAILS_TYPE_OFFICE, $email)
                    ->create(),
                'person',
            ],
            'companies create' => [
                static fn (string $email): object => (new CompaniesCreateRequestBuilder())
                    ->setCompany('ABC Company')
                    ->addEmailAddress(Constants::CONTACT_DETAILS_TYPE_OFFICE, $email)
                    ->create(),
                'company',
            ],
            'companies update' => [
                static fn (string $email): object => (new CompaniesUpdateRequestBuilder())
                    ->setCompany('DEF company')
                    ->addEmailAddress(1, Constants::CONTACT_DETAILS_TYPE_OFFICE, $email)
                    ->create(),
                'company',
            ],
        ];
    }

    /**
     * A leading/trailing whitespace e-mail must be trimmed by every builder.
     *
     * @dataProvider builderProvider
     *
     * @param callable(string): object $buildRequest
     * @param string                   $rootKey
     *
     * @test
     *
     * @throws RequestValidatorException
     * @throws JsonException
     */
    public function addEmailAddressTrimsWhitespace(callable $buildRequest, string $rootKey): void
    {
        $this->assertAddedEmailIsTrimmed($buildRequest('  trimmed@example.org  '), $rootKey);
    }
}
