<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Request\People\CustomFields;

use Netresearch\Sdk\CentralStation\Request\CustomField;
use Netresearch\Sdk\CentralStation\Request\People\CustomFields\Update;
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
        $customField = new CustomField();
        $customField
            ->setContent('CUSTOM-FIELD-CONTENT')
            ->setCustomFieldsTypeId(1003)
            ->setAttachableId(12345678)
            ->setAttachableType('Person');

        $request = new Update();
        $request->setCustomField($customField);

        self::assertSame(
            [
                'custom_field' => [
                    'name'                  => 'CUSTOM-FIELD-CONTENT',
                    'attachable_id'         => 12345678,
                    'attachable_type'       => 'Person',
                    'custom_fields_type_id' => 1003,
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
