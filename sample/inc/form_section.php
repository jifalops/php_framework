<h3>New Section</h3>
<form method='post'>
<input name='table' value='section' type='hidden' />
<input name='submitted' value='true' type='hidden' />
<input name='course_number' type='text' value='<?php echo $result['course_number']; ?>' />
    Course Number (numbers only)<br />
<input name='section_number' type='text' value='<?php echo $result['section_number']; ?>' />
    Section Number (numbers only)<br />
<input name='semester' type='text' value='<?php echo $result['semester']; ?>' />
    Semester (numbers only)<br />
<input name='year' type='text' value='<?php echo $result['year']; ?>' />
    Year (numbers only)<br />
<input name='instructor' type='text' value='<?php echo $result['instructor']; ?>' />
    Instructor<br />
<input type='submit' value='Submit' />
</form>