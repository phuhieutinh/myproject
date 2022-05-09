<?php
require_once '../dbconnect.php';
require '../function/function_nofication.php';

session_start();

$conn = connect_db();

if (isset($_SESSION['admin_login'])) {

    if (isset($_SESSION['userID'])) {

        $id = $_SESSION['userID'];
        $sql = "SELECT * FROM user WHERE userID = '$id'";
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
        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard-rtl/">

        <link href="../css/rome.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>
    </head>

    <body>
        <header>
            <p class="topbar">Dashboard</p>

            <div>
                <div class="popup" onclick="myFunction()">
                    <img src="../picture/component/nofication.png" alt="nofication" class="nofication" id="myNofication">
                    <span class="popuptext" id="myPopup">
                        <div class="popuptop">
                            <p>Thông báo</p>
                        </div>
                        <?php $nofication = nofication(); ?>div>
                        </a>
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

        <nav>
            <ul>
                <img src="../picture/Logo alta.png" alt="logo" class="logo">
                <li><a href="" id="dashboard"><img src="../picture/component/dashboard.png" alt="dashboard">
                        Dashboard</a>
                </li>
                <li class="monitor"><a href="../dashboard/monitor.php" class="monitor"><img src="../picture/component/monitor.png" alt="monitor">Thiết
                        bị</a></li>
                <li><a href="../dashboard/service.php" class="service"><img src="../picture/component/service.png" alt="service">Dịch vụ</a></li>
                <li><a href="../dashboard/progression.php" class="progression"><img src="../picture/component/progression.png" alt="progression">Cấp
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
        </nav>

        <main id="main_dashboard">
            <div id="dashboard_index">
                <h1>Biểu đồ cấp số</h1>

                <div class="quantity_progress_id">
                    <img src="../picture/component/dashboard/dashboard_id.png" alt="">

                    <?php
                    $result = mysqli_query($conn, 'SELECT COUNT(progressID) AS sum_progressID FROM progression');
                    $row = mysqli_fetch_assoc($result);
                    $sum_progressID = $row['sum_progressID'];
                    ?>
                    <p>Số thứ tự đã cấp</p>
                    <span><?php echo $sum_progressID ?></span>
                    <small>
                        <img src="../picture/component/progress_up.png" alt="">
                        <p>22,44%</p>
                    </small>
                </div>

                <div class="quantity_progress_use">
                    <img src="../picture/component/dashboard/dashboard_use.png" alt="">
                    <p>Số thứ tự đã sử dụng</p>

                    <?php
                    $result = mysqli_query($conn, 'SELECT SUM(status LIKE "Đã sử dụng") AS sum_status_used FROM progression');
                    $row = mysqli_fetch_assoc($result);
                    $sum_status_used = $row['sum_status_used'];
                    ?>
                    <span><?php echo $sum_status_used ?></span>
                    <small>
                        <img src="../picture/component/progress_low.png" alt="">
                        <p>22,44%</p>
                    </small>
                </div>

                <div class="quantity_progress_waiting">
                    <img src="../picture/component/dashboard/dashboard_waiting.png" alt="">
                    <p>Số thứ tự đang chờ</p>

                    <?php
                    $result = mysqli_query($conn, 'SELECT SUM(status LIKE "Đang chờ") AS sum_status_wait FROM progression');
                    $row = mysqli_fetch_assoc($result);
                    $sum_status_wait = $row['sum_status_wait'];
                    ?>
                    <span><?php echo $sum_status_wait ?></span>
                    <small>
                        <img src="../picture/component/progress_up.png" alt="">
                        <p>22,44%</p>
                    </small>
                </div>

                <div class="quantity_progress_pass">
                    <img src="../picture/component/dashboard/dashboard_pass.png" alt="">
                    <p>Số thứ tự đã bỏ qua</p>

                    <?php
                    $result = mysqli_query($conn, 'SELECT SUM(status LIKE "Bỏ qua") AS sum_status_pass FROM progression');
                    $row = mysqli_fetch_assoc($result);
                    $sum_status_pass = $row['sum_status_pass'];
                    ?>
                    <span><?php echo $sum_status_pass ?></span>
                    <small>
                        <img src="../picture/component/progress_low.png" alt="">
                        <p>22,44%</p>
                    </small>
                </div>
            </div>

            <div class="chart_canvas">
                <h1>Bảng thống kê theo ngày</h1>
                <p>tháng 11/2021</p>
                <div class="date_chart">
                    <p>Xem theo</p>
                    <select name="" id="date_chart">
                        <option value="" selected="selected">Ngày</option>
                        <option value="">Tuần</option>
                        <option value="">Tháng</option>
                    </select>
                </div>

                <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
            </div>

        </main>

        <footer id="dashboard_generality">
            <h1>Tổng quan</h1>

            <div id="monitor_percentage">

                <div class="circle_monitor">
                    <div class="monitor_circle">
                        <div class="monitor-value">100%</div>
                    </div>
                </div>

                <?php
                $result = mysqli_query($conn, 'SELECT COUNT(monitorID) AS sum_monitorID FROM monitor');
                $row = mysqli_fetch_assoc($result);
                $sum_monitorID = $row['sum_monitorID'];
                ?>
                <h2><?php echo $sum_monitorID ?></h2>
                <h1><img src="../picture/component/dashboard/dashboard_monitor.png" alt=""> Thiết bị</h1>

                <div class="top">
                    <p><img src="../picture/component/dashboard/yellow.png" alt="">Đang hoạt động</p>
                    <?php
                    $result = mysqli_query($conn, 'SELECT SUM(monitorStatus LIKE "Hoạt động") AS sum_monitorStatus FROM monitor');
                    $row = mysqli_fetch_assoc($result);
                    $sum_monitorStatus = $row['sum_monitorStatus'];
                    ?>
                    <span><?php echo $sum_monitorStatus ?></span>
                </div>

                <div class="bottom">
                    <p><img src="../picture/component/dashboard/gray.png" alt="">Ngưng hoạt động</p>
                    <?php
                    $result = mysqli_query($conn, 'SELECT SUM(monitorStatus LIKE "Ngưng hoạt động") AS sum_monitorStatus FROM monitor');
                    $row = mysqli_fetch_assoc($result);
                    $sum_monitorStatus = $row['sum_monitorStatus'];
                    ?>
                    <span><?php echo $sum_monitorStatus ?></span>
                </div>
            </div>

            <div id="service_percentage">

                <div class="circle_service">
                    <div class="service_circle">
                        <div class="service-value">100%</div>
                    </div>
                </div>
                <?php
                $result = mysqli_query($conn, 'SELECT COUNT(serviceID) AS sum_serviceID FROM service');
                $row = mysqli_fetch_assoc($result);
                $sum_serviceID = $row['sum_serviceID'];
                ?>
                <h2><?php echo $sum_serviceID ?></h2>

                <h1><img src="../picture/component/dashboard/dashboard_service.png" alt=""> Dịch vụ</h1>

                <div class="top">
                    <p><img src="../picture/component/dashboard/blue.png" alt="">Đang hoạt động</p>
                    <?php
                    $result = mysqli_query($conn, 'SELECT SUM(serviceStatus LIKE "Hoạt động") AS sum_serviceStatus FROM service');
                    $row = mysqli_fetch_assoc($result);
                    $sum_monitorStatus = $row['sum_serviceStatus'];
                    ?>
                    <span><?php echo $sum_monitorStatus ?></span>

                </div>

                <div class="bottom">
                    <p><img src="../picture/component/dashboard/gray.png" alt="">Ngưng hoạt động</p>
                    <?php
                    $result = mysqli_query($conn, 'SELECT SUM(serviceStatus LIKE "Ngưng hoạt động") AS sum_serviceStatus FROM service');
                    $row = mysqli_fetch_assoc($result);
                    $sum_serviceStatus = $row['sum_serviceStatus'];
                    ?>
                    <span><?php echo $sum_serviceStatus ?></span>

                </div>

            </div>

            <div id="progress_percentage">

                <div class="circle_progress">
                    <div class="progress_circle">
                        <div class="progress-value">100%</div>
                    </div>
                </div>

                <h2><?php echo $sum_progressID ?></h2>
                <h1><img src="../picture/component/dashboard/dasboard_progress.png" alt=""> Cấp số</h1>

                <div class="top">
                    <p><img src="../picture/component/dashboard/orange.png" alt="">Đã sử dụng</p>
                    <span><?php echo $sum_status_used ?></span>
                </div>

                <div class="middle">
                    <p><img src="../picture/component/dashboard/gray.png" alt="">Đang chờ</p>
                    <span><?php echo $sum_status_wait ?></span>
                </div>

                <div class="bottom">
                    <p><img src="../picture/component/dashboard/orange.png" alt="">Bỏ qua</p>
                    <span><?php echo $sum_status_pass ?></span>
                </div>
            </div>

            <div id="inline_cal"></div>
        </footer>
    <?php
} else if (isset($_SESSION['user_login'])) {
    header("location:../user/index.php");
} else {
    header("location:../index.php");
}
    ?>
    <script src="../js/dashboard.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" integrity="sha384-EbSscX4STvYAC/DxHse8z5gEDaNiKAIGW+EpfzYTfQrgIlHywXXrM9SUIZ0BlyfF" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha384-i+dHPTzZw7YVZOx9lbH5l6lP74sLRtMtwN2XjVqjf3uAGAREAF4LMIUDTWEVs4LI" crossorigin="anonymous"></script>
    <script src="../js/chart/dashboard.js"></script>

    <script src="../js/calendars/jquery-3.3.1.min.js"></script>
    <script src="../js/calendars/rome.js"></script>
    <script src="../js/calendars/main.js"></script>
    </body>

    </html>