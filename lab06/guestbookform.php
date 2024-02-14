<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lab06 Task 2 - Guestbook</h1>
    <form action="guestbooksave.php" method="POST">
        <fieldset>
            <legend><b>Enter your details to sign our guest book</b></legend>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name">
            <br>
            <br>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email">
            <br>
            <br>
            <input type="submit" value="Sign">
            <input type="reset" value="Reset Form">


        </fieldset>
    </form>
    <br>
    <a href="guestbookshow.php">View Guest Book</a>
</body>
</html>