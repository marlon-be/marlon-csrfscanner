<?php
namespace Scanner\Rule;

use Scanner\Entity\Form;

/**
 * Test if a form has a hidden token field
 */
class HasTokenFieldRule implements Rule
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