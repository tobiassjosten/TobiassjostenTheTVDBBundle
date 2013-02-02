<?php

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
    }
}
