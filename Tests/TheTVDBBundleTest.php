<?php

/*
 * This file is part of the TheTVDBBundle package.
 *
 * (c) Tobias Sjösten <tobias.sjosten@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tobiassjosten\TheTVDBBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tobiassjosten\TheTVDBBundle\DependencyInjection\TobiassjostenTheTVDBExtension;
use Tobiassjosten\TheTVDBBundle\TobiassjostenTheTVDBBundle;

/**
 * TheTVDBBundle Test Suite.
 */
class TheTVDBBundleTest extends WebTestCase
{
    /**
     * Test without an API key parameter.
     *
     * @expectedException InvalidArgumentException
     */
    public function testMissingAPIKey()
    {
        $this->getTheTVDB();
    }

    /**
     * Test the service instantiation.
     */
    public function testInstance()
    {
        $this->assertInstanceOf(
            'FPN\TheTVDB\Api',
            $this->getTheTVDB('ABC123')
        );
    }

    /**
     * Test that our API key is properly used.
     */
    public function testAPIKey()
    {
        $this->assertEquals(
            'http://www.thetvdb.com/api/ABC123/',
            $this->getTheTVDB('ABC123')->getBaseUrlWithKey()
        );
    }

    /**
     * Build a container with our extension.
     *
     * @param string $apiKey Asdf
     *
     * @return FPN\TheTVDB\Api
     */
    public function getTheTVDB($apiKey = null)
    {
        $container = new ContainerBuilder();

        if ($apiKey) {
            $container->setParameter('thetvdb_api_key', $apiKey);
        }

        $extension = new TobiassjostenTheTVDBExtension();
        $extension->load(array(array()), $container);

        $bundle = new TobiassjostenTheTVDBBundle();
        $bundle->build($container);

        $container->compile();

        return $container->get('thetvdb');
    }
}
