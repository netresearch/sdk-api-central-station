<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model;

use Netresearch\Sdk\CentralStation\Model\Attachments\Attachment;

/**
 * An attachments record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Attachments
{
    /**
     * An attachment.
     *
     * @var Attachment
     */
    public $attachment;

    /**
     * The base64 encoded data of the attachment.
     *
     * @var string
     */
    public $data;
}
