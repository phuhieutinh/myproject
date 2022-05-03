<?php

function userlog($log)
{
    require_once '../dbconnect.php';

    $conn = connect_db();

    if (isset($_SESSION['userID'])) {

        $id = $_SESSION['userID'];
    }

    $userlogID = "SELECT max(id) + 1 FROM userlog";
    $IPaddress = $_SERVER['SERVER_ADDR'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $userlogTime = date('Y-m-d H:i:s');
    $userlogAction = $log;

    $insert_sql = "INSERT INTO userlog(userlogID ,userlogTime, IPaddress, userlogAction, userID) VALUES('$userlogID', '$userlogTime', '$IPaddress', '$userlogAction', '$id')";

    if (mysqli_query($conn, $insert_sql)) {
    } else {
        echo "Error: " . $insert_sql . "<br>" . mysqli_error($conn);
    }
}

function userlog_sub($log)
{
    require_once '../../dbconnect.php';

    $conn = connect_db();

    if (isset($_SESSION['userID'])) {

        $id = $_SESSION['userID'];
    }

    $userlogID = "SELECT max(id) + 1 FROM userlog";
    $IPaddress = $_SERVER['SERVER_ADDR'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $userlogTime = date('Y-m-d H:i:s');
    $userlogAction = $log;

    $insert_sql = "INSERT INTO userlog(userlogID ,userlogTime, IPaddress, userlogAction, userID) VALUES('$userlogID', '$userlogTime', '$IPaddress', '$userlogAction', '$id')";

    if (mysqli_query($conn, $insert_sql)) {
    } else {
        echo "Error: " . $insert_sql . "<br>" . mysqli_error($conn);
    }
}
