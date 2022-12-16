<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Test\Request\People\Addresses;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\Address;
use Netresearch\Sdk\CentralStation\Request\People\Addresses\Update;
use PHPUnit\Framework\TestCase;

/**
 * Unit test class for the "update" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class UpdateTest extends TestCase
{
    /**
     * Tests creating a valid serialized request structure.
     *
     * @test
     */
    public function jsonSerialize(): void
    {
        $address = new Address();
        $address
            ->setStreet('Mustergasse 2')
            ->setZip('98765')
            ->setCity('Musterhausen')
            ->setStateCode(null)
            ->setCountryCode('AT')
            ->setPrimary(false)
            ->setType(Constants::ADDRESS_TYPE_WORK);

        $request = new Update();
        $request->setAddress($address);

        self::assertSame(
            [
                'addr' => [
                    'street'       => 'Mustergasse 2',
                    'zip'          => '98765',
                    'city'         => 'Musterhausen',
                    'state_code'   => null,
                    'country_code' => 'AT',
                    'atype'        => 'work',
                    'primary'      => false,
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
