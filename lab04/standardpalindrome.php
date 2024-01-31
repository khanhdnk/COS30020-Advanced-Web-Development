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
    // Regular expression pattern to match only letters, spaces, and HTML entities
    $pattern = '/^[\D\s]*$/';
    $punctuation = array('.', ',', '!', '?', ';', ':', '-', '_', '"', "'", '(', ')', '[', ']', '{', '}', ' ', '<', '>');

    // Check if the input string matches the pattern
    if (preg_match($pattern, $_POST['str'])) {
        $str = $_POST['str'];
        $_str = str_replace($punctuation, '', $str);
        $reverse_string = strrev($_str);
        if (strcmp(strtolower($_str), strtolower($reverse_string)) === 0) {
            echo "<p style='color: blue;'>".htmlentities($str)."is a standard palindrome.</p>";
        } else {
            echo "<p>". htmlentities($str) ."is not a standard palindrome.</p>";
        }
    } else {
        echo "<p>Please enter a string containing only letters, spaces, and HTML entities.</p>";
    }
} else {
    echo "<p>Please enter a string.</p>";
}
?>
</body>
</html>
