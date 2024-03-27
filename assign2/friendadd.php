<?php
session_start();
require_once("ultilities/validate_field.php");
require_once("settings.php");
if ($_SESSION['authenticated'] == false) {
    header("Location: login.php");
}
$notification = array();
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
    <title>Home</title>
</head>

<body>

    <div class="container mx-auto py-10 flex justify-center items-center ">
        <div
            class="bg-gray-50 bg-opacity-30 border border-black border-opacity-20 p-3 md:p-10 rounded-lg shadow-lg max-w-2xl">
            <h1>My Friend System</h1>
            <?php
            $conn = @mysqli_connect($host, $user, $pswd);
            if ($conn === false) {
                die("Error: Unable to connect. " . mysqli_connect_error());
            }
            if (!@mysqli_select_db($conn, $dbnm)) {
                die("Error: Unable to select database. " . mysqli_error($conn));
            }
            $offset = ($page_num - 1) * $records_per_page;
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST['friendId']) && !empty($_POST['friendId'])) {
                    $the_other_friend_id = $_POST['friendId'];
                    add_friend_feature($the_other_friend_id, $notification);
                }
            }
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


            //query get friends who is not in the friend list
            $get_not_friends = "SELECT f.friend_id, f.profile_name FROM friends f WHERE f.friend_id != {$row['friend_id']} AND f.friend_id NOT IN ( SELECT mf.friend_id1 FROM myfriends mf WHERE mf.friend_id2 = {$row['friend_id']}) AND f.friend_id NOT IN ( SELECT mf.friend_id2 FROM myfriends mf WHERE mf.friend_id1 = {$row['friend_id']}) LIMIT {$records_per_page} OFFSET $offset";
            //excute query
            $not_friend_result = mysqli_query($conn, $get_not_friends);
            $total_page = ceil(mysqli_num_rows($not_friend_result));

            function add_friend_feature($friend_id, &$notification)
            {
                global $conn;
                $sql = "INSERT INTO myfriends (friend_id1, friend_id2) VALUES ({$_SESSION['friend_id']}, {$friend_id})";
                $unfriend_result = mysqli_query($conn, $sql);
                if (!$unfriend_result) {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                if ($unfriend_result) {
                    $notification[] = "<p>Unfriend successfully</p>";
                } else {
                    $notification[] = "<p>Unfriend failed</p>";
                }
            }
            ?>
            <h1 class="font-bold">
                <?php echo "$profile_name" ?>'s Friend List Page
            </h1>
            <h1>Total number of friends is
                <?php echo $number_of_friends ?>
            </h1>
            <?php
            if (mysqli_num_rows($not_friend_result) > 0) {
                echo "<table class='w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400'>";
                echo "<thead class='text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400'>";
                echo "<tr>
                <th scope='col' class='px-6 py-3'>
                    Profile Name
                </th>
                <th scope='col' class='px-6 py-3'>
                    Action
                </th>
                </tr>";
                echo "</thead>";
                foreach ($not_friend_result as $stranger) {
                    echo "<tr class='odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700'>";
                    echo "<td class='px-6 py-4'>{$stranger['profile_name']}</td>";
                    echo "<td class='px-6 py-4'>
                    <form method='POST' action='friendadd.php'>
                        <input type='hidden' name='friendId' value='{$stranger['friend_id']}'>
                        <input class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full'  type='submit' name='addfriend' value='Add as friend'>
                    </form>
                    </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>You don't have any friend</p> ";

            }
            
            echo "<div class='mt-4'>";
                if ($page_num > 1) {
                    echo "<a href='friendadd.php?page_num=" . ($page_num - 1) . "' class='mr-2'>Previous</a>";
                }
                if (mysqli_num_rows($not_friend_result) == $records_per_page) {
                    echo "<a href='friendadd.php?page_num=" . ($page_num + 1) . "'>Next</a>";
                }
                echo "</div>";
            ?>
            <a href="friendlist.php">Friend List</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>

</html>