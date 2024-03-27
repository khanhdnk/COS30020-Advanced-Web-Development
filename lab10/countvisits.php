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

if(file_exists($dir)){
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
        $counter -> setHits();
        $res = $counter -> getHits();
        $counter -> closeConnection();
    } catch (Exception $e) {
        $msg[] = "Cannot connect to database, set up again at <a href='setup.php'>setup</a> <br/>";
    }
} else {
    $msg[] = "Keys are not set up properly, set up again at <a href='setup.php'>setup</a> <br/>";
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Your Name" />
        <title>TITLE</title>
    </head>
    <body>
        <h1>Web Programming – Lab10</h1>
        <p>This page has received <?php echo ($res ? $res : 0) . ' hit' . ((int)$res > 1 ? 's' : ''); ?></p>
        <a href="startover.php">Start over</a>
        <p><?php foreach($msg as $message){
            echo $message;
        } ?></p>
    </body>
</html>


