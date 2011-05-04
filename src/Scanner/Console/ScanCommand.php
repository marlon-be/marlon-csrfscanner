<?php
namespace Scanner\Console;

use Scanner\Collection\RulesCollection;

use Scanner\Rule\HiddenTokenFieldRule;

use Scanner\Entity\Page;

use Scanner\Collection\PageCollection;

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
		$indent = '    ';

		//$foo = $this->getHelper('foo');

		$profile = new Profile;
		$profile->loadFile(getcwd().DIRECTORY_SEPARATOR.$input->getArgument('profile'));

		$rules = new RulesCollection(array(
			new HiddenTokenFieldRule(),
		));

		foreach($profile->getPages() as $page)
		{
			$output->writeLn('<info>'.$page->getUri().'</info>');
			foreach($page->getForms() as $form)
			{
				$output->writeLn($indent.$form->getName());

				foreach($rules as $rule)
				{
					if(!$rule->isValid($form)) {
						$output->writeLn($indent.$indent."<error>".$rule->getMessage()."</error>");
					}

				}
			}
			$output->writeLn('');
		}

		$output->writeln('<info>Done.</info>');
	}
}
