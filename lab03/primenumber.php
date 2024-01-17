<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    function is_prime($number)
    {
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

    if (isset($_GET["number"]) && !empty($_GET["number"])) {
        if (is_numeric($_GET["number"])) {
            $number = $_GET["number"];
            if (is_prime($number)) {
                echo "<p>$number is a prime number.</p>";
            } else {
                echo "<p>$number is not a prime number.</p>";
            }

        } else {
            echo "<p>Please enter a number.</p>";
        }
    } else {
        header("Location: primenumberform.php");
    }
    ?>
</body>

</html>