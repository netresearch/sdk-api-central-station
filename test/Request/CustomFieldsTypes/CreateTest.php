<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Request\CustomFieldsTypes;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\CustomFieldsType;
use Netresearch\Sdk\CentralStation\Request\CustomFieldsTypes\Create;
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
        $customFieldsType = new CustomFieldsType();
        $customFieldsType
            ->setName('New Custom Field Type')
            ->setCategory(Constants::CUSTOM_FIELDS_TYPE_CATEGORY_PERSON)
            ->setPosition(123)
            ->setType(Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE_SELECT)
            ->setOptions('OPTION-1', 'OPTION-2');

        $request = new Create($customFieldsType);

        self::assertSame(
            [
                'custom_fields_type' => [
                    'name'     => 'New Custom Field Type',
                    'category' => 'Person',
                    'ftype'    => 'select',
                    'options'  => ['OPTION-1', 'OPTION-2'],
                    'position' => 123,
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
