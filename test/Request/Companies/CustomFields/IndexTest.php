<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Test\Request\Companies\CustomFields;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\Companies\CustomFields\Index;
use PHPUnit\Framework\TestCase;

/**
 * Unit test class for the "index" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class IndexTest extends TestCase
{
    /**
     * Tests creating a valid serialized request structure.
     *
     * @test
     */
    public function jsonSerialize(): void
    {
        $request = new Index();
        $request->setIncludes(Constants::CUSTOM_FIELDS_INCLUDE_CUSTOM_FIELDS_TYPE);

        self::assertSame(
            [
                'includes' => 'custom_fields_type',
            ],
            $request->jsonSerialize()
        );
    }
}
