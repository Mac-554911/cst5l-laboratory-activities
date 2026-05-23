<?php
class Student {
public $id_number;
public $name;
public $year_level;
public $course;
public function __construct($id_number, $name, $year_level, $course) {
$this->id_number = $id_number;
$this->name = $name;
$this->year_level = $year_level;
$this->course = $course;
}
}
$student1 = new Student("2023-0001", "Cottontails Bunny", "1st Year", "BSCA");
$student2 = new Student("2023-0002", "Robowan Robot", "1st Year", "BSCA");
$student3 = new Student("2023-0003", "My Sweet Piano Sheep", "1st Year", "BSCA");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Students</title>
</head>
<body>
<table border="1">
<tr>
<th>ID Number</th>
<th>Full Name</th>
<th>Year Level</th>
<th>Course</th>
</tr>
<tr>
<td><?php echo $student1->id_number; ?></td>
<td><?php echo $student1->name; ?></td>
<td><?php echo $student1->year_level; ?></td>
<td><?php echo $student1->course; ?></td>
</tr>
<tr>
<td><?php echo $student2->id_number; ?></td>
<td><?php echo $student2->name; ?></td>
<td><?php echo $student2->year_level; ?></td>
<td><?php echo $student2->course; ?></td>
</tr>
<tr>
<td><?php echo $student3->id_number; ?></td>
<td><?php echo $student3->name; ?></td>
<td><?php echo $student3->year_level; ?></td>
<td><?php echo $student3->course; ?></td>
</tr>
</table>
</body>
</html>