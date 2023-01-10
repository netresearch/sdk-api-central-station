<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Api\Actions\People;

use Netresearch\Sdk\CentralStation\Api\Actions\People;
use Netresearch\Sdk\CentralStation\Collection\ProtocolsCollection;
use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\Protocols;
use Netresearch\Sdk\CentralStation\Model\Protocols\Protocol;
use Netresearch\Sdk\CentralStation\Request\People\Protocols\Create;
use Netresearch\Sdk\CentralStation\Request\People\Protocols\Update;
use Netresearch\Sdk\CentralStation\Request\Protocols\Index;
use Netresearch\Sdk\CentralStation\Test\Provider\People\ProtocolsProvider;
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
     * Returns an instance of the people API endpoint.
     *
     * @param string   $responseJsonFile
     * @param int|null $personId
     *
     * @return People
     * @throws ServiceException
     */
    private function getPeopleApi(
        string $responseJsonFile = '',
        int $personId = null
    ): People {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        return $serviceFactoryMock
            ->api()
            ->people($personId);
    }

    /**
     * @return string[][]
     */
    public function indexResponseDataProvider(): array
    {
        return [
            'Response' => [
                ProtocolsProvider::indexResponseSuccess(),
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
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(string $responseJsonFile): void
    {
        $peopleApi = $this->getPeopleApi($responseJsonFile, 123456);
        $result    = $peopleApi->protocols()->index(new Index());

        self::assertWebserviceUrl('https://www.example.org/people/123456/protocols', $peopleApi);
        self::assertHttpMethod('GET', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertInstanceOf(ProtocolsCollection::class, $result);
        self::assertContainsOnlyInstancesOf(Protocols::class, $result);

        foreach ($result as $protocols) {
            self::assertInstanceOf(Protocols::class, $protocols);
            self::assertInstanceOf(Protocols\Protocol::class, $protocols->protocolObjectNote);
        }

        $this->assertFirstProtocol($result->offsetGet(0)->protocolObjectNote);
        $this->assertSecondProtocol($result->offsetGet(1)->protocolObjectNote);
    }

    /**
     * Asserts that the data of the given protocol matches the expected values.
     *
     * @param Protocol $protocol
     *
     * @return void
     */
    private function assertFirstProtocol(Protocol $protocol): void
    {
        self::assertSame(43342215, $protocol->id);
        self::assertSame(87444, $protocol->accountId);
        self::assertSame(0, $protocol->attachmentsCount);
        self::assertSame(1, $protocol->commentsCount);
        self::assertIsArray($protocol->comments);
        self::assertContainsOnlyInstancesOf(Protocols\Comment::class, $protocol->comments);
        self::assertSame([30016185], $protocol->personIds);
        self::assertSame([], $protocol->companyIds);
        self::assertTrue($protocol->confidential);
        self::assertSame('E-Mail', $protocol->name);
        self::assertSame('E-Mail', $protocol->content);
        self::assertSame(Constants::PROTOCOL_FORMAT_MARKDOWN, $protocol->format);
        self::assertSame(Constants::PROTOCOL_BADGE_EMAIL, $protocol->badge);
        self::assertSame('ProtocolObjectNote', $protocol->type);
        self::assertSame(158291, $protocol->userId);
        self::assertSame('08.12.2022', $protocol->createdAt->format('d.m.Y'));
        self::assertSame('08.12.2022 15:26:03', $protocol->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Asserts that the data of the given protocol matches the expected values.
     *
     * @param Protocol $protocol
     *
     * @return void
     */
    private function assertSecondProtocol(Protocol $protocol): void
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

    /**
     * @return string[][]
     */
    public function showResponseDataProvider(): array
    {
        return [
            'Response' => [
                ProtocolsProvider::showResponseSuccess(),
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
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(string $responseJsonFile): void
    {
        $peopleApi = $this->getPeopleApi($responseJsonFile, 123456);
        $result  = $peopleApi->protocols()->show();

        self::assertWebserviceUrl('https://www.example.org/people/123456/protocols', $peopleApi);
        self::assertHttpMethod('GET', $peopleApi);
        self::assertHttpHeaders($peopleApi);
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
    private function assertThirdProtocol(Protocol $protocol): void
    {
        self::assertSame(42483967, $protocol->id);
        self::assertSame(87444, $protocol->accountId);
        self::assertSame(1, $protocol->attachmentsCount);
        self::assertSame(0, $protocol->commentsCount);
        self::assertIsArray($protocol->comments);
        self::assertContainsOnlyInstancesOf(Protocols\Comment::class, $protocol->comments);
        self::assertSame([27325165], $protocol->personIds);
        self::assertSame([], $protocol->companyIds);
        self::assertFalse($protocol->confidential);
        self::assertSame('ISB Call 9', $protocol->name);
        self::assertSame('ISB Call 9', $protocol->content);
        self::assertSame(Constants::PROTOCOL_FORMAT_PLAINTEXT, $protocol->format);
        self::assertSame(Constants::PROTOCOL_BADGE_NOTE, $protocol->badge);
        self::assertSame('ProtocolObjectNote', $protocol->type);
        self::assertSame(117760, $protocol->userId);
        self::assertSame('03.11.2022', $protocol->createdAt->format('d.m.Y'));
        self::assertSame('08.12.2022 12:40:07', $protocol->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * @return string[][]
     */
    public function createResponseDataProvider(): array
    {
        return [
            'Response' => [
                ProtocolsProvider::createResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "create" method.
     *
     * @dataProvider createResponseDataProvider
     * @test
     *
     * @param string $responseJsonFile
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function create(string $responseJsonFile): void
    {
        $peopleApi = $this->getPeopleApi($responseJsonFile, 123456);

        $result = $peopleApi
            ->protocols()
            ->create(
                new Create(
                    new \Netresearch\Sdk\CentralStation\Request\Protocol()
                )
            );

        self::assertWebserviceUrl('https://www.example.org/people/123456/protocols', $peopleApi);
        self::assertHttpMethod('POST', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertInstanceOf(Protocols\Protocol::class, $result->protocolObjectNote);

        $this->assertCreatedProtocol($result->protocolObjectNote);
    }

    /**
     * Asserts that the data of the given protocol matches the expected values.
     *
     * @param Protocol $protocol
     *
     * @return void
     */
    private function assertCreatedProtocol(Protocol $protocol): void
    {
        self::assertSame(43388190, $protocol->id);
        self::assertSame(87444, $protocol->accountId);
        self::assertSame(0, $protocol->attachmentsCount);
        self::assertSame(0, $protocol->commentsCount);
        self::assertIsArray($protocol->comments);
        self::assertContainsOnlyInstancesOf(Protocols\Comment::class, $protocol->comments);
        self::assertSame([], $protocol->personIds);
        self::assertSame([], $protocol->companyIds);
        self::assertTrue($protocol->confidential);
        self::assertSame('Test-Protokoll-Notiz', $protocol->name);
        self::assertSame('Inhalt meiner Test-Protokoll-Notiz', $protocol->content);
        self::assertSame(Constants::PROTOCOL_FORMAT_MARKDOWN, $protocol->format);
        self::assertSame(Constants::PROTOCOL_BADGE_EMAIL, $protocol->badge);
        self::assertSame('ProtocolObjectNote', $protocol->type);
        self::assertSame(117760, $protocol->userId);
        self::assertSame('12.12.2022', $protocol->createdAt->format('d.m.Y'));
        self::assertSame('12.12.2022 11:24:31', $protocol->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Tests "update" method.
     *
     * @test
     */
    public function update(): void
    {
        $peopleApi = $this->getPeopleApi('', 123456);
        $result  = $peopleApi->protocols(987654)->update(new Update());

        self::assertWebserviceUrl('https://www.example.org/people/123456/protocols/987654', $peopleApi);
        self::assertHttpMethod('PUT', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertTrue($result);
    }

    /**
     * Tests "delete" method.
     *
     * @test
     */
    public function delete(): void
    {
        $peopleApi = $this->getPeopleApi('', 123456);
        $result  = $peopleApi->protocols(987654)->delete();

        self::assertWebserviceUrl('https://www.example.org/people/123456/protocols/987654', $peopleApi);
        self::assertHttpMethod('DELETE', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertTrue($result);
    }
}
