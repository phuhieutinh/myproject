<?php
require_once '../dbconnect.php';
include '../function/function_userlog.php';

session_start();

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
    $status_active = $_POST['status'];
    $status_connect = $_POST['status_connect'];

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
        $insert_serviceid = $value;
    }


    $array_newdata = implode(", ", $newarray);

    if ($update == 1) {
        $sql = "UPDATE monitor SET monitorCode='$monitorcode', monitorName='$monitorname', ipaddress='$ipaddress', monitorType='$monitortype', username='$username', monitorPassword='$monitorPassword', serviceID='$insert_serviceid', nameService='$array_newdata', monitorStatus='$status_active', statusConnect='$status_connect' WHERE monitorID=$monitorID";

        $log = "Update monitor Name success monitor Name is $monitorname";
        $update_userlog = userlog($log);
    } else {
        $sql = "INSERT INTO monitor(monitorID, monitorCode ,monitorName, ipaddress, monitorType, username, monitorPassword, serviceID, nameService, monitorStatus, statusConnect) VALUES('$monitorID', '$monitorcode','$monitorname', '$ipaddress', '$monitortype', '$username', '$monitorPassword', '$insert_serviceid', '$array_newdata', '$status_active', '$status_connect')";

        $log = "Add monitor Name success monitor Name is $monitorname";
        $update_userlog = userlog($log);
    }

    if (mysqli_query($conn, $sql)) {
        $message = "ADD OR UPDATE SUCCESSFUL !!!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script type='text/javascript'>
        window.location = '../dashboard/monitor.php';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
