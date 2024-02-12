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
    umask(0007);
    $dir = "../../data/jobposts";

    if (!file_exists($dir)) {
      mkdir($dir, 02770, true);
    }

    $file = '../../data/jobposts/jobs.txt';
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

    function validateRadio($value, $error)
    {
        if (!isset($value) || empty($value)) {
            echo "<p>$error</p>";
        } else {
            return $value;
        }
        return null;
    }

    function validateCheckbox($value, $error)
    {
        if (!isset($value) || empty($value)) {
            echo "<p>$error</p>";
        } else {
            return implode(', ', $value);
        }
        return null;
    }

    function validateSelection($value, $error)
    {
        if ($value === 'none' || empty($value)) {
            echo "<p>$error</p>";
        } else {
            return $value;
        }
        return null;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = validateInputField('title', $_POST['title'], '/^[\p{L}0-9 ,.!]{1,20}$/u', 'Title must only contain letters (maximum 20 characters), numbers, and spaces.');
        $positionID = validateInputField('position ID', $_POST['positionID'], '/^PID\d{4}$/', 'Position ID must be starts with "PID" and followed by 4 digits.');
        $description = validateInputField('description', $_POST['description'], '/^.{1,250}$/', 'Description must only contain letters (maximum 250 characters), numbers, and spaces.');
        $closingDate = validateInputField('closing date', $_POST['closingDate'], '/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/\d{2}$/', 'Closing date must be in the format "YYYY-MM-DD".');
        $position = validateRadio(isset($_POST['position'])? $_POST['position']:'', 'Position must be selected.');
        $contract = validateRadio(isset($_POST['contract'])? $_POST['contract']:'', 'Contract must be selected.');
        $application = validateCheckbox(isset($_POST['application'])? $_POST['application']: '', 'Application by must be selected with at least 1 option.');
        $location = validateSelection(isset($_POST['location'])?$_POST['location']:'', 'Location must be selected.');

        if (!$title || !$positionID || !$description || !$closingDate || !$position || !$contract || !$application || !$location) {
            echo "You are not passing the validation. Please try again.";
        }
        else{
            echo "this is legit";
            if (isPositionIdUnique($_POST['positionID'], $file)) {
                $record = "$title\t$positionID\t$description\t$closingDate\t$position\t$contract\t$application\t$location\n";
            } else {
                echo "this is not unique";
            }
        }
    }



    ?>
    <div class="lastnote">
        <p class="return"><a href="postjobform.php"><span>Back to Job Posting Page </span></a></p>
        <p class="return"><a href="index.php"><span>Back to Home</span></a></p>
    </div>








</body>

</html>