<?php
namespace Scanner\Rule;

use Symfony\Component\DomCrawler\Form;
use Symfony\Component\BrowserKit\Client;

interface Rule
{
	function setClient(Client $client);

	function isValid(Form $form);

	function getMessage();
}