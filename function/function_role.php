<?php
require_once '../dbconnect.php';
include '../function/function_userlog.php';

session_start();

$conn = connect_db();

if (isset($_POST['submit'])) {
    $update = $_POST['controlUpdate'];
    $roleID = $_POST['roleID'];
    $roleName = $_POST['roleName'];
    $descriptive = $_POST['descriptive'];
    $checkbox1 = $_POST['functionA'];

    $array_data = implode(",", $checkbox1);

    if ($update == 1) {
        $sql = "UPDATE role SET roleName='$roleName', descriptive='$descriptive', function='$array_data' WHERE roleID=$roleID";

        $log = "Update role success Role Name is $roleName";
        $update_userlog = userlog($log);
    } else {
        $sql = "INSERT INTO role(roleID ,roleName, descriptive, function) VALUES('$roleID', '$roleName', '$descriptive', '$array_data')";

        $log = "Add role success Role Name is $roleName";
        $update_userlog = userlog($log);
    }


    if (mysqli_query($conn, $sql)) {
        $message = "ADD OR UPDATE SUCCESSFUL !!!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script type='text/javascript'>
        window.location = '../dashboard/submenu/mrole.php';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
