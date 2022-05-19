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
    $auto_start = $_POST['auto_start'];

    if (isset($_POST['prefix_check']) || isset($_POST['surfix_check'])) {
        $prefix = $_POST['prefix'];
        $surfix = $_POST['surfix'];
    } else {
        $prefix = null;
        $surfix = null;
    }

    if ($update == 1) {
        $sql = "UPDATE service SET serviceName='$serviceName', descriptive='$descriptive', serviceDate='$serviceDate', serviceStatus = '$serviceStatus', prefix_id='$prefix', surfix_id='$surfix', stt_service='$auto_start' WHERE serviceID=$serviceID";

        $stt_result_service = mysqli_query($conn, "DELETE FROM progression WHERE serviceID=$serviceID");

        $log = "Update service success Service Name is $serviceName";
        $update_userlog = userlog($log);
    } else {
        $sql = "INSERT INTO service(serviceID ,serviceName, descriptive, serviceStatus, serviceDate, prefix_id, surfix_id, stt_service) VALUES('$serviceID', '$serviceName', '$descriptive', '$serviceStatus', '$serviceDate', '$prefix', '$surfix', '$auto_start')";

        $log = "Add service success Service Name is $serviceName";
        $update_userlog = userlog($log);
    }

    if (mysqli_query($conn, $sql)) {
        header('location:../dashboard/service.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
