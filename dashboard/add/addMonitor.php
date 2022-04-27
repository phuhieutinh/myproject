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

    // add and update
    $uid = "";
    if (isset($_GET['id'])) {
        $uid = $_GET['id'];
    }
    $monitorID = 'SELECT max(id) + 1 FROM monitor';
    $monitorCode = "";
    $monitorName = "";
    $ipaddress = "";
    $username = "";
    $monitorPassword = "";
    $monitorType = "";
    $serviceID = [];
    $isUpdated = 0;
    if ($uid != "") {
        $query = "SELECT * FROM monitor WHERE monitorID = $uid";
        $rlquery = mysqli_query($conn, $query);
        while ($data = mysqli_fetch_assoc($rlquery)) {
            $monitorID = $data['monitorID'];
            $monitorCode = $data['monitorCode'];
            $monitorName = $data['monitorName'];
            $ipaddress = $data['ipaddress'];
            $username = $data['username'];
            $monitorPassword = $data['monitorPassword'];
            $monitorType = $data['monitorType'];
            $serviceID = $data['serviceID'];
            $nameService = $data['nameService'];
        }
        $isUpdated = 1;
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
        <link rel="stylesheet" href="../../css/add/addmonitor.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
        <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
    </head>

    <body>
        <header>
            <div id="add-page">
                <p class="addtop-monitor">Thiết bị</p>
                <img src="../../picture/component/u_angle-right.png" alt="" class="angle">
                <p class="addtop-page"><a href="../../dashboard/monitor.php" style="text-decoration: none; color: rgba(126, 125, 136, 1);">Danh sách thiết bị</a></p>
                <img src="../../picture/component/u_angle-right.png" alt="" class="angle">
                <p class="topbar">Thêm thiết bị</p>
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
            <p class="maccounttext">Quản lý thiết bị</p>
        </div>

        <main id="addmonitor">
            <p class="top">Thông tin thiết bị</p>
            <form action="../../function/function_monitor.php" id="addmonitor" method="POST">

                <input type="hidden" name="controlUpdate" value="<?php echo $isUpdated ?>" />

                <input type="hidden" name="monitorID" value="<?php echo $monitorID ?>" <?php if ($isUpdated == 1) echo "readonly"; ?>>

                <div class="monitorcode">
                    <label for="monitorcode">Mã thiết bị<span class="required">*</span></label>
                    <input type="text" id="data" name="monitorcode" value="<?php echo $monitorCode ?>" placeholder="Nhập Mã thiết bị">
                </div>

                <div class="monitorname">
                    <label for="monitorname">Tên thiết bị<span class="required">*</span></label>
                    <input type="text" name="monitorname" placeholder="Nhập tên thiết bị" id="data" value="<?php echo $monitorName ?>">
                </div>

                <div class="ipaddress">
                    <label for="ipaddress">Địa chỉ IP<span class="required">*</span></label>
                    <input type="text" name="ipaddress" placeholder="Nhập địa chỉ IP" id="data" value="<?php echo $ipaddress ?>">
                </div>

                <div class="type-monitor">
                    <label for="monitortype">Loại thiết bị<span class="required">*</span></label>

                    <select name="monitortype" id="type-monitor">
                        <option value="<?php echo ($monitorType == "") ? "" : $monitorType ?>" class="deco" selected>
                            <?php echo ($monitorType == "") ? "Chọn Loại thiết bị" : $monitorType ?>
                        </option>

                        <option value="Kiosk">Kiosk</option>
                        <option value="Display counter">Display counter</option>
                    </select>
                </div>

                <div class="username">
                    <label for="username">Tên đăng nhập<span class="required">*</span></label>
                    <input type="text" name="username" placeholder="Nhập tài khoản" id="data" value="<?php echo $username ?>">
                </div>

                <div class="password">
                    <label for="monitorPassword">Mật khẩu<span class="required">*</span></label>
                    <input type="password" name="monitorPassword" placeholder="Nhập mật khẩu" id="data" value="<?php echo $monitorPassword ?>">
                </div>

                <div class="useservice">
                    <label for="useservice">Dịch vụ sử dụng<span class="required">*</span></label>

                    <select name="states[]" multiple class="chosen-select">

                        <?php

                        $sql_serviceall = "SELECT * FROM service";
                        $query_serviceall = mysqli_query($conn, $sql_serviceall);

                        while ($row_serviceall = mysqli_fetch_assoc($query_serviceall)) {
                            $serviceID_select = $row_serviceall['serviceID'];
                            $serviceName = $row_serviceall['serviceName'];

                            echo "<option value='$serviceID_select'>$serviceName</option>";
                        }

                        ?>
                    </select>

                </div>

                <div class="btn">

                    <input type="submit" class="submit" value="Thêm thiết bị" name="submit">

                    <a href="../../dashboard/monitor.php" class="cancel">Hủy bỏ</a>
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

            <li><a href="" id="monitor"><img src="../../picture/component/monitor.png" alt="monitor">Thiết
                    bị</a></li>

            <li><a href="../../dashboard/service.php" class="service"><img src="../../picture/component/service.png" alt="service">Dịch vụ</a></li>

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