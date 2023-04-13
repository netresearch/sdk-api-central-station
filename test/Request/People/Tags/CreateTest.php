<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Request\People\Tags;

use Netresearch\Sdk\CentralStation\Request\People\Tags\Create;
use Netresearch\Sdk\CentralStation\Request\Tag;
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
        $tag = new Tag();
        $tag->setName('Funny new tag')
            ->setAttachableId(123456)
            ->setAttachableType('Person');

        $request = new Create($tag);

        self::assertSame(
            [
                'tag' => [
                    'name'            => 'Funny new tag',
                    'attachable_id'   => 123456,
                    'attachable_type' => 'Person',
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
