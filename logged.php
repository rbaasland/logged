<?php

namespace Logged;

class Logged
{
    private $log_file = "logged.log";

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
        $this->writeData($log, $this->writeHeading($line, $file));
        $this->writeData($log, $content);
        $this->writeData($log, $this->writeFooter());
        $this->closeLoggedFile($log);
    }

    private function openLoggedFile()
    {
        return fopen($this->log_file, "a");
    }

    private function closeLoggedFile($file)
    {
        fclose($file);
    }

    private function writeData($log, $content) {
        if (is_array($content)) {
            $content = $this->prepareArrayOutput($content);
        } else{
            $content .= PHP_EOL;
        }
        fwrite($log, $content);
    }

    private function writeHeading($line, $file) {
        $date = new \DateTime();
        $date_output = $date->format('d-m-Y h:i:s a');
        $heading = "";
        $heading .= "====================================================================================================\n";
        $heading .= "Line " . $line . " on " . $file . " at " . $date_output . "\n";
        $heading .= "====================================================================================================\n";
        return $heading;
    }

    private function writeFooter() {
        $footer = "\n--------------------------------------------------\n\n";
        return $footer;
    }    

    public function clearLoggedFile() {
        $log = fopen($this->log_file, 'w' );
        fclose($log);
    }

    private function prepareArrayOutput($content) {
        ob_start();
        print_r($content);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}
