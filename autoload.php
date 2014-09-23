<?php
/** 
* This is called when you try to create a new instance of an object
* and PHP doesn't know what it is. For this to work as intended,
* all classes should be in the library directory.
*/
function __autoload($class_name) {
	$matches = array();
	find_files($matches, FRAMEWORK_LIBS, $class_name, 'php', 1);    
	find_files($matches, LIB_DIR, $class_name, 'php', 1);
	foreach ($matches as $m) {
		require_once($m);
	}        
}

/** 
 * $matches - an array containing the full file paths of all matches.
 * $directory - The full path of the directory to search.
 * Neither $filename or $extension include the dot between them. 
 * Omitted $filename or $extension matches everything.
 * Omitted $limit (or a limit of 0) means unlimited.
 */
function find_files(&$matches, $directory, $filename=null, $extension=null, $limit=null,
		$case_sensitive=true, $subdirs=true) {
	// File system objects
	$fsos = scandir($directory);
	foreach ($fsos as $fso) {
		$fso_full = $directory . DS . $fso;    
		$parts = pathinfo($fso_full);            
		if (is_file($fso_full)
				&& (empty($filename)
					|| ($case_sensitive && $filename == $parts['filename'])
					|| (!$case_sensitive && strcasecmp($filename, $parts['filename'])))
				&& (empty($extension)
					|| ($case_sensitive && $extension == $parts['extension'])
					|| (!$case_sensitive && strcasecmp($extension, $parts['extension'])))) {                  
			$matches[] = $fso_full;
			if ($limit > 0 && count($matches) >= $limit) return;
		}            
		else if (is_dir($fso_full) && $subdirs && $fso != '.' && $fso != '..') {
			find_files($matches, $fso_full, $filename, $extension, $limit, $case_sensitive, $subdirs);
		}
	}
}