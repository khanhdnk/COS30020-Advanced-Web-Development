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

    <div class="container">
        <form action="postjobprocess.php" method="POST">
            <label for="positionID">Position ID:</label>
            <input type="text" name="positionID" id="positionID">

            <br>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title">

            <br>
            <label for="description">Description:</label><br>
            <textarea name="description" id="description" cols="30" rows="5"></textarea>

            <br>
            <label for="closingDate">Closing Date</label>
            <input type="text" name="closingDate" id="closingDate" value="<?php echo date('d/m/y'); ?>">

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


            <br>
            <input type="submit" value="Post">
            <input type="reset" value="Reset">
            <br>
            <p>All fields are required. <a href="index.php">Return to Home Page</a></p>



        </form>
    </div>
</body>

</html>