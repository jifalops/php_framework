<h3>New Course</h3>
<form method='post'>
<input name='table' value='course' type='hidden' />
<input name='submitted' value='true' type='hidden' />
<input name='course_number' type='text' value='<?php echo $result['course_number']; ?>' />
    Course Number (numbers only)<br />
<input name='course_name' type='text' value='<?php echo $result['course_name']; ?>' />
    Course Name<br />
<input name='description' type='text' value='<?php echo $result['description']; ?>' />
    Description<br />
<input name='credit_hours' type='text' value='<?php echo $result['credit_hours']; ?>' />
    Credit Hours (numbers only)<br />
<input name='level' type='text' value='<?php echo $result['level']; ?>' />
    Level (numbers only)<br />
<input name='offering_dept' type='text' value='<?php echo $result['offering_dept']; ?>' />
    Offering Department (numbers only)<br />
<input type='submit' value='Submit' />
</form>