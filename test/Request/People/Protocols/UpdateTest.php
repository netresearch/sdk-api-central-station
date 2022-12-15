<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Test\Request\People\Protocols;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\People\Protocols\Update;
use Netresearch\Sdk\CentralStation\Request\Protocol;
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
        $protocol = new Protocol();
        $protocol->setName('Name')
            ->setContent('Content')
            ->setBadge(Constants::PROTOCOL_BADGE_EMAIL)
            ->setFormat(Constants::PROTOCOL_FORMAT_HTML)
            ->setConfidential(true)
            ->setPersonIds(123456, 987654)
            ->setCompanyIds(1234, 4567, 7890);

        $request = new Update();
        $request->setProtocol($protocol);

        self::assertSame(
            [
                'protocol' => [
                    'person_ids'   => [
                        123456,
                        987654,
                    ],
                    'company_ids'  => [
                        1234,
                        4567,
                        7890,
                    ],
                    'name'         => 'Name',
                    'content'      => 'Content',
                    'confidential' => true,
                    'format'       => 'html',
                    'badge'        => 'email',
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
