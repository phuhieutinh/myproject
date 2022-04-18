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
    <link rel="stylesheet" href="../../css/add/addaccount.css">
</head>

<body>
    <header>
        <div id="add-page">
            <p class="addtop-page">Cài đặt hệ thống</p>
            <img src="../../picture/component/u_angle-right.png" alt="" class="angle">
            <p class="addtop-page">Quản lý tài khoản</p>
            <img src="../../picture/component/u_angle-right.png" alt="" class="angle">
            <p class="topbar">Thêm tài khoản</p>
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
        <p class="maccounttext">Quản lý tài khoản</p>
    </div>

    <main id="addaccount">
        <p class="top">Thông tin tài khoản</p>
        <form action="" id="addaccount">
            <div class="name">
                <label for="name">Họ tên<span class="required">*</span></label>
                <input type="text" name="name" placeholder="Nhập họ tên">
            </div>

            <div class="username">
                <label for="username">Tên đăng nhập<span class="required">*</span></label>
                <input type="text" name="username" placeholder="Nhập tên đăng nhập">
            </div>

            <div class="phone">
                <label for="phone">Số điện thoại<span class="required">*</span></label>
                <input type="text" name="phone" placeholder="Nhập số điện thoại">
            </div>

            <div class="password">
                <label for="password">Mật khẩu<span class="required">*</span></label>
                <input type="password" name="password" placeholder="Nhập mật khẩu">
            </div>
            <div class="comfirmpw">
                <label for="comfirmpw">Nhập lại mật khẩu<span class="required">*</span></label>
                <input type="password" name="comfirmpw" placeholder="Nhập lại mật khẩu">
            </div>

            <div class="email">
                <label for="email">Email<span class="required">*</span></label>
                <input type="text" name="email" placeholder="Nhập Email">
            </div>

            <div class="role">
                <label for="">Vai trò<span class="required">*</span></label>
                <select name="" id="">
                    <option value="" class="deco" disabled selected>chọn vai trò</option>
                    <option value="">Kế toán</option>
                    <option value="">Bác sĩ</option>
                </select>
            </div>

            <div class="status">
                <label for="">Tình trạng<span class="required">*</span></label>
                <select name="" id="">
                    <option value="" selected="selected">Hoạt động</option>
                    <option value="">Ngưng hoạt động</option>
                </select>
            </div>

            <div class="btn">
                <input type="submit" class="submit" value="Thêm">
                <a href="../../dashboard/submenu/maccount.php" class="cancel">Hủy bỏ</a>
            </div>
        </form>

        <div class="note">
            <span class="required">*</span>
            <p>Là trường thông tin bắt buộc</p>
        </div>
    </main>

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