<?php
// TODO comment on how to use this
class Log {
    // Columns must be escaped first.
    // Rows must be unescaped first.
    const COL_SEPARATOR = '<>';
    const ROW_SEPARATOR = PHP_EOL;       // Other row separators not supported.
    const COL_ESCAPE_FROM = '>';
    const COL_ESCAPE_TO = '|>';
    const ROW_ESCAPE_FROM = PHP_EOL;
    const ROW_ESCAPE_TO = '<PHP_EOL>';

    const LEVEL_NONE     = 0;
    const LEVEL_SUPPRESS = 1;
    const LEVEL_ASSERT   = 2;
    const LEVEL_ERROR    = 3;
    const LEVEL_WARNING  = 4;
    const LEVEL_INFO     = 5;
    const LEVEL_DEBUG    = 6;
    const LEVEL_VERBOSE  = 7;   
    const MAX_LEVEL      = self::LEVEL_VERBOSE;

    private $file;
    private $handle;
    private $level;

    function __construct($file) {
        $this->level = self::LEVEL_INFO;
        if(!empty($file)) $this->open($file);
    }

    private function open($file) {
        $this->file = $file;
        $exists = file_exists($file);
        $this->handle = fopen($file, 'a');
        if (!$exists) {
            fwrite($this->handle, implode(self::COL_SEPARATOR,
                array('TIME', 'LEVEL', 'TAG', 'MESSAGE')) . self::ROW_SEPARATOR);
        }
        return $this->handle;
    }
    
    function is_loggable($level) {
        return $this->level >= $level;
    }
    
    private function log($level, $msg, $tag='', $time='') {
        if (!$this->is_loggable($level)) return FALSE;
        if (empty($tag)) $tag = $_SERVER['PHP_SELF'];
        if (empty($time)) $time = date('Y-m-d H:i:s O');
        $tag = $this->escape($tag);
        $msg = $this->escape($msg);
        return fwrite($this->handle, implode(self::COL_SEPARATOR, 
            array($time, $this->get_level_string($level), $tag, $msg)) . self::ROW_SEPARATOR);
    }

    private function escape($text) {
        $text = str_replace(self::COL_ESCAPE_FROM, self::COL_ESCAPE_TO, $text);
        return str_replace(self::ROW_ESCAPE_FROM, self::ROW_ESCAPE_TO, $text);
    }

    private function unescape($text) {
        $text = str_replace(self::ROW_ESCAPE_TO, self::ROW_ESCAPE_FROM, $text);
        return str_replace(self::COL_ESCAPE_TO, self::COL_ESCAPE_FROM, $text);
    }
    
    function a($msg, $tag=null) { 
        return $this->log(self::LEVEL_ASSERT, $msg, $tag); 
    }
    
    function e($msg, $tag=null) { 
        return $this->log(self::LEVEL_ERROR, $msg, $tag); 
    }
    
    function w($msg, $tag=null) { 
        return $this->log(self::LEVEL_WARNING, $msg, $tag); 
    }
    
    function i($msg, $tag=null) { 
        return $this->log(self::LEVEL_INFO, $msg, $tag); 
    }

    function d($msg, $tag=null) { 
        return $this->log(self::LEVEL_DEBUG, $msg, $tag); 
    }
    
    function v($msg, $tag=null) { 
        return $this->log(self::LEVEL_VERBOSE, $msg, $tag); 
    }

    function get_level() {
        return $this->level;
    }
    
    function get_level_string($level) {
        switch ($level) {
            case self::LEVEL_NONE:     return self::LEVEL_NONE.'-NONE';
            case self::LEVEL_SUPPRESS: return self::LEVEL_SUPPRESS.'-SUPPRESS';
            case self::LEVEL_ASSERT:   return self::LEVEL_ASSERT.'-ASSERT';
            case self::LEVEL_ERROR:    return self::LEVEL_ERROR.'-ERROR';
            case self::LEVEL_WARNING:  return self::LEVEL_WARNING.'-WARNING';
            case self::LEVEL_INFO:     return self::LEVEL_INFO.'-INFO';
            case self::LEVEL_DEBUG:    return self::LEVEL_DEBUG.'-DEBUG';
            case self::LEVEL_VERBOSE:  return self::LEVEL_VERBOSE.'-VERBOSE';            
        }
    }

    function set_level($level) {
        $level = (int) $level;
        if ($level > self::MAX_LEVEL) $level = self::MAX_LEVEL;
        if ($level < self::LEVEL_NONE) $level = self::LEVEL_NONE;
        else $this->level = $level;
    }

    function get_filename() {
        return $this->file;
    }

    function to_array() {
        // Read the log file into an array with each line as an element and
        // trim the newlines so they're not part of the array elements.
        $lines = file($this->file, FILE_IGNORE_NEWLINES | FILE_SKIP_EMPTY_LINES);

        $records = array();
        foreach ($lines as $line) {
            $fields = explode(self::COL_SEPARATOR, $line);
            $records[] = array(
                'time'  => $fields[0],
                'level' => $fields[1],
                'tag'   => $fields[2],
                'msg'   => $fields[3]
            );
        }
        return $records;
    }   

    private function close() {
        return fclose($this->handle);
    }   

    function __destruct() {
        $this->close();
    }
    
    function to_html($level, $css_class='Log.php', $css_id='') {
        $html = '';
        $records = $this->to_array();
        $html .= "<table id='$css_id' class='$css_class'>".PHP_EOL;	
        $header = true;
        foreach ($records as $record) {
            if ($header) {
                $html .= '<tr>'.PHP_EOL;
                foreach ($record as $field) {
                    $html .= '<th>'.$field.'</th>'.PHP_EOL;
                }
                $html .= '</tr>'.PHP_EOL;
                $header = false;
            }
            else {
                $r_level = substr($record['level'], 0, 1);
                if ($r_level > $level) continue;
                $html .= '<tr>'.PHP_EOL;
                foreach ($record as $field) {
                    $html .= '<td>'.$field.'</td>'.PHP_EOL;
                }
                $html .= '</tr>'.PHP_EOL;
            }
        }
        $html .= '</table>'.PHP_EOL;
        return $html;
    }
}
