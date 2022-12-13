<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Protocols\Attachments;

use Netresearch\Sdk\CentralStation\Api\CreateRequestInterface;
use Netresearch\Sdk\CentralStation\Request\Attachments\Common\Attachment;

/**
 * A "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Create implements CreateRequestInterface
{
    /**
     * @var Attachment
     */
    private $attachment;

    /**
     * Constructor.
     *
     * @param Attachment $attachment
     */
    public function __construct(Attachment $attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * @return array<string, array<string, null|int|string>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        $data['attachment'] = $this->attachment->jsonSerialize();

        return $data;
    }
}
