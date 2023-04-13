<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Request\Attachments;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\Attachments\Index;
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
        $request->setPage(1)
            ->setPerPage(5)
            ->setIncludes(Constants::ATTACHMENT_INCLUDE_COMMENTS, Constants::ATTACHMENT_INCLUDE_USER);

        self::assertSame(
            [
                'perpage'  => 5,
                'page'     => 1,
                'includes' => 'comments user',
            ],
            $request->jsonSerialize()
        );
    }
}
