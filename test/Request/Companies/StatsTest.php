<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Request\Companies;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\Companies\Stats;
use PHPUnit\Framework\TestCase;

/**
 * Unit test class for the "stats" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class StatsTest extends TestCase
{
    /**
     * Tests creating a valid serialized request structure.
     *
     * @test
     */
    public function jsonSerialize(): void
    {
        $request = new Stats();
        $request->setFilter([
            'name' => [
                Constants::FILTER_LIKE => '%ABC company%'
            ],
            'created_at' => [
                Constants::FILTER_SMALLER_THAN => '2022-10-25'
            ]
        ]);

        self::assertSame(
            [
                'filter' => [
                    'name' => [
                        Constants::FILTER_LIKE => '%ABC company%',
                    ],
                    'created_at' => [
                        Constants::FILTER_SMALLER_THAN => '2022-10-25',
                    ],
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
