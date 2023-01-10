<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Test\Request\CustomFieldsTypes;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\CustomFieldsType;
use Netresearch\Sdk\CentralStation\Request\CustomFieldsTypes\Update;
use PHPUnit\Framework\TestCase;

/**
 * Unit test class for the "update" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class UpdateTest extends TestCase
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
            ->setName('Updated Custom Field Type')
            ->setCategory(Constants::CUSTOM_FIELDS_TYPE_CATEGORY_PROJECT)
            ->setType(Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE_STRING);

        $request = new Update();
        $request->setCustomFieldsType($customFieldsType);

        self::assertSame(
            [
                'custom_fields_type' => [
                    'name'     => 'Updated Custom Field Type',
                    'category' => 'Project',
                    'ftype'    => 'string',
                    'options'  => null,
                    'position' => null,
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
