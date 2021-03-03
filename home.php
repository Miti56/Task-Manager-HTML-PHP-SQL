<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

$errors = "";

// connect to database
$db = mysqli_connect("localhost", "root", "root", "usernames");
$name = $_SESSION['name'];
// insert a quote if submit button is clicked
if (isset($_POST['submit'])) {

    if (empty($_POST['task'])) {
        $errors = "You must fill in the task";
    }else{
        $user = $_SESSION['name'];
        $task = $_POST['task'];
        $time = $_POST['time'];
        $description = $_POST['description'];
        $query = "INSERT INTO tasks (task , time , description , user) VALUES ('$task','$time','$description','$name')";

        mysqli_query($db, $query);
        header('location: home.php');
    }
}

// delete task
if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];

    mysqli_query($db, "INSERT INTO tasks2 (id , task, time, description, user) VALUES ('$id', 'fix ', 'fix ', 'fix ','$name')");
    mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);


    header('location: home.php');
}
if (isset($_GET['del_task2'])) {
    $id = $_GET['del_task2'];

    mysqli_query($db, "DELETE FROM tasks2 WHERE id=".$id);


    header('location: home.php');
}

// select all tasks if page is visited or refreshed
$tasks = mysqli_query($db, "SELECT * FROM tasks");
$tasks2 = mysqli_query($db, "SELECT * FROM tasks2");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link href="styleHome.css" rel="stylesheet" type="text/css">
</head>
<div style="text-align: center;">
<body>
<div>
<div class="header">
    <h2>Home Page</h2>
</div>
    <p>Welcome back, <?=$_SESSION['name']?>!</p>
    <div class="imgcontainer">
        <img src="https://cdn.onlinewebfonts.com/svg/img_365985.png" alt="logo" class="logo">
    </div>
</div>

    <form method="post" action="home.php" class="input_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <?php if (isset($errors)) { ?>
            <p><?php echo $errors; ?></p>
        <?php } ?>
        <input type="text" placeholder="Enter task"name="task" class="task_input">
        <input type="text" placeholder="Enter description"name="description" class="description_input">
        <input type="datetime-local" name="time" class="time_input">
        </br>
        <button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
    </form>





<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "usernames";

$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tasks3 = mysqli_query($db, "SELECT id, task, description, time FROM tasks WHERE user= '$name'");


$taskOnly = "SELECT id, task, description, time FROM tasks WHERE user= '$name'";

$result = $conn->query($taskOnly);


$conn->close();
?>
<div class="heading">
    <h2>INDIVIDUAL TASKS</h2>
</div>

</div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Tasks</th>
        <th>Description</th>
        <th>Time</th>
        <th>Action</th>
    </tr>
    </thead>


    <?php $i = 1; while ($row = mysqli_fetch_array($tasks3)) { ?>
        <tr>
            <td class="task"> <?php echo $row['id']; ?> </td>
            <td class="task"> <?php echo $row['task']; ?> </td>
            <td class="time"> <?php echo $row['description']; ?> </td>
            <td class="time"> <?php echo $row['time']; ?> </td>

            <td class="delete">
                <a href="home.php?del_task=<?php echo $row['id'] ?>">x</a>
            </td>
        </tr>
        <?php $i++; } ?>

</table>
</div>


<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "usernames";

$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tasks4 = mysqli_query($db, "SELECT id, task, description, time FROM tasks2 WHERE user= '$name'");


$result = $conn->query($taskOnly);


$conn->close();
?>

<div class="heading">
    <h2>FINISHED TASKS</h2>
</div>
<div>
    <table>
        <thead>
        <tr>
        <tr>
            <th>ID</th>
            <th>Tasks</th>
            <th>Description</th>
            <th>Action</th>
        </tr>

        </tr>
        </thead>


        <?php $i = 1; while ($row = mysqli_fetch_array($tasks4)) { ?>
            <tr>
                <td class="task"> <?php echo $row['id']; ?> </td>
                <td class="task"> <?php echo $row['task']; ?> </td>
                <td class="time"> <?php echo $row['description']; ?> </td>
                <td class="delete">
                    <a href="home.php?del_task2=<?php echo $row['id'] ?>">x</a>
                </td>
            </tr>

            <?php $i++; } ?>

    </table>
</div>



<div style="text-align: center;">
    <a href="settings.php">
        <button>Go to settings</button>
    </a>
    <a href="logout.php">
        <button2>Logout</button2>
    </a>
    <div class="theme-switch-wrapper">
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
        </label>
        <em>Enable Dark Mode!</em>
    </div>
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
