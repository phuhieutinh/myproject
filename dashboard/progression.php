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
            $picture = $row['picture'];
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
            <p class="text1">Cấp số</p>
            <img src="../picture/component/u_angle-right.png" alt="" class="angle">
            <p class="topbar">Danh sách cấp số</p>
        </div>

        <div>
            <div class="popup" onclick="myFunction()">
                <img src="../picture/component/nofication.png" alt="nofication" class="nofication" id="myNofication">
                <span class="popuptext" id="myPopup">
                    <div class="popuptop">
                        <p>Thông báo</p>
                    </div>
                    <a href="" class="popuptable">
                        <div class="info">
                            <p class="infoname">Người dùng Nguyễn Thị Thùy Dung</p>
                            <p class="infotime">thời gian nhận số</p>
                        </div>
                    </a>
                </span>
            </div>
        </div>

        <a href="info.php">
            <div id="info">
                <p class="hello">xin chào</p>
                <p class="header username"><?php echo $name ?></p>
                <img src="<?php echo "../" . $picture ?>" alt="smallpicture" class="picinfo">
            </div>
        </a>
    </header>

    <div>
        <p class="managetext">Quản lý cấp số</p>

        <div class="progression servicename">
            <p>Tên dịch vụ</p>
            <select name="" class="servicename">
                <option value="" selected="selected">Tất cả</option>
                <option value="">Khám sản - Phụ Khoa</option>
                <option value="">Khám răng hàm mặt</option>
                <option value="">Khám tai muỗi họng</option>
            </select>
        </div>

        <div class="progression status">
            <p>Tình trạng</p>
            <select name="" class="status">
                <option value="" selected="selected">Tất cả</option>
                <option value="">Đang chờ</option>
                <option value="">Đã sử dụng</option>
                <option value="">Bỏ qua</option>
            </select>
        </div>

        <div class="progression supply">
            <p>Nguồn cấp</p>
            <select name="" class="supply">
                <option value="" selected="selected">Tất cả</option>
                <option value="">Kiosk</option>
                <option value="">Hệ thống</option>
            </select>
        </div>

        <div class="progression date">
            <p>Chọn thời gian</p>
            <input type="date" class="progression datestart">
            <img src="../picture/component/arrow-right.png" alt="">
            <input type="date" class="progression dateend">
        </div>

        <div class="search">
            <p>Từ khóa</p>
            <input type="text" name="search" placeholder="Nhập từ khóa">
            <img src="../picture/component/search.png" alt="search">
        </div>

        <a href="../dashboard/add/addprogress.php" class="add">
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
                        Quản lý vai trò
                    </a>
                </li>
                <li>
                    <a href="../dashboard/submenu/maccount.php">
                        Quản lý tài khoản
                    </a>
                </li>
                <li>
                    <a href="../dashboard/submenu/userlog.php">
                        Nhật ký người dùng
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