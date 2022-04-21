<?php
require_once '../../dbconnect.php';

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
            header("location:../../logout.php");
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
        <link href="../../css/dashboard.css" rel="stylesheet">
        <link rel="stylesheet" href="../../css/add/addprogress.css">
    </head>

    <body>
        <div class="container" id="blur">
            <header>
                <div id="add-page">
                    <p class="addtop-progress">Cấp số</p>
                    <img src="../../picture/component/u_angle-right.png" alt="" class="angle">
                    <p class="addtop-page"><a href="../../dashboard/progression.php" style="text-decoration: none; color: rgba(126, 125, 136, 1);">Danh sách cấp số</a></p>
                    <img src="../../picture/component/u_angle-right.png" alt="" class="angle">
                    <p class="topbar">cấp số mới</p>
                </div>

                <div>
                    <div class="popup" onclick="myFunction()">
                        <img src="../../picture/component/nofication.png" alt="nofication" class="nofication" id="myNofication">
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

                <a href="../info.php">
                    <div id="info">
                        <p class="hello">xin chào</p>
                        <p class="header username"><?php echo $name ?></p>
                        <img src="<?php echo "../../" . $picture ?>" alt="smallpicture" class="picinfo">
                    </div>
                </a>
            </header>

            <div>
                <p class="maccounttext">Quản lý cấp số</p>
            </div>

            <main id="addprogress">
                <h1 class="top">CẤP SỐ MỚI</h1>
                <form action="" method="POST" id="addprogress">

                    <h2 class="top">Dịch vụ khách hàng lựa chọn</h2>

                    <select name="" id="addprogress-service">
                        <option value="" class="deco" disabled selected>Chọn Loại thiết bị</option>
                        <option value="">Kiosk</option>
                        <option value="">Display counter</option>
                    </select>

                    <div class="btn">
                        <div onclick="addpopup()">
                            <input type=" submit" class="submit" value="In số">
                        </div>
                        <a href="../../dashboard/progression.php" class="cancel">Hủy bỏ</a>
                    </div>
                </form>

            </main>

            <ul>
                <img src="../../picture/Logo alta.png" alt="logo" class="logo">
                <li><a href="../../dashboard/index.php" class="dashboard"><img src="../../picture/component/dashboard.png" alt="dashboard">
                        Dashboard</a>
                </li>

                <li><a href="../../dashboard/monitor.php" class="monitor"><img src="../../picture/component/monitor.png" alt="monitor">Thiết
                        bị</a></li>

                <li><a href="../../dashboard/service.php" class="service"><img src="../../picture/component/service.png" alt="service">Dịch vụ</a></li>

                <li><a href="" id="progression"><img src="../../picture/component/progression.png" alt="progression">Cấp
                        số</a>
                </li>

                <li><a href="../../dashboard/report.php" class="report"><img src="../../picture/component/report.png" alt="report">Báo
                        cáo</a></li>

                <li class="setting"><a href="" class="setting"><img src="../../picture/component/setting.png" alt="setting">Cài
                        đặt
                        hệ
                        thống<img src="../../picture/component/dropdown.png" alt="dropdown"></a>
                    <ul class="submenu">
                        <li>
                            <a href="../../dashboard/submenu/mrole.php">
                                Quản lý vai trò
                            </a>
                        </li>
                        <li>
                            <a href="../../dashboard/submenu/maccount.php">
                                Quản lý tài khoản
                            </a>
                        </li>
                        <li>
                            <a href="../../dashboard/submenu/userlog.php">
                                Nhật ký người dùng
                            </a>
                        </li>
                    </ul>
                </li>

                <li><a href="../../logout.php" class="logout"><img src="../../picture/component/logout.png" alt="logout">Đăng
                        xuất</a>
                </li>
            </ul>
        </div>

        <span class="popuptext-progress" id="popupProgress">
            <a href="addprogress.php" class="iconx"><img src="../../picture/component/fi_x.png" alt=""></a>
            <h1>Số thứ tự được cấp</h1>
            <p>2001201</p>
            <h5>DV: Khám răng hàm mặt <h4>(tại quầy số 1)</h4>
            </h5>
            <div class="footer">
                <div class="order-time">
                    <label>Thời gian cấp: </label>
                    <p>09:30 11/10/2021</p>
                </div>

                <div class="use-time">
                    <label>Hạn sử dụng: </label>
                    <p>17:30 11/10/2021</p>
                </div>
            </div>
        </span>

    <?php
} else if (isset($_SESSION['user_login'])) {
    header("location:../../user/index.php");
} else {
    header("location:../../index.php");
}
    ?>
    <script src="../../js/dashboard.js"></script>
    </body>

    </html>