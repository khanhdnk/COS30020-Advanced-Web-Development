<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Job Vacancy Posting System</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="postjobform.php">Post job</a></li>
            <li><a href="searchjobform.php">Search job</a></li>
            <li><a href="about.php">About assignment</a></li>
        </ul>
    </nav>

    <form action="searchjobprocess.php" method="GET">
        <h1>Job Vacancy Posting System</h1>
        <label for="jobTitle">Job Title</label>
        <input type="text" name="jobTitle" id="jobTitle">
        <br>
        <span>Position:</span>
        <input type="radio" name="position" id="fullTime" value="Full Time">
        <label for="position">Full Time</label>

        <input type="radio" name="position" id="partTime" value="Part Time">
        <label for="position">Part Time</label>
        <br>
        <span>Contract:</span>
        <input type="radio" name="contract" id="Going" value="On-Going">
        <label for="onGoing">On-going</label>

        <input type="radio" name="contract" id="fixedTerm" value="Fixed term">
        <label for="fixedTerm">Fixed Term</label>
        <br>
        <span>Application by:</span>
        <input type="checkbox" name="application[]" id="post" value="Post">
        <label for="post">Post</label>

        <input type="checkbox" name="application[]" id="mail" value="Mail">
        <label for="mail">Mail</label>
        <br>
        <label for="location">Location:</label>
        <select id="location" name="location">
            <option value="none">---</option>
            <option value="act">ACT</option>
            <option value="nsw">NSW</option>
            <option value="nt">NT</option>
            <option value="qld">QLD</option>
            <option value="sa">SA</option>
            <option value="tas">TAS</option>
            <option value="vic">VIC</option>
            <option value="wa">WA</option>
        </select>
        <input type="submit" value="search">
        <br>

    </form>
        <a href="index.php">Return to Home Page</a>
</body>

</html>