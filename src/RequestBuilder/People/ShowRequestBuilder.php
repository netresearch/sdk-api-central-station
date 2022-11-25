<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\People;

use Netresearch\Sdk\CentralStation\Api\RequestInterface;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\People\Show as ShowRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\IncludesTrait;
use Netresearch\Sdk\CentralStation\Validator\People\ShowValidator;

/**
 * The request builder to create a valid "show" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class ShowRequestBuilder extends AbstractRequestBuilder
{
    use IncludesTrait;

    /**
     * Sets the person ID.
     *
     * @param int $personId A valid person ID
     *
     * @return ShowRequestBuilder
     */
    public function setPersonId(
        int $personId
    ): ShowRequestBuilder {
        $this->data['personId'] = $personId;

        return $this;
    }

    /**
     * @return ShowRequest|RequestInterface
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface
    {
        // Validate the input
        ShowValidator::validate($this->data);

        // Assign values to request
        $request = new ShowRequest($this->data['personId']);

        if (isset($this->data['includes'])) {
            $request->setIncludes(...$this->data['includes']);
        }

        $this->data = [];

        return $request;
    }
}
