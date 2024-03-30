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
            <h1
                    class="h-14 text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-pink-500 to-blue-500 text-center mb-4 text-2xl font-extrabold leading-none tracking-tight  md:text-3xl lg:text-4xl dark:text-white">
                My friend system</h1>
            <!--            student's information-->
            <p><strong>Name:</strong> Dang Nam Khanh</p>
            <p><strong>Student ID:</strong> 104225661</p>
            <p><strong>Email:</strong> <a href="">104225661@student.swin.edu.au</a></p>
            <br>
            <p>I declare that this assignment is my individual work. I have not worked collaboratively nor have I copied
                from any other student’s work or from any other source.</p>
            <br>
            <?php
            require_once("settings.php");
            // Create connection
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
                //create the friends table
                $sql_create_first_table = "CREATE TABLE IF NOT EXISTS friends (
                    friend_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    friend_email VARCHAR(50) NOT NULL,
                    password VARCHAR(20) NOT NULL,
                    profile_name VARCHAR(30) NOT NULL,
                    date_started DATE NOT NULL,
                    num_of_friends INT UNSIGNED
                );";

                $result1 = mysqli_query($conn, $sql_create_first_table);
                if ($result1) {
                    echo "<p>Table 'friends' created successfully</p>";
                } else {
                    echo "<p>Table 'friends' creation failure." . mysqli_error($conn) . "</p>";
                }

                //create the myfriends table
                $sql_create_second_table = "CREATE TABLE IF NOT EXISTS myfriends (
                    friend_id1 INT NOT NULL,
                    friend_id2 INT NOT NULL
                );";


                $result2 = mysqli_query($conn, $sql_create_second_table);
                if ($result2) {
                    echo "<p>Table 'myfriends' created successfully</p>";
                } else {
                    echo "<p>Table 'myfriends' creation failure." . mysqli_error($conn) . "</p>";
                }

                //check if the friends tables have records
                $query_first_table = "SELECT * FROM friends";
                $result3 = mysqli_query($conn, $query_first_table);
                if ($result3) {
                    if (mysqli_num_rows($result3) > 0) {
                        echo "<p>Table 'friends' has records</p>";
                    } else {
                        //if the table has no records, add records to the table
                        $sql_add_friends = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends) VALUES
                            ('john@example.com', 'password123', 'John Doe', '2023-01-15', 25),
                            ('alice@example.com', 'alicepass', 'Alice Smith', '2023-02-28', 30),
                            ('bob@example.com', 'bobpassword', 'Bob Johnson', '2023-03-10', 20),
                            ('emily@example.com', 'emilypass', 'Emily Brown', '2023-04-05', 15),
                            ('chris@example.com', 'chrispass', 'Chris Wilson', '2023-05-20', 18),
                            ('sarah@example.com', 'sarahpass', 'Sarah Davis', '2023-06-11', 22),
                            ('michael@example.com', 'michaelpass', 'Michael Taylor', '2023-07-03', 27),
                            ('lisa@example.com', 'lisapass', 'Lisa Martinez', '2023-08-18', 35),
                            ('david@example.com', 'davidpass', 'David Anderson', '2023-09-22', 19),
                            ('jennifer@example.com', 'jenniferpass', 'Jennifer Rodriguez', '2023-10-09', 24);
                            ";
                        $result4 = mysqli_query($conn, $sql_add_friends);
                        if ($result4) {
                            echo "<p>Records added to 'friends' table successfully</p>";
                        } else {
                            echo "<p>Records addition to 'friends' table failure." . mysqli_error($conn) . "</p>";
                        }
                    }
                }
//                check if the myfriends table has records
                $query_second_table = "SELECT * FROM myfriends";
                $result5 = mysqli_query($conn, $query_second_table);
                if ($result5) {
                    if (mysqli_num_rows($result5) > 0) {
                        echo "<p>Table 'myfriends' has records</p>";
                    } else {
                        //if the table has no records, add records to the table
                        $sql_add_myfriends = "INSERT INTO myfriends (friend_id1, friend_id2) VALUES
                        (1,2),
                        (1,3),
                        (1,4),
                        (1,5),
                        (1,6),
                        (1,7),
                        (1,8),
                        (1,9),
                        (1,10),
                        (2,3),
                        (2,4),
                        (2,5),
                        (2,6),
                        (2,7),
                        (2,8),
                        (2,9),
                        (2,10),
                        (3,4),
                        (3,5),
                        (3,6),
                        (3,7),
                        (3,8),
                        (3,9);";
                        $result6 = mysqli_query($conn, $sql_add_myfriends);
                        if (!$result6) {
                            echo "<p>Records addition to 'myfriends' table failure." . mysqli_error($conn) . "</p>";
                        } else {
                            echo "<p>Records added to 'myfriends' table successfully</p>";
                        }
                    }
                }


            mysqli_close($conn);
            }


            ?>
            <a href="signup.php" class="underline text-blue-700 block mt-1 w-60">Sign up <span
                        class="text-xl ">&#x203A</span> </a>
            <a href="login.php" class="underline text-blue-700 block mt-1 w-60">Login <span
                        class="text-xl">&#x203A</span> </a>
            <a href="about.php" class="underline text-blue-700 block mt-1 w-60">About <span
                        class="text-xl">&#x203A</span> </a>

        </div>
    </div>
</body>

</html>