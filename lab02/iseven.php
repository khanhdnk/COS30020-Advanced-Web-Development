<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["number"] ) && !empty($_GET["number"])) {
                if (is_numeric($_GET["number"])) {
                    $number = round($_GET["number"]);
                    $result = ($number % 2 == 0) ? "even" : "odd";
                    echo "<p>The variable $number contains an $result number.</p>";
                } else {
                    echo "<p>Please enter a valid number.</p>";
                }
            } else {
                header("Location: extra_challenge.php");
            }
        }
    ?>
</body>
</html>