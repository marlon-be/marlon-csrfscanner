<?php


namespace Scanner\Console;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected function configure()
    {
	        $this
	        ->setName('test')
	        ->setDescription('Run a proof of concept.')
	        //->setDefinition()
	        ->setHelp("Just some stuff to get going");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$foo = $this->getHelper('foo');

		$output->writeln('<info>Foobar.</info>');

    }
}
