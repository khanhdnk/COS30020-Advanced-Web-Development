<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $filename = "../../data/lab05/guestbook.txt"; // Define the path to the guestbook file

    if (!file_exists($filename)) { // Check if the guestbook file doesn't exist
        echo "<p style='color:red'>Guestbook is empty!</p>"; // Display a message indicating that the guestbook is empty
        exit; // Exit the script
    } else {
        $handle = fopen($filename, "r"); // Open the guestbook file in read mode
        $data = ""; // Initialize an empty string to store guestbook entries
        while (!feof($handle)) { // Loop until the end of the file is reached
            $tmp = stripslashes(fgets($handle)); // Read a line from the file and remove slashes
            $data .= $tmp; // Append the line to the data string
        }
        echo "<p>Guest book entries:</p>
                  <pre>$data</pre>"; // Display the guestbook entries in a <pre> element
        fclose($handle); // Close the file handle
    }
    ?>
</body>

</html>
