<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Vacancy Information</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body>
    <h1>Job Vacancy Information</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="postjobform.php">Post job</a></li>
            <li><a href="searchjobform.php">Search job</a></li>
            <li><a href="about.php">About assignment</a></li>
        </ul>
    </nav>
    <?php
    require 'sanitiseInput.php';
    $filePath = '../../data/jobposts/jobs.txt';
    function validateCheckbox($value)
    {
        if (isset($value)) {
            return sanitiseInput(implode(', ', $value)) ;
        } else {
            return false;

        }
    }

    function validateLocation($value)
    {
        if ($value !== 'none') {
            return $value;
        } else {
            return false;
        }
    }

    if (isset($_GET['jobTitle']) && !empty($_GET['jobTitle'])) {
        $jobTitle = strtolower( sanitiseInput($_GET['jobTitle']));
        $position = isset($_GET['position']) ? $_GET['position'] : false;
        $contract = isset($_GET['contract']) ? $_GET['contract'] : false;
        $application = isset($_GET['application'])? validateCheckbox($_GET['application']) : false;
        $location = isset($_GET['location'])? validateLocation($_GET['location']) : false;

        if (!file_exists($filePath)) {
            echo "<p style='color: red'>No job posts found.</p>";
            return;
        }else{
            $handle = fopen($filePath, 'r');
            if ($handle) {
                echo "<table class='table-auto border-2'>";
                echo "<tr>
                        <th>Title</th>
                        <th>Position ID</th>
                        <th>Description</th>
                        <th>Closing Date</th>
                        <th>Position</th>
                        <th>Contract</th>
                        <th>Application By</th>
                        <th>Location</th>
                        </tr>";
                while (($line = fgets($handle)) !== false) {
                    $attributes = explode("\t", $line);
                    if ((isset($attributes[0]) && strpos(strtolower($attributes[0]), $jobTitle) !== false) && //using isset in case the field jobtitle is broken
                    (!$position || strpos($attributes[4], $position) !== false) &&
                    (!$contract || strpos($attributes[5], $contract) !== false) &&
                    (!$application || strpos($attributes[6], $application) !== false) &&
                    (!$location || strpos($attributes[7], $location) !== false))

                    {
                        echo "<tr>";
                        echo "<td class='border-2'>" . $attributes[0] . "</td>";
                        echo "<td class='border-2'>" . $attributes[1] . "</td>";
                        echo "<td class='border-2'>" . $attributes[2] . "</td>";
                        echo "<td class='border-2'>" . $attributes[3] . "</td>";
                        echo "<td class='border-2'>" . $attributes[4] . "</td>";
                        echo "<td class='border-2'>" . $attributes[5] . "</td>";
                        echo "<td class='border-2'>" . $attributes[6] . "</td>";
                        echo "<td class='border-2'>" . $attributes[7] . "</td>";
                        echo "</tr>";
                    }
                }
                echo "</table>";
                fclose($handle);
            }else{
                echo "<p style='color: red'>Error reading file.</p>";
            }

        }
    }else{
        echo "<p style='color: red'>Please provide the job title.</p>";
    }
    ?>
    <a href="searchjobform.php">Search for another job vacancy </a>
    <a href="index.php">Return to Home Page</a>

</body>
</html>