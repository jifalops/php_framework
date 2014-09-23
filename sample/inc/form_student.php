<h3>New Student</h3>
<form method='post'>
<input name='table' value='student' type='hidden' />
<input name='submitted' value='true' type='hidden' />
<input name='student_number' type='text' value='<?php echo $result['student_number']; ?>' />
    Student Number (numbers only)<br />
<input name='ssn' type='text' value='<?php echo $result['ssn']; ?>' />
    SSN (numbers only)<br />
<input name='first_name' type='text' value='<?php echo $result['first_name']; ?>' />
    First Name<br />
<input name='last_name' type='text' value='<?php echo $result['last_name']; ?>' />
    Last Name<br />
<input name='cur_address' type='text' value='<?php echo $result['cur_address']; ?>' />
    Current Address<br />
<input name='cur_city' type='text' value='<?php echo $result['cur_city']; ?>' />
    Current City<br />
<input name='cur_state' type='text' value='<?php echo $result['cur_state']; ?>' />
    Current State (abbrev.)<br />
<input name='cur_zip' type='text' value='<?php echo $result['cur_zip']; ?>' />
    Current Zip (numbers only)<br />
<input name='cur_phone' type='text' value='<?php echo $result['cur_phone']; ?>' />
    Current Phone (numbers only)<br />
<input name='perm_address' type='text' value='<?php echo $result['perm_address']; ?>' />
    Permanent Address<br />
<input name='perm_city' type='text' value='<?php echo $result['perm_city']; ?>' />
    Permanent City<br />
<input name='perm_state' type='text' value='<?php echo $result['perm_state']; ?>' />
    Permanent State (abbrev.)<br />
<input name='perm_zip' type='text' value='<?php echo $result['perm_zip']; ?>' />
    Permanent Zip (numbers only)<br />
<input name='perm_phone' type='text' value='<?php echo $result['perm_phone']; ?>' />
    Permanent Phone (numbers only)<br />
<input name='dob' type='text' value='<?php echo $result['dob']; ?>' />
    Birthday (YYYY-MM-DD)<br />
<input name='sex' type='text' value='<?php echo $result['sex']; ?>' />
    Sex (M or F)<br />
<input name='class' type='text' value='<?php echo $result['class']; ?>' />
    Class<br />
<input name='major_dept' type='text' value='<?php echo $result['major_dept']; ?>' />
    Major Department (code)<br />
<input name='minor_dept' type='text' value='<?php echo $result['minor_dept']; ?>' />
    Minor Department (code)<br />
<input name='program' type='text' value='<?php echo $result['program']; ?>' />
    Program<br />
<input type='submit' value='Submit' />
</form>