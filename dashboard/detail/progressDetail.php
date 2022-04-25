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
        <link rel="stylesheet" href="../../css/detail/progressDetail.css">
    </head>

    <body>
        <header>
            <div id="add-page">
                <p class="addtop-progress">Thiết bị</p>
                <img src="../../picture/component/u_angle-right.png" alt="" class="angle">

                <p class="addtop-page"><a href="../../dashboard/monitor.php" style="text-decoration: none; color: rgba(126, 125, 136, 1);">Danh sách cấp số</a></p>

                <img src="../../picture/component/u_angle-right.png" alt="" class="angle">
                <p class="topbar">Chi tiết</p>
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

            <a href="../../dashboard/progression.php" class="back">
                <img src="../../picture/component/back-square.png" alt="">
                <p>Quay lại</p>
            </a>
        </div>

        <main id="progressDetail">

            <?php
            if (isset($_GET['id'])) {
                $progressid = $_GET['id'];

                $sql_progress = "SELECT * FROM progression where progressID = '$progressid'";
                $result_progress = mysqli_query($conn, $sql_progress);
                if (mysqli_num_rows($result_progress) > 0) {
                    $row_progress = mysqli_fetch_assoc($result_progress);

                    $progressID = $row_progress['progressID'];
                    $customerName = $row_progress['customerName'];
                    $phone = $row_progress['phone'];
                    $email = $row_progress['email'];

                    $sell_date = date_create($row_progress['sellDate']);
                    $sell_date_format = date_format($sell_date, "H:i d/m/Y");

                    $use_date = date_create($row_progress['useDate']);
                    $use_date_format = date_format($use_date, "H:i d/m/Y");

                    $status = $row_progress['status'];
                    $supply = $row_progress['supply'];

                    $serviceID = $row_progress['serviceID'];
                    $sql_service = "SELECT serviceName FROM progression, service WHERE $serviceID = service.serviceID";
                    $query_service = mysqli_query($conn, $sql_service);
                    while ($row_service = mysqli_fetch_assoc($query_service)) {
                        $serviceName = $row_service['serviceName'];
                    }
                } else {
                    echo "NO DATA";
                }
            }

            ?>

            <p class="top">Thông tin cấp số</p>
            <div class="progressName">
                <h1>Họ tên: </h1>
                <p><?php echo $customerName; ?></p>
            </div>

            <div class="serviceName">
                <h1>Tên dịch vụ: </h1>
                <p><?php echo $serviceName; ?></p>
            </div>

            <div class="number-order">
                <h1>Số thứ tự: </h1>
                <p><?php echo $progressID; ?></p>
            </div>

            <div class="order-date">
                <h1>Thời gian cấp: </h1>
                <p id="use-service"><?php echo $sell_date_format; ?></p>
            </div>

            <div class="use-date">
                <h1>Hạn sử dụng: </h1>
                <p><?php echo $use_date_format; ?></p>
            </div>

            <div class="supply">
                <h1>Nguồn cấp: </h1>
                <p><?php echo $supply; ?></p>
            </div>

            <div class="statrus">
                <h1>Trạng thái: </h1>
                <p><?php echo $status; ?></p>
            </div>

            <div class="phone">
                <h1>Số điện thoại: </h1>
                <p><?php echo $phone; ?></p>
            </div>

            <div class="Email">
                <h1>Địa chỉ Email: </h1>
                <p><?php echo $email; ?></p>
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