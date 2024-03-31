<?php
session_start();
require_once("ultilities/validate_field.php");
require_once("settings.php");
//check if the user is authenticated
if ($_SESSION['authenticated'] == false) {
    header("Location: login.php");
}

$notification = array();
//checking for page number
$page_num = isset($_GET['page_num']) ? intval($_GET['page_num']) : 1;
$records_per_page = 5; // Number of records to display per page


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
                    <li class="md:px-4 md:py-2 text-purple-600"><a href="friendlist.php">Friend Add</a></li>
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
                class="animate__animated animate__fadeIn bg-gray-50 bg-opacity-30 border border-black border-opacity-20 p-3 md:p-10 rounded-lg shadow-lg max-w-2xl">
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
            //calculate offset based on page number

            //query get the current user's data
            $sql = "SELECT * FROM friends WHERE friend_email = '{$_SESSION['email']}'";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($result);
            $profile_name = $row['profile_name'];
            //query get numbers of friends
            $get_current_friend = "SELECT f.friend_id, f.profile_name
            FROM friends f JOIN myfriends mf
            ON f.friend_id = mf.friend_id1 OR f.friend_id = mf.friend_id2
            WHERE (mf.friend_id1 = {$row['friend_id']} OR mf.friend_id2 = {$row['friend_id']}) 
            AND f.friend_id != {$row['friend_id']}";
            //excute query
            $current_friend_result = mysqli_query($conn, $get_current_friend);
            $number_of_friends = mysqli_num_rows($current_friend_result);

            // Query to get the total number of friends not in the friend list
            $get_total_not_friends = "SELECT COUNT(*) as total FROM friends f WHERE f.friend_id != {$row['friend_id']} AND f.friend_id NOT IN ( SELECT mf.friend_id1 FROM myfriends mf WHERE mf.friend_id2 = {$row['friend_id']}) AND f.friend_id NOT IN ( SELECT mf.friend_id2 FROM myfriends mf WHERE mf.friend_id1 = {$row['friend_id']})";

            // Execute the query
            $total_not_friends_result = mysqli_query($conn, $get_total_not_friends);

            // Fetch the result
            $total_not_friends_row = mysqli_fetch_assoc($total_not_friends_result);

            // Calculate the total number of pages
            $total_pages = ceil($total_not_friends_row['total'] / $records_per_page);
            if ($page_num > $total_pages) {
                $page_num = $total_pages;
            }
            if ($page_num < 1) {
                $page_num = 1;
            }
            $offset = ($page_num - 1) * $records_per_page;



            //query get friends who is not in the friend list
            $get_not_friends = "SELECT f.friend_id, f.profile_name FROM friends f WHERE f.friend_id != {$row['friend_id']} AND f.friend_id NOT IN ( SELECT mf.friend_id1 FROM myfriends mf WHERE mf.friend_id2 = {$row['friend_id']}) AND f.friend_id NOT IN ( SELECT mf.friend_id2 FROM myfriends mf WHERE mf.friend_id1 = {$row['friend_id']}) LIMIT {$records_per_page} OFFSET $offset";
            //excute query
            $not_friend_result = mysqli_query($conn, $get_not_friends);
            $total_page = ceil(mysqli_num_rows($not_friend_result));

            function add_friend_feature($friend_id, &$notification, $number_of_friends)
            {
                global $conn;
                $number_of_friends_of_the_other = "SELECT f.friend_id, f.profile_name
                FROM friends f JOIN myfriends mf
                ON f.friend_id = mf.friend_id1 OR f.friend_id = mf.friend_id2
                WHERE (mf.friend_id1 = {$friend_id} OR mf.friend_id2 = {$friend_id}) 
                AND f.friend_id != {$friend_id}";

                $result1 = mysqli_query($conn, $number_of_friends_of_the_other);
                //due to the database is messed up, I have to use another query to get the real number of friends of the other user
                //get the number of friends of the other user
                $number_of_friends_of_stranger = mysqli_num_rows($result1);

                //add friend
                $sql = "INSERT INTO myfriends (friend_id1, friend_id2) VALUES ({$_SESSION['friend_id']}, {$friend_id})";
                $trigger_add_friend = mysqli_query($conn, $sql);
                if (!$trigger_add_friend) {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                if ($trigger_add_friend) {
                    $notification[] = "<p class='text-green-500'>Add friend successfully</p>";
                } else {
                    $notification[] = "<p class='text-red-500'>Add friend failed</p>";
                }

                //update the number of friends of current user logged in
                $sql_current_user_update = "UPDATE friends SET num_of_friends =  $number_of_friends + 1 WHERE friend_id = {$_SESSION['friend_id']}";
                $update_current_user_nof = mysqli_query($conn, $sql_current_user_update);

                //update the number of friends of the other user
                $sql_other_user_update = "UPDATE friends SET num_of_friends =  $number_of_friends_of_stranger + 1 WHERE friend_id = $friend_id";
                $update_stranger_user_nof = mysqli_query($conn, $sql_other_user_update);

            }

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST['friendId']) && !empty($_POST['friendId'])) {
                    $the_other_friend_id = $_POST['friendId'];
                    add_friend_feature($the_other_friend_id, $notification, $number_of_friends);
                    $number_of_friends++;
                    header("Location: friendadd.php");
                }
            }
            ?>
            <h1 class="font-bold">
                <?php echo "$profile_name" ?>'s Friend List Page
            </h1>
            <h1 class="italic text-right mt-3">Total number of friends is
                <?php echo $number_of_friends ?>
            </h1>
            <?php
            function get_mutual_of_two_user($current_user, $stranger_id)
            {


                global $conn;
                $get_mutal_friend_query = "SELECT COUNT(*) AS mutual_friend_count
                FROM friends AS f JOIN myfriends AS mf
                ON (f.friend_id = mf.friend_id1 AND mf.friend_id2 = {$stranger_id})
                OR (f.friend_id = mf.friend_id2 AND mf.friend_id1 = {$stranger_id})
                WHERE f.friend_id != {$current_user}
                AND f.friend_id IN (
                  SELECT friend_id1 FROM myfriends WHERE friend_id2 = {$current_user}
                  UNION SELECT friend_id2 FROM myfriends WHERE friend_id1 = {$current_user}
                )";
                $mutal_friend_result = mysqli_query($conn, $get_mutal_friend_query);
                $count = mysqli_fetch_assoc($mutal_friend_result);
                return $count["mutual_friend_count"];
            }

            if (mysqli_num_rows($not_friend_result) > 0) {


                echo "<table class=' w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400'>";
                echo "<thead class='text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400'>";
                echo "<tr>
                <th scope='col' class='px-6 py-3'>
                    Profile Name
                </th>
                <th scope='col' class='px-6 py-3'>
                    Mutual Firends
                </th>
                <th scope='col' class='px-6 py-3'>
                    Action
                </th>
                </tr>";
                echo "</thead>";
                foreach ($not_friend_result as $stranger) {
                    echo "<tr class='odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700'>";
                    echo "<td class='px-6 py-4'><a href='frienddetails.php?f_id={$stranger['friend_id']}' class='underline'>{$stranger['profile_name']} + {$stranger['friend_id']}</a> <i class='fa-solid fa-magnifying-glass'></i></td>";
                    echo "<td class='px-6 py-4'>";
                    echo get_mutual_of_two_user($row['friend_id'], $stranger['friend_id']) . " mutual friends";
                    echo "</td>";
                    echo "<td class='px-6 py-4'>
                    <form method='POST' action='friendadd.php'>
                        <input type='hidden' name='friendId' value='{$stranger['friend_id']}'>
                        <input class='cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full'  type='submit' name='addfriend' value='Add as friend'>
                    </form>
                    </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='text-center mt-5 text-blue-600'>There are no friends to add</p> ";

            }

            echo "<div class='mt-4 flex justify-between px-5'>";
            $previousButton = "<div></div>";
            if ($page_num > 1) {
                $previousButton = "<a href='friendadd.php?page_num=" . ($page_num - 1) . "' class='bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 hover:from-red-500 hover:via-purple-500 hover:to-pink-500 text-white font-bold py-1 px-6 rounded-full shadow-lg transition duration-300 transform hover:scale-105'>Previous</a>";
            }

            // Store the HTML for the "Next" button
            $nextButton = "";
//            if (mysqli_num_rows($not_friend_result) == $records_per_page) {
//                $nextButton = "<a href='friendadd.php?page_num=" . ($page_num + 1) . "' class='bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 hover:from-red-500 hover:via-purple-500 hover:to-pink-500 text-white font-bold py-1 px-6 rounded-full shadow-lg transition duration-300 transform hover:scale-105'>Next</a>";
//            }
            if ($page_num < $total_pages) {
                $nextButton = "<a href='friendadd.php?page_num=" . ($page_num + 1) . "' class='bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 hover:from-red-500 hover:via-purple-500 hover:to-pink-500 text-white font-bold py-1 px-6 rounded-full shadow-lg transition duration-300 transform hover:scale-105'>Next</a>";
            }

            // Echo out the buttons in the desired order
            echo $previousButton;
            echo $nextButton;
            echo "</div>";
            foreach ($notification as $noti) {
                echo "<p>$noti</p>";
            }
            mysqli_close($conn)
            ?>
            <a href="friendlist.php" class="underline text-blue-700 block mt-3 w-60">Friend List <span
                        class="text-xl ">&#x203A</span></a>
            <a href="logout.php" class="underline text-blue-700 block mt-3 w-60">Logout <span
                        class="text-xl ">&#x203A</span></a>
        </div>
    </div>
</body>

</html>