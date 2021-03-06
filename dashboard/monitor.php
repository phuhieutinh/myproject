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
        <style>
            .readmore {
                max-width: 371px;
                max-height: 49px;
                /* border: 1px solid #333; */
                padding: 10px;
            }

            .readless {
                position: sticky;
                padding: 27px 391px 9px 1px;
            }

            .readmore.less {
                max-width: 371px !important;
                max-height: 31px !important;
                white-space: nowrap;
                text-overflow: ellipsis;
                overflow: hidden;
            }
        </style>
    </head>

    <body>
        <header class="monitor">
            <div id="topbar">
                <p class="text1">Thiết bị</p>
                <img src="../picture/component/u_angle-right.png" alt="" class="angle">
                <p class="topbar">Danh sách thiết bị</p>
            </div>


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

        <div>
            <p class="managetext">Danh sách thiết bị</p>
            <div class="activedropdown">
                <p>Trạng thái hoạt động</p>
                <form action="monitor.php" method="POST">
                    <div class="select_monitor">
                        <select name="search_select" id="activedropdown" onchange="form.submit()">
                            <option value="" disabled selected style="display: none;">Tất cả</option>
                            <option value="All">Tất cả</option>
                            <option value="Hoạt động">Hoạt động</option>
                            <option value="Ngưng hoạt động">Ngưng hoạt động</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="connectdropdown">
                <p>Trạng thái kết nối</p>
                <form action="monitor.php" method="POST">
                    <div class="select_monitor">
                        <select name="search_select" id="connectdropdown" onchange="form.submit()">
                            <option value="" disabled selected style="display: none;">Tất cả</option>
                            <option value="All">Tất cả</option>
                            <option value="Kết nối">Kết nối</option>
                            <option value="Mất Kết nối">Mất Kết nối</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="search">
                <p>Từ khóa</p>
                <form action="monitor.php" method="POST">
                    <input type="text" name="search" placeholder="Nhập từ khóa" autocomplete="off">
                    <button type="submit" id="submit" name="submit_search" class=""><img src="../picture/component/search.png" alt="search"></button>
                </form>
            </div>

            <a href="../dashboard/add/addMonitor.php" class="add">
                <img src="../picture/component/add-square.png" alt="">
                <p>Thêm thiết bị</p>
            </a>
        </div>

        <ul>
            <img src="../picture/Logo alta.png" alt="logo" class="logo">
            <li><a href="../dashboard/index.php" class="dashboard"><img src="../picture/component/dashboard.png" alt="dashboard">
                    Dashboard</a>
            </li>
            <li><a href="" id="monitor"><img src="../picture/component/menu/monitor.png" alt="monitor">Thiết
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

        <main id="mainmonitor" class="importance">
            <table style="width:100%; max-height: 100%" class="tablemonitor">
                <tr>
                    <th class="start">Mã thiết bị</th>
                    <th>Tên thiết bị</th>
                    <th>Địa chỉ IP</th>
                    <th>Trạng thái Hoạt động</th>
                    <th>Trạng thái kết nối</th>
                    <th id="activeservice">Dịch vụ sử dụng</th>
                    <th></th>
                    <th class="end"></th>
                </tr>
                <?php
                $sql_pagination = 'SELECT count(monitorID) as total from monitor';
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

                if (isset($_POST['submit_search'])) {
                    $search = addslashes($_POST['search']);
                    if (empty($search)) {
                        $query = "SELECT * FROM monitor ORDER BY monitorID DESC LIMIT $start, $limit";
                    } else {
                        $query = "SELECT * FROM monitor WHERE monitorName LIKE '%$search%' OR nameService LIKE '%$search%' ORDER BY monitorID DESC LIMIT $start, $limit";
                    }
                } elseif (isset($_POST['search_select'])) {
                    $search_select = addslashes($_POST['search_select']);
                    if (empty($search_select)) {
                        $query = "SELECT * FROM monitor ORDER BY monitorID DESC LIMIT $start, $limit";
                    } elseif ($search_select == 'All') {
                        $query = "SELECT * FROM monitor ORDER BY monitorID DESC LIMIT $start, $limit";
                    } else {
                        $query = "SELECT * FROM monitor WHERE monitorStatus LIKE '$search_select' OR statusConnect LIKE '$search_select' ORDER BY monitorID DESC LIMIT $start, $limit";
                    }
                } else {
                    $query = "SELECT * FROM monitor ORDER BY monitorID DESC LIMIT $start, $limit";
                }

                $result_list = mysqli_query($conn, $query);

                if (mysqli_num_rows($result_list) > 0) {
                    while ($row_monitor = mysqli_fetch_assoc($result_list)) {
                        $monitorID = $row_monitor['monitorID'];
                        $monitorCode = $row_monitor['monitorCode'];
                        $monitorName = $row_monitor['monitorName'];
                        $ipaddress = $row_monitor['ipaddress'];
                        $status_active = $row_monitor['monitorStatus'];
                        $status_connect = $row_monitor['statusConnect'];
                        $nameService = $row_monitor['nameService'];

                        $active = '<img src="../picture/component/EllipseGreen.png" alt="active">';

                        $stopActive = '<img src="../picture/component/EllipseRed.png" alt="active">';
                ?>
                        <tr>
                            <td id="start"><?php echo $monitorCode; ?></td>
                            <td><?php echo $monitorName; ?></td>
                            <td><?php echo $ipaddress; ?></td>
                            <td><?php echo ($status_active == "Hoạt động") ? $active . $status_active : $stopActive . $status_active; ?></td>
                            <td><?php echo ($status_connect == "Kết nối") ? $active . $status_connect : $stopActive . $status_connect; ?></td>
                            <td>
                                <div class='readmore'>
                                    <?php echo $nameService; ?>
                                </div>
                            </td>
                            <td><a href="../dashboard/detail/monitorDetail.php?id=<?php echo $monitorID ?>">Chi tiết</a></td>
                            <td id="end"><a href="../dashboard/add/addMonitor.php?id=<?php echo $monitorID; ?>">Cập nhật</a></td>
                        </tr>
                <?php }
                }
                ?>
            </table>
        </main>

        <div class="pagination">
            <?php
            if ($current_page > 1 && $total_page > 1) {
                echo '<a class="pagination-box" href="monitor.php?page=' . ($current_page - 1) . '"><img class="pagination-img" src="../picture/component/fi_left.png" alt="left"></a>';
            }

            for ($i = 1; $i <= 5; $i++) {
                if ($i == $current_page) {
                    echo '<span class="pagination-active">' . $i . '</span> ';
                } else {
                    echo '<a class="pagination-box" href="monitor.php?page=' . $i . '">' . $i . '</a> ';
                }
            }
            echo "<a class='less'> ... </a>";
            echo '<a class="pagination-box" href="monitor.php?page=' . $total_page . '">' . $total_page . '</a> ';

            if ($current_page < $total_page && $total_page > 1) {
                echo '<a class="pagination-box" href="monitor.php?page=' . ($current_page + 1) . '"><img class="pagination-img" src="../picture/component/fi_right.png" alt="right"></a>';
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
    <script>
        window.onload = function() {
            let rm = document.querySelectorAll('.readmore');
            rm.forEach(el => {
                el.classList.add('less');
                var div = document.createElement('div');
                div.innerHTML = "<a href='javascript:void(0);' class='rmlink' onclick='toggleRM(this)'>Xem Thêm</a>";
                el.append(div);

            })
        }

        function toggleRM(el) {
            const cl = el.parentNode.parentNode.classList
            const is_less = cl.contains('less');
            el.innerHTML = !is_less ? "Xem Thêm" : "<a href='javascript:void(0);' class='readless' onclick='toggleRM(this)'></a>";
            if (is_less) cl.remove('less');
            else cl.add('less');
        }
    </script>
    </body>

    </html>