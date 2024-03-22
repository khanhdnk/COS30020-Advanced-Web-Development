<?php
session_start();
require_once("ultilities/validate_field.php");
require_once("settings.php");


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
        <div
            class="bg-gray-50 bg-opacity-30 border border-black border-opacity-20 p-3 md:p-10 rounded-lg shadow-lg max-w-2xl">
            <form action="signup.php" method="POST" novalidate>
                <h1 class="font-bold text-center text-2xl mb-10">MyFriend System Registration Page</h1>

                <label for="email">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full p-2 border border-black border-opacity-20 rounded-lg"
                    value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">

                <label for="profilename">Profile Name</label>
                <input type="text" name="profilename" id="profilename"
                    class="w-full p-2 border border-black border-opacity-20 rounded-lg"
                    value="<?= isset($_POST['profilename']) ? $_POST['profilename'] : '' ?>">

                <label for="password">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full p-2 border border-black border-opacity-20 rounded-lg">

                <label for="confirmpassword">Confirm Password</label>
                <input type="password" name="confirmpassword" id="confirmpassword"
                    class="w-full p-2 border border-black border-opacity-20 rounded-lg">


                <button type="submit" class="w-full bg-black text-gray-50 p-2 rounded-lg mt-4">Register</button>

                <button type="reset" class="w-full bg-red-500 text-gray-50 p-2 rounded-lg mt-4">Clear</button>

                <a href="index.php">Home</a>

                <?php

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $conn = @mysqli_connect($host, $user, $pswd);
                    if ($conn === false) {
                        die("Error: Unable to connect. " . mysqli_connect_error());
                    }

                    if (!@mysqli_select_db($conn, $dbnm)) {
                        die("Error: Unable to select database. " . mysqli_error($conn));
                    }
                    $errmsg = array();
                    $email = validate_field($_POST['email'], '/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/', $errmsg, "Invalid email format", "email");
                    $profile_name = validate_field($_POST['profilename'], '/^[a-zA-Z]+$/', $errmsg, "Profile must contain only letters and cannot be blank", "profile name");
                    $password = validate_field($_POST['password'], '/^[a-zA-Z0-9]+$/', $errmsg, "Password must contain only letters and numbers and cannot be blank", "password");
                    $confirm_password = validate_field($_POST['confirmpassword'], '/^[a-zA-Z0-9]+$/', $errmsg, "Password must contain only letters and numbers and cannot be blank", "confirm password");
                    // Checking the email field
                    $is_unique_email = check_unique_email($email, $conn);
                    if ($email && $profile_name && $password && $confirm_password) {
                        if ($password == $confirm_password) {

                            // or die('Database not available');
                            if (!$conn) {
                                echo "<p>Database connection failure</p>";
                            } else {
                                $registing_query = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends) VALUES ('$email', '$password', '$profile_name', CURDATE(), 0)";
                                $result = mysqli_query($conn, $registing_query);
                                if ($result) {
                                    echo "<p>Registration successful</p>";
                                    $_SESSION['authenticated'] = true;
                                    header("Location: index.php");
                                    exit();
                                } else {
                                    $errmsg[] = "<p>Registration failed</p>";
                                }
                            }
                            mysqli_close($conn);
                        } else {
                            $errmsg[] = "<p style='color: red'>Password and Confirm Password do not match</p>";
                            foreach ($errmsg as $msg) {
                                echo "<p style='color: red'>$msg</p>";
                            }
                        }
                    } else {
                        foreach ($errmsg as $msg) {
                            echo "<p style='color: red'>$msg</p>";
                        }
                    }
                }
                ?>
            </form>
        </div>
    </div>
</body>

</html>