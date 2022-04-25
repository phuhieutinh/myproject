<?php
require_once '../dbconnect.php';

session_start();

$conn = connect_db();

$array = array("value1", "value2", "value3", "valuen");
$array_data = implode("array_separator", $array);

$query = "INSERT INTO test (testID, array) VALUES(NULL,'" . $array_data . "');";

if (mysqli_query($conn, $query)) {
    echo "update successfully <a href=''>Back to page</a>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$query = "SELECT * FROM test WHERE array LIKE '%value3%'";
$array = explode("array_separator", $array_data);
if (mysqli_query($conn, $query)) {
    print_r($array);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
