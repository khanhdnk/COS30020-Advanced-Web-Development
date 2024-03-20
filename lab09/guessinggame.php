<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    session_start(); // start the session
    if (!isset ($_SESSION["number"])) { // check if session variable exists
        $_SESSION["number"] = rand(1, 100); // create the session variable
    }
    //set number of guesses
    if (!isset ($_SESSION["guesses"])) { // check if session variable exists
        $_SESSION["guesses"] = 0; // create the session variable
    }
    $msg = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["gnumber"])) {
            if (is_numeric($_POST["gnumber"])) {
                $gnumber = $_POST["gnumber"];
                if ($gnumber > 100 || $gnumber < 1) {
                    $msg = "<p>You need to enter number between 100 and 1</p>";
                } else {
                    if ($gnumber == $_SESSION["number"]) {
                        session_unset();
                        $msg = "<p style='color: green'>Congratulations! You guessed the hidden number</p>";
                    } else {
                        $_SESSION["guesses"]++;
                        $msg = "<p style='color: red'>Wrong guess. Try again</p>";
                    }
                    //                echo "<p><a href='guessinggame.php'>Play again</a></p>";
                }
            } else {
                $msg = "<p>Invalid input</p>";
            }
        } else {
            $msg = "<p>Enter a number and press the Guess button</p>";
        }

    }

    if (!isset ($_SESSION["number"])) { // check if session variable exists
        $_SESSION["number"] = rand(1, 100); // create the session variable
    }
    //set number of guesses
    if (!isset ($_SESSION["guesses"])) { // check if session variable exists
        $_SESSION["guesses"] = 0; // create the session variable
    }

    ?>
    <h1>Guessing game</h1>
    <form action="guessinggame.php" method="post">
        <label for="gnumber">Enter a number between 1 and 100, then press the Guess button.</label><br>
        <input type="text" id="gnumber" name="gnumber" required><br>
        <input type="submit" value="Guess">
        <p>Number of guesses: <?php echo $_SESSION["guesses"] ?></p>
        <p>riel number: <?php echo $_SESSION['number']?></p>
        <p><?php echo $msg ?></p>
        <p><a href="giveup.php">Give Up</a></p>
        <p><a href="startover.php">Start Over</a></p>
    </form>
    <?php

    ?>
</body>
</html>