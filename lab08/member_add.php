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
    <?php
    require_once("settings.php");
    $conn = @mysqli_connect($host, $user, $pswd)
        or die('Failed to connect to server');
    // Use database
    @mysqli_select_db($conn, 's104225661_db')
        or die('Database not available');
    $sql = "CREATE TABLE IF NOT EXISTS vipmembers (
        member_id INT AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(40),
        lname VARCHAR(40),
        gender VARCHAR(1),
        email VARCHAR(40),
        phone VARCHAR(20)
    );";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
    if (
        isset($_POST['fname']) && !empty($_POST['fname']) &&
        isset($_POST['lname']) && !empty($_POST['lname']) &&
        isset($_POST['gender']) && !empty($_POST['gender']) &&
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['phone']) && !empty($_POST['phone'])
    ) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $insert_sql = "INSERT INTO vipmembers (fname, lname, gender, email, phone) VALUES ('$fname', '$lname', '$gender', '$email', '$phone')";
        $insert_result = mysqli_query($conn, $insert_sql);
        if ($insert_result) {
            echo "<p>New record created successfully</p>";
        } else {
            echo "<p>" . mysqli_error($conn) . "</p>";
        }
    }
    else{
        echo "<p>All fields are required!</p>"; 
    }



    // close connection
    mysqli_close($conn);
    ?>
</body>

</html>