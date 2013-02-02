<?php

/*
 * This file is part of the TheTVDBBundle package.
 *
 * (c) Tobias Sjösten <tobias@tobiassjosten.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tobiassjosten\TheTVDBBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This loads and manages our bundle configuration.
 */
class TobiassjostenTheTVDBExtension extends Extension
{
    /**
     * Loads the extension configuration.
     *
     * @param array            $configs   An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if ($container->hasParameter('thetvdb_mirror_url')) {
            $container->getDefinition('fpn_thetvdb.api')
                ->addArgument($container->getParameter('thetvdb_mirror_url'));
        }

        $container->setAlias('thetvdb', 'fpn_thetvdb.api');
    }
}
