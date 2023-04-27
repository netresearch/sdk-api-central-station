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
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\Container\Collection\TagContainerCollection;
use Netresearch\Sdk\CentralStation\Model\Container\TagContainer;
use Netresearch\Sdk\CentralStation\Model\Tag;
use Netresearch\Sdk\CentralStation\Request\People\Tags\Create;
use Netresearch\Sdk\CentralStation\Request\People\Tags\Update;
use Netresearch\Sdk\CentralStation\Request\Tags\Index;
use Netresearch\Sdk\CentralStation\Test\Provider\People\TagsProvider;
use Netresearch\Sdk\CentralStation\Test\TestCase;

/**
 * Class TagsTest
 *
 * Tests the mapping of the JSON response to the proper models.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class TagsTest extends TestCase
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
    public static function indexResponseDataProvider(): array
    {
        return [
            'Response' => [
                TagsProvider::indexResponseSuccess(),
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
        $result  = $peopleApi->tags()->index(new Index());

        self::assertWebserviceUrl('https://www.example.org/people/123456/tags', $peopleApi);
        self::assertHttpMethod('GET', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertInstanceOf(TagContainerCollection::class, $result);
        self::assertContainsOnlyInstancesOf(TagContainer::class, $result);

        foreach ($result as $tags) {
            self::assertInstanceOf(TagContainer::class, $tags);
            self::assertInstanceOf(Tag::class, $tags->tag);
        }

        $this->assertFirstTag($result->offsetGet(0)->tag);
        $this->assertSecondTag($result->offsetGet(1)->tag);
    }

    /**
     * Asserts that the data of the given tag matches the expected values.
     *
     * @param Tag $tag
     *
     * @return void
     */
    private function assertFirstTag(Tag $tag): void
    {
        self::assertSame(45_067_258, $tag->id);
        self::assertSame(47143, $tag->accountId);
        self::assertSame(8_439_487, $tag->attachableId);
        self::assertSame('Company', $tag->attachableType);
        self::assertSame('Branche|Mobilität / Verkehr', $tag->name);
        self::assertSame('13.10.2019', $tag->createdAt->format('d.m.Y'));
        self::assertSame('05.11.2020 10:44:32', $tag->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Asserts that the data of the given tag matches the expected values.
     *
     * @param Tag $tag
     *
     * @return void
     */
    private function assertSecondTag(Tag $tag): void
    {
        self::assertSame(45_067_261, $tag->id);
        self::assertSame(47143, $tag->accountId);
        self::assertSame(8_439_487, $tag->attachableId);
        self::assertSame('Company', $tag->attachableType);
        self::assertSame('Branche|Mess- / Verfahrenstechnik / Sensorik', $tag->name);
        self::assertSame('13.10.2019', $tag->createdAt->format('d.m.Y'));
        self::assertSame('05.11.2020 10:44:22', $tag->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * @return string[][]
     */
    public static function showResponseDataProvider(): array
    {
        return [
            'Response' => [
                TagsProvider::showResponseSuccess(),
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
        $result  = $peopleApi->tags()->show();

        self::assertWebserviceUrl('https://www.example.org/people/123456/tags', $peopleApi);
        self::assertHttpMethod('GET', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertInstanceOf(Tag::class, $result);

        $this->assertFirstTag($result);
    }

    /**
     * @return string[][]
     */
    public static function createResponseDataProvider(): array
    {
        return [
            'Response' => [
                TagsProvider::createResponseSuccess(),
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
            ->tags()
            ->create(
                new Create(
                    new \Netresearch\Sdk\CentralStation\Request\Tag()
                )
            );

        self::assertWebserviceUrl('https://www.example.org/people/123456/tags', $peopleApi);
        self::assertHttpMethod('POST', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertInstanceOf(Tag::class, $result);

        $this->assertCreatedTag($result);
    }

    /**
     * Asserts that the data of the given tag matches the expected values.
     *
     * @param Tag $tag
     *
     * @return void
     */
    private function assertCreatedTag(Tag $tag): void
    {
        self::assertSame(45_067_258, $tag->id);
        self::assertSame(47143, $tag->accountId);
        self::assertSame(8_439_487, $tag->attachableId);
        self::assertSame('Company', $tag->attachableType);
        self::assertSame('Branche|Mobilität / Verkehr', $tag->name);
        self::assertSame('13.10.2019', $tag->createdAt->format('d.m.Y'));
        self::assertSame('05.11.2020 10:44:32', $tag->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Tests "update" method.
     *
     * @test
     */
    public function update(): void
    {
        $peopleApi = $this->getPeopleApi('', 123456);
        $result  = $peopleApi->tags(987654)->update(new Update());

        self::assertWebserviceUrl('https://www.example.org/people/123456/tags/987654', $peopleApi);
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
        $result  = $peopleApi->tags(987654)->delete();

        self::assertWebserviceUrl('https://www.example.org/people/123456/tags/987654', $peopleApi);
        self::assertHttpMethod('DELETE', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertTrue($result);
    }
}
