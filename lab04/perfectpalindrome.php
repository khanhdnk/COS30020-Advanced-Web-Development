<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_POST['str']) && !empty($_POST['str'])) {
    // Regular expression pattern to match only letters and spaces
    $pattern = '/^\D*$/';

    // Check if the input string matches the pattern
    if (preg_match($pattern, $_POST['str'])) {
        $str = $_POST['str'];
        $reverse_string = strrev($str);
        if (strcmp(strtolower($str), strtolower($reverse_string)) === 0) {
            echo "<p>$str is a perfect palindrome.</p>";
        } else {
            echo "<p>$str is not a perfect palindrome.</p>";
        }
    } else {
        echo "<p>Please enter a string containing only letters and spaces.</p>";
    }
} else {
    echo "<p>Please enter a string.</p>";
}
?>
</body>
</html>
