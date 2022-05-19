<?php
require_once '../../dbconnect.php';
require '../../function/function_nofication.php';
include '../../function/function_userlog.php';

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

    // add progress
    $progressID_form = 'SELECT max(id) + 1 FROM progression';

    if (isset($_POST['submit'])) {
        $progress_ID = $_POST['progressID'];
        $serviceID = $_POST['progress_service'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $sell_date = date('Y-m-d H:i:s');
        $use_date = date('Y-m-d 17:30:00');
        $status = "Đang chờ";
        $supply = "Hệ thống";
        $stt_progress = 0;

        if ($stt_progress == 0 || $stt_progress == NULL) {
            $stt_result_service = mysqli_query($conn, "SELECT stt_service FROM service WHERE $serviceID = serviceID");
            $row_stt_service = mysqli_fetch_assoc($stt_result_service);
            $stt_service = $row_stt_service['stt_service'];

            $stt_result_progress = mysqli_query($conn, "SELECT max(stt_progress) as max FROM progression WHERE $serviceID = progression.serviceID");
            $row_stt_progress = mysqli_fetch_assoc($stt_result_progress);
            $stt_progress = $row_stt_progress['max'];

            if ($stt_service == $stt_progress || $stt_service < $stt_progress) {
                $stt_progress += 1;
            } else {
                $stt_progress = $stt_service;
            }
        } else {
        }

        $sql = "INSERT INTO progression(progressID ,serviceID, sellDate, useDate, status, supply, stt_progress) VALUES('$progress_ID', '$serviceID', '$sell_date', '$use_date', '$status', '$supply', '$stt_progress')";

        if (mysqli_query($conn, $sql)) {
            $log = "add progress success";
            $update_userlog = userlog_sub($log);
?>

            <body onload="addpopup()">

            </body>
    <?php
        } else {
            error_reporting(-1);
            echo '<script>alert("Bạn chưa chọn dịch vụ")</script>';
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
                            <?php $nofication = nofication_sub(); ?>
                        </span>
                    </div>
                </div>

                <a href="../info.php">
                    <div id="info">
                        <p class="hello">xin chào</p>
                        <p class="header username"><?php echo $name ?></p>
                        <img src="<?php echo "../../picture/avatar/" . $picture ?>" alt="smallpicture" class="picinfo">
                    </div>
                </a>
            </header>

            <div>
                <p class="maccounttext">Quản lý cấp số</p>
            </div>

            <main id="addprogress">
                <h1 class="top">CẤP SỐ MỚI</h1>
                <form action="addprogress.php" method="POST" id="addprogress">

                    <h2 class="top">Dịch vụ khách hàng lựa chọn</h2>

                    <input type="hidden" name="progressID" value="<?php echo $progressID_form ?>" ?>

                    <select name="progress_service" id="addprogress-service">
                        <option value="" class="deco" disabled selected>Chọn dịch vụ</option>
                        <?php
                        $sql_service = "SELECT * FROM service";
                        $query_service = mysqli_query($conn, $sql_service);

                        while ($row_service = mysqli_fetch_assoc($query_service)) {
                            $serviceID_select = $row_service['serviceID'];
                            $serviceName = $row_service['serviceName'];

                            echo "<option value='$serviceID_select'name='serviceID'>$serviceName</option>";
                        }
                        ?>
                    </select>

                    <div class="btn">
                        <input type="submit" class="submit" value="In số" name="submit">


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

        <?php
        $sql_popup = "SELECT * FROM progression";
        $query_popup = mysqli_query($conn, $sql_popup);
        while ($row_popup = mysqli_fetch_assoc($query_popup)) {
            $serviceID_popup = $row_popup['serviceID'];
            $stt = $row_popup['stt_progress'];

            $sell_date_popup = date_create($row_popup['sellDate']);
            $sell_date_format = date_format($sell_date_popup, "H:i d/m/Y");

            $use_date_popup = date_create($row_popup['useDate']);
            $use_date_format = date_format($use_date_popup, "H:i d/m/Y");

            $sql_service_popup = "SELECT * FROM progression, service WHERE $serviceID_popup = service.serviceID";
            $query_service_popup = mysqli_query($conn, $sql_service_popup);
            while ($row_service_popup = mysqli_fetch_assoc($query_service_popup)) {
                $serviceName_popup = $row_service_popup['serviceName'];
                $prefix_id = $row_service_popup['prefix_id'];
                $surfix_id = $row_service_popup['surfix_id'];
            }
        }
        ?>

        <span class="popuptext-progress" id="popupProgress">
            <a href="addprogress.php" class="iconx"><img src="../../picture/component/fi_x.png" alt=""></a>
            <h1>Số thứ tự được cấp</h1>
            <p><?php echo $prefix_id . $stt . $surfix_id ?></p>
            <h5>DV: <?php echo $serviceName_popup; ?> <h4>(tại quầy số 1)</h4>
            </h5>
            <div class="footer">
                <div class="order-time">
                    <label>Thời gian cấp: </label>
                    <p><?php echo $sell_date_format; ?></p>
                </div>

                <div class="use-time">
                    <label>Hạn sử dụng: </label>
                    <p><?php echo $use_date_format; ?></p>
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