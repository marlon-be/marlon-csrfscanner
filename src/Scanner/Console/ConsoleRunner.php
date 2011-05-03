<?php

namespace Scanner\Console;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;

class ConsoleRunner
{
    static public function run(HelperSet $helperSet)
    {
        $cli = new Application('Csrf Scanner', '0.1');
        $cli->setCatchExceptions(true);
        $cli->setHelperSet($helperSet);
        self::addCommands($cli);
        $cli->run();
    }

    static public function addCommands(Application $cli)
    {
        $cli->addCommands(array(
            new \Scanner\Console\TestCommand,
        ));
    }
}