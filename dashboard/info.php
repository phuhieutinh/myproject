<?php
require_once '../dbconnect.php';

$conn = connect_db();

if (isset($_GET['id'])) {
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM user where userID = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        
        $row = mysqli_fetch_assoc($result);
        $userID = $id;
        $Name = $row['name'];
        $username = $row['username'];
        $phone = $row['phone'];
        $pw = $row['pw'];
        $email = $row['email'];
        $role = $row['role'];
        $picture = $row['picture'];
    }
 else {
    echo "0 results";
    exit;
}
echo $userID . $username;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="../css/dashboard.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
    if(isset($_SESSION['admin_login'])){
    ?>
    <ul>
        <img src="../picture/Logo alta.png" alt="logo" class="logo">
        <li><a href="" class="dashboard"><img src="../picture/component/dashboard.png" alt="dashboard">
                Dashboard</a>
        </li>
        <li><a href="" class="monitor"><img src="../picture/component/monitor.png" alt="monitor">Thiết bị</a></li>
        <li><a href="" class="service"><img src="../picture/component/service.png" alt="service">Dịch vụ</a></li>
        <li><a href="" class="progression"><img src="../picture/component/progression.png" alt="progression">Cấp
                số</a>
        </li>
        <li><a href="" class="report"><img src="../picture/component/report.png" alt="report">Báo cáo</a></li>

        <li><a href="" class="setting"><img src="../picture/component/setting.png" alt="setting">Cài đặt hệ
                thống<img src="../picture/component/dropdown.png" alt="dropdown"></a>
            <ul class="submenu">
                <li>
                    <a href="#">Quản lý vai trò</a>
                </li>
                <li>
                    <a href="#">Quản lý tài khoản</a>
                </li>
                <li>
                    <a href="#">Nhật ký người dùng</a>
                </li>
            </ul>
        </li>

        <li><a href="../logout.php" class="logout"><img src="../picture/component/logout.png" alt="logout">Đăng xuất</a>
        </li>
    </ul>

    <header>
        <p class="topbar">Thông tin cá nhân</p>
        <img src="../picture/component/nofication.png" alt="nofication" class="nofication">
        <a href="info.php">
            <div id="info">
                <p class="hello">xin chào</p>
                <p class="header username">Lê Quỳnh Aí Vân</p>
                <img src="../picture/myself.png" alt="smallpicture" class="picinfo">
            </div>
        </a>
    </header>

    <main>
        <div id="pic">
            <div>
                <img src="../picture/component/camera.png" alt="iconcamera" class="iconcamera">
            </div>
            <p class="main username">Lê Quỳnh Aí Vân</p>
        </div>

        <div id="detail">
            <div class="name">
                <label for="name">Tên người dùng</label>
                <input type="text" name="name" placeholder="Lê Quỳnh Aí Vân" class="fix" readonly>
            </div>
            <div class="phone">
                <label for="phone">Số điện thoại</label>
                <input type="text" name="phone" placeholder="0767375921" class="fix" readonly>
            </div>
            <div class="email">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="adminSS01@domain.com" class="fix" readonly>
            </div>
            <div class="username">
                <label for="username">Tên đăng nhập</label>
                <input type="text" name="username" placeholder="lequynhhaivan01" class="fix" readonly>
            </div>
            <div class="password">
                <label for="password">mật khẩu</label>
                <input type="text" name="password" placeholder="123123" class="fix" readonly>
            </div>
            <div class="role">
                <label for="role">vai trò</label>
                <input type="text" name="role" placeholder="Kế Toán" class="fix" readonly>
            </div>
        </div>
    </main>
    <?php
    }else if(isset($_SESSION['user_login'])){
        header("location:index.php?id=$userID");
    }else{
        header("location:index.php");
    }
    ?>
    <script src="../js/dashboard.js"></script>
</body>

</html>