<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $filename = "../../data/lab05/guestbook.txt";

    if (!file_exists($filename)) {
        echo "<p style='color:red'>Guestbook is empty!</p>";
        exit;
    } else {
        $handle = fopen($filename, "r");
        $data = "";
        while (!feof($handle)) {
            $tmp = stripslashes(fgets($handle));
            $data .= $tmp;
        }
        echo "<p>Guest book entries:</p>
                  <pre>$data</pre>";
        fclose($handle);
    }
    ?>
</body>

</html>