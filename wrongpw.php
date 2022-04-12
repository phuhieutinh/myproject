<?php
require_once 'dbconnect.php';

$conn = connect_db();

session_start();

if(isset($_POST["username"])&&isset($_POST["password"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    echo $username . "</br>" . $password . "</br>";
    
    if($username && $password){
        $sql = "SELECT * FROM user WHERE username = '$username' AND pw = '$password'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) == 0){
            header("location: wrongpw.php");
        }else{
            header("location: dashboard/info.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link href="css/login.css" rel="stylesheet">
</head>

<body>
    <img src="picture/Logo alta.png" alt="logo" class="logo">
    <main>

    </main>
    <div class="login">
        <img src="picture/Group 341.png" alt="pic" class="pic">
        <p class="system">Hệ Thống</p>
        <p class="manage">Quản Lý Xếp Hàng</p>

    </div>
    <form action="index.php" method="POST">
        <div class="username">
            <label for="username" class="username">Tên Đăng Nhập *</label>
            <input type="text" name="username" class="namewrongpw">
        </div>
        <div class="pw">
            <label for="password" class="pw">Mật Khẩu *</label>
            <input type="password" name="password" class="wrongpw">
        </div>
        <div class="wrongpw">
            <img src="picture/component/warming.png" alt="wrongpw" class="wrongpw">
            <p class="wrongpw">Sai mật khẩu hoặc
                tên
                đăng
                nhập</p>
        </div>
        <button type="submit" name="login" class="login">Đăng nhập</button>
    </form>
    <a href="login/forget.php" class="forgetwrongpw">Quên mật khẩu?</a>

</body>

</html>