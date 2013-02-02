<?php

/*
 * This file is part of the TheTVDBBundle package.
 *
 * (c) Tobias Sjösten <tobias.sjosten@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Tobiassjosten\TheTVDBBundle\Command\TheTVDBSearchCommand;

class TheTVDBSearchCommandTest extends WebTestCase
{
    public function testMatch()
    {
        $output = $this->execute(true);

        $this->assertEquals(
            'Smallville (72218)'.PHP_EOL
            .'- Smallville is an american tv serie.'.PHP_EOL,
            $output
        );
    }

    public function testNoMatch()
    {
        $output = $this->execute();

        $this->assertEquals('No such show could be found'.PHP_EOL, $output);
    }

    private function execute($mockResponse = false)
    {
        $kernel = $this->createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->add(new TheTVDBSearchCommand());

        if ($mockResponse) {
            $kernel
                ->getContainer()
                ->get('fpn_thetvdb.http_client')
                ->mockRequestBody('searchTvShow');
        }

        $command = $application->find('thetvdb:search');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        return $commandTester->getDisplay();
    }
}
