<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body>

<?php
    if (isset($_GET["result"])) {
        if ($_GET["result"] == "emptyinput") {
            echo "<div class='alert-error'><p>Error: Empty Field</p><</div>";
        }
        else if ($_GET["result"] == "emailincorrect") {
            echo "<div class='alert-error'><p>Error: Email Incorrect</p></div>";

        }
        else if ($_GET["result"] == "passwordincorrect") {
            echo "<div class='alert-error'><p>Error: Password Incorrect</p></div>";
        }
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