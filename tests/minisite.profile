<?php
$this->addStartpages(array(
	Config::MINISITE,
));

$this->addRules(array(
	new Scanner\Rule\HasTokenField,
	new Scanner\Rule\ModifyingTokenCauses403,
));

$this->setPreScript(function($client){
	$client->testvalue = 123;
});