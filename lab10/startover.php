<?php
    require_once("./hitcounter.php");

    $counter;
    
    $msg = []; 

    $dir = "../../data/lab10";
    $filename = $dir . "/mykeys.txt";
    $host = "";
    $user = "";
    $pwd = "";
    $db = "";

    if(file_exists($dir) && is_readable($filename)) {
        $handle = fopen($filename, "r"); 
        if(!feof($handle)) $host = trim(fgets($handle)); 
        if(!feof($handle)) $user = trim(fgets($handle)); 
        if(!feof($handle)) $pwd = trim(fgets($handle)); 
        if(!feof($handle)) $db = trim(fgets($handle)); 
        fclose($handle);
    }
    
    $res = false;

    if(!empty($host) && !empty($user) && !empty($db)) {
        try {
            $counter = new HitCounter($host, $user, $pwd, $db, 'hitcounter');
            $counter -> startOver();
            $counter -> closeConnection();
        } catch (Exception $e) {
            $msg[] = "Cannot connect to database, set up again at <a href='setup.php'>setup</a> <br/>";
        }
    } else {
        $msg[] = "Keys are not set up properly, set up again at <a href='setup.php'>setup</a> <br/>";
    }

    header("location: countvisits.php");
?>