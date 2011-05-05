<?php
$this->addStartpages(array(
	Config::MINISITE,
));

$this->addRules(array(
	new Scanner\Rule\HiddenTokenFieldRule,
));