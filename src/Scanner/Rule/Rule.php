<?php
namespace Scanner\Rule;

use Scanner\Entity\Form;

interface Rule
{
	function isValid(Form $form);

	function getMessage();
}