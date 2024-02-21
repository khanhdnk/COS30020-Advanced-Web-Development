<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">

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

    <form action="searchjobprocess.php" method="GET">
        <h1>Job Vacancy Posting System</h1>
        <label for="jobTitle" class="block text-gray-700 text-sm font-bold mb-2">Job Title</label>
        <input type="text" name="jobTitle" id="jobTitle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 w-60 h-10">
        <br>
        <span>Position:</span>
        <input type="radio" name="position" id="fullTime" value="Full Time" class="">
        <label for="position">Full Time</label>

        <input type="radio" name="position" id="partTime" value="Part Time" class="">
        <label for="position">Part Time</label>
        <br>
        <span>Contract:</span>
        <input type="radio" name="contract" id="Going" value="On-Going" class="">
        <label for="onGoing">On-going</label>

        <input type="radio" name="contract" id="fixedTerm" value="Fixed term" class="">
        <label for="fixedTerm">Fixed Term</label>
        <br>
        <span>Application by:</span>
        <input type="checkbox" name="application[]" id="post" value="Post" class="">
        <label for="post">Post</label>

        <input type="checkbox" name="application[]" id="mail" value="Mail" class="">
        <label for="mail">Mail</label>
        <br>
        <label for="location">Location:</label>
        <select id="location" name="location">
            <option value="none">---</option>
            <option value="act">ACT</option>
            <option value="nsw">NSW</option>
            <option value="nt">NT</option>
            <option value="qld">QLD</option>
            <option value="sa">SA</option>
            <option value="tas">TAS</option>
            <option value="vic">VIC</option>
            <option value="wa">WA</option>
        </select>
        <input type="submit" value="Search" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        <br>

    </form>
        <a href="index.php">Return to Home Page</a>
</body>

</html>