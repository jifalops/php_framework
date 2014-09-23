<form>
	<select name='table'>
	<?php foreach ($tables as $t) echo "<option>$t</option>".NL; ?>
	</select>
	<input type='submit' value='Go' />
</form>