<?php
/**
 *
 * @return void
 */

namespace Logged;

/**
 *
 * @return void
 */

class Logged
{
    /**
     * @var string $_logFile        Default file name for the general log file
     */

    private $_logFile = "logged.log";

    /**
     * @var string $_queryFile        Default file name for the query log file
     */

    private $_queryFile = "query.log";

    /**
     * Change the default log file
     *
     * The default file is saved in the root of the project called logged.log.
     * You can change the default log file name and location.
     *
     * @param string $logFile the new name and extension of the basic logged file.
     *
     * @return void
     */

    public function setLogFile($logFile)
    {
        $this->logFile = $logFile;
    }

    /**
     *
     * @return void
     */

    public function getLogfile()
    {
        return $this->logFile;
    }

    /**
     *
     * @return void
     */

    public function logQuery($line, $file, $query) 
    {
        $log = $this->_openQueryFile();
        $this->writeData($log, $this->_writeHeading($line, $file, 'query'));
        $this->writeData($log, $query);
        $this->writeData($log, $this->_writeFooter());
        $this->closeLoggedFile($log);
    }

    /**
     *
     * @return void
     */

    public function logDataFile($line, $file, $content)
    {
        $log = $this->_openLoggedFile();
        $this->writeData($log, $this->_writeHeading($line, $file));
        $this->writeData($log, $content);
        $this->writeData($log, $this->_writeFooter());
        $this->closeLoggedFile($log);
    }

    /**
     *
     * @return void
     */
    private function _openLoggedFile()
    {
        return fopen($this->logFile, "a");
    }

    /**
     *
     * @return void
     */
    private function _openQueryFile()
    {
        return fopen($this->queryFile, "a");
    }

    /**
     *
     * @return void
     */
    private function _closeLoggedFile($file)
    {
        fclose($file);
    }

    /**
     *
     * @return void
     */
    private function _writeData($log, $content) 
    {
        if (is_array($content)) {
            $content = $this->prepareArrayOutput($content);
        } else {
            $content .= PHP_EOL;
        }
        fwrite($log, $content);
    }

    /**
     *
     * @return void
     */
    private function _writeHeading($line, $file, $type = '') 
    {
        $date = new \DateTime();
        $date_output = $date->format('d-m-Y h:i:s a');
        $heading = "";
        $heading .= "****************************************************************************************************\n";
        if (!empty($type)) {
            $header .= strtoupper($type) . "\n";
        }
        $heading .= "Line " . $line . " on " . $file . " at " . $date_output . "\n";
        $heading .= "****************************************************************************************************\n";
        return $heading;
    }

    /**
     *
     * @return void
     */
    private function _writeFooter() 
    {
        $footer = "\n\n";
        return $footer;
    }    

    /**
     *
     * @return void
     */
    public function clearLoggedFile() 
    {
        $log = fopen($this->logFile, 'w');
        fclose($log);
    }

    /**
     *
     * @return void
     */
    private function _prepareArrayOutput($content) 
    {
        ob_start();
        print_r($content);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}
