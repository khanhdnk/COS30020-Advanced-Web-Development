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

?>