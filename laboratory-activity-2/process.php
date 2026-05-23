<?php
// PROCESS.PHP
// This file receives the form data from index.php, sanitizes and validates it, then displays the result.
// RETRIEVE AND SANITIZE INPUTS
// We use htmlspecialchars() to convert special characters into safe HTML entities so attackers cannot inject scripts.
// trim() removes any accidental whitespace the user may have typed at the start or end of a field.
$student_id = htmlspecialchars(trim($_POST['student_id'] ?? ''));
$full_name = htmlspecialchars(trim($_POST['full_name'] ?? ''));
$email = htmlspecialchars(trim($_POST['email'] ?? ''));
$age = htmlspecialchars(trim($_POST['age'] ?? ''));
$course = htmlspecialchars(trim($_POST['course'] ?? ''));
$gender = htmlspecialchars(trim($_POST['gender'] ?? ''));
// A checkbox only sends a value when it is checked, so we use isset() to avoid an undefined index error.
$terms = isset($_POST['terms']) ? htmlspecialchars($_POST['terms']) : '';
// VALIDATE INPUTS
// We store all error messages in an array so we can display all of them together instead of stopping at the first one.
$errors = [];
// This checks whether the student ID field was left empty before submitting.
if (empty($student_id)) {
$errors[] = "Student ID is required.";
}
// This checks whether the full name field was left empty.
if (empty($full_name)) {
$errors[] = "Full Name is required.";
}
// EMAIL VALIDATION
// We first check if the field is empty, then use filter_var() with FILTER_VALIDATE_EMAIL to confirm the format is correct.
if (empty($email)) {
$errors[] = "Email address is required.";
} else {
// filter_var() returns false if the email does not follow a standard format like user@domain.com.
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$errors[] = "Please enter a valid email address.";
}
}
// AGE VALIDATION
// We check if the field is empty first, then verify that the value is a number within a realistic range.
if (empty($age)) {
$errors[] = "Age is required.";
} elseif (!is_numeric($age) || (int)$age < 1 || (int)$age > 100) {
// This prevents someone from entering a negative number, zero, or an unrealistically large age.
$errors[] = "Please enter a valid age (1–100).";
}
// This checks if the student selected a course from the dropdown menu.
if (empty($course)) {
$errors[] = "Please select a course.";
}
// This checks if the student picked one of the gender radio button options.
if (empty($gender)) {
$errors[] = "Please select a gender.";
}
// This checks whether the terms and conditions checkbox was ticked before the form was submitted.
if (empty($terms)) {
$errors[] = "You must agree to the Terms & Conditions.";
}
// CLASSIFY AGE USING IF STATEMENT
// We cast $age to an integer before comparing so we are working with a number and not a string value.
$age_classification = '';
if (!empty($age) && is_numeric($age)) {
// This compares the age to 18 to decide whether the student is considered a Minor or an Adult.
if ((int)$age < 18) {
$age_classification = "Minor";
} else {
$age_classification = "Adult";
}
}
// GET FULL COURSE NAME USING SWITCH STATEMENT
// Each case matches a course abbreviation and assigns the corresponding full program title to the variable.
$full_course_name = '';
switch ($course) {
case 'BSIT':
$full_course_name = "Bachelor of Science in Information Technology";
break;
case 'BSCS':
$full_course_name = "Bachelor of Science in Computer Science";

break;
case 'BSIS':
$full_course_name = "Bachelor of Science in Information Systems";
break;
default:
// This runs if the submitted course value does not match any of the three cases above.
$full_course_name = "Unknown Course";
break;
}
// CUSTOM FUNCTION — generateGreeting()
// This function accepts the student's name and age classification, then returns a personalized welcome message.
function generateGreeting($name, $classification) {
// We concatenate the two parameters into a single sentence that will be displayed on the results page.
return "Welcome, " . $name . "! You are registered as a " . $classification . " student.";
}
// CALL THE FUNCTION
// We only call generateGreeting() if both the name and age classification have values to avoid an incomplete message.
$greeting_message = '';
if (!empty($full_name) && !empty($age_classification)) {
$greeting_message = generateGreeting($full_name, $age_classification);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8"/>
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
 <title>Registration Result</title>
 <!-- BOOTSTRAP CSS -->
 <!-- This loads Bootstrap 5 from the CDN so we can use its layout and component classes in the output page. -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
 <!-- GOOGLE FONTS -->
 <!-- This imports the same fonts used in index.php so both pages look visually consistent. -->
 <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300
&display=swap" rel="stylesheet"/>
 <style>
/* CSS CUSTOM PROPERTIES */
/* These are the same color variables from index.php to keep both pages visually consistent. */
:root {
--ink: #0d0d0d;
--paper: #f5f2ec;
--accent: #c94b3f;
--accent-light: #f0e0de;
--success: #2d6a4f;
--success-light: #d8f3dc;
--muted: #7a7067;
--border: #d4cfc6;
--card-bg: #ffffff;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
/* BODY */
/* This sets the background, font, and padding so the results page matches the layout of index.php. */
body {
background-color: var(--paper);
font-family: 'DM Sans', sans-serif;
color: var(--ink);
min-height: 100vh;
padding: 40px 16px 60px;
}
/* BACKGROUND GRID */
/* This reuses the same pseudo-element grid pattern from index.php to keep the pages feeling connected. */
body::before {
content: '';
position: fixed;
inset: 0;
background-image:
linear-gradient(var(--border) 1px, transparent 1px),
linear-gradient(90deg, var(--border) 1px, transparent 1px);
background-size: 40px 40px;
opacity: 0.35;
pointer-events: none;
z-index: 0;
}
/* PAGE WRAPPER */
/* This centers the output content and limits its width so the layout stays clean on wide screens. */
.page-wrapper {

position: relative;
z-index: 1;
max-width: 700px;
margin: 0 auto;
}
/* PAGE HEADER */
/* This styles the top title area that changes depending on whether there are errors or a successful submission. */
.page-header {
margin-bottom: 32px;
padding-bottom: 22px;
border-bottom: 2px solid var(--ink);
}
.header-tag {
display: inline-block;
font-family: 'Syne', sans-serif;
font-size: 11px;
font-weight: 700;
letter-spacing: 0.18em;
text-transform: uppercase;
padding: 4px 10px;
border-radius: 2px;
margin-bottom: 14px;
}
/* TAG COLOR VARIANTS */
/* These two classes switch the tag between red for errors and green for a successful submission. */
.tag-error { color: var(--accent); background: var(--accent-light); }
.tag-success { color: var(--success); background: var(--success-light); }
.page-header h1 {
font-family: 'Syne', sans-serif;
font-weight: 800;
font-size: clamp(26px, 5vw, 38px);
line-height: 1.1;
letter-spacing: -0.02em;
}
/* ERROR CARD */
/* This is the red-bordered box that lists all the validation errors found in the submitted form. */
.error-card {
background: #fff;
border: 1.5px solid #e8c6c3;
border-left: 4px solid var(--accent);
border-radius: 6px;
padding: 22px 26px;
box-shadow: 4px 4px 0 var(--accent);
margin-bottom: 28px;
}
.error-card h5 {
font-family: 'Syne', sans-serif;
font-weight: 700;
font-size: 14px;
text-transform: uppercase;
letter-spacing: 0.08em;
color: var(--accent);
margin-bottom: 12px;
}
.error-card ul {
list-style: none;
padding: 0;
}
.error-card ul li {
font-size: 14px;
color: #7b2a22;
padding: 5px 0;
border-bottom: 1px solid #f0e0de;
display: flex;
align-items: center;
gap: 8px;
}
/* ERROR LIST BULLET */
/* This adds a small red X before each error message using a CSS pseudo-element instead of an image. */
.error-card ul li::before {
content: '✕';
font-size: 11px;
color: var(--accent);
font-weight: 700;
}
.error-card ul li:last-child { border-bottom: none; }

/* GREETING BANNER */
/* This is the green banner at the top of the success page that shows the personalized function output. */
.greeting-banner {
background: var(--success-light);
border: 1.5px solid #b7e4c7;
border-left: 4px solid var(--success);
border-radius: 6px;
padding: 16px 22px;
margin-bottom: 28px;
font-size: 15px;
font-weight: 500;
color: var(--success);
}
/* RESULT CARD */
/* This is the white card that organizes the submitted student data into labeled rows. */
.result-card {
background: var(--card-bg);
border: 1.5px solid var(--border);
border-radius: 6px;
padding: 32px 28px;
box-shadow: 4px 4px 0 var(--ink);
margin-bottom: 24px;
}
/* SECTION LABEL */
/* This reuses the same uppercase section label style from index.php to group the output fields. */
.section-label {
font-family: 'Syne', sans-serif;
font-size: 10px;
font-weight: 700;
letter-spacing: 0.16em;
text-transform: uppercase;
color: var(--muted);
margin-bottom: 16px;
padding-bottom: 8px;
border-bottom: 1px solid var(--border);
}
/* DATA ROW */
/* Each row uses flexbox to align the label on the left and the value on the right. */
.data-row {
display: flex;
justify-content: space-between;
align-items: flex-start;
padding: 11px 0;
border-bottom: 1px solid var(--border);
gap: 16px;
}
.data-row:last-child { border-bottom: none; }
/* DATA LABEL */
/* This is the small uppercase key on the left side of each data row. */
.data-label {
font-size: 12px;
font-weight: 600;
text-transform: uppercase;
letter-spacing: 0.08em;
color: var(--muted);
min-width: 130px;
padding-top: 2px;
}
/* DATA VALUE */
/* This is the right-aligned value that shows what the student submitted. */
.data-value {
font-size: 15px;
font-weight: 400;
color: var(--ink);
text-align: right;
flex: 1;
}
/* MINOR BADGE */
/* This is a yellow pill badge displayed next to the age when the student is classified as a Minor. */
.badge-minor {
display: inline-block;
background: #fff3cd;
color: #856404;
border: 1px solid #ffc107;
font-size: 12px;
font-weight: 700;
padding: 3px 10px;
border-radius: 20px;
font-family: 'Syne', sans-serif;
letter-spacing: 0.06em;

}
/* ADULT BADGE */
/* This is a green pill badge displayed next to the age when the student is classified as an Adult. */
.badge-adult {
display: inline-block;
background: var(--success-light);
color: var(--success);
border: 1px solid #b7e4c7;
font-size: 12px;
font-weight: 700;
padding: 3px 10px;
border-radius: 20px;
font-family: 'Syne', sans-serif;
letter-spacing: 0.06em;
}
/* TERMS BADGE */
/* This is a green badge used to confirm that the student agreed to the terms and conditions. */
.badge-terms {
display: inline-block;
background: var(--success-light);
color: var(--success);
border: 1px solid #b7e4c7;
font-size: 12px;
font-weight: 700;
padding: 3px 10px;
border-radius: 20px;
font-family: 'Syne', sans-serif;
letter-spacing: 0.06em;
}
.section-gap { margin-top: 26px; }
/* BACK BUTTON */
/* This styles the link that takes the user back to index.php to either fix errors or submit another entry. */
.btn-back {
display: inline-block;
background: transparent;
color: var(--ink);
font-family: 'Syne', sans-serif;
font-weight: 700;
font-size: 13px;
letter-spacing: 0.08em;
text-transform: uppercase;
border: 2px solid var(--ink);
border-radius: 4px;
padding: 10px 26px;
text-decoration: none;
transition: background 0.18s, color 0.18s, box-shadow 0.12s, transform 0.1s;
box-shadow: 3px 3px 0 var(--ink);
}
.btn-back:hover {
background: var(--ink);
color: var(--paper);
transform: translate(-1px, -1px);
box-shadow: 4px 4px 0 var(--accent);
}
/* MOBILE ADJUSTMENTS */
/* This stacks the label and value vertically on small screens so the text does not get too cramped. */
@media (max-width: 520px) {
.result-card { padding: 22px 16px; }
.data-row { flex-direction: column; gap: 4px; }
.data-value { text-align: left; }
}
 </style>
</head>
<body>
<div class="page-wrapper">
<?php if (!empty($errors)): ?>
 <!-- ERROR STATE -->
 <!-- This block only renders if the $errors array has at least one item, meaning validation failed. -->
 <div class="page-header">
<div class="header-tag tag-error">Submission Failed</div>
<h1>Please fix the<br>errors below.</h1>
 </div>
 <!-- ERROR LIST CARD -->
 <!-- This card loops through the $errors array and prints each message as a separate list item. -->
 <div class="error-card">
<h5>The following issues were found:</h5>
<ul>
<?php foreach ($errors as $error): ?>
<!-- This outputs each individual error message collected during the validation step above. -->
<li><?= $error ?></li>
<?php endforeach; ?>
</ul>
 </div>
 <!-- BACK LINK -->
 <!-- This link takes the user back to index.php so they can correct the fields that failed validation. -->
 <a href="index.php" class="btn-back">← Go Back &amp; Fix</a>
<?php else: ?>
 <!-- SUCCESS STATE -->
 <!-- This block only renders when there are no errors, meaning all fields passed validation. -->
 <div class="page-header">
<div class="header-tag tag-success">Registration Successful</div>
<h1>Student Record<br>Submitted</h1>
 </div>
 <!-- GREETING BANNER -->
 <!-- This displays the personalized message returned by the generateGreeting() function defined above. -->
 <div class="greeting-banner">
<?= $greeting_message ?>
 </div>
 <!-- STUDENT IDENTITY -->
 <!-- This card shows the personal details the student submitted in the first section of the form. -->
 <div class="result-card">
<div class="section-label">01 — Student Identity</div>
<div class="data-row">
<span class="data-label">Student ID</span>
<span class="data-value"><?= $student_id ?></span>
</div>
<div class="data-row">
<span class="data-label">Full Name</span>
<span class="data-value"><?= $full_name ?></span>
</div>
<div class="data-row">
<span class="data-label">Email Address</span>
<span class="data-value"><?= $email ?></span>
</div>
<div class="data-row">
<span class="data-label">Age</span>
<!-- This displays the submitted age number along with the Minor or Adult badge from the if statement. -->
<span class="data-value">
<?= $age ?> years old &nbsp;
<?php if ($age_classification === 'Minor'): ?>
<span class="badge-minor">Minor</span>
<?php else: ?>
<span class="badge-adult">Adult</span>
<?php endif; ?>
</span>
</div>
<div class="data-row">
<span class="data-label">Gender</span>
<span class="data-value"><?= $gender ?></span>
</div>
 </div>
 <!-- ACADEMIC INFORMATION -->
 <!-- This card shows the course and terms data, including the full course name resolved by the switch statement. -->
 <div class="result-card">
<div class="section-label">02 — Academic Information</div>
<div class="data-row">
<span class="data-label">Course Code</span>
<span class="data-value"><?= $course ?></span>
</div>
<div class="data-row">
<span class="data-label">Full Course Name</span>
<!-- This shows the full program title that was assigned by the switch statement in Step 4. -->
<span class="data-value"><?= $full_course_name ?></span>
</div>
<div class="data-row">
<span class="data-label">Terms Agreed</span>
<span class="data-value"><span class="badge-terms">✓ Agreed</span></span>
</div>
 </div>

 <!-- BACK LINK -->
 <!-- This link lets the user go back to index.php if they want to register another student. -->
 <a href="index.php" class="btn-back">← Submit Another</a>
<?php endif; ?>
</div><!-- /page-wrapper -->
<!-- BOOTSTRAP JS -->
<!-- This loads the Bootstrap JavaScript bundle so interactive components on this page function correctly. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>