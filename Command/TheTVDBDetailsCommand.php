<?php

/*
 * This file is part of the TheTVDBBundle package.
 *
 * (c) Tobias Sjösten <tobias@tobiassjosten.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tobiassjosten\TheTVDBBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command to show the details of a given series.
 */
class TheTVDBDetailsCommand extends ContainerAwareCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('thetvdb:details')
            ->setDescription('Show detailed information for a TV series')
            ->addArgument('id', InputArgument::REQUIRED, 'Series id');
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $show = $this
            ->getContainer()
            ->get('thetvdb')
            ->getTvShow($input->getArgument('id'));

        if (!count($shows)) {
            $output->writeln('<error>No such show could be found</error>');
        } else {
            foreach ($shows as $show) {
                $output->writeln(sprintf(
                    '%d %d %s',
                    $show->getId(),
                    $show->getFirstAired()->format('Y'),
                    $show->getName()
                ));
            }
        }
    }
}
