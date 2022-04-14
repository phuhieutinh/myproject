<?php
require_once '../dbconnect.php';

session_start();

$conn = connect_db();

if(isset($_SESSION['user_login'])){

    if (isset($_SESSION['userID'])) {
    
        $id = $_SESSION['userID'];
        $sql = "SELECT * FROM user where userID = '$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            
            $row = mysqli_fetch_assoc($result);
            $userID = $id;
            $name = $row['name'];
        }
     else {
        echo "0 results";
        exit;
    }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../css/user.css" rel="stylesheet">
</head>

<body>

    <img src="../picture/Logo alta.png" alt="logo" class="logo">
    <h1>Cài đặt thiết bị KIO_01</h1>
    <a href="../logout.php" class="logout"><img src="../picture/component/logout.png" alt="logout">
        <p class="logout">Log out</p>
    </a>
    <a href="" class="setting"><img src="../picture/component/settinguser.png" alt="setting" class="setting">
        <p class="setting">Cài đặt</p>
    </a>
    <main id="container">
        <p class="text setting">Vị trí thiết bị kết nối</p>

        <select name="" id="dropdown">
            <option value="" selected="selected">Quầy dịch vụ số 1</option>
            <option value="" class="">Tất cả</option>
            <option value="" class="">Khám tim mạch</option>
            <option value="" class="">Khám mắt</option>
            <option value="" class="">Khám tổng quát</option>
        </select>

        <p class="text setting set2">Số thứ tự hiển thị của dịch vụ</p>
    </main>



    <?php
    }else if(isset($_SESSION['admin_login'])){
        header("location:../dashboard/index.php");
    }else{
        header("location:../index.php");
    }
    ?>
</body>

</html>