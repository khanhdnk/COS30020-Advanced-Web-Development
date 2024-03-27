<?php
$msg = "";
umask(0007);
$dirname = "../../data/lab10/";
if (!is_dir($dirname)) {
    mkdir($dirname, 02770);
}
$filename = "mykeys.txt";
if (isset($_POST["host"]) && isset($_POST["user"]) && isset($_POST["pwd"]) && isset($_POST["db"])) {
    $_POST["host"] = trim($_POST["host"]);
    $_POST["user"] = trim($_POST["user"]);
    $_POST["db"] = trim($_POST["db"]);
    if (!empty($_POST["host"]) && !empty($_POST["user"]) && !empty($_POST["db"])) {
        $handle = fopen($dirname . $filename, "w");
        $data = $_POST["host"] . "\n" . $_POST["user"] . "\n" . $_POST["pwd"] . "\n" . $_POST["db"];
        $written = fwrite($handle, $data); // write string to text file
        if ($written == strlen($data)) {
            $msg .= "Creating and writing keys to file successful. <br/>";
        } else {
            $msg .= "Writing keys to file failed. <br/>";
        }
        fclose($handle);

        $conn = new mysqli($_POST["host"], $_POST["user"], $_POST["pwd"]);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $create_db_query = "CREATE DATABASE IF NOT EXISTS ".$_POST["db"].";";
    
        $create_hitcounter_query = "
            CREATE TABLE `hitcounter` ( 
                `id` SMALLINT NOT NULL PRIMARY KEY,
                `hits` SMALLINT NOT NULL 
            );
        ";
    
    
        $insert_initial_query = "
            INSERT INTO hitcounter (id, hits) VALUES (1, 0);
        ";

        $conn->query("START TRANSACTION;");
        $result1 = mysqli_query($conn, $create_db_query);
        $conn -> query("USE ".$_POST["db"].";");
        $result2 = mysqli_query($conn, $create_hitcounter_query);
        $result3 = mysqli_query($conn, $insert_initial_query);
        $conn->query("COMMIT;");
        if($result1 && $result2 && $result3) {
            $msg .= "Successfully creating table and inserting value . <br/>";
        } else {
            $msg .= "Creating table and inserting value failed. <br/>";
        }

        mysqli_close($conn);

    }else{
        $msg .= "Please fill in all fields. <br/>";
    }
} else {
    $msg .= "Please fill in all fields. <br/>";
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
    <h1>Web Programming – Lab10 - Set up</h1>
    <form action="setup.php" method="post" style="max-width: 500px; display: flex; flex-direction: column;">
        <label for="host">Host name: </label>
        <input type="text" name="host" id="host" />
        <label for="username">Username: </label>
        <input type="text" name="user" id="username" />
        <label for="password">Password: </label>
        <input type="password" name="pwd" id="password" />
        <label for="database">Database: </label>
        <input type="text" name="db" id="database" />

        <p>
            <?php echo $msg; ?>
        </p>

        <input type="submit" value="Set up" />
    </form>
</body>

</html>