<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Api\Actions;

use Netresearch\Sdk\CentralStation\Collection\ProtocolsCollection;
use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Model\Protocols;
use Netresearch\Sdk\CentralStation\Model\Protocols\Protocol;
use Netresearch\Sdk\CentralStation\Request\Protocols\Index;
use Netresearch\Sdk\CentralStation\Test\Provider\Protocols\IndexProvider;
use Netresearch\Sdk\CentralStation\Test\Provider\Protocols\ShowProvider;
use Netresearch\Sdk\CentralStation\Test\TestCase;

/**
 * Class ProtocolsTest
 *
 * Tests the mapping of the JSON response to the proper models.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class ProtocolsTest extends TestCase
{
    /**
     * Returns an instance of the protocols API endpoint.
     *
     * @param string   $responseJsonFile
     * @param int|null $protocolId
     *
     * @return \Netresearch\Sdk\CentralStation\Api\Actions\Protocols
     */
    private function getProtocolsApi(
        string $responseJsonFile = '',
        int $protocolId = null
    ): \Netresearch\Sdk\CentralStation\Api\Actions\Protocols {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        return $serviceFactoryMock
            ->api()
            ->protocols($protocolId);
    }

    /**
     * @return string[][]
     */
    public function indexResponseDataProvider(): array
    {
        return [
            'Response' => [
                IndexProvider::indexResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "index" method.
     *
     * @dataProvider indexResponseDataProvider
     * @test
     *
     * @param string $responseJsonFile
     */
    public function index(string $responseJsonFile): void
    {
        $protocolsApi = $this->getProtocolsApi($responseJsonFile);
        $result  = $protocolsApi->index(new Index());

        self::assertWebserviceUrl('https://www.example.org/protocols', $protocolsApi);
        self::assertHttpMethod('GET', $protocolsApi);
        self::assertHttpHeaders($protocolsApi);
        self::assertInstanceOf(ProtocolsCollection::class, $result);
        self::assertContainsOnlyInstancesOf(Protocols::class, $result);

        foreach ($result as $protocols) {
            self::assertInstanceOf(Protocols::class, $protocols);
            self::assertInstanceOf(Protocols\Protocol::class, $protocols->protocolObjectNote);
        }

        $this->assertFirstProtocol($result[0]->protocolObjectNote);
        $this->assertSecondProtocol($result[1]->protocolObjectNote);
    }

    /**
     * Asserts that the data of the given protocol matches the expected values.
     *
     * @param Protocol $protocol
     *
     * @return void
     */
    private function assertFirstProtocol(Protocol $protocol)
    {
        self::assertSame(36085763, $protocol->id);
        self::assertSame(87444, $protocol->accountId);
        self::assertSame(0, $protocol->attachmentsCount);
        self::assertSame(0, $protocol->commentsCount);
        self::assertIsArray($protocol->comments);
        self::assertContainsOnlyInstancesOf(Protocols\Comment::class, $protocol->comments);
        self::assertSame([26125010], $protocol->personIds);
        self::assertSame([1799973197], $protocol->companyIds);
        self::assertFalse($protocol->confidential);
        self::assertSame('Interview Text 2015 - 1', $protocol->name);
        self::assertSame('Interview Text 2015 - 2', $protocol->content);
        self::assertSame(Constants::PROTOCOL_FORMAT_PLAINTEXT, $protocol->format);
        self::assertSame(Constants::PROTOCOL_BADGE_OTHER, $protocol->badge);
        self::assertSame('ProtocolObjectNote', $protocol->type);
        self::assertSame(150959, $protocol->userId);
        self::assertSame('24.01.2022', $protocol->createdAt->format('d.m.Y'));
        self::assertSame('24.01.2022 10:10:31', $protocol->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Asserts that the data of the given protocol matches the expected values.
     *
     * @param Protocol $protocol
     *
     * @return void
     */
    private function assertSecondProtocol(Protocol $protocol)
    {
        self::assertSame(36085781, $protocol->id);
        self::assertSame(87444, $protocol->accountId);
        self::assertSame(0, $protocol->attachmentsCount);
        self::assertSame(0, $protocol->commentsCount);
        self::assertIsArray($protocol->comments);
        self::assertContainsOnlyInstancesOf(Protocols\Comment::class, $protocol->comments);
        self::assertSame([26125043], $protocol->personIds);
        self::assertSame([1799973221], $protocol->companyIds);
        self::assertFalse($protocol->confidential);
        self::assertSame('Investoren-Interview - 1', $protocol->name);
        self::assertSame('Investoren-Interview - 2', $protocol->content);
        self::assertSame(Constants::PROTOCOL_FORMAT_PLAINTEXT, $protocol->format);
        self::assertSame(Constants::PROTOCOL_BADGE_OTHER, $protocol->badge);
        self::assertSame('ProtocolObjectNote', $protocol->type);
        self::assertSame(150959, $protocol->userId);
        self::assertSame('24.01.2022', $protocol->createdAt->format('d.m.Y'));
        self::assertSame('24.01.2022 10:10:38', $protocol->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * @return string[][]
     */
    public function showResponseDataProvider(): array
    {
        return [
            'Response' => [
                ShowProvider::showResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "show" method.
     *
     * @dataProvider showResponseDataProvider
     * @test
     *
     * @param string $responseJsonFile
     */
    public function show(string $responseJsonFile): void
    {
        $protocolsApi = $this->getProtocolsApi($responseJsonFile, 123456);
        $result  = $protocolsApi->show();

        self::assertWebserviceUrl('https://www.example.org/protocols/123456', $protocolsApi);
        self::assertHttpMethod('GET', $protocolsApi);
        self::assertHttpHeaders($protocolsApi);
        self::assertInstanceOf(Protocols\Protocol::class, $result->protocolObjectNote);

        $this->assertThirdProtocol($result->protocolObjectNote);
    }

    /**
     * Asserts that the data of the given protocol matches the expected values.
     *
     * @param Protocol $protocol
     *
     * @return void
     */
    private function assertThirdProtocol(Protocol $protocol)
    {
        self::assertSame(43342275, $protocol->id);
        self::assertSame(87444, $protocol->accountId);
        self::assertSame(1, $protocol->attachmentsCount);
        self::assertSame(0, $protocol->commentsCount);
        self::assertIsArray($protocol->comments);
        self::assertContainsOnlyInstancesOf(Protocols\Comment::class, $protocol->comments);
        self::assertSame([30016185], $protocol->personIds);
        self::assertSame([], $protocol->companyIds);
        self::assertFalse($protocol->confidential);
        self::assertSame('Testdatei', $protocol->name);
        self::assertSame('Testdatei', $protocol->content);
        self::assertSame(Constants::PROTOCOL_FORMAT_MARKDOWN, $protocol->format);
        self::assertSame(Constants::PROTOCOL_BADGE_OTHER, $protocol->badge);
        self::assertSame('ProtocolObjectNote', $protocol->type);
        self::assertSame(158291, $protocol->userId);
        self::assertSame('08.12.2022', $protocol->createdAt->format('d.m.Y'));
        self::assertSame('08.12.2022 15:31:09', $protocol->updatedAt->format('d.m.Y H:i:s'));
    }
}
