<?php
namespace Scanner\Entity;
use Scanner\Tools\Spider;
use Scanner\Rule\Rule;
use Scanner\Collection\RulesCollection;
use Scanner\Collection\PagesCollection;
use Goutte\Client;

/**
 * A profile encapsulates a site and the rules it should be tested for.
 *
 */
class Profile
{
	/** @var RulesCollection */
	private $rules;

	/** @var PagesCollection */
	private $startpages;

	/** @var Client */
	private $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
		$this->rules = new RulesCollection;
		$this->startpages = new PagesCollection;
	}

	public function loadFile($filename)
	{
		require $filename;
	}

	public function addRules(array $rules)
	{
		foreach($rules as $rule) {
			$this->rules->add($rule);
		}
	}

	public function addStartPages(array $uris)
	{
		foreach($uris as $uri)
		{
			$page = new Page($uri);
			$page->setClient($this->client);
			$this->startpages->add($page);
		}
	}

	/** @return PagesCollection All spidered pages */
	public function spider()
	{
		$spider = new Spider;
		return $spider->spider($this->startpages);
	}

	public function getRules()
	{
	    return $this->rules;
	}

	public function getStartPages()
	{
	    return $this->startpages;
	}
}