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
            echo "0 results";
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
    </head>

    <body>
        <header>
            <div id="maccounttopbar">
                <p class="maccounttop">Cài đặt hệ thống</p>
                <img src="../../picture/component/u_angle-right.png" alt="" class="angle">
                <p class="topbar">Nhật ký hoạt động</p>
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

        <div class="userlog date">
            <p>Chọn thời gian</p>
            <form action="" method="POST">
                <input type="date" class="userlog datestart" name="start_date">
                <img src="../../picture/component/arrow-right.png" alt="">
                <input type="date" class="userlog dateend" name="end_date" onchange="form.submit()">
            </form>
        </div>

        <div id="mrolesearch" class="search">
            <p>Từ khóa</p>
            <form action="" method="POST">
                <input type="text" name="search" placeholder="Nhập từ khóa" autocomplete="off">
                <button type="submit" id="submit" name="submit_search" class=""><img src="../../picture/component/search.png" alt="search"></button>
            </form>
        </div>

        <ul>
            <img src="../../picture/Logo alta.png" alt="logo" class="logo">
            <li><a href="../../dashboard/index.php" class="dashboard"><img src="../../picture/component/dashboard.png" alt="dashboard">
                    Dashboard</a>
            </li>
            <li class="monitor"><a href="../../dashboard/monitor.php" class="monitor"><img src="../../picture/component/monitor.png" alt="monitor">Thiết
                    bị</a></li>
            <li><a href="../../dashboard/service.php" class="service"><img src="../../picture/component/service.png" alt="service">Dịch vụ</a></li>
            <li><a href="../../dashboard/progression.php" class="progression"><img src="../../picture/component/progression.png" alt="progression">Cấp
                    số</a>
            </li>
            <li><a href="../../dashboard/report.php" class="report"><img src="../../picture/component/report.png" alt="report">Báo
                    cáo</a></li>

            <li class="setting"><a href="" class="setting" id="setting"><img src="../../picture/component/setting.png" alt="setting">Cài
                    đặt
                    hệ
                    thống<img src="../../picture/component/dropdown.png" alt="dropdown" class="icondropdown"></a>
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
                        <a href="../../dashboard/submenu/userlog.php" id="userlog" class="userlog">
                            Nhật ký người dùng
                        </a>
                    </li>
                </ul>
            </li>

            <li><a href="../../logout.php" class="logout"><img src="../../picture/component/logout.png" alt="logout">Đăng
                    xuất</a>
            </li>
        </ul>

        <main id="userlog" class="importance">
            <table style="width:100%" class="tablemonitor">
                <tr>
                    <th class="start">Tên đăng nhập</th>
                    <th>Thời gian tác động</th>
                    <th>IP thực hiện</th>
                    <th class="end">Thao tác thực hiện</th>
                </tr>

                <?php
                $sql_pagination = 'SELECT count(userlogID) as total from userlog';
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
                        $query = "SELECT * FROM userlog LIMIT $start, $limit";
                    } else {
                        $query = "SELECT * FROM `userlog` WHERE `userlogTime` BETWEEN '$start_date_format' AND '$end_date_format' LIMIT $start, $limit";
                    }
                } elseif (isset($_POST['submit_search'])) {
                    $search = addslashes($_POST['search']);
                    if (empty($search)) {
                        $query = "SELECT * FROM userlog LIMIT $start, $limit";
                    } else {
                        $query = "SELECT * FROM userlog, user WHERE user.userID = userlog.userID AND username LIKE '%$search%' LIMIT $start, $limit";
                    }
                } else {
                    $query = "SELECT * FROM userlog ORDER BY userID DESC LIMIT $start, $limit";
                }
                $result_list = mysqli_query($conn, $query);

                if (mysqli_num_rows($result_list) > 0) {
                    while ($row_userlog = mysqli_fetch_assoc($result_list)) {
                        $userlogID = $row_userlog['userlogID'];
                        $IPaddress = $row_userlog['IPaddress'];

                        $userlogTime = date_create($row_userlog['userlogTime']);
                        $userlogTime_format = date_format($userlogTime, "H:i d/m/Y");

                        $userlogAction = $row_userlog['userlogAction'];
                        $userID = $row_userlog['userID'];

                        $sql_user = "SELECT username FROM userlog, user WHERE $userID = user.userID AND $userlogID = userlog.userlogID";
                        $query_user = mysqli_query($conn, $sql_user);
                        while ($row_user = mysqli_fetch_assoc($query_user)) {
                            $userlog_username = $row_user['username'];
                        }
                ?>

                        <tr>
                            <td id="start"><?php echo $userlog_username; ?></td>
                            <td><?php echo $userlogTime_format; ?></td>
                            <td><?php echo $IPaddress; ?></td>
                            <td id="end"><?php echo $userlogAction; ?></td>
                        </tr>

                <?php }
                }
                ?>
            </table>
        </main>

        <div class="pagination">
            <?php
            if ($current_page > 1 && $total_page > 1) {
                echo '<a class="pagination-box" href="userlog.php?page=' . ($current_page - 1) . '"><img class="pagination-img" src="../../picture/component/fi_left.png" alt="left"></a>';
            }

            for ($i = 1; $i <= 5; $i++) {
                if ($i == $current_page) {
                    echo '<span class="pagination-active">' . $i . '</span> ';
                } else {
                    echo '<a class="pagination-box" href="userlog.php?page=' . $i . '">' . $i . '</a> ';
                }
            }
            echo "<a class='less'> ... </a>";
            echo '<a class="pagination-box" href="userlog.php?page=' . $total_page . '">' . $total_page . '</a> ';

            if ($current_page < $total_page && $total_page > 1) {
                echo '<a class="pagination-box" href="userlog.php?page=' . ($current_page + 1) . '"><img class="pagination-img" src="../../picture/component/fi_right.png" alt="right"></a>';
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