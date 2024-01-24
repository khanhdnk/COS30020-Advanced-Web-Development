<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Lab03 Task 2 - Leap Year</h1>
    <hr>
    <!-- Form for user input with a text field to enter the year -->
    <form action="leapyear_selfcall.php" method="GET">
        <label for="year">Enter a year:</label>
        <input type="text" id="year" name="year">
        <input type="submit" value="Submit">
    </form>

    <?php
    // Function to check if a year is a leap year
    function is_leapyear($year)
    {
        // Leap year logic: divisible by 4 and not divisible by 100 unless also divisible by 400
        if ($year % 4 == 0 && ($year % 100 != 0 || $year % 400 == 0)) {
            return true;
        } else {
            return false;
        }
    }

    // Check if the form is submitted and the input is provided
    if (isset($_GET["year"]) && !empty($_GET["year"])) {

        // Check if the input is a numeric value and greater than or equal to 0
        if (!is_numeric($_GET["year"]) || $_GET["year"] < 0) {
            echo "<p>Please provide a valid positive number for the year.</p>";
        } else {
            // Validate and round the input to the nearest integer
            $year = round($_GET["year"]);
            // Check if the rounded year is a leap year
            if (is_leapyear($year)) {
                echo "<p>$year is a leap year.</p>";
            } else {
                echo "<p>$year is a standard year.</p>";
            }
        }
    } else {
        // Display a message if the year is not provided
        echo "<p>Please provide a year.</p>";
    }
    ?>
</body>

</html>
