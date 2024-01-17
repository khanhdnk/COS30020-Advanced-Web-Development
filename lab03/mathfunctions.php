<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        function factorial($n)
        { // declare the factorial function
            $result = 1; // declare and initialise the result variable
            $factor = $n; // declare and initialise the factor variable
            while ($factor > 1) { // loop to multiple all factors until 1
                $result = $result * $factor;
                $factor--; // next factor
            } // Note that the factor 1 is not multiplied
            return $result;
        }
    ?>
</body>

</html>