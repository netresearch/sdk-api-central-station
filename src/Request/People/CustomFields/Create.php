<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\People\CustomFields;

use Netresearch\Sdk\CentralStation\Request\CustomField;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;

/**
 * A "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Create implements RequestInterface
{
    /**
     * @var CustomField
     */
    private CustomField $customField;

    /**
     * Constructor.
     *
     * @param CustomField $customField
     */
    public function __construct(CustomField $customField)
    {
        $this->customField = $customField;
    }

    /**
     * @return array<string, array<string, null|int|string>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        $data['custom_field'] = $this->customField->jsonSerialize();

        return $data;
    }
}
