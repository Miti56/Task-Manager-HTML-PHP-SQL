<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'usernames';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
    // Could not get the data that should have been sent.
    exit('Please fill both the username and password fields!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
$name = $_POST['username'];
$pwd = $_POST['password'];
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT password FROM accountsManagerSalt WHERE username = ?')) {
    // Bind parameters, in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        $salt = bin2hex(openssl_random_pseudo_bytes(5));
        $query = "SELECT * from accountsManagerSalt WHERE username = '" . $name . "'";

        if (isset($name) and isset($pwd)) {
            require "connect.php";
            require "pepper.php";
            $connection = new mysqli(host, username, password, database, port);

            $salt = bin2hex(openssl_random_pseudo_bytes(5));
            $sql = "SELECT * from accountsManagerSalt WHERE username = '" . $name . "'";
            $result = $connection->query($sql);
            $user = $result->fetch_assoc();
            //Might be vulnerable to timing attacks
            if (md5($pwd . $user["salt"] . pepper) === $user["password"]) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $_POST['username'];
                header('Location: home.php');
            } else {
                echo "wrong password";
            }

        }
    } else {
        header('Location: redirectCREATE.html');
    }
    $connection->close();
}
?>


