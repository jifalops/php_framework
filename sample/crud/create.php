<?php
	require_once('header.php');
	require_once(INC_DIR.DS.'nav.php');
	
	$table = htmlspecialchars($_POST['table']);
	$submitted = htmlspecialchars($_POST['submitted']);
	
    $tables = $db->get_tables();
?>
<div align='center'>
<h1>Create</h1>
<?php     
    if ($submitted == 'true') {
        $fields = $db->get_column_names($table);
        $sql = "INSERT INTO {$table} (";
        $first = TRUE;
        foreach ($fields as $field) {
            if (substr($field, -3) == '_id') continue;
            if ($first) { $sql .= $field; $first = FALSE; }
            else $sql .= ', ' . $field;
        }
        $sql .= ') VALUES (';
        $first = TRUE;
        foreach ($fields as $field) {
			$f = htmlspecialchars($_POST[$field]);
            if (substr($field, -3) == '_id') continue;
            if ($first) { $sql .= '\''.$f.'\''; $first = FALSE; }
            else $sql .= ', \'' . $f.'\'';
        }
        $sql .= ');';       
        
        $result = $db->query($sql);
        $errors = $db->get_errors();
        
        echo '<p>Request submitted! Result:</p>'.NL;
        
        if (!empty($errors)) {
            foreach ($errors as $e) {
                echo '<p>Error '.$e['errno'].': '.$e['error'].'</p>';
            }            
        }
        
        echo nl2br('<p>'.print_r($result, TRUE).'</p>');        
        
        echo '<p>Original query:</p>';
        echo nl2br($sql);
    } 
    elseif (array_search($_GET['table'], $tables) !== FALSE) {        
        echo '<table><tr><td>';
        require_once(INC_DIR.DS.'form_'.$_GET['table'].'.php');
        echo '</td></tr></table>';
    }    
    else { 
        echo '<p>What would you like to create?</p>'.NL;
        require_once(INC_DIR.DS.'form_table_chooser.php');
    } ?> 
</div>
