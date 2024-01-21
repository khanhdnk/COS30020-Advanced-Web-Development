<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Job Vacancy Posting System</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="postjobform.php">Post job</a></li>
            <li><a href="searchjobform.php">Search job</a></li>
            <li><a href="about.php">About assignment</a></li>
        </ul>
    </nav>

    <?php
    function validateInputField($name, $value, $pattern, $error)
    {
        if (!isset($value) || empty($value)) {
            echo "<p>Please provide the $name.</p>";
        } else if (!preg_match($pattern, $value)) {
            echo "<p>$error</p>";
        } else {
            return $value;
        }
        return null;
    }

    function isPositionIdUnique($positionId, $pathToFile)
    {
        // If the file doesn't exist, we can assume the position ID is unique
        if (!file_exists($pathToFile)) {
            echo"this is not exist";
            return true;
        }

        $fileHandle = fopen($pathToFile, 'r');

        // If the file couldn't be opened, throw an exception
        if (!$fileHandle) {
            throw new Exception("Unable to open file: $pathToFile");
        }

        while (($line = fgets($fileHandle)) !== false) {
            $attributes = explode("\t", $line);
            $existingPositionId = isset($attributes[0]) ? trim($attributes[0]) : null;

            if ($existingPositionId === $positionId) {
                fclose($fileHandle);
                return false; // Position ID already exists
            }
        }

        fclose($fileHandle);
        return true; // Position ID is unique
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = validateInputField('title', $_POST['title'], '/^[\p{L}0-9 ,.!]{1,20}$/u', 'Title must only contain letters (maximum 20 characters), numbers, and spaces.');
        if (!$title) {
            echo "this is null";
        }
        if (isPositionIdUnique($_POST['positionID'], 'jobposts/jobs.txt')) {
            echo "this is unique";
        } else {
            echo "this is not unique";
        }
    }



    ?>
    <div class="lastnote">
        <p class="return"><a href="postjobform.php"><span>Back to Job Posting Page </span></a></p>
        <p class="return"><a href="index.php"><span>Back to Home</span></a></p>
    </div>








</body>

</html>