
Fit Page






<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
 <title>Student Registration Form</title>
 <!-- BOOTSTRAP CSS -->
 <!-- This loads the Bootstrap 5 stylesheet from a CDN so we can use its grid and component classes. -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
 <!-- GOOGLE FONTS -->
 <!-- This imports Syne and DM Sans to make the page look more polished and professional. -->
 <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300
&display=swap" rel="stylesheet"/>
 <style>
/* CSS CUSTOM PROPERTIES */
/* These variables store the color palette so we only need to update a color value in one place. */
:root {
--ink: #0d0d0d;
--paper: #f5f2ec;
--accent: #c94b3f;
--accent-light: #f0e0de;
--muted: #7a7067;
--border: #d4cfc6;
--card-bg: #ffffff;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
/* BODY */
/* This sets the background color, default font, and padding so the page has breathing room on all sides. */
body {
background-color: var(--paper);
font-family: 'DM Sans', sans-serif;
color: var(--ink);
min-height: 100vh;
padding: 40px 16px 60px;
}
/* BACKGROUND GRID */
/* This uses a pseudo-element to draw a subtle grid pattern behind the content without extra HTML tags. */
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
/* This centers the content block and limits its width so the form stays readable on wide screens. */
.page-wrapper {
position: relative;
z-index: 1;
max-width: 680px;
margin: 0 auto;
}
/* FORM HEADER */
/* This styles the section at the top that shows the page title and a short instruction. */
.form-header {
margin-bottom: 36px;
padding-bottom: 24px;
border-bottom: 2px solid var(--ink);
}
.header-tag {
display: inline-block;
font-family: 'Syne', sans-serif;
font-size: 11px;
font-weight: 700;
letter-spacing: 0.18em;
text-transform: uppercase;
color: var(--accent);
background: var(--accent-light);
padding: 4px 10px;
border-radius: 2px;
margin-bottom: 14px;
}

.form-header h1 {
font-family: 'Syne', sans-serif;
font-weight: 800;
font-size: clamp(28px, 5vw, 42px);
line-height: 1.1;
letter-spacing: -0.02em;
color: var(--ink);
}
.form-header p {
margin-top: 10px;
color: var(--muted);
font-size: 15px;
font-weight: 300;
}
/* FORM CARD */
/* This is the white box that wraps the form fields and separates them visually from the background. */
.form-card {
background: var(--card-bg);
border: 1.5px solid var(--border);
border-radius: 6px;
padding: 36px 32px;
box-shadow: 4px 4px 0px var(--ink);
}
/* SECTION LABEL */
/* This is the small uppercase text used as a visual divider between different parts of the form. */
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
/* FORM CONTROLS */
/* These rules style the text inputs and dropdowns so they match the overall design of the page. */
.form-label {
font-size: 13px;
font-weight: 500;
color: var(--ink);
margin-bottom: 6px;
}
.form-control,
.form-select {
border: 1.5px solid var(--border);
border-radius: 4px;
padding: 10px 14px;
font-family: 'DM Sans', sans-serif;
font-size: 14px;
background: var(--paper);
color: var(--ink);
transition: border-color 0.2s, box-shadow 0.2s;
}
/* FOCUS STATE */
/* This highlights the active field with a dark border so the user knows where they are typing. */
.form-control:focus,
.form-select:focus {
border-color: var(--ink);
box-shadow: 3px 3px 0 var(--ink);
background: #fff;
outline: none;
}
.form-control::placeholder { color: var(--muted); }
/* RADIO AND CHECKBOX */
/* This resizes the default browser inputs and overrides the checked color to match the page palette. */
.form-check-input {
border: 1.5px solid var(--border);
width: 17px;
height: 17px;
cursor: pointer;
}
.form-check-input:checked {
background-color: var(--ink);
border-color: var(--ink);
}

.form-check-label {
font-size: 14px;
color: var(--ink);
cursor: pointer;
}
/* TERMS BOX */
/* This gives the terms checkbox area a tinted background to make it stand out from the regular fields. */
.terms-box {
background: var(--accent-light);
border: 1.5px solid #e8c6c3;
border-radius: 4px;
padding: 14px 16px;
}
/* SUBMIT BUTTON */
/* This styles the main button and adds a colored offset shadow to give it a solid, pressable appearance. */
.btn-submit {
background: var(--ink);
color: var(--paper);
font-family: 'Syne', sans-serif;
font-weight: 700;
font-size: 14px;
letter-spacing: 0.08em;
text-transform: uppercase;
border: 2px solid var(--ink);
border-radius: 4px;
padding: 13px 36px;
width: 100%;
margin-top: 8px;
transition: background 0.18s, color 0.18s, transform 0.1s, box-shadow 0.1s;
box-shadow: 3px 3px 0 var(--accent);
cursor: pointer;
}
/* BUTTON HOVER AND ACTIVE STATES */
/* This shifts the button slightly on hover and further on click to simulate a physical press. */
.btn-submit:hover {
background: var(--accent);
border-color: var(--accent);
color: #fff;
transform: translate(-1px, -1px);
box-shadow: 4px 4px 0 var(--ink);
}
.btn-submit:active {
transform: translate(1px, 1px);
box-shadow: 1px 1px 0 var(--ink);
}
/* REQUIRED INDICATOR */
/* This colors the asterisk red so users can immediately see which fields cannot be left blank. */
.req { color: var(--accent); margin-left: 2px; }
/* SECTION GAP */
/* This adds extra vertical space between the two form sections so they feel clearly separated. */
.section-gap { margin-top: 28px; margin-bottom: 20px; }
/* FORM FOOTER */
/* This centers and softens the small note below the card that explains the required field indicator. */
.form-footer {
text-align: center;
margin-top: 20px;
font-size: 12px;
color: var(--muted);
}
/* MOBILE ADJUSTMENTS */
/* This reduces the card padding on small screens so the form does not feel too tight. */
@media (max-width: 576px) {
.form-card { padding: 24px 18px; }
}
 </style>
</head>
<body>
<div class="page-wrapper">
 <!-- PAGE HEADER -->
 <!-- This section displays the form title and a short instruction to guide the student. -->
 <div class="form-header">
<div class="header-tag">Student Enrollment</div>
<h1>Registration<br>Form</h1>
<p>Complete all fields below to submit your student record.</p>
 </div>

 <!-- FORM CARD -->
 <!-- This wraps the entire form inside a styled card to keep everything visually grouped. -->
 <div class="form-card">
<!-- FORM ELEMENT -->
<!-- This uses method POST so form data is sent in the request body instead of the URL, and it targets process.php. -->
<form method="POST" action="process.php" novalidate>
<!-- SECTION 1: IDENTITY -->
<!-- This section collects the basic personal information needed to identify the student. -->
<div class="section-label">01 — Identity</div>
<div class="row g-3">
<!-- STUDENT ID FIELD -->
<!-- This input accepts the student's school-assigned ID number with a maximum of 20 characters. -->
<div class="col-sm-4">
<label for="student_id" class="form-label">Student ID <span class="req">*</span></label>
<input
type="text"
class="form-control"
id="student_id"
name="student_id"
placeholder="e.g. 2024-0001"
maxlength="20"
/>
</div>
<!-- FULL NAME FIELD -->
<!-- This input collects the student's complete name, ideally in Last Name, First Name M.I. format. -->
<div class="col-sm-8">
<label for="full_name" class="form-label">Full Name <span class="req">*</span></label>
<input
type="text"
class="form-control"
id="full_name"
name="full_name"
placeholder="Last Name, First Name M.I."
/>
</div>
<!-- EMAIL FIELD -->
<!-- Using type="email" lets the browser do a simple format check on the client side before submission. -->
<div class="col-sm-8">
<label for="email" class="form-label">Email Address <span class="req">*</span></label>
<input
type="email"
class="form-control"
id="email"
name="email"
placeholder="you@email.com"
/>
</div>
<!-- AGE FIELD -->
<!-- This uses type="number" with min and max attributes to restrict the input to a sensible range. -->
<div class="col-sm-4">
<label for="age" class="form-label">Age <span class="req">*</span></label>
<input
type="number"
class="form-control"
id="age"
name="age"
placeholder="e.g. 18"
min="1"
max="100"
/>
</div>
</div>
<!-- SECTION 2: ACADEMIC INFO -->
<!-- This section collects the student's enrolled course and gender. -->
<div class="section-label section-gap">02 — Academic Info</div>
<div class="row g-3">
<!-- COURSE DROPDOWN -->
<!-- This dropdown limits the choices to BSIT, BSCS, and BSIS so an invalid course cannot be typed in. -->
<div class="col-sm-6">
<label for="course" class="form-label">Course <span class="req">*</span></label>
<select class="form-select" id="course" name="course">
<option value="" disabled selected>Select a course…</option>
<option value="BSIT">BSIT</option>
<option value="BSCS">BSCS</option>
<option value="BSIS">BSIS</option>
</select>
</div>

<!-- GENDER RADIO BUTTONS -->
<!-- Radio buttons are used here because the student should only be able to select one gender option. -->
<div class="col-sm-6">
<label class="form-label d-block">Gender <span class="req">*</span></label>
<div class="d-flex gap-4 pt-1">
<div class="form-check">
<input class="form-check-input" type="radio" name="gender" id="male" value="Male"/>
<label class="form-check-label" for="male">Male</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="gender" id="female" value="Female"/>
<label class="form-check-label" for="female">Female</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="gender" id="other" value="Other"/>
<label class="form-check-label" for="other">Other</label>
</div>
</div>
</div>
</div>
<!-- TERMS AND CONDITIONS CHECKBOX -->
<!-- This checkbox must be ticked before the form is accepted, as process.php checks for its value. -->
<div class="section-gap">
<div class="terms-box">
<div class="form-check">
<input
class="form-check-input"
type="checkbox"
id="terms"
name="terms"
value="agreed"
/>
<label class="form-check-label" for="terms">
I confirm that all information I have provided is accurate and I agree to the
<strong>Terms &amp; Conditions</strong> of student enrollment. <span class="req">*</span>
</label>
</div>
</div>
</div>
<!-- SUBMIT BUTTON -->
<!-- Clicking this button submits all form data via POST to process.php for validation and processing. -->
<button type="submit" class="btn-submit">Submit Registration →</button>
</form>
 </div>
 <!-- FOOTER NOTE -->
 <!-- This reminds the user that fields marked with an asterisk are required before they can submit. -->
 <p class="form-footer">Fields marked <span style="color:var(--accent)">*</span> are required.</p>
</div><!-- /page-wrapper -->
<!-- BOOTSTRAP JS -->
<!-- This loads the Bootstrap JavaScript bundle required for interactive components to work properly. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>