<?php
require_once '../dbconnect.php';
include '../function/function_userlog.php';

session_start();

$conn = connect_db();

if (isset($_FILES['fileupload']) && isset($_POST['userid'])) {
    $userID = $_POST['userid'];

    $filename = $_FILES["fileupload"]["name"];
    $tempname = $_FILES["fileupload"]["tmp_name"];
    $folder = "../picture/avatar/" . $filename;

    $sql = "UPDATE user SET picture='$filename' WHERE userID = $userID";

    if (mysqli_query($conn, $sql)) {
        if (move_uploaded_file($tempname, $folder)) {
            $log = "Upload file success File Name is $filename";
            $update_userlog = userlog($log);

            $message = "ADD OR UPDATE SUCCESSFUL !!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script type='text/javascript'>window.location = '../dashboard/info.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
