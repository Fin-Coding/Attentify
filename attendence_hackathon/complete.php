<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>

<?php
    if (isset($_GET["name"])) {
        $name = $_GET["name"];
        echo($name);
    }
?> 
<div>
    <h2>Log In</h2>
    <form action="login_process.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>    

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="submit">Log In</button>
    </form>
</div>


</body>
</html>