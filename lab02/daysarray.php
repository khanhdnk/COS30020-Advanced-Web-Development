<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //Print days in Eng
        $days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        echo "<p>The days of the week in English are:</p>";
        echo "<p>";
        $lastIndexOfArray = count($days) - 1;
        foreach($days as $i => $day){
            if($i == $lastIndexOfArray) {
                echo $day . ".";
            } else {
                echo $day . ", ";
            }
        }
        echo "</p>";

        //reassigning the values of the array
        $daysInFrench = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
        foreach($days as $i => &$day){
            $day = $daysInFrench[$i];
        }
        //Print days in French
        echo "<p>The days of the week in French are:</p>";
        echo "<p>";
        foreach($days as $i => $day){
            if($i == $lastIndexOfArray) {
                echo $day . ".";
            } else {
                echo $day . ", ";
            }
        } 
        echo "</p>";
        
    ?>
</body>
</html>
