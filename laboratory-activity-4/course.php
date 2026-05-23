<?php
class Course {
public $course_code;
public $course_name;
public $course_instructor;
public function __construct($course_code, $course_name, $course_instructor) {
$this->course_code = $course_code;
$this->course_name = $course_name;
$this->course_instructor = $course_instructor;
}
}
$course1 = new Course("PAHF4", "Physical Education 1", "Mr. Pochacco");
$course2 = new Course("HM101", "Intoduction to Cooking", "Mr. Pompompurin");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Courses</title>
</head>
<body>
<table border="1">
<tr>
<th>Course Code</th>
<th>Course Name</th>
<th>Course Instructor</th>
</tr>
<tr>
<td><?php echo $course1->course_code; ?></td>
<td><?php echo $course1->course_name; ?></td>
<td><?php echo $course1->course_instructor; ?></td>
</tr>
<tr>
<td><?php echo $course2->course_code; ?></td>
<td><?php echo $course2->course_name; ?></td>
<td><?php echo $course2->course_instructor; ?></td>
</tr>
</table>
</body>
</html>