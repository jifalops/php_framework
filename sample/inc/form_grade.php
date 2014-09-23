<h3>New Grade</h3>
<form method='post'>
<input name='table' value='grade' type='hidden' />
<input name='submitted' value='true' type='hidden' />
<input name='student_number' type='text' value='<?php echo $result['student_number']; ?>' />
    Student Number (numbers only)<br />
<input name='section_id' type='text' value='<?php echo $result['section_id']; ?>' />
    Section ID (numbers only)<br />
<input name='letter_grade' type='text' value='<?php echo $result['letter_grade']; ?>' />
    Letter Grade<br />
<input name='numeric_grade' type='text' value='<?php echo $result['numeric_grade']; ?>' />
    Numeric Grade (numbers only)<br />
<input type='submit' value='Submit' />
</form>