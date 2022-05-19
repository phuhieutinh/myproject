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

        <div>
            <p class="managetext">Quản lý cấp số</p>

            <div class="progression servicename">
                <p>Tên dịch vụ</p>
                <form action="progression.php" method="POST">
                    <div class="select">
                        <select name="search_select" class="servicename" onchange="form.submit()">
                            <option value="" disabled selected style="display: none;">Tất cả</option>
                            <option value="All">Tất cả</option>

                            <?php
                            $sql_service = "SELECT * FROM service";
                            $query_service = mysqli_query($conn, $sql_service);

                            while ($row_service = mysqli_fetch_assoc($query_service)) {
                                $serviceID_select = $row_service['serviceID'];
                                $serviceName = $row_service['serviceName'];

                                echo "<option value='$serviceID_select'>$serviceName</option>";
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>

            <div class="progression status">
                <p>Tình trạng</p>
                <form action="progression.php" method="POST">
                    <div class="select">
                        <select name="search_select" class="status" onchange="form.submit()">
                            <option value="" disabled selected style="display: none;">Tất cả</option>
                            <option value="All">Tất cả</option>
                            <option value="Đang chờ">Đang chờ</option>
                            <option value="Đã sử dụng">Đã sử dụng</option>
                            <option value="Bỏ qua">Bỏ qua</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="progression supply">
                <p>Nguồn cấp</p>
                <div class="select">
                    <form action="progression.php" method="POST">
                        <select name="search_select" class="supply" onchange="form.submit()">
                            <option value="" disabled selected style="display: none;">Tất cả</option>
                            <option value="All">Tất cả</option>
                            <option value="Kiosk">Kiosk</option>
                            <option value="Hệ thống">Hệ thống</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="progression date">
                <p>Chọn thời gian</p>
                <form action="" method="POST">
                    <input type="date" class="progression datestart" name="start_date">
                    <img src="../picture/component/arrow-right.png" alt="">
                    <input type="date" class="progression dateend" name="end_date" onchange="form.submit()">
                </form>
            </div>

            <div class="search">
                <p>Từ khóa</p>
                <form action="progression.php" method="POST">
                    <input type="text" name="search" placeholder="Nhập từ khóa" autocomplete="off">
                    <button type="submit" id="submit" name="submit_search" class=""><img src="../picture/component/search.png" alt="search"></button>
                </form>
            </div>

            <a href="../dashboard/add/addprogress.php" class="add">
                <img src="../picture/component/add-square.png" alt="">
                <p>Cấp số mới</p>
            </a>
        </div>

        <ul>
            <img src="../picture/Logo alta.png" alt="logo" class="logo">

            <li><a href="../dashboard/index.php" class="dashboard"><img src="../picture/component/dashboard.png" alt="dashboard">
                    Dashboard</a>
            </li>

            <li><a href="../dashboard/monitor.php" class="monitor"><img src="../picture/component/monitor.png" alt="monitor">Thiết
                    bị</a></li>

            <li><a href="../dashboard/service.php" class="service"><img src="../picture/component/service.png" alt="service">Dịch vụ</a></li>

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

        <main id="mainmonitor" class="importance">
            <table style="width:100%" class="tablemonitor">
                <tr>
                    <th class="start">STT</th>
                    <th>Tên khách hàng</th>
                    <th>Tên dịch vụ</th>
                    <th>Thời gian cấp</th>
                    <th>Hạn sử dụng</th>
                    <th>Trạng thái</th>
                    <th>Nguồn cấp</th>
                    <th class="end"></th>
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

                if (isset($_POST['submit_search'])) {
                    $search = addslashes($_POST['search']);
                    if (empty($search)) {
                        $query = "SELECT * FROM progression LIMIT $start, $limit";
                    } else {
                        $query = "SELECT * FROM progression, service WHERE customerName LIKE '%$search%' OR service.serviceID = progression.serviceID AND prefix_id LIKE '%$search%' OR service.serviceID = progression.serviceID AND surfix_id LIKE '%$search%' OR service.serviceID = progression.serviceID AND serviceName LIKE '%$search%' LIMIT $start, $limit";
                    }
                } elseif (isset($_POST['search_select'])) {
                    $search_select = addslashes($_POST['search_select']);
                    if (empty($search_select)) {
                        $query = "SELECT * FROM progression LIMIT $start, $limit";
                    } elseif ($search_select == "All") {
                        $query = "SELECT * FROM progression LIMIT $start, $limit";
                    } else {
                        $query = "SELECT * FROM progression WHERE status LIKE '$search_select' OR supply LIKE '$search_select' OR serviceID LIKE '$search_select' LIMIT $start, $limit";
                    }
                } elseif (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                    $start_date_format = date("Y-m-d 00:00:00", strtotime($_POST['start_date']));
                    $end_date_format = date("Y-m-d 23:59:00", strtotime($_POST['end_date']));

                    if (empty($start_date_format && $end_date_format)) {
                        $query = "SELECT * FROM progression LIMIT $start, $limit";
                    } else {
                        $query = "SELECT * FROM `progression` WHERE `sellDate` BETWEEN '$start_date_format' AND '$end_date_format' LIMIT $start, $limit";
                    }
                } else {
                    $query = "SELECT * FROM progression LIMIT $start, $limit";
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

                        $sql_service = "SELECT * FROM progression, service WHERE $serviceID = service.serviceID AND $progressID = progression.progressID";
                        $query_service = mysqli_query($conn, $sql_service);
                        $row_service = mysqli_fetch_assoc($query_service);
                        $serviceName = $row_service['serviceName'];
                        $prefix = $row_service['prefix_id'];
                        $surfix = $row_service['surfix_id'];

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
                            <td><?php echo $customerName; ?></td>
                            <td><?php echo $serviceName; ?></td>
                            <td><?php echo $sell_date_format; ?></td>
                            <td><?php echo $use_date_format; ?></td>
                            <td><?php echo $status_master ?></td>
                            <td><?php echo $supply; ?></td>
                            <td id="end"><a href="../dashboard/detail/progressDetail.php?id=<?php echo $progressID ?>">Chi tiết</a></td>
                        </tr>

                <?php }
                }
                ?>
            </table>
        </main>

        <div class="pagination">
            <?php
            if ($current_page > 1 && $total_page > 1) {
                echo '<a class="pagination-box" href="progression.php?page=' . ($current_page - 1) . '"><img class="pagination-img" src="../picture/component/fi_left.png" alt="left"></a>';
            }

            for ($i = 1; $i <= 5; $i++) {
                if ($i == $current_page) {
                    echo '<span class="pagination-active">' . $i . '</span> ';
                } else {
                    echo '<a class="pagination-box" href="progression.php?page=' . $i . '">' . $i . '</a> ';
                }
            }
            echo "<a class='less'> ... </a>";
            echo '<a class="pagination-box" href="progression.php?page=' . $total_page . '">' . $total_page . '</a> ';

            if ($current_page < $total_page && $total_page > 1) {
                echo '<a class="pagination-box" href="progression.php?page=' . ($current_page + 1) . '"><img class="pagination-img" src="../picture/component/fi_right.png" alt="right"></a>';
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