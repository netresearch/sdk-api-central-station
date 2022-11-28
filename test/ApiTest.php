<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test;

use Netresearch\Sdk\CentralStation\Api\Actions\People;

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
     * Tests if "people"-method returns the right configured people API instance.
     *
     * @test
     */
    public function people(): void
    {
        $serviceFactoryMock = $this->getServiceFactoryMock();

        $peopleApi = $serviceFactoryMock
            ->api()
            ->people();

        self::assertWebserviceUrl(
            'https://www.example.org/people',
            $peopleApi
        );
    }
}
