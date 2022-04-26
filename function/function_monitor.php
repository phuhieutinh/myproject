<?php
require_once '../dbconnect.php';

$conn = connect_db();

if (isset($_POST['submit'])) {
    $update = $_POST['controlUpdate'];
    $monitorID = $_POST['monitorID'];
    $monitorcode = $_POST['monitorcode'];
    $monitorname = $_POST['monitorname'];
    $ipaddress = $_POST['ipaddress'];
    $monitortype = $_POST['monitortype'];
    $username = $_POST['username'];
    $monitorPassword = $_POST['monitorPassword'];
    $serviceID = $_POST['states'];

    $array_data = implode(",", $serviceID);

    $array = explode(",", $array_data);

    $newarray = array();
    foreach ($array as $value) {
        $sql_service = "SELECT * FROM service WHERE serviceID = $value";
        $query_service = mysqli_query($conn, $sql_service);
        if (mysqli_num_rows($query_service) > 0) {
            while ($row_service = mysqli_fetch_assoc($query_service)) {
                $serviceName = $row_service['serviceName'];
            }
            array_push($newarray, $serviceName);
        }
    }

    $array_newdata = implode(", ", $newarray);

    if ($update == 1) {
        $sql = "UPDATE monitor SET monitorCode='$monitorcode', monitorName='$monitorname', ipaddress='$ipaddress', monitorType='$monitortype', username='$username', monitorPassword='$monitorPassword', serviceID='1', nameService='$array_newdata' WHERE monitorID=$monitorID";
    } else {
        $sql = "INSERT INTO monitor(monitorID, monitorCode ,monitorName, ipaddress, monitorType, username, monitorPassword, serviceID, nameService) VALUES('$monitorID', '$monitorcode','$monitorname', '$ipaddress', '$monitortype', '$username', '$monitorPassword', '1', '$array_newdata')";
    }

    if (mysqli_query($conn, $sql)) {
        header('location:../dashboard/monitor.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
