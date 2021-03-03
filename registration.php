<html>
<head>
    <title> Registration Form </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styleLogin.css">
</head>
<body>
<div style="text-align: center;">
    <div class="header">
        <h2>Registration Form</h2>
    </div>

    <form action="server.php" method="post">
        <div class="imgcontainer">
            <img src="https://cdn3.iconfinder.com/data/icons/basicolor-essentials/24/055_add_new_user-512.png" alt="logo" class="logo">
        </div>

        <div class="container">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" id = "username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required>

            <a type="submit" name="login" value="LOGIN">
                <button>Register</button>
            </a>
            <a href="index.php">
                <button2>Go back</button2>
            </a>
        </div>
    </form>

    <div class="theme-switch-wrapper">
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
        </label>
        <em>Enable Dark Mode!</em>
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
