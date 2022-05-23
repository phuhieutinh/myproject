<?php
require_once '../dbconnect.php';
require '../function/function_nofication.php';

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
            header("location:../logout.php");
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
                <p class="text1">Báo cáo</p>
                <img src="../picture/component/u_angle-right.png" alt="" class="angle">
                <p class="topbar">Lập báo cáo</p>
            </div>

            <div>
                <div class="popup" onclick="myFunction()">
                    <img src="../picture/component/nofication.png" alt="nofication" class="nofication" id="myNofication">
                    <span class="popuptext" id="myPopup">
                        <div class="popuptop">
                            <p>Thông báo</p>
                        </div>
                        <?php $nofication = nofication(); ?>
                    </span>
                </div>
            </div>

            <a href="info.php">
                <div id="info">
                    <p class="hello">xin chào</p>
                    <p class="header username"><?php echo $name ?></p>
                    <img src="<?php echo "../picture/avatar/" . $picture ?>" alt="smallpicture" class="picinfo">
                </div>
            </a>
        </header>

        <div class="userlog date">
            <p>Chọn thời gian</p>
            <form action="" method="POST">
                <input type="date" class="userlog datestart" name="start_date">
                <img src="../picture/component/arrow-right.png" alt="">
                <input type="date" class="userlog dateend" name="end_date" onchange="form.submit()">
            </form>
        </div>

        <div class="export">
            <label for="export">
                <img src="../picture/component/document-download.png" alt="">
                <p>Tải về</p>
                <form action="../function/download_report.php" class="export" method="POST">
                    <input type="submit" name="export" class="export" id="export">
                </form>
            </label>
        </div>

        <ul>
            <img src="../picture/Logo alta.png" alt="logo" class="logo">
            <li><a href="../dashboard/index.php" class="dashboard"><img src="../picture/component/dashboard.png" alt="dashboard">
                    Dashboard</a>
            </li>
            <li><a href="../dashboard/monitor.php" class="monitor"><img src="../picture/component/monitor.png" alt="monitor">Thiết
                    bị</a></li>
            <li><a href="../dashboard/service.php" class="service"><img src="../picture/component/service.png" alt="service">Dịch vụ</a></li>
            <li><a href="../dashboard/progression.php" class="progression"><img src="../picture/component/progression.png" alt="progression">Cấp
                    số</a>
            </li>
            <li><a href="../dashboard/report.php" id="report"><img src="../picture/component/menu/report.png" alt="report">Báo
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

        <main id="report_page" class="importance">
            <table style="width:100%" class="tablemonitor">
                <tr>
                    <th class="start">Số thứ tự</th>
                    <th>Tên dịch vụ</th>
                    <th>Thời gian cấp</th>
                    <th>Tình trạng</th>
                    <th class="end">Nguồn cấp</th>
                </tr>

                <?php
                $sql_pagination = 'SELECT count(progressID) as total from progression';
                $result_pagination = mysqli_query($conn, $sql_pagination);
                $row_pagination = mysqli_fetch_assoc($result_pagination);
                $total_records = $row_pagination['total'];

                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                $limit = 9;

                $total_page = ceil($total_records / $limit);
                if ($current_page > $total_page) {
                    $current_page = $total_page;
                } else if ($current_page < 1) {
                    $current_page = 1;
                }
                $start = ($current_page - 1) * $limit;

                if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                    $start_date_format = date("Y-m-d 00:00:00", strtotime($_POST['start_date']));
                    $end_date_format = date("Y-m-d 23:59:00", strtotime($_POST['end_date']));

                    if (empty($start_date_format && $end_date_format)) {
                        $query = "SELECT * FROM progression ORDER BY progressID DESC LIMIT $start, $limit";
                    } else {
                        $query = "SELECT * FROM `progression` WHERE `sellDate` BETWEEN '$start_date_format' AND '$end_date_format' ORDER BY progressID DESC LIMIT $start, $limit";
                    }
                } else {
                    $query = "SELECT * FROM progression ORDER BY progressID DESC LIMIT $start, $limit";
                }
                $result_list = mysqli_query($conn, $query);

                if (mysqli_num_rows($result_list) > 0) {
                    while ($row_progress = mysqli_fetch_assoc($result_list)) {
                        $progressID = $row_progress['progressID'];
                        $customerName = $row_progress['customerName'];
                        $stt_progress = $row_progress['stt_progress'];

                        $sell_date = date_create($row_progress['sellDate']);
                        $sell_date_format = date_format($sell_date, "H:i d/m/Y");

                        $use_date = date_create($row_progress['useDate']);
                        $use_date_format = date_format($use_date, "H:i d/m/Y");

                        $status = $row_progress['status'];
                        $supply = $row_progress['supply'];
                        $serviceID = $row_progress['serviceID'];

                        $sql_service = "SELECT * FROM progression, service WHERE $serviceID = service.serviceID";
                        $query_service = mysqli_query($conn, $sql_service);
                        while ($row_service = mysqli_fetch_assoc($query_service)) {
                            $serviceName = $row_service['serviceName'];
                            $prefix = $row_service['prefix_id'];
                            $surfix = $row_service['surfix_id'];
                        }

                        $waiting = '<img src="../picture/component/EllipseBlue.png" alt="active">';

                        $done = '<img src="../picture/component/EllipseGray.png" alt="active">';

                        $pass = '<img src="../picture/component/EllipseRed.png" alt="active">';

                        if ($status == "Đang chờ") {
                            $status_master = $waiting . $status;
                        } elseif ($status == "Đã sử dụng") {
                            $status_master = $done . $status;
                        } else {
                            $status_master = $pass . $status;
                        }
                ?>

                        <tr>
                            <td id="start"><?php echo $prefix . $stt_progress . $surfix; ?></td>
                            <td><?php echo $serviceName; ?></td>
                            <td><?php echo $sell_date_format; ?></td>
                            <td><?php echo $status_master; ?></td>
                            <td id="end"><?php echo $supply; ?></td>
                        </tr>

                <?php }
                }
                ?>
            </table>
        </main>

        <div class="pagination">
            <?php
            if ($current_page > 1 && $total_page > 1) {
                echo '<a class="pagination-box" href="report.php?page=' . ($current_page - 1) . '"><img class="pagination-img" src="../picture/component/fi_left.png" alt="left"></a>';
            }

            for ($i = 1; $i <= 5; $i++) {
                if ($i == $current_page) {
                    echo '<span class="pagination-active">' . $i . '</span> ';
                } else {
                    echo '<a class="pagination-box" href="report.php?page=' . $i . '">' . $i . '</a> ';
                }
            }
            echo "<a class='less'> ... </a>";
            echo '<a class="pagination-box" href="report.php?page=' . $total_page . '">' . $total_page . '</a> ';

            if ($current_page < $total_page && $total_page > 1) {
                echo '<a class="pagination-box" href="report.php?page=' . ($current_page + 1) . '"><img class="pagination-img" src="../picture/component/fi_right.png" alt="right"></a>';
            }
            ?>
        </div>

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