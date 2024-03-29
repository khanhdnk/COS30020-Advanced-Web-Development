<?php
require_once ('sanitiseInput.php');
function validate_field($input, $pattern , &$errmsg, $msg, $field_name){
    if (!isset($input) || empty($input)){
        $errmsg[] = "Please provide the $field_name";
    } else {
        if (!preg_match($pattern, $input)){
            $errmsg[] = $msg;
        }
        else{
            return sanitiseInput($input);
        }
    }
    return null;
}


function check_unique_email($email, $conn, &$errmsg){
    $query = "SELECT friend_email FROM friends WHERE friend_email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0){
        $errmsg[] = "Email already exists";
        return false;
    }
    return true;
}

?>