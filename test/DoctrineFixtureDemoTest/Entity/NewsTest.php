<?php

namespace Erostophia\unit\DoctrineFixtureDemo\Entity;

use DoctrineFixtureDemo\Entity\News;

final class NewsTest extends \PHPUnit_Framework_TestCase
{
    private $news;

    protected function setUp()
    {
        $this->news = new News();
    }

    public function testGetId()
    {
        $this->news->getId();
    }

    public function testSetGetTitle()
    {
        $this->news->setTitle('bar');
        $this->assertEquals('bar', $this->news->getTitle());
    }

    public function testSetGetContent()
    {
        $this->news->setContent('BarBazBat');
        $this->assertEquals('BarBazBat', $this->news->getContent());
    }
}
