<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Request\Protocols;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\Protocols\Index;
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
        $request->setPage(3)
            ->setPerPage(2)
            ->setOrderBy('name')
            ->setOrderDirection('asc')
            ->setIncludes(Constants::PROTOCOL_INCLUDE_COMMENTS);

        self::assertSame(
            [
                'perpage'  => 2,
                'page'     => 3,
                'order'    => 'name-asc',
                'includes' => 'comments',
            ],
            $request->jsonSerialize()
        );
    }
}
