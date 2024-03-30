<?php
session_start();
require_once("ultilities/validate_field.php");
require_once("settings.php");
//check if the user is authenticated
if ($_SESSION['authenticated'] == false) {
    header("Location: login.php");

}else{
    if (!isset($_GET['f_id'])){
        header("Location: friendadd.php");
    }else{
        $f_id = $_GET['f_id'];
    }
}
$notification = array();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
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
                    <li class="md:px-4 md:py-2 hover:text-gray-400"><a href="friendlist.php">Friend Add</a></li>
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
            class="animate__animated animate__slideInUp bg-gray-50 bg-opacity-30 border border-black border-opacity-20 p-3 md:p-10 rounded-lg shadow-lg max-w-2xl">
            <h1 class="h-14 text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-pink-500 to-blue-500 text-center mb-4 text-2xl font-extrabold leading-none tracking-tight  md:text-3xl lg:text-4xl dark:text-white">
                My Friend System</h1>
            <?php
            //create connection
            $conn = @mysqli_connect($host, $user, $pswd);
            if ($conn === false) {
                die("Error: Unable to connect. " . mysqli_connect_error());
            }
            if (!@mysqli_select_db($conn, $dbnm)) {
                die("Error: Unable to select database. " . mysqli_error($conn));
            }
            $sql = "SELECT * FROM friends WHERE friend_id = $f_id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0) {
                echo "<p class='text-red-500 text-center'>No friend found</p>";
            } else {
                $row = mysqli_fetch_assoc($result);
                echo "<p class='text-center text-2xl font-semibold text-gray-700 mb-5'>Friend Details</p>";

                echo "<p class='text-center text-lg font-semibold text-gray-700'>Name: " . $row['profile_name'] . "</p>";
                echo "<p class='text-center text-lg font-semibold text-gray-700'>Email: " . $row['friend_email'] . "</p>";
                echo "<p class='text-center text-lg font-semibold text-gray-700'>Date Started: " . $row['date_started'] . "</p>";
            }
            ?>
            <a href="friendadd.php" class="underline text-blue-700 block mt-3 w-60">Friend Add <span
                    class="text-xl ">&#x203A</span></a>
            <a href="logout.php" class="underline text-blue-700 block mt-3 w-60">Logout <span
                    class="text-xl ">&#x203A</span></a>
        </div>
    </div>
</body>

</html>