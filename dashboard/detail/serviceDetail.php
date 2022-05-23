<?php
require_once '../../dbconnect.php';
require '../../function/function_nofication.php';

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

    if (isset($_GET['id'])) {
        $serviceID = $_GET['id'];

        $sql_service = "SELECT * FROM service where serviceID = '$serviceID'";
        $result_service = mysqli_query($conn, $sql_service);
        if (mysqli_num_rows($result_service) > 0) {
            $row_service = mysqli_fetch_assoc($result_service);

            $serviceName = $row_service['serviceName'];
            $descriptive = $row_service['descriptive'];
            $prefix = $row_service['prefix_id'];
            $surfix = $row_service['surfix_id'];
            $auto_stt = $row_service['stt_service'];
        } else {
            echo "NO DATA";
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
        <link rel="stylesheet" href="../../css/detail/serviceDetail.css">
    </head>

    <body>
        <header>
            <div id="add-page">
                <p class="addtop-service">Dịch vụ</p>
                <img src="../../picture/component/u_angle-right.png" alt="" class="angle">

                <p class="addtop-page"><a href="../../dashboard/service.php" style="text-decoration: none; color: rgba(126, 125, 136, 1);">Danh sách dịch vụ</a></p>

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
            <p class="maccounttext">Quản lý dịch vụ</p>

            <a href="../../dashboard/add/addservice.php?id=<?php echo $serviceID; ?>" class="edit">
                <img src="../../picture/component/edit-square.png" alt="">
                <p>Cập nhật Danh sách</p>
            </a>

            <a href="../../dashboard/service.php" class="back">
                <img src="../../picture/component/back-square.png" alt="">
                <p>Quay lại</p>
            </a>
        </div>

        <main id="serviceDetail">
            <p class="top">Thông tin dịch vụ</p>
            <div class="serviceCode">
                <h1>Mã dịch vụ: </h1>
                <p><?php echo $serviceID ?></p>
            </div>

            <div class="serviceName">
                <h1>Tên dịch vụ: </h1>
                <p><?php echo $serviceName ?></p>
            </div>

            <div class="descriptive">
                <h1>Mô tả: </h1>
                <p><?php echo $descriptive ?></p>
            </div>
            <?php

            ?>
            <p class="text-rule">Quy tắc cắp số</p>

            <div class="auto">
                <label for="auto">Tăng tự động</label>
                <div>
                    <input type="text" class="start" placeholder="<?php echo $auto_stt ?>" readonly />
                    <span>đến</span>
                    <input type="text" class="end" placeholder="9999" readonly />
                </div>
            </div>

            <div class="prefix">
                <label for="prefix">Prefix:</label>
                <input type="text" placeholder="<?php echo $prefix ?>" readonly>
            </div>

            <div class="reset">
                <label for="reset">Reset mỗi ngày</label>
            </div>

            <p class="example">Ví dụ: 201-2001</p>
        </main>

        <div id="table">
            <div class="activedropdown">
                <p>Trạng thái</p>
                <form action="" method="POST">
                    <select name="search_select" id="activedropdown" onchange="form.submit()">
                        <option value="" disabled selected style="display: none;">Tất cả</option>
                        <option value="All">Tất cả</option>
                        <option value="Đang chờ">Đang chờ</option>
                        <option value="Đã sử dụng">Đã sử dụng</option>
                        <option value="Bỏ qua">Bỏ qua</option>
                    </select>
                </form>
            </div>

            <div class="dateservice">
                <p>Chọn thời gian</p>
                <form action="" method="POST">
                    <input type="date" id="start">
                    <img src="../../picture/component/arrow-right.png" alt="">
                    <input type="date" id="end" name="end_date" onchange="form.submit()">
                </form>
            </div>

            <form action="" method="POST" class="search">
                <label for="search">Từ khóa</label>

                <input type="text" name="search" placeholder="Nhập từ khóa" autocomplete="off" onchange="form.submit()">
                <img src="../../picture/component/search.png" alt="search" class="imgsearch_serviceDetail">
                <!-- <button type=" submit" id="submit" name="submit_search" class=""></button> -->
            </form>

            <div id="tableDetail">
                <table class="table-serviceDetail" style="width: 100%">
                    <tr>
                        <th style="width:50%">Số thứ tự</th>
                        <th style="width:50%">Trạng thái</th>
                    </tr>

                    <?php
                    $sql_pagination = "SELECT count(progressID) as total from progression WHERE serviceID = $serviceID";
                    $result_pagination = mysqli_query($conn, $sql_pagination);
                    $row_pagination = mysqli_fetch_assoc($result_pagination);
                    $total_records = $row_pagination['total'];

                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $limit = 7;

                    $total_page = ceil($total_records / $limit);
                    if ($current_page > $total_page) {
                        $current_page = $total_page;
                    } else if ($current_page < 1) {
                        $current_page = 1;
                    }
                    $start = ($current_page - 1) * $limit;

                    if (isset($_POST['search'])) {
                        $search = addslashes($_POST['search']);
                        if (empty($search)) {
                            $query = "SELECT * FROM progression WHERE serviceID = $serviceID ORDER BY progressID DESC LIMIT $start, $limit";
                        } else {
                            $query = "SELECT * FROM progression WHERE stt_progress LIKE '$search' ORDER BY progressID DESC LIMIT $start, $limit";
                        }
                    } elseif (isset($_POST['search_select'])) {
                        $search_select = addslashes($_POST['search_select']);
                        if (empty($search_select)) {
                            $query = "SELECT * FROM progression WHERE serviceID = $serviceID ORDER BY progressID DESC LIMIT $start, $limit";
                        } elseif ($search_select == "All") {
                            $query = "SELECT * FROM progression WHERE serviceID = $serviceID ORDER BY progressID DESC LIMIT $start, $limit";
                        } else {
                            $query = "SELECT * FROM progression WHERE serviceID = $serviceID AND status LIKE '$search_select' ORDER BY progressID DESC LIMIT $start, $limit";
                        }
                    } elseif (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                        $start_date_format = date("Y-m-d 00:00:00", strtotime($_POST['start_date']));
                        $end_date_format = date("Y-m-d 23:59:00", strtotime($_POST['end_date']));

                        if (empty($start_date_format && $end_date_format)) {
                            echo 'No data';
                        } else {
                            $query = "SELECT * FROM `progression` WHERE `sellDate` BETWEEN '$start_date_format' AND '$end_date_format' ORDER BY progressID DESC LIMIT $start, $limit";
                        }
                    } else {
                        $query = "SELECT * FROM progression WHERE serviceID = $serviceID ORDER BY progressID DESC LIMIT $start, $limit";
                    }

                    $result_list = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result_list) > 0) {
                        while ($row_progress = mysqli_fetch_assoc($result_list)) {
                            $progressID = $row_progress['progressID'];
                            $stt_progress = $row_progress['stt_progress'];
                            $status = $row_progress['status'];

                            $waiting = '<img src="../../picture/component/EllipseBlue.png" alt="active">';

                            $done = '<img src="../../picture/component/EllipseGray.png" alt="active">';

                            $pass = '<img src="../../picture/component/EllipseRed.png" alt="active">';

                            if ($status == "Đang chờ") {
                                $status_master = $waiting . $status;
                            } elseif ($status == "Đã sử dụng") {
                                $status_master = $done . $status;
                            } else {
                                $status_master = $pass . $status;
                            }
                    ?>

                            <tr>
                                <td><?php echo $prefix . $stt_progress . $surfix; ?></td>
                                <td><?php echo $status_master ?></td>
                            </tr>
                    <?php }
                    }
                    ?>
                </table>
            </div>
        </div>

        <ul>
            <img src="../../picture/Logo alta.png" alt="logo" class="logo">
            <li><a href="../../dashboard/index.php" class="dashboard"><img src="../../picture/component/dashboard.png" alt="dashboard">
                    Dashboard</a>
            </li>

            <li><a href="../../dashboard/monitor.php" class="monitor"><img src="../../picture/component/monitor.png" alt="monitor">Thiết
                    bị</a></li>

            <li><a href="" id='service'><img src="../../picture/component/menu/service.png" alt="service">Dịch vụ</a></li>

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

        <div class="pagination">
            <?php
            if ($current_page > 1 && $total_page > 1) {
                echo '<a class="pagination-box" href="serviceDetail.php?page=' . ($current_page - 1) . '"><img class="pagination-img" src="../../picture/component/fi_left.png" alt="left"></a>';
            }

            for ($i = 1; $i <= 5; $i++) {
                if ($i == $current_page) {
                    echo '<span class="pagination-active">' . $i . '</span> ';
                } else {
                    echo '<a class="pagination-box" href="serviceDetail.php?page=' . $i . '">' . $i . '</a> ';
                }
            }
            echo "<a class='less'> ... </a>";
            echo '<a class="pagination-box" href="serviceDetail.php?page=' . $total_page . '">' . $total_page . '</a> ';

            if ($current_page < $total_page && $total_page > 1) {
                echo '<a class="pagination-box" href="serviceDetail.php?page=' . ($current_page + 1) . '"><img class="pagination-img" src="../../picture/component/fi_right.png" alt="right"></a>';
            }
            ?>
        </div>

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