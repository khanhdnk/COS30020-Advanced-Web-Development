<?php
session_start();
require_once("ultilities/validate_field.php");
require_once("settings.php");
if ($_SESSION['authenticated'] == false) {
    header("Location: login.php");
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
                <img width="60" height="60" src="https://img.icons8.com/external-wanicon-lineal-wanicon/64/external-friend-friendship-wanicon-lineal-wanicon.png" alt="external-friend-friendship-wanicon-lineal-wanicon"/>
            </div>
            <!-- Menu -->
            <div class=" order-3 w-full md:w-auto md:order-2">
                <ul class="flex font-semibold justify-between">
                    <li class="md:px-4 md:py-2 text-purple-600"><a href="friendlist.php">Friend List</a></li>
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
        <div class="animate__animated animate__slideInUp bg-gray-50 bg-opacity-30 border border-black border-opacity-20 p-3 md:p-10 rounded-lg shadow-lg max-w-2xl limitwidth">
            <h1 class="h-14 text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-pink-500 to-blue-500 text-center mb-4 text-2xl font-extrabold leading-none tracking-tight  md:text-3xl lg:text-4xl dark:text-white">My Friend System</h1>
            <?php
            $conn = @mysqli_connect($host, $user, $pswd);
            if ($conn === false) {
                die("Error: Unable to connect. " . mysqli_connect_error());
            }
            if (!@mysqli_select_db($conn, $dbnm)) {
                die("Error: Unable to select database. " . mysqli_error($conn));
            }

            $sql = "SELECT * FROM friends WHERE friend_email = '{$_SESSION['email']}'";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($result);
            $profile_name = $row['profile_name'];
            $get_friends = "SELECT f.friend_id, f.profile_name
            FROM friends f JOIN myfriends mf
            ON f.friend_id = mf.friend_id1 OR f.friend_id = mf.friend_id2
            WHERE (mf.friend_id1 = {$row['friend_id']} OR mf.friend_id2 = {$row['friend_id']}) 
            AND f.friend_id != {$row['friend_id']}";
            $result2 = mysqli_query($conn, $get_friends);
            $number_of_friends = mysqli_num_rows($result2);

            function unfriend($friend_id, &$notification, &$connect, $number_of_friends){
                echo "activated";
                $number_of_friends_of_the_other = "SELECT f.friend_id, f.profile_name
                FROM friends f JOIN myfriends mf
                ON f.friend_id = mf.friend_id1 OR f.friend_id = mf.friend_id2
                WHERE (mf.friend_id1 = {$friend_id} OR mf.friend_id2 = {$friend_id}) 
                AND f.friend_id != {$friend_id}";

                $result1 = mysqli_query($connect, $number_of_friends_of_the_other);
                //due to the database is messed up, I have to use another query to get the real number of friends of the other user
                //get the number of friends of the other user
                $number_of_friends_of_stranger = mysqli_num_rows($result1);




                $sqli = "DELETE FROM myfriends WHERE (friend_id1 = {$_SESSION['friend_id']} AND friend_id2 = {$friend_id}) OR (friend_id1 = {$friend_id} AND friend_id2 = {$_SESSION['friend_id']})";
                $unfriend_result = mysqli_query($connect, $sqli);
                //echo error query
                if (!$unfriend_result) {
                    echo "Error: " . $sqli . "<br>" . mysqli_error($connect);
                }
                if ($unfriend_result) {
                    $notification[] =  "<p class='text-green-500'>Unfriend successfully</p>";
                }else{
                    $notification[] =  "<p class='text-red-500'>Unfriend failed</p>";
                }

                //update the number of friends of current user logged in
                $sql_current_user_update = "UPDATE friends SET num_of_friends =  $number_of_friends - 1 WHERE friend_id = {$_SESSION['friend_id']}";
                $update_current_user_nof = mysqli_query($connect, $sql_current_user_update);

                //update the number of friends of the other user
                $sql_other_user_update = "UPDATE friends SET num_of_friends =  $number_of_friends_of_stranger - 1 WHERE friend_id = $friend_id";
                $update_stranger_user_nof = mysqli_query($connect, $sql_other_user_update);





            }
            //if the user click on the unfriend button
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                if (isset($_POST['friendId'])) {
                    $the_other_friend_id = $_POST['friendId'];
                    echo "hello";
                    unfriend($the_other_friend_id, $notification, $conn, $number_of_friends);
                    $number_of_friends = $number_of_friends - 1;
                    header("Location: friendlist.php");
                }

            }


            ?>
            <h1 class="font-bold"><?php echo "$profile_name"?>'s Friend List Page</h1>
            <h1 class="italic text-right mt-3">Total number of friends is <?php echo $number_of_friends?></h1>
            <?php
            if ($number_of_friends > 0) {
                echo "<table class=' w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400'>";
                echo "<thead class='text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400'>";
                echo "<tr class=''>
                <th scope='col' class='px-6 py-3'>
                    Profile Name
                </th>
                <th scope='col' class='px-6 py-3'>
                    Action
                </th>
                </tr>";
                echo "</thead>";
                foreach( $result2 as $friend){
                    echo "<tr class='odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700'>";
                    echo "<td class='px-6 py-4'>{$friend['profile_name']}</td>";
                    echo "<td class='px-6 py-4'>
                                <form method='POST' action='friendlist.php'>
                                <input type='hidden' name='friendId' value='{$friend['friend_id']}'>
                                
                                <input class='cursor-pointer bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded-full' type='submit' name='addfriend' value='Unfriend'>
                                </form>
                            </td>";
                    echo "</tr>";
                }
                echo "</table>";
            }else{
                echo "<p class='mt-4 text-yellow-400'>You don't have any friend</p> ";
            }
            foreach($notification as $noti){
                echo "<p>$noti</p>";
            }
            mysqli_close($conn);
            ?>

            <a href="friendadd.php" class="underline text-blue-700 block mt-3 w-60">Add Friend <span
                        class="text-xl ">&#x203A</span></a>
            <a href="logout.php" class="underline text-blue-700 block mt-3 w-60">Logout  <span
                        class="text-xl ">&#x203A</span></a>
        </div>
    </div>
</body>

</html>