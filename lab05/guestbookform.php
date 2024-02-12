<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Lab05 Task 2 - Guestbook</h1>

    <form action="guestbooksave.php" method="Post">
        <fieldset>
            <legend><b>Enter your details to sign our guest book</b></legend>
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname">
            <br>
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname">
            <br>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
    <a href="guestbookshow.php">Show Guest Book</a>
</body>

</html>