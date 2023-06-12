<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="apply.html">
    <meta name="keywords" content="Assignment part-01">
    <meta name="author" content="Vikrant Tiwari">
    <link href="styles/style.css" rel="stylesheet">
    <title>Apply</title>
</head>
<body>
<section class="main">
    <section class="navbar">
        <?php include 'nav.inc'; ?>
    </section>
    <div class="register">
        <div class="ETxt">
            <h1>Ready to Start Innovating?</h1>
            <p>Take The Leap!</p>
        </div>
        <form method="post" action="processEOI.php" novalidate="novalidate">
            <fieldset style="display:inline-block;" class="UserDetails">
                <legend id="UDForm">User Details</legend>

                <label for="JobReference">Job Reference :</label>
                <input type="text" id="JobReference" name="JobReference" maxlength="5" required="required"
                       placeholder="Enter Job reference number"><br>

                <label for="FirstName">First name :</label>
                <input type="text" id="FirstName" name="FirstName" pattern="^[a-zA-Z ]+$"
                       placeholder="Enter your First Name" size="20" required="required"><br>

                <label for="lastname">Last name :</label>
                <input type="text" id="lastname" name="LastName" pattern="^[a-zA-Z ]+$"
                       placeholder="Enter your Last Name" size="20" required="required"><br>
                <label for="date_of_birth">Date of birth :</label>
                <input type="text" placeholder="dd/mm/yyyy" name="DateOfBirth" id="date_of_birth" required="required"><br>
            </fieldset>

            <br><br>
            <div id="GForm">
                <fieldset style="display:inline-block;" class="Gender">
                    <legend>Gender Details</legend>
                    <strong>Gender</strong>
                    <label for="gender">Please Select your Gender :</label><br>
                    <label>
                        <input type="radio" id="gender" name="Gender" value="Male" required="required">
                        Male
                    </label>
                    <label>
                        <input type="radio" name="Gender" value="Female" required="required">
                        Female
                    </label><br>
                </fieldset>

            </div>
            <br><br>
            <fieldset style="display:inline-block;" class="PersonalDetails">
                <legend id="PDForm">
                    <strong>Personal Details</strong>
                </legend>
                <label for="staddress">Street Address :</label>
                <input type="text" size="40" name="StreetAddress" id="staddress" required="required"><br>
                <label for="suburb">Suburb/Town :</label>
                <input type="text" name="SuburbTown" id="suburb" maxlength="40" required="required"><br>
                <label for="state">State :</label>
                <select name="State" id="state" required="required">
                    <option value="">Please Select</option>
                    <option value="ACT">ACT</option>
                    <option value="NSW">NSW</option>
                    <option value="NT">NT</option>
                    <option value="QLD">QLD</option>
                    <option value="SA">SA</option>
                    <option value="TAS">TAS</option>
                    <option value="VIC">VIC</option>
                    <option value="WA">WA</option>
                </select><br>
                <label for="postcode">Postcode :</label>
                <input type="text" name="PostCode" id="postcode" pattern="^[0-9]+$" size="4" required="required"><br>
                <label for="email">Email Address :</label>
                <input type="text" name="EmailAddress" id="email" placeholder="name@domain.com" required="required"><br>
                <label for="pnumber">Phone number :</label>
                <input type="tel" id="pnumber" name="PhoneNumber" placeholder="(###) ###-###"
                       pattern="[\(\d{3}\) +\d{3}-\d{3}]" minlength="8" maxlength="12" required="required"><br>
            </fieldset>

            <br><br>
            <fieldset style="display:inline-block;" class="SkillsList">
                <legend id="SLForm">Skill list</legend>
                <label for="communication">Communication & interpersonal</label>
                <input type="checkbox" id="communication" name="Skill1" value="Skill1Tick"><br>
                <label for="problemsolvingskills">Problem Solving skills</label>
                <input type="checkbox" id="problemsolvingskills" name="Skill2" value="Skill2Tick"><br>
                <label for="goodorganisationalskills">Good organisational skills</label>
                <input type="checkbox" id="goodorganisationalskills" name="Skill3" value="Skill3Tick"><br>
                <label for="abilitytoprioritisetasks">Ability to prioritise tasks</label>
                <input type="checkbox" id="abilitytoprioritisetasks" name="Skill4" value="Skill4Tick">
                <br>
                <label for="logicalapproachtowork">Logical approach to work</label>
                <input type="checkbox" id="logicalapproachtowork" name="Skill5" value="Skill5Tick"><br>
                <label for="meticulousattentiontodetail">Meticulous attention to detail</label>
                <input type="checkbox" id="meticulousattentiontodetail" name="Skill6" value="Skill6Tick">
                <br>
                <label for="otherskills">Other skills (Please Write)</label>
                <input type="checkbox" id="otherskills" name=Skill7" value="Skill7Tick"><br>
                <textarea id="otherskillsextra" name="OtherSkills" rows="7" cols="40"
                          placeholder="Write Other skills here..."></textarea><br>
            </fieldset>

            <br>
            <div class="srbuttons">
                <input type="submit" value="Apply" class="submit">
                <input type="reset" value="Reset Form" class="reset">
            </div>
        </form>
    </div>
    <?php include 'footer.inc'; ?>
</section>
</body>
</html>
 