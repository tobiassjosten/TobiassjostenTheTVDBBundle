<?php

/*
 * This file is part of the TheTVDBBundle package.
 *
 * (c) Tobias Sjösten <tobias.sjosten@gmail.com>
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
 * Command to search for series.
 */
class TheTVDBSearchCommand extends ContainerAwareCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('thetvdb:search')
            ->setDescription('Search for a TV series')
            ->addArgument('name', InputArgument::OPTIONAL, 'Series name');
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $shows = $this
            ->getContainer()
            ->get('thetvdb')
            ->searchTvShow($input->getArgument('name'));

        if (!count($shows)) {
            $output->writeln('<error>No such show could be found</error>');
            return;
        }

        foreach ($shows as $show) {
            $output->writeln($show->getName().' ('.$show->getId().')');
            $output->writeln('- '.$show->getOverview());
        }
    }
}
