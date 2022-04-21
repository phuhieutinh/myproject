<?php
require_once '../dbconnect.php';

$conn = connect_db();

if (isset($_POST['submit'])) {
    $update = $_POST['controlUpdate'];
    $roleID = $_POST['roleID'];
    $roleName = $_POST['roleName'];
    $descriptive = $_POST['descriptive'];

    if ($update == 1) {
        $sql = "UPDATE role SET roleName='$roleName', descriptive='$descriptive' WHERE roleID=$roleID";
    } else {
        $sql = "INSERT INTO role(roleID ,roleName, descriptive) VALUES('$roleID', '$roleName', '$descriptive')";
    }


    if (mysqli_query($conn, $sql)) {
        header('location:../dashboard/submenu/mrole.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}