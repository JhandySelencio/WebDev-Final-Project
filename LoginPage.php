<?php

$is_invalid = false;

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $mysqli = require __DIR__ . "/Database.php";
    $sql = sprintf("SELECT * FROM users
                    WHERE username = '%s'",
                    $mysqli->real_escape_string($_POST["username"]));

    $result = $mysqli->query($sql);
    session_start();

    $user = $result->fetch_assoc();

    if($user){
        if($_POST["password"] == $user["password"]){
            session_start();
            $_SESSION["user_id"]=$user["id"];
            header("Location: Home Browser/HomePage.html");
        }
    }

    $is_invalid = true;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="LogInStyles.css">
      <title>Login Page</title>
  </head>
  <body>
    <div class="boxA">
        <?php if($is_invalid): ?>
            <em>Invalid Login</em>
        <?php endif; ?>
        <form method="post">
            <div class="miniBoxA">
                <h2>WELCOME BACK!</h2>
                <input type="text" placeholder="Username"  id="username" name="username"
                value="<?= htmlspecialchars($_POST["username"] ?? "") ?>">
                <input type="password" placeholder="Password"
                id="password" name="password">
                <input type="submit" name="submit" value="Login" id="inputButton">
            </div>
            <div class="miniBoxB">
                <h2>SIGN UP NOW</h2>
            </div>
            <div class="miniBoxC">
                <p>Login your username and password</p>
            </div>
            <div class="miniBoxD">
                <p>Don't have an account yet?
                 <a href="RegisterPage.html">Sign Up</a> now
                </p>
        </form>
    </div>
  </body>
</html>
