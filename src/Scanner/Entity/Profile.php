<?php
namespace Scanner\Entity;

use Scanner\Specification\NotSpecification;
use Scanner\Specification\IsAMailtoLink;
use Scanner\Tools\Spider;
use Scanner\Rule\Rule;
use Scanner\Collection\RulesCollection;
use Scanner\Collection\DomainsCollection;
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

	/** @var DomainsCollection */
	private $domainWhitelist;

	/** @var Closure */
	private $prescript;

	/** @var PagesCollection */
	private $pageBlacklist;

	public function __construct(Client $client)
	{
		$this->client = $client;
		$this->rules = new RulesCollection;
		$this->startpages = new PagesCollection;
		$this->pageBlacklist = new PagesCollection;
		$this->domainWhitelist = new DomainsCollection;
	}

	public function loadFile($filename)
	{
		require $filename;
	}

	/**
	 * Set a script to be executed before scanning (eg a login script)
	 */
	public function setPreScript(\Closure $prescript)
	{
		$this->prescript = $prescript;
	}

	public function executePreScript()
	{
		if($script = $this->prescript) {
			$script($this->client);
		}
	}

	public function addRules(array $rules)
	{
		foreach($rules as $rule)
		{
			$rule->setClient($this->client);
			$this->rules->add($rule);
		}
	}

	public function addStartPages(array $uris)
	{
		foreach($uris as $uri)
		{
			$page = new Page($uri);
			$this->domainWhitelist->add($page->getDomain());
			$page->setClient($this->client);
			$this->startpages->add($page);
		}
	}

	public function blacklist(array $uris = array())
	{
		foreach($uris as $uri)	{
			$this->pageBlacklist->add(new Page($uri));
		}
	}

	/** @return PagesCollection All spidered pages */
	public function spider()
	{
		$todo = clone $this->startpages;
		$done = new PagesCollection;
		$isAMailtoLink = new IsAMailtoLink;

		while(count($todo))
		{
			$current = $todo->pop();
			if(!$done->contains($current))
			{
				foreach($current->findLinkedPages() as $found)
				{
					if(
						!$done->contains($found)
						&& !$this->pageBlacklist->contains($found)
						&& $this->domainWhitelist->contains($found->getDomain())
						&& $isAMailtoLink->not_()->isSatisfiedBy($found)
					) {
						$todo->add($found);
					}
				}
			}
			$done->add($current);
		}

		return $done;
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