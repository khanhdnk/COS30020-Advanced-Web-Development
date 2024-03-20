<?php
session_start(); // start the session
session_unset(); // unset all session variables
session_destroy(); // destroy all data associated with the session
header('Location: guessinggame.php', true, 303); // redirect to number.php
?>