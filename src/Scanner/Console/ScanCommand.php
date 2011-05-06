<?php
namespace Scanner\Console;

use Goutte\Client;
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
		$client = new Client;
		$indent = '   ';
		$leaf = '|_ ';

		$profile = new Profile($client);
		$profile->loadFile(getcwd().DIRECTORY_SEPARATOR.$input->getArgument('profile'));

		foreach($profile->spider() as $page)
		{
			$output->writeLn('<info>'.$page->getUri().'</info>');
			foreach($page->getForms() as $form)
			{
				$name = $form->getFormNode()->getAttribute('name');
				$output->writeLn($indent.$leaf.sprintf('<form name="%s">', $name));
				foreach($profile->getRules() as $rule)
				{
					$rule->setClient($client);
					if(!$rule->isValid($form)) {
						$output->writeLn($indent.$indent.$leaf."<error>".$rule->getMessage()."</error>");
					}

				}
			}
			$output->writeLn('');
		}

		$output->writeln('<info>Done.</info>');
	}
}
