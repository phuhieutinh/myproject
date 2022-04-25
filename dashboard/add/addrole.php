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

    $uid = "";
    if (isset($_GET['id'])) {
        $uid = $_GET['id'];
    }
    $roleID = 'int';
    $roleName = "";
    $descriptive = "";
    $isUpdated = 0;
    if ($uid != "") {
        $query = "SELECT * FROM role WHERE roleID = $uid";
        $rlquery = mysqli_query($conn, $query);
        while ($data = mysqli_fetch_assoc($rlquery)) {
            $roleID = $data['roleID'];
            $roleName = $data['roleName'];
            $descriptive = $data['descriptive'];
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
        <link rel="stylesheet" href="../../css/add/addrole.css">
    </head>

    <body>
        <header>
            <div id="add-page">
                <p class="addtop-page">Cài đặt hệ thống</p>
                <img src="../../picture/component/u_angle-right.png" alt="" class="angle">
                <p class="addtop-page"><a href="../../dashboard/submenu/mrole.php" style="text-decoration: none; color: rgba(126, 125, 136, 1);">Quản lý vai trò</a></p>
                <img src="../../picture/component/u_angle-right.png" alt="" class="angle">
                <p class="topbar">Thêm vai trò</p>
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
            <p class="maccounttext">Danh sách vai trò</p>
        </div>

        <main id="addrole">
            <p class="top">Thông tin vai trò</p>
            <form action="../../function/function_role.php" id="addrole" method="POST">

                <input type="hidden" name="controlUpdate" value="<?php echo $isUpdated ?>" />

                <input type="hidden" name="roleID" value="<?php echo $roleID ?>" <?php if ($isUpdated == 1) echo "readonly"; ?>>

                <div class="namerole">
                    <label for="roleName">Tên vai trò<span class="required">*</span></label>
                    <input type="text" name="roleName" value="<?php echo $roleName; ?>" placeholder="Nhập tên vai trò">
                </div>

                <div class="descriptive">
                    <label for="descriptive">Mô tả</label>
                    <input type="text" name="descriptive" placeholder="Nhập mô tả" value="<?php echo $descriptive; ?>">
                </div>

                <label for="" class="function-group">Phân quyền chức năng<span class="required">*</span></label>

                <div class="function-group">
                    <h1 class="functionA">Nhóm chức năng A</h1>
                    <div class="function1">
                        <input type="checkbox" id="function1" name="function1" value="">
                        <label for="function1"> Tất cả</label>
                    </div>

                    <div class="function2">
                        <input type="checkbox" id="function2" name="function2" value="">
                        <label for="function2"> Chức năng x</label>
                    </div>

                    <div class="function3">
                        <input type="checkbox" id="function3" name="function3" value="">
                        <label for="function3"> Chức năng y</label>
                    </div>

                    <div class="function4">
                        <input type="checkbox" id="function4" name="function4" value="">
                        <label for="function4"> Chức năng z</label>
                    </div>

                    <h1 class="functionB">Nhóm chức năng B</h1>

                    <div class="function5">
                        <input type="checkbox" id="function5" name="function5" value="">
                        <label for="function5"> Tất cả</label>
                    </div>

                    <div class="function6">
                        <input type="checkbox" id="function6" name="function6" value="">
                        <label for="function6"> Chức năng x</label>
                    </div>

                    <div class="function7">
                        <input type="checkbox" id="function7" name="function7" value="">
                        <label for="function7"> Chức năng y</label>
                    </div>

                    <div class="function8">
                        <input type="checkbox" id="function8" name="function8" value="">
                        <label for="function8"> Chức năng z</label>
                    </div>

                </div>

                <div class="btn">
                    <input type="submit" class="submit" name="submit" value="<?php echo ($isUpdated !== 1) ? "Thêm" : "Cập nhật" ?>">

                    <a href="../../dashboard/submenu/mrole.php" class="cancel">Hủy bỏ</a>
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
                    thống<img src="../../picture/component/dropdown.png" alt="dropdown" id="icondropdown"></a>
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