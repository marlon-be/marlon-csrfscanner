<?php
namespace Test\Scanner\Entity;

use Scanner\Entity\Form;
use Symfony\Component\DomCrawler\Crawler;
use DOMDocument;
use Test\Scanner\TestCase;

require_once __DIR__.'/../TestCase.php';

class FormTest extends TestCase
{
	/** @var Form */
	protected $form;

	public function setUp()
	{
		$document = new DOMDocument;
		$document->loadHTML('
			<form name="myform" method="POST">
				<input type="text" name="email" />
				<input type="hidden" name="token" value="randomtokenxyz" />
				<input type="submit" name="submit"/>
			</form>
		');
		$crawler = new Crawler($document, 'http://example.com');
		$this->form = new Form($crawler->selectButton('submit')->form());
	}

	/** @test */
	public function ChecksIfInputFieldExists()
	{
		$this->assertTrue($this->form->has('token'));
		$this->assertFalse($this->form->has('nonexistantfield'));
	}

	/** @test */
	public function HasValidState()
	{
		$this->assertTrue($this->form->isValid());
		$this->form->setInvalid();
		$this->assertFalse($this->form->isValid());
		$this->form->setValid();
		$this->assertTrue($this->form->isValid());
	}
}
