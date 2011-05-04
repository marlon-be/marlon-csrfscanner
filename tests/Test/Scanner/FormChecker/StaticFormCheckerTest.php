<?php
namespace Test\Scanner;
use Test\Scanner\TestCase;

require_once __DIR__.'/../TestCase.php';

class StaticFormCheckerTest extends TestCase
{
	/** @test */
	public function FormWithHiddenTokenFieldIsValid()
	{
		var_dump(__METHOD__.' in '.__FILE__.' @ '.__LINE__, $this->getProfile()); die;
	}

}