<?php
session_start();
require_once("ultilities/validate_field.php");
require_once("settings.php");

if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
    header("Location: friendlist.php");
}
//if form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //initialise an array to store error messages
    $errmsg = array();

    //validate fields
    $email = validate_field($_POST['email'], '/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/', $errmsg, "Invalid email format", "email");
    $password = validate_field($_POST['password'], '/^[a-zA-Z0-9]+$/', $errmsg, "Password must contain only letters and numbers and cannot be blank", "password");
    if ($email && $password) {
        $conn = @mysqli_connect($host, $user, $pswd);
        if ($conn === false) {
            die("Error: Unable to connect. " . mysqli_connect_error());
        }

        if (!@mysqli_select_db($conn, $dbnm)) {
            die("Error: Unable to select database. " . mysqli_error($conn));
        }
        // or die('Database not available');
        if (!$conn) {
            echo "<p>Database connection failure</p>";
        } else {
            $registing_query = "SELECT friend_id, friend_email, password FROM friends WHERE friend_email = '$email'";
            $result = mysqli_query($conn, $registing_query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                if ($row['password'] == $password) {
                    echo "<p>Login successfull</p>";
                    $_SESSION['authenticated'] = true;
                    $_SESSION['email'] = $row['friend_email'];
                    $_SESSION['friend_id'] = $row['friend_id'];
                    header("Location: friendlist.php");
                    exit();
                } else {
                    $errmsg[] = "<p style='color: red'>Password is incorrect.</p>";
                }
            } else {
                $errmsg[] = "<p style='color: red'>Email does not exist.</p>";
            }
        }
        mysqli_close($conn);

    }
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
    <nav class=" shadow-lg shadow-gray-300 w-100 px-8 md:px-auto">
        <div class="md:h-16 h-28 mx-auto md:px-4 container flex items-center justify-between flex-wrap md:flex-nowrap">
            <!-- Logo -->
            <div class="text-indigo-500 md:order-1">
                <img width="60" height="60"
                     src="https://img.icons8.com/external-wanicon-lineal-wanicon/64/external-friend-friendship-wanicon-lineal-wanicon.png"
                     alt="external-friend-friendship-wanicon-lineal-wanicon"/>
            </div>
            <!-- Menu -->
            <div class=" order-3 w-full md:w-auto md:order-2">
                <ul class="flex font-semibold justify-between">
                    <li class="md:px-4 md:py-2 hover:text-gray-400"><a href="friendlist.php">Friend List</a></li>
                    <li class="md:px-4 md:py-2 hover:text-gray-400"><a href="friendadd.php">Friend Add</a></li>
                    <li class="md:px-4 md:py-2 hover:text-gray-400"><a href="about.php">About</a></li>
                </ul>
            </div>
            <div class="order-2 md:order-3">
                <a href="index.php">
                    <button class="bg-black px-4 py-2  text-gray-50 rounded-full flex items-center gap-2">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </button>

                </a>
            </div>
        </div>
    </nav>
    <div class="container mx-auto py-10 flex justify-center items-center ">
        <div
                class="bg-gray-50 bg-opacity-30 border border-black border-opacity-20 p-3 md:p-10 rounded-lg shadow-lg max-w-2xl">
            <form action="login.php" method="POST" novalidate>
                <h1 class="font-bold text-center text-2xl mb-10">MyFriend System Login Page</h1>

                <label for="email">Email</label>
                <input type="email" name="email" id="email"
                       class="w-full p-2 border border-black border-opacity-20 rounded-lg"
                       value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">

                <label for="password">Password</label>
                <input type="password" name="password" id="password"
                       class="w-full p-2 border border-black border-opacity-20 rounded-lg">

                <button type="submit" class="w-full bg-black text-gray-50 p-2 rounded-lg mt-4">Login</button>

<!--                <button type="reset" class="w-full bg-red-500 text-gray-50 p-2 rounded-lg mt-4">Clear</button>-->
                <a href="login.php" class="block bg-red-500 text-gray-50 p-2 rounded-lg mt-4 text-center">Clear</a>


            </form>
            <?php
            //display error messages
            if (isset($errmsg) && count($errmsg) > 0) {
                foreach ($errmsg as $msg) {
                    echo "<p style='color: red'>$msg</p>";
                }
            }

            ?>
            <!--            link to home page-->
            <a href="signup.php" class="underline text-blue-700 block mt-3 w-60">Sign Up <span
                        class="text-xl ">&#x203A</span></a>
            <a href="index.php" class="underline text-blue-700 block mt-3 w-60">Home <span
                        class="text-xl ">&#x203A</span></a>
        </div>
    </div>
</body>

</html>