<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Test\Request\Tags;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\Tags\Common\Tag;
use Netresearch\Sdk\CentralStation\Request\Tags\Update;
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
        $tag = new Tag('Funny updated tag');
        $tag->setAttachableId(123456)
            ->setAttachableType('Person');

        $request = new Update(123456);
        $request->setTag($tag);

        self::assertSame(123456, $request->getTagId());
        self::assertSame(
            [
                'tag' => [
                    'name'            => 'Funny updated tag',
                    'attachable_id'   => 123456,
                    'attachable_type' => 'Person',
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
