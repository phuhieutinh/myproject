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
        <link rel="stylesheet" href="../../css/add/addservice.css">
    </head>

    <body>
        <header>
            <div id="add-page">
                <p class="addtop-service">Dịch vụ</p>
                <img src="../../picture/component/u_angle-right.png" alt="" class="angle">
                <p class="addtop-page"><a href="../../dashboard/service.php" style="text-decoration: none; color: rgba(126, 125, 136, 1);">Danh sách dịch vụ</a></p>
                <img src="../../picture/component/u_angle-right.png" alt="" class="angle">
                <p class="topbar">Thêm dịch vụ</p>
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
            <p class="maccounttext">Quản lý dịch vụ</p>
        </div>

        <main id="addservice">
            <p class="top">Thông tin dịch vụ</p>
            <form action="" id="addservice">

                <div class="servicecode">
                    <label for="servicecode">Mã dịch vụ<span class="required">*</span></label>
                    <input type="text" name="servicecode">
                </div>

                <div class="servicename">
                    <label for="servicename">Tên vai trò<span class="required">*</span></label>
                    <input type="text" name="servicename" placeholder="">
                </div>

                <div class="descriptive">
                    <label for="descriptive">Mô tả</label>
                    <input type="text" name="descriptive" placeholder="Nhập mô tả">
                </div>

                <div class="btn">
                    <input type="submit" class="submit" value="Thêm dịch vụ">
                    <a href="../../dashboard/service.php" class="cancel">Hủy bỏ</a>
                </div>

                <p class="text-rule">Quy tắc cắp số</p>

                <div class="auto">
                    <input type="checkbox" id="auto" name="auto" value="">
                    <label for="auto">Tăng tự động từ:</label>
                    <div>
                        <input type="text" class="start" placeholder="0001" readonly />
                        <span>đến</span>
                        <input type="text" class="end" placeholder="9999" />
                    </div>
                </div>

                <div class="prefix">
                    <input type="checkbox" id="prefix" name="prefix" value="">
                    <label for="prefix">Prefix:</label>
                    <input type="text" placeholder="0001" readonly>
                </div>

                <div class="surfix">
                    <input type="checkbox" id="surfix" name="surfix" value="">
                    <label for="surfix">Surfix:</label>
                    <input type="text" placeholder="0001" readonly>
                </div>

                <div class="reset">
                    <input type="checkbox" id="reset" name="reset" value="">
                    <label for="reset">Reset mỗi ngày</label>
                </div>
            </form>

            <div class="note">
                <span class="required">*</span>
                <p>Là trường thông tin bắt buộc</p>
            </div>
        </main>

        <ul>
            <img src="../../picture/Logo alta.png" alt="logo" class="logo">
            <li><a href="../../dashboard/index.php" class="dashboard"><img src="../../picture/component/dashboard.png" alt="dashboard">
                    Dashboard</a>
            </li>
            <li><a href="../../dashboard/monitor.php" class="monitor"><img src="../../picture/component/monitor.png" alt="monitor">Thiết
                    bị</a></li>
            <li><a href="" id='service'><img src="../../picture/component/service.png" alt="service">Dịch vụ</a></li>
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