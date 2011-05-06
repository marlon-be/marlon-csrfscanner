<?php
namespace Scanner\Rule;

use Symfony\Component\BrowserKit\Client;

abstract class AbstractRule implements Rule
{
	/** @var Client */
	protected $client;

	public function setClient(Client $client)
	{
		$this->client = $client;
	}
}