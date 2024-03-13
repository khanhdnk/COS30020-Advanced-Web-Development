<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Search Member Page</h1>
    <form action="member_search.php" method="post">
        <label for="search">Search by Last Name:</label>
        <input type="text" id="search" name="search" required><br>
        <input type="submit" value="Search">
    </form>

    <?php
    require_once("settings.php");
    $conn = @mysqli_connect($host, $user, $pswd)
        or die('Failed to connect to server');
    // Use database
    @mysqli_select_db($conn, 's104225661_db')
        or die('Database not available');

    if (isset($_POST['search']) && !empty($_POST['search'])) {
        $search = $_POST['search'];
        $search = stripslashes($search);
        $sql = "SELECT member_id, fname, lname, email FROM vipmembers WHERE LOWER(lname) LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Member ID</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>" . $row['member_id'] . "</td><td>" . $row['fname'] . "</td><td>"
                        . $row['lname'] . "</td><td>" . $row['email']. "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No data found.</p>";
            }
        } else {
            echo "<p>" . mysqli_error($conn) . "</p>";
        }
    }
    else{
        echo "<p>Please enter a last name to search for a member(s)</p> ";
    }


    ?>
</body>

</html>