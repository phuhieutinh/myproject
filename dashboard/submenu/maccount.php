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
</head>

<body>
    <header>
        <div id="maccounttopbar">
            <p class="maccounttop">Cài đặt hệ thống</p>
            <img src="../../picture/component/u_angle-right.png" alt="" class="angle">
            <p class="topbar">Quản lý tài khoản</p>
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
        <p class="maccounttext">Danh sách tài khoản</p>
        <div class="activedropdown">
            <p>Trạng thái</p>
            <select name="" onchange="location = this.value;" id="activedropdown">
                <option value="maccount.php">Tất cả</option>
                <option value="">Hoạt động</option>
                <option value="">Ngưng hoạt động</option>
            </select>
        </div>

        <div class=" search">
            <p>Từ khóa</p>
            <input type="text" name="search" placeholder="Nhập từ khóa">
            <img src="../../picture/component/search.png" alt="search">
        </div>

        <a href="../../dashboard/add/addaccount.php" class="add">
            <img src="../../picture/component/add-square.png" alt="">
            <p>Thêm tài khoản</p>
        </a>
    </div>

    <ul>
        <img src="../../picture/Logo alta.png" alt="logo" class="logo">
        <li><a href="../../dashboard/index.php" class="dashboard"><img src="../../picture/component/dashboard.png"
                    alt="dashboard">
                Dashboard</a>
        </li>
        <li class="monitor"><a href="../../dashboard/monitor.php" class="monitor"><img
                    src="../../picture/component/monitor.png" alt="monitor">Thiết
                bị</a></li>
        <li><a href="../../dashboard/service.php" class="service"><img src="../../picture/component/service.png"
                    alt="service">Dịch vụ</a></li>
        <li><a href="../../dashboard/progression.php" class="progression"><img
                    src="../../picture/component/progression.png" alt="progression">Cấp
                số</a>
        </li>
        <li><a href="../../dashboard/report.php" class="report"><img src="../../picture/component/report.png"
                    alt="report">Báo
                cáo</a></li>

        <li class="setting"><a href="" class="setting" id="setting"><img src="../../picture/component/setting.png"
                    alt="setting">Cài
                đặt
                hệ
                thống<img src="../../picture/component/dropdown.png" alt="dropdown" id="icondropdown"></a>
            <ul class="submenu">
                <li>
                    <a href="../../dashboard/submenu/mrole.php">
                        Quản lý vai trò
                    </a>
                </li>
                <li>
                    <a href="../../dashboard/submenu/maccount.php" id="maccount" class="maccount">
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

    <main id="mainmonitor">
        <table style="width:100%" class="tablemonitor">
            <tr>
                <th>Tên đăng Nhập</th>
                <th>Họ tên</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Trạng thái Hoạt động</th>
                <th></th>
            </tr>
            <?php
                $sql_pagination = 'SELECT count(userID) as total from user';
                $result_pagination = mysqli_query($conn, $sql_pagination);
                $row_pagination = mysqli_fetch_assoc($result_pagination);
                $total_records = $row_pagination['total'];

                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                $limit = 8;

                $total_page = ceil($total_records / $limit);
                if ($current_page > $total_page) {
                    $current_page = $total_page;
                } else if ($current_page < 1) {
                    $current_page = 1;
                }
                $start = ($current_page - 1) * $limit;

                $query = "SELECT * FROM user LIMIT $start, $limit";
                $result_list = mysqli_query($conn, $query);


                $query = "SELECT * FROM user";
                $data = mysqli_query($conn, $query);
                if (mysqli_num_rows($result_list) > 0) {
                    while ($row = mysqli_fetch_assoc($result_list)) {
                        $userid = $row['userID'];
                        $Name = $row['name'];
                        $username = $row['username'];
                        $phone = $row['phone'];
                        $email = $row['email'];
                        $roleID = $row['roleID'];
                        $status = $row['status'];

                        $active = '<img src="../../picture/component/EllipseGreen.png" alt="active">';

                        $stopActive = '<img src="../../picture/component/EllipseRed.png" alt="active">';

                        $sql_role = "SELECT roleName FROM user, role WHERE $roleID = role.roleID";
                        $query_role = mysqli_query($conn, $sql_role);
                        while ($row_role = mysqli_fetch_assoc($query_role)) {
                            $roleName = $row_role['roleName'];
                        }
                ?>

            <tr>
                <td><?php echo $username; ?></td>
                <td><?php echo $Name; ?></td>
                <td><?php echo $phone; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $roleName; ?></td>
                <td><?php echo ($status == "Hoạt động") ? $active . $status : $stopActive . $status; ?></td>
                <td><a href="../../dashboard/add/addaccount.php?id=<?php echo $userid; ?>">Cập nhật</a></td>
            </tr>
            <?php }
                }
                ?>
        </table>

    </main>

    <div class="pagination">
        <?php
            if ($current_page > 1 && $total_page > 1) {
                echo '<a href="maccount.php?page=' . ($current_page - 1) . '">Prev</a> | ';
            }

            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $current_page) {
                    echo '<span>' . $i . '</span> | ';
                } else {
                    echo '<a href="maccount.php?page=' . $i . '">' . $i . '</a> | ';
                }
            }

            if ($current_page < $total_page && $total_page > 1) {
                echo '<a href="maccount.php?page=' . ($current_page + 1) . '">Next</a> | ';
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