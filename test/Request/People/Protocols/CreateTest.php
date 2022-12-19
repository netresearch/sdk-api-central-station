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
use Netresearch\Sdk\CentralStation\Request\People\Protocols\Create;
use Netresearch\Sdk\CentralStation\Request\Protocols\Common\Protocol;
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
        $protocol = new Protocol();
        $protocol->setName('Name')
            ->setContent('Content')
            ->setBadge(Constants::PROTOCOL_BADGE_EMAIL)
            ->setFormat(Constants::PROTOCOL_FORMAT_HTML)
            ->setConfidential(true)
            ->setPersonIds(123456, 987654);

        $request = new Create($protocol);

        self::assertSame(
            [
                'protocol' => [
                    'person_ids'   => [
                        123456,
                        987654,
                    ],
                    'company_ids'  => null,
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
