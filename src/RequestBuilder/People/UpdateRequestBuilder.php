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
use Netresearch\Sdk\CentralStation\Request\People\Common\Person;
use Netresearch\Sdk\CentralStation\Request\People\Update as UpdateRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\People\UpdateValidator;

/**
 * The request builder to create a valid "update" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class UpdateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Sets the person ID.
     *
     * @param int $personId A valid person ID
     *
     * @return UpdateRequestBuilder
     */
    public function setPersonId(
        int $personId
    ): UpdateRequestBuilder {
        $this->data['personId'] = $personId;

        return $this;
    }

    /**
     * Sets the person.
     *
     * @param null|string $lastName
     * @param null|string $firstName
     * @param null|string $gender
     * @param null|string $title
     *
     * @return UpdateRequestBuilder
     */
    public function setPerson(
        string $lastName = null,
        string $firstName = null,
        string $gender = null,
        string $title = null
    ): UpdateRequestBuilder {
        $this->data['person'] = [
            'lastName'  => $lastName,
            'firstName' => $firstName,
            'gender'    => $gender,
            'title'     => $title,
        ];

        return $this;
    }

    /**
     * @return UpdateRequest|RequestInterface
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface
    {
        // Validate the input
        UpdateValidator::validate($this->data);

        // Assign values to request
        $request = new UpdateRequest($this->data['personId']);

        if (isset($this->data['person'])) {
            $person = new Person();
            $person
                ->setLastName($this->data['person']['lastName'])
                ->setFirstName($this->data['person']['firstName'])
                ->setGender($this->data['person']['gender'])
                ->setTitle($this->data['person']['title']);

            $request->setPerson($person);
        }

        $this->data = [];

        return $request;
    }
}
