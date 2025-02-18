<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Request\Tags;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\Tags\Index;
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
        $request->setPage(2)
            ->setPerPage(10)
            ->setOrderBy('name')
            ->setOrderDirection('desc')
            ->setFilter([
                'created_at' => [
                    Constants::FILTER_SMALLER_THAN => '2022-10-25',
                ],
            ]);

        self::assertSame(
            [
                'perpage' => 10,
                'page'    => 2,
                'order'   => 'name-desc',
                'filter'  => [
                    'created_at' => [
                        Constants::FILTER_SMALLER_THAN => '2022-10-25',
                    ],
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
