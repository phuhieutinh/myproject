<?php
function connect_db()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "system";

    // create connection
    $conn = mysqli_connect($servername, $username, $password, $db);

    // check conection
    if (!$conn) {
        die("Connection failed" . mysqli_connect_error());
    }
    return $conn;
}
