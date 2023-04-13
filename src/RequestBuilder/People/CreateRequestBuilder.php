<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\People;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\Address;
use Netresearch\Sdk\CentralStation\Request\Addresses;
use Netresearch\Sdk\CentralStation\Request\ContactDetail;
use Netresearch\Sdk\CentralStation\Request\ContactDetails;
use Netresearch\Sdk\CentralStation\Request\CustomField;
use Netresearch\Sdk\CentralStation\Request\CustomFields;
use Netresearch\Sdk\CentralStation\Request\People\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\Request\Person;
use Netresearch\Sdk\CentralStation\Request\Position;
use Netresearch\Sdk\CentralStation\Request\Positions;
use Netresearch\Sdk\CentralStation\Request\Tag;
use Netresearch\Sdk\CentralStation\Request\Tags;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\People\CreateValidator;

/**
 * The request builder to create a valid "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
class CreateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Sets the person's data.
     *
     * @param string      $lastName   The last name
     * @param null|string $firstName  The first name
     * @param null|string $gender     The gender (use one of Constants::GENDER_*)
     * @param null|string $title      The title
     * @param null|string $salutation The salutation
     *
     * @return CreateRequestBuilder
     */
    public function setPerson(
        string $lastName,
        string $firstName = null,
        string $gender = null,
        string $title = null,
        string $salutation = null
    ): CreateRequestBuilder {
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
     * @return CreateRequestBuilder
     */
    public function setLanguage(string $languageCode): CreateRequestBuilder
    {
        $this->data['person']['languageCode'] = $languageCode;
        return $this;
    }

    /**
     * Sets the background information about the person.
     *
     * @param string $background The background information about the person
     *
     * @return CreateRequestBuilder
     */
    public function setBackground(string $background): CreateRequestBuilder
    {
        $this->data['person']['background'] = $background;
        return $this;
    }

    /**
     * Adds a position attribute.
     *
     * @param string $companyName The name of the company
     * @param string $position    The name of the position at the company
     * @param bool   $primary     TRUE if the position is the primary one
     *
     * @return CreateRequestBuilder
     */
    public function addPosition(
        string $companyName,
        string $position,
        bool $primary = false
    ): CreateRequestBuilder {
        if (!isset($this->data['positions'])) {
            $this->data['positions'] = [];
        }

        $this->data['positions'][] = [
            'companyName' => $companyName,
            'position'    => $position,
            'primary'     => $primary,
        ];

        return $this;
    }

    /**
     * Adds a tag attribute.
     *
     * @param string $tagName The name of the tag
     *
     * @return CreateRequestBuilder
     */
    public function addTag(string $tagName): CreateRequestBuilder
    {
        if (!isset($this->data['tags'])) {
            $this->data['tags'] = [];
        }

        if (!\in_array($tagName, $this->data['tags'], true)) {
            $this->data['tags'][] = $tagName;
        }

        return $this;
    }

    /**
     * Adds a telephone number attribute.
     *
     * @param string $type        The type of the telephone number (use one of Constants::CONTACT_DETAILS_TYPE)
     * @param string $phoneNumber The telephone number
     *
     * @return CreateRequestBuilder
     */
    public function addTelephone(string $type, string $phoneNumber): CreateRequestBuilder
    {
        if (!isset($this->data['phoneNumbers'])) {
            $this->data['phoneNumbers'] = [];
        }

        $this->data['phoneNumbers'][] = [
            'type'        => $type,
            'phoneNumber' => $phoneNumber,
        ];

        return $this;
    }

    /**
     * Adds an email address attribute.
     *
     * @param string $type         The type of the email address (use one of Constants::CONTACT_DETAILS_TYPE)
     * @param string $emailAddress The email address
     *
     * @return CreateRequestBuilder
     */
    public function addEmailAddress(string $type, string $emailAddress): CreateRequestBuilder
    {
        if (!isset($this->data['emailAddresses'])) {
            $this->data['emailAddresses'] = [];
        }

        $this->data['emailAddresses'][] = [
            'type'         => $type,
            'emailAddress' => $emailAddress,
        ];

        return $this;
    }

    /**
     * Adds a website attribute.
     *
     * @param string $type    The type of the website (use one of Constants::CONTACT_DETAILS_TYPE)
     * @param string $website The website address
     *
     * @return CreateRequestBuilder
     */
    public function addWebsite(string $type, string $website): CreateRequestBuilder
    {
        if (!isset($this->data['websites'])) {
            $this->data['websites'] = [];
        }

        $this->data['websites'][] = [
            'type'    => $type,
            'website' => $website,
        ];

        return $this;
    }

    /**
     * Adds an address attribute.
     *
     * @param string      $type        The type of address (use one of Constants::ADDRESS_TYPE)
     * @param string      $street      The street name
     * @param null|string $zip         The zip code
     * @param null|string $city        The city name
     * @param null|string $countryCode The two-letter country code
     * @param null|string $stateCode   The two-letter state code
     * @param bool        $primary     TRUE if the address is the primary one
     *
     * @return CreateRequestBuilder
     */
    public function addAddress(
        string $type,
        string $street,
        string $zip = null,
        string $city = null,
        string $countryCode = null,
        string $stateCode = null,
        bool $primary = false
    ): CreateRequestBuilder {
        if (!isset($this->data['addresses'])) {
            $this->data['addresses'] = [];
        }

        $this->data['addresses'][] = [
            'type'        => $type,
            'street'      => $street,
            'zip'         => $zip,
            'city'        => $city,
            'countryCode' => $countryCode,
            'stateCode'   => $stateCode,
            'primary'     => $primary,
        ];

        return $this;
    }

    /**
     * Adds a custom field attribute.
     *
     * @param string $content            The content of the custom field
     * @param int    $customFieldsTypeId The ID of the underlying custom fields type
     *
     * @return CreateRequestBuilder
     */
    public function addCustomField(string $content, int $customFieldsTypeId): CreateRequestBuilder
    {
        if (!isset($this->data['customFields'])) {
            $this->data['customFields'] = [];
        }

        $this->data['customFields'][] = [
            'content'            => $content,
            'customFieldsTypeId' => $customFieldsTypeId,
        ];

        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return CreateRequest
     *
     * @throws RequestValidatorException
     */
    public function create(): CreateRequest
    {
        // Validate the input
        CreateValidator::validate($this->data);

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

        // Add positions
        if (isset($this->data['positions'])) {
            $positions = [];

            foreach ($this->data['positions'] as $item) {
                $position = new Position();
                $position->setCompanyName($item['companyName'])
                    ->setName($item['position'])
                    ->setPrimaryFunction($item['primary']);

                $positions[] = $position;
            }

            $person->setPositions(new Positions($positions));
        }

        // Add tags
        if (isset($this->data['tags'])) {
            $tags = [];

            foreach ($this->data['tags'] as $tagName) {
                $tag = new Tag();
                $tag->setName($tagName);

                $tags[] = $tag;
            }

            $person->setTags(new Tags($tags));
        }

        // Add phone numbers
        if (isset($this->data['phoneNumbers'])) {
            $phoneNumbers = [];

            foreach ($this->data['phoneNumbers'] as $item) {
                $phoneNumber = new ContactDetail();
                $phoneNumber->setType($item['type'])
                    ->setName($item['phoneNumber']);

                $phoneNumbers[] = $phoneNumber;
            }

            $person->setPhoneNumbers(new ContactDetails($phoneNumbers));
        }

        // Add email addresses
        if (isset($this->data['emailAddresses'])) {
            $emailAddresses = [];

            foreach ($this->data['emailAddresses'] as $item) {
                $emailAddress = new ContactDetail();
                $emailAddress->setType($item['type'])
                    ->setName($item['emailAddress']);

                $emailAddresses[] = $emailAddress;
            }

            $person->setEmailAddresses(new ContactDetails($emailAddresses));
        }

        // Add websites
        if (isset($this->data['websites'])) {
            $homepages = [];

            foreach ($this->data['websites'] as $item) {
                $homepage = new ContactDetail();
                $homepage->setType($item['type'])
                    ->setName($item['website']);

                $homepages[] = $homepage;
            }

            $person->setHomepages(new ContactDetails($homepages));
        }

        // Add addresses
        if (isset($this->data['addresses'])) {
            $addresses = [];

            foreach ($this->data['addresses'] as $item) {
                $address = new Address();
                $address->setType($item['type'])
                    ->setStreet($item['street'])
                    ->setCity($item['city'])
                    ->setCountryCode($item['countryCode'])
                    ->setStateCode($item['stateCode'])
                    ->setZip($item['zip'])
                    ->setPrimary($item['primary']);

                $addresses[] = $address;
            }

            $person->setAddresses(new Addresses($addresses));
        }

        // Add custom fields
        if (isset($this->data['customFields'])) {
            $customFields = [];

            foreach ($this->data['customFields'] as $item) {
                $customField = new CustomField();
                $customField->setContent($item['content'])
                    ->setCustomFieldsTypeId($item['customFieldsTypeId']);

                $customFields[] = $customField;
            }

            $person->setCustomFields(new CustomFields($customFields));
        }

        // Assign values to request
        $request = new CreateRequest($person);

        $this->data = [];

        return $request;
    }
}
