<?php
namespace Scanner\Console;

use Scanner\Entity\Profile;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScanCommand extends Command
{
	protected function configure()
	{
		$this
			->setName('scan')
			->setDescription('Run a proof of concept.')
			->setDefinition(
				array(
					new InputArgument('profile', InputArgument::REQUIRED, 'The profile of the site you want to test'),
				)
			)
			->setHelp("Scan a website for CSRF vulnerabilities");
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		//$foo = $this->getHelper('foo');

		$profile = new Profile;
		$profile->loadFile(getcwd().DIRECTORY_SEPARATOR.$input->getArgument('profile'));

		$output->writeln('<info>Done.</info>');
	}
}
