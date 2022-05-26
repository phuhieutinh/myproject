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
    $chart_data = '';
    $cur_month = date('m');
    $cur_year = date('Y');

    if (isset($_POST['search_select'])) {
        $search_select = addslashes($_POST['search_select']);
        if (empty($search_select)) {
            $query_sum_stt = mysqli_query($conn, "SELECT Day(`sellDate`) AS 'date',COUNT(*) AS 'count_progressID' FROM `progression` GROUP BY Day(`sellDate`)");
        } elseif ($search_select == "day") {
            $query_sum_stt = mysqli_query($conn, "SELECT Day(`sellDate`) AS 'date',COUNT(*) AS 'count_progressID' FROM `progression` WHERE Month(`sellDate`) = Month(CURDATE()) GROUP BY Day(`sellDate`)");
        } elseif ($search_select == "week") {
            $query_sum_stt = mysqli_query($conn, "SELECT WEEK(`sellDate`) AS 'date',COUNT(*) AS 'count_progressID' FROM `progression` WHERE Month(`sellDate`) = Month(CURDATE()) GROUP BY WEEK(`sellDate`)");
        } elseif ($search_select == "month") {
            $query_sum_stt = mysqli_query($conn, "SELECT Month(`sellDate`) AS 'date',COUNT(*) AS 'count_progressID' FROM `progression` WHERE Year(`sellDate`) = YEAR(CURDATE()) GROUP BY Month(`sellDate`)");
        }
    } else {
        $query_sum_stt = mysqli_query($conn, "SELECT Day(`sellDate`) AS 'date',COUNT(*) AS 'count_progressID' FROM `progression` GROUP BY Day(`sellDate`)");
    }

    while ($row_sum_stt = mysqli_fetch_array($query_sum_stt)) {
        $count_progressID = $row_sum_stt['count_progressID'];
        $day = $row_sum_stt['date'];

        $chart_data .= "{date: '" . $day . "', total:" . $count_progressID . "}, ";
    }
    $chart_data = substr($chart_data, 0, -2);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link href="../css/dashboard.css" rel="stylesheet">

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

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
                <li><a href="" id="dashboard"><img src="../picture/component/menu/dashboard.png" alt="dashboard">
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
                <div class="container" style="width: 791px;">
                    <?php
                    if (isset($_POST['search_select'])) {
                        if ($search_select == "day") {
                            echo "<h1>Bảng thống kê theo ngày</h1>";
                            echo "<p>tháng $cur_month/$cur_year</p>";
                        } elseif ($search_select == "week") {
                            echo "<h1>Bảng thống kê theo tuần</h1>";
                            echo "<p>tháng $cur_month/$cur_year</p>";
                        } elseif ($search_select == "month") {
                            echo "<h1>Bảng thống kê theo tháng</h1>";
                            echo "<p>năm $cur_year</p>";
                        }
                    } else {
                        echo "<h1>Bảng thống kê theo ngày</h1>";
                        echo "<p>tháng $cur_month/$cur_year</p>";
                    }
                    ?>
                    <div class="date_chart">
                        <p>Xem theo</p>
                        <form action="" method="POST">
                            <select name="search_select" id="date_chart" onchange="form.submit()">
                                <?php
                                if (isset($_POST['search_select'])) {
                                    if ($search_select == "day") {
                                        echo '<option value="" disabled selected style="display: none;">Ngày</option>';
                                    } elseif ($search_select == "week") {
                                        echo '<option value="" disabled selected style="display: none;">Tuần</option>';
                                    } elseif ($search_select == "month") {
                                        echo '<option value="" disabled selected style="display: none;">Tháng</option>';
                                    }
                                } else {
                                    echo '<option value="" disabled selected style="display: none;">Ngày</option>';
                                }
                                ?>
                                <option value="day">Ngày</option>
                                <option value="week">Tuần</option>
                                <option value="month">Tháng</option>
                            </select>
                        </form>
                    </div>
                    <br /><br />
                    <br /><br />
                    <br /><br />
                    <div id="chart"></div>
                </div>
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

            <div id="inline_cal">
                <div class="rd-container" style="display: inline-block; z-index: 99;">
                    <div class="rd-date">
                        <div class="rd-month"><button class="rd-back" type="button"></button><button class="rd-next" type="button"></button>
                            <div class="rd-month-label">May 2022</div>
                            <hr>
                            <table class="rd-days">
                                <thead class="rd-days-head">
                                    <tr class="rd-days-row">
                                        <th class="rd-day-head">Su</th>
                                        <th class="rd-day-head">Mo</th>
                                        <th class="rd-day-head">Tu</th>
                                        <th class="rd-day-head">We</th>
                                        <th class="rd-day-head">Th</th>
                                        <th class="rd-day-head">Fr</th>
                                        <th class="rd-day-head">Sa</th>
                                    </tr>
                                </thead>
                                <tbody class="rd-days-body" data-rome-offset="0">
                                    <tr class="rd-days-row">
                                        <td class="rd-day-body">01</td>
                                        <td class="rd-day-body">02</td>
                                        <td class="rd-day-body">03</td>
                                        <td class="rd-day-body">04</td>
                                        <td class="rd-day-body">05</td>
                                        <td class="rd-day-body">06</td>
                                        <td class="rd-day-body">07</td>
                                    </tr>
                                    <tr class="rd-days-row">
                                        <td class="rd-day-body">08</td>
                                        <td class="rd-day-body">09</td>
                                        <td class="rd-day-body">10</td>
                                        <td class="rd-day-body">11</td>
                                        <td class="rd-day-body">12</td>
                                        <td class="rd-day-body">13</td>
                                        <td class="rd-day-body">14</td>
                                    </tr>
                                    <tr class="rd-days-row">
                                        <td class="rd-day-body">15</td>
                                        <td class="rd-day-body">16</td>
                                        <td class="rd-day-body">17</td>
                                        <td class="rd-day-body">18</td>
                                        <td class="rd-day-body">19</td>
                                        <td class="rd-day-body">20</td>
                                        <td class="rd-day-body">21</td>
                                    </tr>
                                    <tr class="rd-days-row">
                                        <td class="rd-day-body">22</td>
                                        <td class="rd-day-body">23</td>
                                        <td class="rd-day-body rd-day-selected">24</td>
                                        <td class="rd-day-body">25</td>
                                        <td class="rd-day-body">26</td>
                                        <td class="rd-day-body">27</td>
                                        <td class="rd-day-body">28</td>
                                    </tr>
                                    <tr class="rd-days-row">
                                        <td class="rd-day-body">29</td>
                                        <td class="rd-day-body">30</td>
                                        <td class="rd-day-body">31</td>
                                        <td class="rd-day-body rd-day-next-month">01</td>
                                        <td class="rd-day-body rd-day-next-month">02</td>
                                        <td class="rd-day-body rd-day-next-month">03</td>
                                        <td class="rd-day-body rd-day-next-month">04</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    <?php
} else if (isset($_SESSION['user_login'])) {
    header("location:../user/index.php");
} else {
    header("location:../index.php");
}
    ?>
    <script src="../js/dashboard.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script>
        Morris.Area({
            element: 'chart',
            data: [<?php echo $chart_data; ?>],
            xkey: 'date',
            ykeys: ['total'],
            labels: ['total', 'date'],
            hideHover: 'auto',
            // stacked: true,
            parseTime: false,
        });
    </script>

    <script src="../js/calendars/jquery-3.3.1.min.js"></script>
    <script src="../js/calendars/rome.js"></script>
    <script src="../js/calendars/main.js"></script>
    </body>

    </html>