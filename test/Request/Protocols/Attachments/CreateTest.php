<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Test\Request\Protocols\Attachments;

use Netresearch\Sdk\CentralStation\Request\Attachments\Common\Attachment;
use Netresearch\Sdk\CentralStation\Request\Protocols\Attachments\Create;
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
        $attachment = new Attachment();
        $attachment->setFilename('my-uploaded-file.jpg')
            ->setContentType('image/jpg')
            ->setData(base64_encode('BASE64 ENCODED FILE CONTENT'));

        $request = new Create($attachment);

        self::assertSame(
            [
                'attachment' => [
                    'content_type'             => 'image/jpg',
                    'filename'                 => 'my-uploaded-file.jpg',
                    'attachable_id'            => null,
                    'attachable_type'          => null,
                    'attachment_category_id'   => null,
                    'attachment_category_name' => null,
                    'data'                     => 'QkFTRTY0IEVOQ09ERUQgRklMRSBDT05URU5U',
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
