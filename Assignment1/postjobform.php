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
        <form action="" method="POST">
            <label for="positionID">Position ID:</label>
            <input type="text" name="positionID" id="positionID">

            <br>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title">

            <br>
            <label for="description">Description:</label>
            <input type="text" name="description" id="description">

            <br>
            <label for="closingDate">Closing Date</label>
            <input type="text" name="closingDate" id="closingDate">

            <br>
            <span>Position:</span>
            <input type="radio" name="fullTime" id="fullTime">
            <label for="fullTime">Full Time</label>

            <input type="radio" name="partTime" id="partTime">
            <label for="partTime">Part Time</label>

            <br>
            <span>Contract:</span>
            <input type="radio" name="onGoing" id="onGoing">
            <label for="onGoing">On-going</label>
            
            <input type="radio" name="fixedTerm" id="fixedTerm">
            <label for="fixedTerm">Fixed Term</label>

            <br>
            <span>Application by:</span>
            <input type="textbox" name="post" id="post">
            <label for="post">Post</label>

            <input type="textbox" name="mail" id="mail">
            <label for="mail">Mail</label>
            <br>

            <label for="location">Location:</label>
            <select id="location" name="location">
                <option value="none">---</option>
                <option value="hanoi">Hanoi</option>
                <option value="danang">DaNang</option>
                <option value="saigon">Saigon</option>
                <!-- Add more options as needed -->
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