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
            $sql = "SELECT * FROM friends WHERE email = '{$_SESSION['email']}'";
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
            $get_not_friends = "SELECT f.friend_id, f.profile_name FROM friends f WHERE f.friend_id != {$row['friend_id']} AND f.friend_id NOT IN ( SELECT mf.friend_id1 FROM myfriends mf WHERE mf.friend_id2 = {$row['friend_id']}) AND f.friend_id NOT IN ( SELECT mf.friend_id2 FROM myfriends mf WHERE mf.friend_id1 = {$row['friend_id']})";
            //excute query
            $not_friend_result = mysqli_query($conn, $get_not_friends);

            function add_friend_feature($friend_id)
            {
                global $conn;
                $sql = "DELETE FROM myfriends WHERE (friend_id1 = {$_SESSION['friend_id']} AND friend_id2 = {$friend_id}) OR (friend_id1 = {$friend_id} AND friend_id2 = {$_SESSION['friend_id']})";
                $unfriend_result = mysqli_query($conn, $sql);
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
                echo "<table>";
                foreach ($not_friend_result as $stranger) {
                    echo "<tr>";
                    echo "<td>{$stranger['profile_name']}</td>";
                    echo "<td>
                    <form method='POST' action='friendadd.php'>
                        <input type='hidden' name='friendId' value='{$stranger['friend_id']}'>
                        <input class='btn btn-outline-info' type='submit' name='addfriend' value='Add as friend'>
                    </form>
                    </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>You don't have any friend</p> ";

            }

            ?>
            <a href="addfriend.php">Add Friend</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>

</html>