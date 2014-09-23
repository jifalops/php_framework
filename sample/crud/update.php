<?php
	require_once('header.php');
    require_once(INC_DIR.DS.'nav.php');    
    $tables = $db->get_tables();
	
	$table = htmlspecialchars($_POST['table']);
	$submitted = htmlspecialchars($_POST['submitted']);
?>
<div align='center'>
<h1>Update</h1>
<?php
    if ($submitted == 'true') {
        //echo nl2br(print_r($_POST, TRUE));
        $sql = 'UPDATE '.$table.' SET ';
        $first = TRUE;
        foreach (array_keys($_POST) as $field) {			
            if ($field == 'table' || $field == 'submitted') continue;
			$f = htmlspecialchars($_POST[$field]);
            elseif ($first) $sql .= $field.'=\''.$f.'\'';
            else $sql .= ','.$field.'=\''.$f.'\'';            
        }
        //where field=value
    }
	// TODO Security flaw!!
    elseif (array_search($_GET['table'], $tables) !== FALSE) {
        $sql = 'SELECT * FROM '.$_GET['table'].' WHERE ';
        $first = TRUE;
        foreach ($_GET['fields'] as $f) {
            if ($first) $sql .= $f.'=\''.$_GET[$f].'\'';
            else $sql .= ' AND '.$f.'=\''.$_GET[$f].'\'';
        }
        $result = $db->result_array($sql);
        echo '<table><tr><td align=\'left\'>';
        require_once(INC_DIR.DS.'form_'.$_GET['table'].'.php');
        echo '</td></tr></table>';
    }    
    else { 
        echo '<p>Define a record would you like to update.</p>'.NL;
        require_once(INC_DIR.DS.'form_row_chooser.php');
    }    
?>
</div>