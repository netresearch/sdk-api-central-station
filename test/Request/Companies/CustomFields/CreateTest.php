<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Request\Companies\CustomFields;

use Netresearch\Sdk\CentralStation\Request\Companies\CustomFields\Create;
use Netresearch\Sdk\CentralStation\Request\CustomField;
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
        $customField = new CustomField();
        $customField
            ->setContent('CUSTOM-FIELD-CONTENT')
            ->setCustomFieldsTypeId(1003)
            ->setAttachableId(12_345_678)
            ->setAttachableType('Company');

        $request = new Create($customField);

        self::assertSame(
            [
                'custom_field' => [
                    'name'                  => 'CUSTOM-FIELD-CONTENT',
                    'attachable_id'         => 12_345_678,
                    'attachable_type'       => 'Company',
                    'custom_fields_type_id' => 1003,
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
