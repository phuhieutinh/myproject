<?php
require_once '../dbconnect.php';

session_start();

$conn = connect_db();

$query = "SELECT * FROM user";
$data = mysqli_query($conn, $query);
if (mysqli_num_rows($data) > 0) {
    while ($row = mysqli_fetch_assoc($data)) {
        $userid = $row['userID'];
        $Name = $row['name'];
        $username = $row['username'];
        $phone = $row['phone'];
        $email = $row['email'];
        $roleID = $row['roleID'];
        $status = $row['status'];

        $array = array();
        for ($x = 1; $x <= $userid; $x++) {
            array_push($array, $x);
        }
    }
}

print_r($array);
echo "</br>";
// $array = [1, 2, 3, 4, 5];
function addPrefixToArray(array $array, string $prefix)
{
    return array_map(function ($arrayValues) use ($prefix) {
        return $prefix . $arrayValues;
    }, $array);
}

function addSuffixToArray(array $array, string $suffix)
{
    return array_map(function ($arrayValues) use ($suffix) {
        return $arrayValues . $suffix;
    }, $array);
}

print_r(addPrefixToArray($array, 'prefix'));
echo "</br>";
print_r(addSuffixToArray($array, 'suffix'));