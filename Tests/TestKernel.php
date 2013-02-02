<?php

/*
 * This file is part of the TheTVDBBundle package.
 *
 * (c) Tobias Sjösten <tobias.sjosten@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class TestKernel extends Kernel
{
    public function registerBundles()
    {
        return array(
            new Tobiassjosten\TheTVDBBundle\TobiassjostenTheTVDBBundle(),
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/test_kernel_config.yml');
    }
}
