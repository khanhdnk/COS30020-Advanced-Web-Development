<?php
function sanitiseInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    return htmlspecialchars($input);
}
?>