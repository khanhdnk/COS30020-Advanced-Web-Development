<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Lab04 Task 3 - Standard Palindrome</h1>
    <hr>
    <?php
    if (isset($_POST['str']) && !empty($_POST['str'])) {
        // Regular expression pattern to match only letters, spaces, and HTML entities
        $pattern = '/^[\D\s]*$/';
        $punctuation = array('.', ',', '!', '?', ';', ':', '-', '_', '"', "'", '(', ')', '[', ']', '{', '}', ' ', '<', '>');

        // Check if the input string matches the pattern
        if (preg_match($pattern, $_POST['str'])) {
            $str = $_POST['str'];
            $_str = str_replace($punctuation, '', $str);
            $reverse_string = strrev($_str);
            if (strcmp(strtolower($_str), strtolower($reverse_string)) === 0) {
                echo "<p  style='color: blue;'>" . htmlentities($str) . " is a standard palindrome.</p>";
            } else {
                echo "<p  style='color: red;'>" . htmlentities($str) . " is not a standard palindrome.</p>";
            }
        } else {
            echo "<p>Please enter a string containing only letters, spaces, and HTML entities.</p>";
        }
    } else {
        echo "<p>Please enter a string.</p>";
    }
    ?>
    <form action="standardpalindromeself.php" method="POST">
        <label for="str">Enter string</label>
        <input type="text" name="str" id="str">
        <input type="submit" value="Check Palindrome">
    </form>

</body>

</html>