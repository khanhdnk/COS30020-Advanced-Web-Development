<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Vacancy Information</title>
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
    $filePath = '../../data/jobposts/jobs.txt';
    if (isset($_GET['jobTitle']) && !empty($_GET['jobTitle'])) {
        $jobTitle = $_GET['jobTitle'];
        if (!file_exists($filePath)) {
            echo "<p style='color: red'>No job posts found.</p>";
            return;
        }else{
            $handle = fopen($filePath, 'r');
            if ($handle) {
                echo "<table border='1'>";
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
                    if (isset($attributes[0]) && strpos($attributes[0], $jobTitle) !== false) {
                        echo "<tr>";
                        echo "<td>" . $attributes[0] . "</td>";
                        echo "<td>" . $attributes[1] . "</td>";
                        echo "<td>" . $attributes[2] . "</td>";
                        echo "<td>" . $attributes[3] . "</td>";
                        echo "<td>" . $attributes[4] . "</td>";
                        echo "<td>" . $attributes[5] . "</td>";
                        echo "<td>" . $attributes[6] . "</td>";
                        echo "<td>" . $attributes[7] . "</td>";
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