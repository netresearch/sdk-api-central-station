<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test;

use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Request\People\Index;

/**
 * Class ApiTest
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class ApiTest extends TestCase
{
    /**
     * @return string[][]
     */
    public function errorResponseDataProvider(): array
    {
        return [
            'Unauthorized' => [
                401,
                AuthenticationException::class,
                'Authentication failed. Please check your API key.',
            ],

            'Forbidden' => [
                403,
                ServiceException::class,
                'The specified user does not have sufficient rights for the action.',
            ],

            'NotFound' => [
                404,
                ServiceException::class,
                'Not Found',
            ],

            'Conflict' => [
                409,
                ServiceException::class,
                'The request was made under false assumptions. For example, if the resource has '
                . 'been changed in the meantime.',
            ],

            'UnsupportedMediaType' => [
                415,
                ServiceException::class,
                'The content of the request was submitted with an invalid or not allowed media type. '
                . 'Only .json is supported.',
            ],

            'InternalServerError' => [
                500,
                ServiceException::class,
                'Internal Server Error',
            ],

            'InsufficientStorage' => [
                507,
                ServiceException::class,
                'The request could not be processed because the account does not have enough storage '
                . 'space (e.g. contacts, offers & projects or storage space).',
            ],
        ];
    }

    /**
     * Tests processing of error responses.
     *
     * @dataProvider errorResponseDataProvider
     * @test
     *
     * @param int    $expectedStatusCode     The expected status code
     * @param string $expectedExceptionClass The expected exception class thrown by this error
     * @param string $expectedErrorMessage   The expected exception message thrown
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function errorResponse(
        int $expectedStatusCode,
        string $expectedExceptionClass,
        string $expectedErrorMessage
    ): void {
        // Create mock
        $serviceFactoryMock = $this->getServiceFactoryMock(
            '',
            $expectedStatusCode
        );

        $this->expectException($expectedExceptionClass);
        $this->expectExceptionMessage($expectedErrorMessage);
        $this->expectExceptionCode($expectedStatusCode);

        // Create a dummy request (only used to trigger the response handling)
        $request = new Index();

        $serviceFactoryMock
            ->api()
            ->people()
            ->index($request);
    }

    /**
     * Tests if "people"-method returns the right configured people API instance.
     *
     * @test
     */
    public function people(): void
    {
        $peopleApi = $this
            ->getServiceFactoryMock()
            ->api()
            ->people();

        self::assertWebserviceUrl(
            'https://www.example.org/people',
            $peopleApi
        );
    }

    /**
     * Tests if "tags"-method returns the right configured people API instance.
     *
     * @test
     */
    public function tags(): void
    {
        $tagsApi = $this
            ->getServiceFactoryMock()
            ->api()
            ->tags();

        self::assertWebserviceUrl(
            'https://www.example.org/tags',
            $tagsApi
        );
    }

    /**
     * Tests if "protocols"-method returns the right configured people API instance.
     *
     * @test
     */
    public function protocols(): void
    {
        $tagsApi = $this
            ->getServiceFactoryMock()
            ->api()
            ->protocols();

        self::assertWebserviceUrl(
            'https://www.example.org/protocols',
            $tagsApi
        );
    }

    /**
     * Tests if "customFieldsTypes"-method returns the right configured people API instance.
     *
     * @test
     */
    public function customFieldsTypes(): void
    {
        $tagsApi = $this
            ->getServiceFactoryMock()
            ->api()
            ->customFieldsTypes();

        self::assertWebserviceUrl(
            'https://www.example.org/custom_fields_types',
            $tagsApi
        );
    }
}
