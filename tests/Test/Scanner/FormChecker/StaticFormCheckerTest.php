<?php
namespace Test\Scanner;

use Test\Scanner\TestCase;

require_once __DIR__.'/../TestCase.php';

class StaticFormCheckerTest extends TestCase
{
	/** @test */
	public function FormWithHiddenTokenFieldIsValid()
	{
		$client = new \Goutte\Client();
		$crawler = $client->request('GET', $this->getProfile()->getDomain().'/goodform.php');
		$form = $crawler->filter("form[name='goodform']");
		$tokenfields = $form->filter("input[name='tokenf']");
		$this->assertEquals(1, count($tokenfields));
	}

}