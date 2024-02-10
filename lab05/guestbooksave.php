<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Lab05 Task 2 - Guestbook</h1>

    <?php
    umask(0007);
    $dir = "../../data/lab05";
    if (!file_exists($dir)) {
        mkdir($dir, 02770);
    }
    if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $filename = "$dir/guestbook.txt";
        $handle = fopen($filename, "a");
        fwrite($handle, $firstname . ", " . $lastname . "\n");
        fclose($handle);
        echo "<p style='color:green'>Thank you for signing our guest book!</p>";
    } else {
        echo "<p style='color:red'><b>You must enter your first and last name!
        <br>
        Use the Browser's 'Go Back' button to return to the Guestbook form.</b></p>";

    }
    ?>
    <a href="guestbookshow.php">Show Guest Book</a>

</body>

</html>