<?php
function sanitiseInput($input)
{
    //criteria for sanitising input
    $input = trim($input);
    $input = stripslashes($input);
    return htmlspecialchars($input);
}
?>