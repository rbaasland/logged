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

    public function logDataFile($line, $file, $content)
    {
        $log = $this->openLoggedFile();
        fwrite($log, $line);
        fwrite($log, $line);
        $this->closeLoggedFile($log);
    }

    private function openLoggedFile()
    {
        return fopen($this->log_file, "w");
    }

    private function closeLoggedFile($file)
    {
        fclose($file);
    }
}
