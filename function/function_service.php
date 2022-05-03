<?php
require_once '../dbconnect.php';
include '../function/function_userlog.php';

session_start();

$conn = connect_db();

if (isset($_POST['submit'])) {
    $update = $_POST['controlUpdate'];
    $serviceID = $_POST['serviceID'];
    $serviceName = $_POST['servicename'];
    $descriptive = $_POST['descriptive'];
    $serviceStatus = $_POST['status'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $serviceDate = date('Y-m-d H:i:s');

    if ($update == 1) {
        $sql = "UPDATE service SET serviceName='$serviceName', descriptive='$descriptive', serviceDate='$serviceDate', serviceStatus = '$serviceStatus' WHERE serviceID=$serviceID";

        $log = "Update service success Service Name is $serviceName";
        $update_userlog = userlog($log);
    } else {
        $sql = "INSERT INTO service(serviceID ,serviceName, descriptive, serviceStatus, serviceDate) VALUES('$serviceID', '$serviceName', '$descriptive', '$serviceStatus', '$serviceDate')";

        $log = "Add service success Service Name is $serviceName";
        $update_userlog = userlog($log);
    }
    echo 'hello';


    if (mysqli_query($conn, $sql)) {
        header('location:../dashboard/service.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
