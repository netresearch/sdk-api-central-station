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
use Netresearch\Sdk\CentralStation\Collection\TagsCollection;
use Netresearch\Sdk\CentralStation\Model\Tags;
use Netresearch\Sdk\CentralStation\Model\Tags\Tag;
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
     */
    private function getPeopleApi(
        string $responseJsonFile = '',
        int $personId = null,
        int $statusCode = 200
    ): People {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile, $statusCode);

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
     */
    public function index(string $responseJsonFile): void
    {
        $peopleApi = $this->getPeopleApi($responseJsonFile, 123456);
        $result  = $peopleApi->tags()->index(new Index());

        self::assertWebserviceUrl('https://www.example.org/people/123456/tags', $peopleApi);
        self::assertHttpMethod('GET', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertInstanceOf(TagsCollection::class, $result);
        self::assertContainsOnlyInstancesOf(Tags::class, $result);

        foreach ($result as $tags) {
            self::assertInstanceOf(Tags::class, $tags);
            self::assertInstanceOf(Tags\Tag::class, $tags->tag);
        }

        $this->assertFirstTag($result[0]->tag);
        $this->assertSecondTag($result[1]->tag);
    }

    /**
     * Asserts that the data of the given tag matches the expected values.
     *
     * @param Tag $tag
     *
     * @return void
     */
    private function assertFirstTag(Tag $tag)
    {
        self::assertSame(45067258, $tag->id);
        self::assertSame(47143, $tag->accountId);
        self::assertSame(8439487, $tag->attachableId);
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
    private function assertSecondTag(Tag $tag)
    {
        self::assertSame(45067261, $tag->id);
        self::assertSame(47143, $tag->accountId);
        self::assertSame(8439487, $tag->attachableId);
        self::assertSame('Company', $tag->attachableType);
        self::assertSame('Branche|Mess- / Verfahrenstechnik / Sensorik', $tag->name);
        self::assertSame('13.10.2019', $tag->createdAt->format('d.m.Y'));
        self::assertSame('05.11.2020 10:44:22', $tag->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * @return string[][]
     */
    public function showResponseDataProvider(): array
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
     */
    public function show(string $responseJsonFile): void
    {
        $peopleApi = $this->getPeopleApi($responseJsonFile, 123456);
        $result  = $peopleApi->tags()->show();

        self::assertWebserviceUrl('https://www.example.org/people/123456/tags', $peopleApi);
        self::assertHttpMethod('GET', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertInstanceOf(Tags\Tag::class, $result);

        $this->assertFirstTag($result);
    }

    /**
     * @return string[][]
     */
    public function createResponseDataProvider(): array
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
        self::assertInstanceOf(Tags\Tag::class, $result);

        $this->assertCreatedTag($result);
    }

    /**
     * Asserts that the data of the given tag matches the expected values.
     *
     * @param Tag $tag
     *
     * @return void
     */
    private function assertCreatedTag(Tag $tag)
    {
        self::assertSame(45067258, $tag->id);
        self::assertSame(47143, $tag->accountId);
        self::assertSame(8439487, $tag->attachableId);
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
        $peopleApi = $this->getPeopleApi('', 123456, 204);
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
        $peopleApi = $this->getPeopleApi('', 123456, 204);
        $result  = $peopleApi->tags(987654)->delete();

        self::assertWebserviceUrl('https://www.example.org/people/123456/tags/987654', $peopleApi);
        self::assertHttpMethod('DELETE', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertTrue($result);
    }
}
