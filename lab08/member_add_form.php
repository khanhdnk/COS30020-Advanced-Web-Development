<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="member_add.php" method="post">
        <h1>Add New Member</h1>
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" required><br>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" required><br>

        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="phone">Phone number:</label>
        <input type="text" id="phone" name="phone" required><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>