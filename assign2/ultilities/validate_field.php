<?php
require_once ('sanitiseInput.php');
//validate fields based on passed regex pattern and generate error message if the field is invalid
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

//query the database to check if the email is unique and generate error message if it is not
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