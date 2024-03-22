<?php
function validate_field($input, $pattern , &$errmsg, $msg, $field_name){
    if (!isset($input) || empty($input)){
        $errmsg[] = "Please provide the $field_name";
    } else {
        if (!preg_match($pattern, $input)){
            $errmsg[] = $msg;
        }
        else{
            return $input;
        }
    }
    return null;
}

function sanitiseInput($input)
{
    //criteria for sanitising input
    $input = trim($input);
    $input = stripslashes($input);
    return htmlspecialchars($input);
}

function check_unique_email($email, $conn){
    $query = "SELECT friend_email FROM friends WHERE friend_email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0){
        return false;
    }
    return true;
}

?>