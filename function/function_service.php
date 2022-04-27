<?php
require_once '../dbconnect.php';

$conn = connect_db();

if (isset($_POST['submit'])) {
    $update = $_POST['controlUpdate'];
    $serviceID = $_POST['serviceID'];
    $serviceName = $_POST['servicename'];
    $descriptive = $_POST['descriptive'];
    $serviceStatus = "Hoạt động";

    if ($update == 1) {
        $sql = "UPDATE service SET serviceName='$serviceName', descriptive='$descriptive' WHERE serviceID=$serviceID";
    } else {
        $sql = "INSERT INTO service(serviceID ,serviceName, descriptive, serviceStatus) VALUES('$serviceID', '$serviceName', '$descriptive', '$serviceStatus')";
    }
    echo 'hello';


    if (mysqli_query($conn, $sql)) {
        header('location:../dashboard/service.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
