<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model;

/**
 * A protocol record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Protocol extends AbstractEntity
{
    /**
     * ID of account.
     *
     * @var int
     */
    public $accountId;

    /**
     * ID of the user which created the note.
     *
     * @var int
     */
    public $userId;

    /**
     * IDs of the linked persons.
     *
     * @var int[]
     */
    public $personIds;

    /**
     * IDs of the linked companies.
     *
     * @var int[]
     */
    public $companyIds;

    /**
     * The sketch of the note.
     *
     * @var null|string
     */
    public $name;

    /**
     * The content of the note.
     *
     * @var null|string
     */
    public $content;

    /**
     * Whether if the note is confidential or not.
     *
     * @var bool
     */
    public $confidential;

    /**
     * The format of the note (either "plaintext", "markdown", "textile" or "html" (default)).
     *
     * @var string
     */
    public $format;

    /**
     * The type of the note (either "ProtocolObjectNote", "ProtocolUserNote", or "ProtocolAttachment").
     *
     * @var string
     */
    public $type;

    /**
     * The badge of the note (either "note", "call", "email", "meeting" or "other", "research" for companies).
     *
     * @var string
     */
    public $badge;

    /**
     * The number of assigned attachment to this note.
     *
     * @var int
     */
    public $attachmentsCount;

    /**
     * The number of assigned comments to this note.
     *
     * @var int
     */
    public $commentsCount;

    /**
     * The list of comments assigned to this note.
     *
     * @var Comment[]
     */
    public $comments = [];
}
