<?php

namespace DoctrineFixtureDemoTest\Repository;

use DoctrineFixtureDemo\DataFixture\NewsLoad;
use DoctrineFixtureDemotest\FixtureManager;
use DoctrineFixtureDemo\Repository\NewsRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use PHPUnit_Framework_TestCase;

class NewsRepositoryTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->repository      = new NewsRepository(
            FixtureManager::getEntityManager(),
            new ClassMetadata('DoctrineFixtureDemo\Entity\News')
        );

        $this->fixtureExecutor = FixtureManager::getFixtureExecutor();
    }

    public function testGetLatestNews()
    {
        $this->fixtureExecutor->execute([new NewsLoad()]);
        $this->assertCount(1, $this->repository->getLatestNews(1));
        $this->assertInstanceOf('DoctrineFixtureDemo\Entity\News', $this->repository->getLatestNews(1)[0]);
    }
}
