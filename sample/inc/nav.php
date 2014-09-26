<table width='100%'><tr><td>

<a href='index.php'>Home</a> |
<a href='logs.php'>Logs</a> |
<a href='search.php'>View Database</a> |
<a href='todo.php'>TODO</a>

</td><td align='right'>

<form action='search.php' method='get'>
	<input type='text' name='q' value='<?php echo htmlspecialchars($_GET['q']); ?>' />
	<input type='submit' value='Search' />
</form>

</td></tr></table>
<hr />