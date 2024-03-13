<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Web application development"/>
    <meta name="keywords" content="PHP"/>
    <meta name="author" content="Your Name"/>
    <title>TITLE</title>
</head>
<body>
    <h1>Web Programming - Lab08</h1>
    <?php
    require_once("settings.php");
    // complete your answer based on Lecture 8 slides 26 and 44
    $conn = @mysqli_connect($host, $user, $pswd)
    or die('Failed to connect to server');
    // Use database
    @mysqli_select_db($conn, 's104225661_db')
    or die('Database not available');
    $sql = "SELECT car_id, make, model, price FROM cars";
    $result=  mysqli_query($conn, $sql);

    echo "<table border='1'>";
    echo "<tr><th>Car ID</th><th>Make</th><th>Model</th><th>Price</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row['car_id'] . "</td><td>" . $row['make'] . "</td><td>"
            . $row['model'] . "</td><td>" . $row["price"] . "</td></tr>";
    }
    echo "</table>";

    // free result and close connection
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</body>
</html>