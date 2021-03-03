<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'usernames';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT username FROM accountsManager ');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Settings Page</title>
    <link href="styleSettings.css" rel="stylesheet" type="text/css">

</head>
<body class="loggedin">
<div style="text-align: center;">
    <div class="header">
    <h2>Profile Page</h2>
    </div>
    <div class="imgcontainer">
        <img src="https://cdn.onlinewebfonts.com/svg/img_365985.png" alt="logo" class="logo">
    </div>
    <div>
        <p>Your account details are below:</p>

        <td>Username:</td>
        <td><?=$_SESSION['name']?></td>
        </br>
        <div class="theme-switch-wrapper">
            <label class="theme-switch" for="checkbox">
                <input type="checkbox" id="checkbox" />
                <div class="slider round"></div>
            </label>
            <em>Enable Dark Mode!</em>
            </br>
            <a href="logout.php">
                <button>Logout</button>
            </a>
            <a href="home.php">
                <button2>Go back</button2>
            </a>
            </br>
    </div>
</div>
<script>
    const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');

    function switchTheme(e) {
        if (e.target.checked) {
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark'); //add this
        }
        else {
            document.documentElement.setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light'); //add this
        }
    }

    toggleSwitch.addEventListener('change', switchTheme, false);

    const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;

    if (currentTheme) {
        document.documentElement.setAttribute('data-theme', currentTheme);

        if (currentTheme === 'dark') {
            toggleSwitch.checked = true;
        }
    }

</script>
</body>
</html>