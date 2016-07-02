<?php

namespace Logged;

class Logged
{
    private $log_file = "error.log";

    public function setLogFile($log_file)
    {
        $this->log_file = $log_file;
    }

    public function getLogfile()
    {
        return $this->log_file;
    }

    public function loggedLogFile()
    {
    }
}
