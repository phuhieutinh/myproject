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
        <link rel="stylesheet" href="../../css/detail/monitorDetail.css">
    </head>

    <body>
        <header>
            <div id="add-page">
                <p class="addtop-monitor">Thiết bị</p>
                <img src="../../picture/component/u_angle-right.png" alt="" class="angle">

                <p class="addtop-page"><a href="../../dashboard/monitor.php" style="text-decoration: none; color: rgba(126, 125, 136, 1);">Danh sách thiết bị</a></p>

                <img src="../../picture/component/u_angle-right.png" alt="" class="angle">
                <p class="topbar">Chi tiết thiết bị</p>
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
            <?php
            if (isset($_GET['id'])) {
                $monitorid = $_GET['id'];
            ?>
                <p class="maccounttext">Quản lý thiết bị</p>

                <a href="../../dashboard/add/addMonitor.php?id=<?php echo $monitorid ?>" class="edit">
                    <img src="../../picture/component/edit-square.png" alt="">
                    <p>Cập nhật thiết bị</p>
                </a>
        </div>

        <main id="monitorDetail">
            <p class="top">Thông tin thiết bị</p>

        <?php
                $sql_monitor = "SELECT * FROM monitor where monitorID = '$monitorid'";
                $result_monitor = mysqli_query($conn, $sql_monitor);
                if (mysqli_num_rows($result_monitor) > 0) {
                    $row_monitor = mysqli_fetch_assoc($result_monitor);

                    $monitorID = $row_monitor['monitorID'];
                    $monitorCode = $row_monitor['monitorCode'];
                    $monitorName = $row_monitor['monitorName'];
                    $ipaddress = $row_monitor['ipaddress'];
                    $username = $row_monitor['username'];
                    $monitorPassword = $row_monitor['monitorPassword'];
                    $monitorType = $row_monitor['monitorType'];
                    $serviceID = $row_monitor['serviceID'];
                    $nameService = $row_monitor['nameService'];
                } else {
                    echo "NO DATA";
                }
            }

        ?>

        <div class="monitorCode">
            <h1>Mã thiết bị: </h1>
            <p><?php echo $monitorCode; ?></p>
        </div>

        <div class="monitorName">
            <h1>Tên thiết bị: </h1>
            <p><?php echo $monitorName; ?></p>
        </div>

        <div class="ipaddress">
            <h1>Địa chỉ IP: </h1>
            <p><?php echo $ipaddress; ?></p>
        </div>

        <div class="use-service">
            <h1>Dịch vụ sử dụng: </h1>
            <p id="use-service"><?php echo $nameService; ?></p>
        </div>

        <div class="type-monitor">
            <h1>Loại thiết bị: </h1>
            <p><?php echo $monitorType; ?></p>
        </div>

        <div class="username">
            <h1>Tên đăng nhập: </h1>
            <p><?php echo $username; ?></p>
        </div>

        <div class="password">
            <h1>Mật khẩu: </h1>
            <p><?php echo $monitorPassword; ?></p>
        </div>
        </main>

        <ul>
            <img src="../../picture/Logo alta.png" alt="logo" class="logo">
            <li><a href="../../dashboard/index.php" class="dashboard"><img src="../../picture/component/dashboard.png" alt="dashboard">
                    Dashboard</a>
            </li>

            <li><a href="" id="monitor"><img src="../../picture/component/monitor.png" alt="monitor">Thiết
                    bị</a></li>

            <li><a href="../../dashboard/service.php" class="service"><img src="../../picture/component/service.png" alt="service">Dịch vụ</a></li>

            <li><a href="../../dashboard/progression.php" class="progression"><img src="../../picture/component/progression.png" alt="progression">Cấp
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