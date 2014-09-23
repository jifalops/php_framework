<h3>New Department</h3>
<form method='post'>
<input name='table' value='department' type='hidden' />
<input name='submitted' value='true' type='hidden' />
<input name='dept_code' type='text' value='<?php echo $result['dept_code']; ?>' />
    Department Code (numbers only)<br />
<input name='dept_name' type='text' value='<?php echo $result['dept_name']; ?>' />
    Department Name<br />
<input name='office_number' type='text' value='<?php echo $result['office_number']; ?>' />
    Office Number (numbers only)<br />
<input name='office_phone' type='text' value='<?php echo $result['office_phone']; ?>' />
    Office Phone (numbers only)<br />
<input name='college' type='text' value='<?php echo $result['college']; ?>' />
    College<br />
<input type='submit' value='Submit' />
</form>