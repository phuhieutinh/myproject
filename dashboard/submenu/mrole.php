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
                <p class="topbar">Quản lý vai trò</p>
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
            <p class="managetext">Danh sách vai trò</p>
        </div>

        <div id="mrolesearch" class="search">
            <p>Từ khóa</p>
            <form action="mrole.php" method="POST">
                <input type="text" name="search" placeholder="Nhập từ khóa" autocomplete="off">
                <button type="submit" id="submit" name="submit_search" class=""><img src="../../picture/component/search.png" alt="search"></button>
            </form>

        </div>

        <a href="../../dashboard/add/addrole.php" class="add">
            <img src="../../picture/component/add-square.png" alt="">
            <p>Thêm vai trò</p>
        </a>
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

            <li><a href="" class="setting" id="setting"><img src="../../picture/component/setting.png" alt="setting">Cài
                    đặt
                    hệ
                    thống<img src="../../picture/component/dropdown.png" alt="dropdown" class="icondropdown"></a>
                <ul class="submenu">
                    <li>
                        <a href="../../dashboard/submenu/mrole.php" id="mrole" class="managerole">
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

        <main id="mainmrole" class="importance">
            <table style="width:100%" class="tablemonitor">
                <tr>
                    <th>Tên vai trò</th>
                    <th>Số người dùng</th>
                    <th>Mô tả</th>
                    <th></th>
                </tr>
                <?php
                $sql_pagination = 'SELECT count(roleID) as total from role';
                $result_pagination = mysqli_query($conn, $sql_pagination);
                $row_pagination = mysqli_fetch_assoc($result_pagination);
                $total_records = $row_pagination['total'];

                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                $limit = 5;

                $total_page = ceil($total_records / $limit);
                if ($current_page > $total_page) {
                    $current_page = $total_page;
                } else if ($current_page < 1) {
                    $current_page = 1;
                }
                $start = ($current_page - 1) * $limit;

                if (isset($_POST['submit_search'])) {
                    $search = $_POST['search'];
                    if (empty($search)) {
                        $query = "SELECT * FROM role LIMIT $start, $limit";
                    } else {
                        $query = "SELECT * FROM role WHERE roleName LIKE '%$search%' LIMIT $start, $limit";
                    }
                } else {
                    $query = "SELECT * FROM role LIMIT $start, $limit";
                }
                $result_list = mysqli_query($conn, $query);
                if (mysqli_num_rows($result_list) > 0) {
                    while ($row = mysqli_fetch_assoc($result_list)) {
                        $roleID = $row['roleID'];
                        $roleName = $row['roleName'];
                        $quantity = $row['quantity'];
                        $descriptive = $row['descriptive'];
                ?>
                        <tr>
                            <td><?php echo $roleName; ?></td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo $descriptive; ?></td>
                            <td><a href="../../dashboard/add/addrole.php?id=<?php echo $roleID; ?>">Cập nhật</a></td>
                        </tr>
                <?php }
                }
                ?>
            </table>
        </main>

        <div class="pagination mrole">
            <?php
            if ($current_page > 1 && $total_page > 1) {
                echo '<a class="pagination-box" href="mrole.php?page=' . ($current_page - 1) . '"><img class="pagination-img" src="../../picture/component/fi_left.png" alt="left"></a>';
            }

            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $current_page) {
                    echo '<span class="pagination-active">' . $i . '</span> ';
                } else {
                    echo '<a class="pagination-box" href="mrole.php?page=' . $i . '">' . $i . '</a> ';
                }
            }

            if ($current_page < $total_page && $total_page > 1) {
                echo '<a class="pagination-box" href="mrole.php?page=' . ($current_page + 1) . '"><img class="pagination-img" src="../../picture/component/fi_right.png" alt="right"></a>';
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