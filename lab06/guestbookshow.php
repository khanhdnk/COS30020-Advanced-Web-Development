<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Lab06 Task 2 - Guestbook</h1>
    <h2>View Guestbook </h2>
    <hr>
    <?php
//    allow permission to create directory
    umask(0007);
    $dir = "../../data/lab06";
    if (!file_exists($dir)) {
        mkdir($dir, 02770);
    }
    $fileName = '../../data/lab06/guestbook.txt';
//    check if the file exists
    if (file_exists($fileName)){
        $handle = fopen($fileName, 'r');
        $allData = array();

        while (!feof($handle)){
            $line = fgets($handle);
            if (!empty($line)){
                $user = explode(',', $line);
                $allData[] = $user;
            }
        }
        fclose($handle);
        sort($allData); // sort the array (ascending order by name)
        echo "<table border='1'>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>";

        foreach ($allData as $i => $user){
            echo "<tr>";
            echo "<td>" . ($i + 1) . "</td>";
            echo "<td>" . $user[0] . "</td>";
            echo "<td>" . $user[1] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        echo "<p style='color:red'>No one has signed our guest book yet!</p>";
    }
    ?>
    <br>
    <a href="guestbookform.php">Add Another Visitor</a>


</body>
</html>