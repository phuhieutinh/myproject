<?php
require_once '../dbconnect.php';

session_start();

$conn = connect_db();

if (isset($_SESSION['admin_login'])) {

    if (isset($_SESSION['userID'])) {

        $id = $_SESSION['userID'];
        $sql = "SELECT * FROM user where userID = '$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $userID = $id;
            $name = $row['name'];
        } else {
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
    <title>Dashboard</title>
    <link href="../css/dashboard.css" rel="stylesheet">
</head>

<body>
    <header>
        <div id="topbar">
            <p class="">Cấp số</p>
            <img src="../picture/component/u_angle-right.png" alt="" class="angle">
            <p class="topbar">Danh sách cấp số</p>
        </div>
        <img src="../picture/component/nofication.png" alt="nofication" class="nofication">
        <a href="info.php">
            <div id="info">
                <p class="hello">xin chào</p>
                <p class="header username"><?php echo $name ?></p>
                <img src="../picture/myself.png" alt="smallpicture" class="picinfo">
            </div>
        </a>
    </header>

    <div>
        <p class="monitortext">Quản lý cấp số</p>

        <div class="search">
            <p>Từ khóa</p>
            <input type="text" name="search" placeholder="Nhập từ khóa">
            <img src="../picture/component/search.png" alt="search">
        </div>

        <a href="" class="add">
            <img src="../picture/component/add-square.png" alt="">
            <p>Cấp số mới</p>
        </a>
    </div>

    <ul>
        <img src="../picture/Logo alta.png" alt="logo" class="logo">
        <li><a href="../dashboard/index.php" class="dashboard"><img src="../picture/component/dashboard.png"
                    alt="dashboard">
                Dashboard</a>
        </li>
        <li><a href="../dashboard/monitor.php" class="monitor"><img src="../picture/component/monitor.png"
                    alt="monitor">Thiết
                bị</a></li>
        <li><a href="../dashboard/service.php" class="service"><img src="../picture/component/service.png"
                    alt="service">Dịch vụ</a></li>
        <li><a href="" id="progression"><img src="../picture/component/progression.png" alt="progression">Cấp
                số</a>
        </li>
        <li><a href="../dashboard/report.php" class="report"><img src="../picture/component/report.png" alt="report">Báo
                cáo</a></li>

        <li class="setting"><a href="" class="setting"><img src="../picture/component/setting.png" alt="setting">Cài đặt
                hệ
                thống<img src="../picture/component/dropdown.png" alt="dropdown"></a>
            <ul class="submenu">
                <li>
                    <a href="../dashboard/submenu/mrole.php">
                        <p class="submenu">Quản lý vai trò</p>
                    </a>
                </li>
                <li>
                    <a href="../dashboard/submenu/maccount.php">
                        <p class="submenu">Quản lý tài khoản</p>
                    </a>
                </li>
                <li>
                    <a href="../dashboard/submenu/userlog.php">
                        <p class="submenu">Nhật ký người dùng</p>
                    </a>
                </li>
            </ul>
        </li>

        <li><a href="../logout.php" class="logout"><img src="../picture/component/logout.png" alt="logout">Đăng
                xuất</a>
        </li>
    </ul>

    <main id="mainmonitor">
        <table style="width:100%" class="tablemonitor">
            <tr>
                <th>STT</th>
                <th>Tên khách hàng</th>
                <th>Tên dịch vụ</th>
                <th>Thời gian cấp</th>
                <th>Hạn sử dụng</th>
                <th>Trạng thái</th>
                <th>Nguồn cấp</th>
                <th></th>
            </tr>
            <tr>
                <td>Alfreds</td>
                <td>Maria Anders</td>
                <td>Germany</td>
                <td>Alfreds Futterkiste</td>
                <td>Maria Anders</td>
                <td>Germany</td>
                <td>Maria Anders</td>
                <td>Germany</td>
            </tr>
        </table>
    </main>
    <?php
} else if (isset($_SESSION['user_login'])) {
    header("location:../user/index.php");
} else {
    header("location:../index.php");
}
    ?>
    <script src="../js/dashboard.js"></script>
</body>

</html>