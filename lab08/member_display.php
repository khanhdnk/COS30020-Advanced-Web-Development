<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Display all Members Page</h1>
    <?php
    require_once("settings.php");
    $conn = @mysqli_connect($host, $user, $pswd)
        or die('Failed to connect to server');
    // Use database
    @mysqli_select_db($conn, 's104225661_db')
        or die('Database not available');

    $sql = "SELECT member_id, fname, lname FROM vipmembers";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Member ID</th><th>First Name</th><th>Last Name</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row['member_id'] . "</td><td>" . $row['fname'] . "</td><td>"
                . $row['lname'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No data found.";
    }

    ?>
</body>
</html>