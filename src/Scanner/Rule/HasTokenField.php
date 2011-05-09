<?php
namespace Scanner\Rule;

use Symfony\Component\DomCrawler\Form;

/**
 * Test if a form has a hidden token field
 * @codeCoverageIgnore (Covered by Acceptance\MinisiteTest)
 */
class HasTokenField extends AbstractRule
{
	public function isValid(Form $form)
	{
		return $form->has('token');
	}

	public function getMessage()
	{
		return "No 'token' input field found";
	}

}