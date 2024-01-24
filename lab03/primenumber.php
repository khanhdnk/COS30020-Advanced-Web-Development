<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    // Function to check if a number is a prime number
    function is_prime($number)
    {
        // Prime number logic: greater than or equal to 2 and not divisible by any number from 2 to the square root of the number
        if ($number < 2) {
            return false;
        }

        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i == 0) {
                return false;
            }
        }

        return true;
    }

    // Check if the 'number' parameter is set and not empty in the GET request
    if (isset($_GET["number"]) && !empty($_GET["number"])) {
        // Check if the input is a numeric value and greater than or equal to 0
        if (is_numeric($_GET["number"]) && $_GET["number"] > 0) {
            $number = round($_GET["number"]);

            // Check if the number is a prime number
            if (is_prime($number)) {
                echo "<p>$number is a prime number.</p>";
            } else {
                echo "<p>$number is not a prime number.</p>";
            }
        } else {
            // Display a message if the input is not a valid positive number
            echo "<p>Please enter a number and this number must be higher than 0.</p>";
        }
    } else {
        // Redirect to the 'primenumberform.php' page if the 'number' parameter is not provided
        header("Location: primenumberform.php");
    }
    ?>
</body>

</html>
