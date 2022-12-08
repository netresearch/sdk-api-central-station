<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Test\Request\People;

use Netresearch\Sdk\CentralStation\Request\People\Search;
use PHPUnit\Framework\TestCase;

/**
 * Unit test class for the "search" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class SearchTest extends TestCase
{
    /**
     * Tests creating a valid serialized request structure.
     *
     * @test
     */
    public function jsonSerialize(): void
    {
        $request = new Search();
        $request->setQuery([
            [
                'name',
                'Mäh',
            ]
        ]);

        self::assertSame(
            [
                [
                    'name',
                    'Mäh',
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
