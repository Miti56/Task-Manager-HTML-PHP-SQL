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
// REGISTER USER
if ($stmt = $con->prepare('SELECT password FROM accountsManagerSalt WHERE username = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        header('Location: redirectLOGIN2.html');
    }  else {
        require "pepper.php";
        $username = $_POST['username'];
        $password = $_POST['password'] ;
        $salt = bin2hex(openssl_random_pseudo_bytes(5));
        $query = "INSERT INTO accountsManagerSalt (`username`, `password`, `salt`) VALUES ('" . $username . "', '" . md5($password.$salt.pepper) . "', '" . $salt . "')";
        mysqli_query($con, $query);

        header('Location: redirectLOGIN.html');
        }
    }

