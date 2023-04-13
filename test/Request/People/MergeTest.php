<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Request\People;

use Netresearch\Sdk\CentralStation\Request\People\Merge;
use PHPUnit\Framework\TestCase;

/**
 * Unit test class for the "merge" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class MergeTest extends TestCase
{
    /**
     * Tests creating a valid serialized request structure.
     *
     * @test
     */
    public function jsonSerialize(): void
    {
        $request = new Merge(1);
        $request->setMergeIds(5, 10, 100);

        self::assertSame(1, $request->getPersonId());
        self::assertSame(
            [
                'id'         => 1,
                'looser_ids' => [
                    5,
                    10,
                    100,
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
