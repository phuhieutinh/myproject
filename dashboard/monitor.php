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
    <header class="monitor">
        <div id="topbar">
            <p class="">Thiết bị</p>
            <img src="../picture/component/u_angle-right.png" alt="" class="angle">
            <p class="topbar">Danh sách thiết bị</p>
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
        <p class="monitortext">Danh sách thiết bị</p>
        <div class="activedropdown">
            <p>Trạng thái hoạt động</p>
            <select name="" id="activedropdown">
                <option value="" selected="selected">Tất cả</option>
                <option value="">Hoạt động</option>
                <option value="">Ngưng hoạt động</option>
            </select>
        </div>

        <div class="connectdropdown">
            <p>Trạng thái kết nối</p>
            <select name="" id="connectdropdown">
                <option value="" selected="selected">Tất cả</option>
                <option value="">Kết nối</option>
                <option value="">Mất Kết nối</option>
            </select>
        </div>

        <div class="search">
            <p>Từ khóa</p>
            <input type="text" name="search" placeholder="Nhập từ khóa">
            <img src="../picture/component/search.png" alt="search">
        </div>

        <a href="" class="add">
            <img src="../picture/component/add-square.png" alt="">
            <p>Thêm thiết bị</p>
        </a>
    </div>

    <ul>
        <img src="../picture/Logo alta.png" alt="logo" class="logo">
        <li><a href="../dashboard/index.php" class="dashboard"><img src="../picture/component/dashboard.png"
                    alt="dashboard">
                Dashboard</a>
        </li>
        <li><a href="" id="monitor"><img src="../picture/component/monitor.png" alt="monitor">Thiết
                bị</a></li>
        <li><a href="../dashboard/service.php" class="service"><img src="../picture/component/service.png"
                    alt="service">Dịch vụ</a></li>
        <li><a href="../dashboard/progression.php" class="progression"><img src="../picture/component/progression.png"
                    alt="progression">Cấp
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
                <th>Mã thiết bị</th>
                <th>Tên thiết bị</th>
                <th>Địa chỉ IP</th>
                <th>Trạng thái Hoạt động</th>
                <th>Trạng thái kết nối</th>
                <th id="activeservice">Dịch vụ sử dụng</th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>Alfreds Futterkiste</td>
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