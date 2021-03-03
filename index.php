<html>
<head>
    <title> Login page </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="stylelogin.css">
</head>
<body>
<div style="text-align: center;">
    <div class="header">
        <h2>Welcome to your Task Manager Online</h2>
    </div>


    <form action="authenticate.php" method="post">
    <div class="imgcontainer">
        <img src="https://media.wired.com/photos/5ae0d5ae3f3b183561144216/master/pass/google-tasks.jpg" alt="logo" class="logo">
    </div>

    <div class="container">
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" id = "username" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" id="password" required>


        <a type="submit" name="login" value="LOGIN">
            <button>Login</button>
        </a>
    </div>
        <br/>
        <a href="registration.php">
            <button2>New User?</button2>
        </a>



</form>
    <label class="theme-switch" for="checkbox" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="checkbox" id="checkbox" />
    </label>
    <em>Enable Dark Mode!</em>

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
</div>
</body>
</html>


