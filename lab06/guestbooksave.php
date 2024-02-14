<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lab06 Task 2 - Guestbook</h1>
    <h2>Sign Guestbook</h2>
    <hr>
    <?php
    umask(0007); // Set the mask to ensure file permissions are correctly set when creating the directory and file
    $dir = "../../data/lab06"; // Define the directory path
    if (!file_exists($dir)) {
        mkdir($dir, 02770); // Create the directory if it doesn't exist
    }
    $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'; // Define the regex pattern for email validation
    if (isset($_POST['name']) && isset($_POST['email']) && !empty($_POST['name']) && !empty($_POST['email'])) { // Check if name and email are set and not empty
        $name = $_POST['name']; // Get the name from the form
        $email = $_POST['email']; // Get the email from the form
        if (preg_match($emailPattern, $email)) { // Validate the email
            $fileName = '../../data/lab06/guestbook.txt'; // Define the file name
            $nameData = array(); // Initialize an array to store names
            $emailData = array(); // Initialize an array to store emails
            if (file_exists($fileName)) { // Check if the file exists
                $handle = fopen($fileName, 'r'); // Open the file in read mode
                while (!feof($handle)) { // Loop through the file until the end
                    $line = fgets($handle); // Get a line from the file
                    if (!empty($line)) { // Check if the line is not empty
                        $user = explode(',', $line); // Split the line into an array
                        $nameData[] = $user[0]; // Add the name to the name array
                        $emailData[] = trim($user[1]); // Add the email to the email array
                    }
                }
                fclose($handle); // Close the file
            }
            if (in_array($name, $nameData) || in_array($email, $emailData)) { // Check if the name and email already exist in the arrays
                echo "<p style='color:red'>You have already signed our guest book!</p>"; // Display a message
            } else {
                $handle = fopen($fileName, 'a'); // Open the file in append mode
                fwrite($handle, $name . ',' . $email . "\n"); // Write the name and email to the file
                fclose($handle); // Close the file
                echo "<p style='color:green'>Thank you for signing our guest book:</p>"; // Display a message
                echo "<p><b>Name:</b> $name</p>"; // Display the name
                echo "<p><b>Email:</b> $email</p>"; // Display the email

            }
        } else {
            echo "<p style='color:red'>Email address is not valid.</p>"; // Display a message if the email is not valid
        }
    } else {
        echo "<p style='color:red'>You must enter your name and email address!<br>Use the Browser's 'Go Back' button to return to the Guestbook form.</p>"; // Display a message if the name or email is not set
    }
    echo '<p><a href="guestbookform.php">Add Another Visitor</a><br><a href="guestbookshow.php">View Guest Book</a></p>'; // Display links to add another visitor and view the guest book
    ?>
</body>
</html>
