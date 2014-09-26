<?php
	require_once('header.php');
	require_once(INC_DIR.DS.'nav.php');

	echo '<h4>Things that need to be done:</h4>'.NL;

	// Doesn't work on Windows 
	//exec('grep -nr --binary-files=without-match TODO .', $lines);
	
	$todos = get_todos();
	
	echo '<table border="1">'.NL;
	echo '<tr><th>File</th><th>Line #</th><th>Comment (first line)</th>'.NL;
	foreach (array_keys($todos) as $file) {	
		if (empty($todos[$file]) or $file == __FILE__) continue;
		foreach (array_keys($todos[$file]) as $line_num) {
			$comment = $todos[$file][$line_num];
		
		
		//$lines = $todos[$file];
		//$parts = explode(':', $line, 3);
		//$file = substr($parts[0], 2);
		//$line_num = $parts[1];
		//$comment = $parts[2];
		
		// skip this file and skip index.php (has link to this file)
		

			echo '<tr><td>'.$file.'</td><td>'.$line_num.'</td><td>'.$comment.'</td></tr>'.NL;
		}
	}
	echo '</table>'.NL;
	
	function get_todos() {
		$matches = array();
		$todos = array();
		find_files($matches, APP_ROOT, null, 'php');
		foreach ($matches as $m) {
			$todos[$m] = preg_grep('/TODO/', file($m));
		}
		return $todos;
	}
