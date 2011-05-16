<?php
namespace Scanner\Console;

use Scanner\Collection\FormsCollection;

use Goutte\Client;
use Scanner\Entity\Profile;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @codeCoverageIgnore (Covered by Acceptance\MinisiteTest)
 */
class ScanCommand extends Command
{
	const EXIT_SUCCESS = 0;
	const EXIT_FAIL = 1;

	const LEAF = '|_ ';
	const INDENT = '   ';

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

	private function resolvePath($path)
	{
		if(in_array(substr($path, 0, 1), array('/', '\\'))) {
			return $path;
		} else {
			return getcwd().DIRECTORY_SEPARATOR.$path;
		}
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeLn('Patience...');

		$starttime = time();
		$client = new Client;
		$violations = 0;
		$testedForms = new FormsCollection;

		$profile = new Profile($client);
		$profile->loadFile($this->resolvePath($input->getArgument('profile')));
		$profile->executePreScript();
		$pages = $profile->spider();

		foreach($pages as $page)
		{
			$output->writeLn('<info>'.$page->getUri().'</info>');
			foreach($page->getForms() as $form)
			{
				$output->writeLn(self::INDENT.self::LEAF.$form->getHtml());
				if($testedForms->contains($form)) {
					$output->writeLn(self::INDENT.self::INDENT.self::LEAF.'Already tested');
					continue;
				}
				foreach($profile->getRules() as $rule)
				{
					if(!$rule->isValid($form))
					{
						$output->writeLn(self::INDENT.self::INDENT.self::LEAF."<error>".$rule->getMessage()."</error>");
						++$violations;
					}

				}
				$testedForms->add($form);
			}
			$output->writeLn('');
		}

		$output->writeLn(sprintf('Duration: %s seconds', time() - $starttime));
		$output->writeLn(sprintf('Found %s unique forms on %s pages', count($testedForms), count($pages)));

		if($violations) {
			$output->writeln("<error>$violations violations found.</error>");
			return self::EXIT_FAIL;
		} else {
			$output->writeln('<info>Done.</info>');
			return self::EXIT_SUCCESS;
		}
	}
}
