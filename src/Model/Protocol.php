<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model;

use MagicSunday\JsonMapper\Annotation\ReplaceNullWithDefaultValue;

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
     * ID of an account.
     *
     * @var int
     */
    public int $accountId;

    /**
     * ID of the user which created the note.
     *
     * @var int
     */
    public int $userId;

    /**
     * IDs of the linked persons.
     *
     * @var int[]
     */
    public array $personIds = [];

    /**
     * IDs of the linked companies.
     *
     * @var int[]
     */
    public array $companyIds = [];

    /**
     * The sketch of the note.
     *
     * @var null|string
     */
    public ?string $name = null;

    /**
     * The content of the note.
     *
     * @var null|string
     */
    public ?string $content = null;

    /**
     * Whether if the note is confidential or not.
     *
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public bool $confidential = false;

    /**
     * The format of the note (either "plaintext", "markdown", "textile" or "html" (default)).
     *
     * @var string
     */
    public string $format;

    /**
     * The type of the note (either "ProtocolObjectNote", "ProtocolUserNote", or "ProtocolAttachment").
     *
     * @var string
     */
    public string $type;

    /**
     * The badge of the note (either "note", "call", "email", "meeting" or "other", "research" for companies).
     *
     * @var string
     */
    public string $badge;

    /**
     * The number of assigned attachments to this note.
     *
     * @var int
     */
    public int $attachmentsCount;

    /**
     * The number of assigned comments to this note.
     *
     * @var int
     */
    public int $commentsCount;

    /**
     * The list of comments assigned to this note.
     *
     * @var Comment[]
     */
    public array $comments = [];
}
