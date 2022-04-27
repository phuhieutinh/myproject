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
            $username = $row['username'];
            $phone = $row['phone'];
            $pw = $row['pw'];
            $email = $row['email'];
            $roleID = $row['roleID'];
            $picture = $row['picture'];

            $sql_role = "SELECT roleName FROM user, role WHERE $roleID = role.roleID";
            $query_role = mysqli_query($conn, $sql_role);
            while ($row_role = mysqli_fetch_assoc($query_role)) {
                $roleName = $row_role['roleName'];
            }
        } else {
            header("location:../logout.php");
            exit;
        }
    }

    if (isset($_POST['submit'])) {
        // move the file to the server
        $file_tmp = $_FILES['fileName']['tmp_name'];
        $name_file = $_FILES['fileName']['name'];
        // move the file to the server
        move_uploaded_file($file_tmp, '/user/' . $name_file);
        // header("location:../dashboard/info.php");
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
        <ul>
            <header>
                <p class="topbar">Thông tin cá nhân</p>

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

            <img src="../picture/Logo alta.png" alt="logo" class="logo">
            <li><a href="../dashboard/index.php" class="dashboard"><img src="../picture/component/dashboard.png" alt="dashboard">
                    Dashboard</a>
            </li>
            <li><a href="../dashboard/monitor.php" class="monitor"><img src="../picture/component/monitor.png" alt="monitor">Thiết bị</a></li>
            <li><a href="../dashboard/service.php" class="service"><img src="../picture/component/service.png" alt="service">Dịch vụ</a></li>
            <li><a href="../dashboard/progression.php" class="progression"><img src="../picture/component/progression.png" alt="progression">Cấp
                    số</a>
            </li>
            <li><a href="../dashboard/report.php" class="report"><img src="../picture/component/report.png" alt="report">Báo
                    cáo</a></li>

            <li><a href="" class="setting"><img src="../picture/component/setting.png" alt="setting">Cài đặt hệ
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

            <li><a href="../logout.php" class="logout"><img src="../picture/component/logout.png" alt="logout">Đăng xuất</a>
            </li>
        </ul>

        <main id="info">
            <div id="pic">
                <img src="<?php echo "../picture/avatar/" . $picture ?>" alt="" class="bigpicture">
                <div>
                    <label for="upload">
                        <span class="img_file" aria-hidden="true"></span>

                        <form action="../function/upload_file.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="userid" value="<?php echo $userID ?>">

                            <input type="file" id="upload" style="display:none" name="fileupload" onchange="form.submit()">
                        </form>
                    </label>
                </div>
                <p class="main username"><?php echo $name ?></p>
            </div>

            <div id="detail">
                <div class="name">
                    <label for="name">Tên người dùng</label>
                    <input type="text" name="name" class="fix" value="<?php echo $name ?>" readonly>
                </div>
                <div class="phone">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" name="phone" value="<?php echo $phone ?>" class="fix" readonly>
                </div>
                <div class="email">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php echo $email ?>" class="fix" readonly>
                </div>
                <div class="username">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" name="username" value="<?php echo $username ?>" class="fix" readonly>
                </div>
                <div class="password">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" value="<?php echo $pw ?>" class="fix" readonly>
                </div>
                <div class="role">
                    <label for="role">Vai trò</label>
                    <input type="text" name="role" value="<?php echo $roleName ?>" class="fix" readonly>
                </div>
            </div>
        </main>
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