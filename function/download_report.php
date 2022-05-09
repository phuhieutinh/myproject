<?php
require_once '../dbconnect.php';

$conn = connect_db();

if (isset($_POST['export'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('progressID', 'customerName', 'sell-by-date', 'use-by-date', 'status', 'supplier', 'phone', 'email', 'Service', 'Prefix', 'Surfix'));

    $query = "SELECT * FROM progression ORDER BY progressID DESC";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
}
