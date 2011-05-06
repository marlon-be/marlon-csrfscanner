<?php
$this->addStartpages(array(
	'http://localhost/minisite/',
));

$this->addRules(array(
	//new Scanner\Rule\HasTokenField,
	new Scanner\Rule\ModifyingTokenCauses403,
));