<?php

namespace DoctrineFixtureDemo\DataFixture;

use DoctrineFixtureDemo\Entity\News;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

class NewsLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $news = new News();
        $news->setTitle('bar');
        $news->setContent('BarBazBat');

        $news2 = new News();
        $news2->setTitle('bar2');
        $news2->setContent('BarBazBat2');

        $manager->persist($news);
        $manager->persist($news2);
        $manager->flush();
    }
}
