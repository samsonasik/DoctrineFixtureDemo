<?php

namespace DoctrineFixtureDemotest;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\SchemaTool;

final class FixtureManager
{
    /**
     * Get EntityManager
     */
    public static function getEntityManager()
    {
        $paths = [dirname(__DIR__).'/src/DoctrineFixtureDemo/Entity'];
        $isDevMode = true;

        // the connection configuration
        $connectionParams = array(
            'driver'   => 'pdo_mysql',
            'user'     => 'root',
            'password' => '',
            'dbname'   => 'foobar-test',
        );

        $config = Setup::createConfiguration($isDevMode);
        $driver = new AnnotationDriver(new AnnotationReader(), $paths);

        AnnotationRegistry::registerLoader('class_exists');
        $config->setMetadataDriverImpl($driver);

        $entityManager = EntityManager::create($connectionParams, $config);

        return $entityManager;
    }

    /**
     * Get SchemaTool
     */
    public static function getSchemaTool()
    {
        $schemaTool = new SchemaTool(static::getEntityManager());

        return $schemaTool;
    }

    /**
     * Drop tables
     */
    public static function start()
    {
        static::getSchemaTool()
             ->dropSchema(static::getEntityManager()
                            ->getMetadataFactory()
                            ->getAllMetadata());
    }

    /**
     * Create tables
     */
    public static function getFixtureExecutor()
    {
        static::getSchemaTool()
             ->createSchema(static::getEntityManager()
                              ->getMetadataFactory()
                              ->getAllMetadata());

        return new ORMExecutor(
            static::getEntityManager(),
            new ORMPurger(static::getEntityManager())
        );
    }
}
