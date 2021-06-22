<?php
$user = "coba";
$pwd = "coba12";
if (isset($_POST['login'])) {
    $username = $_POST["user"];
    $password = $_POST["pass"];
    if ($username == $user && $password == $pwd) {
        header("location: index.php?pesan=login");
    } else {
        echo "<script>window.alert('Data Salah')</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login </title>
    <link href="assets/css/login.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="main">
        <img src="assets/images/user.svg" alt="#">
        <h1>Login</h1>

        <form method="POST" action="">
            <input type="text" name="user" placeholder="Username"><br>
            <input type="password" name="pass" placeholder="Password"><br>
            <button class="button" name="login">Login</button><br>
        </form><br>
    </div>
</body>

</html>