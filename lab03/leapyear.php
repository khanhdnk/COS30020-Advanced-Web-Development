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
    <?php

    function is_leapyear($year)
    {

        if (!is_numeric($year)) {
            header("Location: leapyearform.php");
        }
        else{
            if ($year % 4 == 0 && ($year % 100 != 0 || $year % 400 == 0)) {
                return true;
            } else {
                return false;
            }

        }

    }

    // Example usage
    if (isset($_GET["year"]) && !empty($_GET["year"])) {
        $year = $_GET["year"];
        if (is_leapyear($year)) {
            echo "<p>$year is a leap year.</p>";
        }
        else{
            echo "<p>$year is a standard year.</p>";
        }
    }
    else{
        header("Location: leapyearform.php");
    }
    

    ?>

</body>

</html>