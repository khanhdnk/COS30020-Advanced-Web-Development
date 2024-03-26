<?php
session_start();
require_once("ultilities/validate_field.php");
require_once("settings.php");
if ($_SESSION['authenticated'] == false) {
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>

    <div class="container mx-auto py-10 flex justify-center items-center ">
        <div class="bg-gray-50 bg-opacity-30 border border-black border-opacity-20 p-3 md:p-10 rounded-lg shadow-lg max-w-2xl">
            <h1>My Friend System</h1>
            <?php
            $conn = @mysqli_connect($host, $user, $pswd); 
            if ($conn === false) {
                die("Error: Unable to connect. " . mysqli_connect_error());
            }
            if (!@mysqli_select_db($conn, $dbnm)) {
                die("Error: Unable to select database. " . mysqli_error($conn));
            }
            $sql = "SELECT * FROM friends WHERE email = '{$_SESSION['email']}'"; 
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $profile_name = $row['profile_name'];
                
            ?>
        </div>
    </div>
</body>

</html>