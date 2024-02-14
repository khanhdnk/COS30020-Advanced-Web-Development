<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Lab05 Task 2 - Guestbook</h1>

    <?php
    umask(0007); // Set the umask to ensure proper permissions for directory creation
    $dir = "../../data/lab05"; // Define the directory path for storing guestbook data
    if (!file_exists($dir)) { // Check if the directory doesn't exist
        mkdir($dir, 02770); // Create the directory with proper permissions if it doesn't exist
    }
    if (isset($_POST['firstname']) && isset($_POST['lastname'])) { // Check if both first name and last name are set in the POST data
        $firstname = $_POST['firstname']; // Retrieve the value of the first name from the form
        $lastname = $_POST['lastname']; // Retrieve the value of the last name from the form
        $filename = "$dir/guestbook.txt"; // Define the path for the guestbook file
        $handle = fopen($filename, "a"); // Open the file in append mode
        fwrite($handle, $firstname . ", " . $lastname . "\n"); // Write the first name and last name to the file, separated by a comma and a space
        fclose($handle); // Close the file handle
        echo "<p style='color:green'>Thank you for signing our guest book!</p>"; // Display a success message in green
    } else {
        echo "<p style='color:red'><b>You must enter your first and last name!
        <br>
        Use the Browser's 'Go Back' button to return to the Guestbook form.</b></p>"; // Display a warning message in red if first name or last name is missing
    }
    ?>
    <a href="guestbookshow.php">Show Guest Book</a> <!-- Provide a link to show the guest book -->
</body>

</html>
