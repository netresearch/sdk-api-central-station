<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\People;

use Netresearch\Sdk\CentralStation\Request\RequestInterface;
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
 * @api
 */
class UpdateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Sets the person's data.
     *
     * @param null|string $lastName   The last name
     * @param null|string $firstName  The first name
     * @param null|string $gender     The gender (use one of Constants::GENDER_*)
     * @param null|string $title      The title
     * @param null|string $salutation The salutation
     *
     * @return UpdateRequestBuilder
     */
    public function setPerson(
        string $lastName = null,
        string $firstName = null,
        string $gender = null,
        string $title = null,
        string $salutation = null
    ): UpdateRequestBuilder {
        $this->data['person']['lastName'] = $lastName;
        $this->data['person']['firstName'] = $firstName;
        $this->data['person']['gender'] = $gender;
        $this->data['person']['title'] = $title;
        $this->data['person']['salutation'] = $salutation;

        return $this;
    }

    /**
     * Sets the person's language.
     *
     * @param string $languageCode The person's language as ISO-639-1 (e.g. de, en, fr or not set)
     *
     * @return UpdateRequestBuilder
     */
    public function setLanguage(string $languageCode): UpdateRequestBuilder
    {
        $this->data['person']['languageCode'] = $languageCode;
        return $this;
    }

    /**
     * Sets the background information about the person.
     *
     * @param string $background The background information about the person
     *
     * @return UpdateRequestBuilder
     */
    public function setBackground(string $background): UpdateRequestBuilder
    {
        $this->data['person']['background'] = $background;
        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return UpdateRequest|RequestInterface
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface
    {
        // Validate the input
        UpdateValidator::validate($this->data);

        // Assign values to request
        $request = new UpdateRequest();

        if (isset($this->data['person'])) {
            $person = new Person();
            $person->setLastName($this->data['person']['lastName'])
                ->setFirstName($this->data['person']['firstName'])
                ->setGender($this->data['person']['gender'])
                ->setTitle($this->data['person']['title'])
                ->setSalutation($this->data['person']['salutation']);

            if (isset($this->data['person']['languageCode'])) {
                $person->setCountryCode($this->data['person']['languageCode']);
            }

            if (isset($this->data['person']['background'])) {
                $person->setBackground($this->data['person']['background']);
            }

            $request->setPerson($person);
        }

        $this->data = [];

        return $request;
    }
}
