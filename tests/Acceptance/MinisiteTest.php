<?php
namespace Acceptance;

require_once 'PHPUnit/Framework/TestCase.php';

class MinisiteTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 * @covers Scanner\Console\ScanCommand
	 * @covers Scanner\Rule\AbstractRule<extended>
	 */
	public function ScansMinisite()
	{
		$csrfscan = realpath(__DIR__.'/../../bin/csrfscan');
		$profile = realpath(__DIR__.'/../minisite.profile');
		$command = "$csrfscan scan $profile";

		$output = array();
		$return = null;
		exec($command, $output, $return);
		$output = implode(PHP_EOL, $output);
		$this->assertEquals(1, $return, "The command's exit code should be 1 (ScanCommand::EXIT_ERROR)");

$expected =  <<<END
Patience...
http://localhost:8888/csrfscan-minisite/

http://localhost:8888/csrfscan-minisite/tokennotcheckedform.php
   |_ <form name="tokennotcheckedform">
      |_ 403 response expected, but got a 200

http://localhost:8888/csrfscan-minisite/notokenform.php
   |_ <form name="notokenform">
      |_ No 'token' input field found
      |_ No 'token' input field found

http://localhost:8888/csrfscan-minisite/goodform.php
   |_ <form name="goodform">
   |_ <form name="bogusform">
      |_ No 'token' input field found
      |_ No 'token' input field found

http://localhost:8888/csrfscan-minisite/nestedpage.php

Duration: 0 seconds
5 violations found.
END;

		$this->assertEquals($expected, $output);
	}
}