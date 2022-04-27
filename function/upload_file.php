<?php
require_once '../dbconnect.php';

$conn = connect_db();

if (isset($_FILES['fileupload']) && isset($_POST['userid'])) {
    $userID = $_POST['userid'];

    $filename = $_FILES["fileupload"]["name"];
    $tempname = $_FILES["fileupload"]["tmp_name"];
    $folder = "../picture/avatar/" . $filename;

    $sql = "UPDATE user SET picture='$filename' WHERE userID = $userID";

    if (mysqli_query($conn, $sql)) {
        if (move_uploaded_file($tempname, $folder)) {
            header('location:../dashboard/info.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
