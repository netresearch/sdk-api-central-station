<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Request\People;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\Address;
use Netresearch\Sdk\CentralStation\Request\Addresses;
use Netresearch\Sdk\CentralStation\Request\ContactDetail;
use Netresearch\Sdk\CentralStation\Request\ContactDetails;
use Netresearch\Sdk\CentralStation\Request\CustomField;
use Netresearch\Sdk\CentralStation\Request\CustomFields;
use Netresearch\Sdk\CentralStation\Request\People\Create;
use Netresearch\Sdk\CentralStation\Request\Person;
use Netresearch\Sdk\CentralStation\Request\Position;
use Netresearch\Sdk\CentralStation\Request\Positions;
use Netresearch\Sdk\CentralStation\Request\Tag;
use Netresearch\Sdk\CentralStation\Request\Tags;
use PHPUnit\Framework\TestCase;

/**
 * Unit test class for the "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CreateTest extends TestCase
{
    /**
     * Tests creating a valid serialized request structure.
     *
     * @test
     */
    public function jsonSerialize(): void
    {
        $person = new Person();
        $person
            ->setFirstName('Max')
            ->setLastName('Mustermann')
            ->setGender(Constants::GENDER_MALE)
            ->setTitle('Dr. Dr.')
            ->setSalutation('Herr')
            ->setBackground('background')
            ->setCountryCode('de')
            ->setPositions(
                new Positions([
                    (new Position())
                        ->setName('CEO')
                        ->setCompanyName('Company-1'),
                ])
            )
            ->setTags(
                new Tags([
                    (new Tag())->setName('TAG-1'),
                    (new Tag())->setName('TAG-2'),
                ])
            )
            ->setPhoneNumbers(
                new ContactDetails([
                    (new ContactDetail())
                        ->setName('12345')
                        ->setType(Constants::CONTACT_DETAILS_TYPE_OFFICE),
                ])
            )
            ->setEmailAddresses(
                new ContactDetails([
                    (new ContactDetail())
                        ->setName('max.mustermann@example.org')
                        ->setType(Constants::CONTACT_DETAILS_TYPE_PRIVATE),
                ])
            )
            ->setAddresses(
                new Addresses([
                    (new Address())
                        ->setStreet('Street 1')
                        ->setType(Constants::ADDRESS_TYPE_WORK_HQ)
                        ->setCity('New York')
                        ->setCountryCode('US'),
                ])
            )
            ->setCustomFields(
                new CustomFields([
                    (new CustomField())
                        ->setContent('CustomFieldValue')
                        ->setCustomFieldsTypeId(123456),
                ])
            );

        $request = new Create($person);

        self::assertSame(
            [
                'person' => [
                    'name'                     => 'Mustermann',
                    'first_name'               => 'Max',
                    'gender'                   => Constants::GENDER_MALE,
                    'title'                    => 'Dr. Dr.',
                    'salutation'               => 'Herr',
                    'country_code'             => 'de',
                    'background'               => 'background',
                    'positions_attributes'     => [
                        [
                            'id'               => null,
                            'person_id'        => null,
                            'company_id'       => null,
                            'company_name'     => 'Company-1',
                            'name'             => 'CEO',
                            'department'       => null,
                            'primary_function' => false,
                            'former'           => false,
                        ],
                    ],
                    'tags_attributes'          => [
                        [
                            'name'            => 'TAG-1',
                            'attachable_id'   => null,
                            'attachable_type' => null,
                        ],
                        [
                            'name'            => 'TAG-2',
                            'attachable_id'   => null,
                            'attachable_type' => null,
                        ],
                    ],
                    'tels_attributes'          => [
                        [
                            'id'              => null,
                            'name'            => '12345',
                            'atype'           => 'office',
                            'attachable_id'   => null,
                            'attachable_type' => null,
                        ],
                    ],
                    'emails_attributes'        => [
                        [
                            'id'              => null,
                            'name'            => 'max.mustermann@example.org',
                            'atype'           => 'private',
                            'attachable_id'   => null,
                            'attachable_type' => null,
                        ],
                    ],
                    'homepages_attributes'     => null,
                    'addrs_attributes'         => [
                        [
                            'id'           => null,
                            'street'       => 'Street 1',
                            'zip'          => null,
                            'city'         => 'New York',
                            'state_code'   => null,
                            'country_code' => 'US',
                            'atype'        => 'work_hq',
                            'primary'      => false,
                        ],
                    ],
                    'custom_fields_attributes' => [
                        [
                            'name'                  => 'CustomFieldValue',
                            'attachable_id'         => null,
                            'attachable_type'       => null,
                            'custom_fields_type_id' => 123456,
                        ],
                    ],
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
