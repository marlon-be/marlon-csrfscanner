<?php
namespace Scanner\Rule;

use Symfony\Component\DomCrawler\Form;

/**
 * Test if modifying the token results in a 403 response
 */
class ModifyingTokenCauses403 extends AbstractRule
{
	private $message = '';
	public function isValid(Form $form)
	{
		if($form->has('token'))
		{
			$values = $form->getValues();
			$values['token'] = 'modified by csrf scanner';
			$form->setValues($values);
			$this->client->submit($form);
			$status = $this->client->getResponse()->getStatus();
			if(403 == $status) {
				return true;
			}
			$this->message = "403 response expected, but got a $status";
		} else {
			$this->message = "No 'token' input field found";
		}
		return false;
	}

	public function getMessage()
	{
		return $this->message;
	}

}