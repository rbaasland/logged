<?php
require "logged.php";

use PHPUnit\Framework\TestCase;

class LoggedTest extends TestCase
{
    public function testLogFile()
    {
        $logged = new \logged\logged();
        $logged->setLogFile('logged.log');
        $this->assertEquals('logged.log', $logged->getLogFile());
    }

    public function testQueryFile()
    {
        $logged = new \logged\logged();
        $logged->setQueryFile('query.log');
        $this->assertEquals('query.log', $logged->getQueryFile());
    }
}
