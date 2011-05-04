<?php
namespace Scanner\Rule;

use Scanner\Entity\Form;

/**
 * Test if a form has a hidden token field
 */
class HiddenTokenFieldRule implements Rule
{
	public function isValid(Form $form)
	{
		return count($form->filter("input[name='token']"));
	}

	public function getMessage()
	{
		return "No 'token' input field found";
	}

}