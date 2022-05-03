<?php
require_once '../dbconnect.php';
include '../function/function_userlog.php';

session_start();

$conn = connect_db();

if (isset($_SESSION['user_login'])) {

    if (isset($_SESSION['userID'])) {

        $id = $_SESSION['userID'];
        $sql = "SELECT * FROM user where userID = '$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            $userID = $id;
            $name = $row['name'];
        } else {
            exit;
        }
    }

    // add progress
    $progressID_form = 'SELECT max(id) + 1 FROM progression';

    if (isset($_POST['submit'])) {
        $progress_ID = $_POST['progressID'];
        $serviceID = $_POST['user_service'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $sell_date = date('Y-m-d H:i:s');
        $use_date = date('Y-m-d 17:30:00');
        $customerName = $_POST['customerName'];
        $customerPhone = $_POST['customerPhone'];
        $email = $_POST['email'];
        $status = "Đang chờ";
        $supply = "Kiosk";

        $sql = "INSERT INTO progression(progressID ,serviceID, sellDate, useDate, status, phone, email, customerName, supply) VALUES('$progress_ID', '$serviceID', '$sell_date', '$use_date', '$status', '$customerPhone', '$email', '$customerName', '$supply')";

        if (mysqli_query($conn, $sql)) {
            $log = "add progress success progressID";
            $update_userlog = userlog($log);
?>

            <body onload="addpopup()">

            </body>
    <?php
        } else {
            error_reporting(-1);
            echo '<script>alert("Bạn chưa chọn dịch vụ")</script>';
        }
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User interface</title>
        <link href="../css/user.css" rel="stylesheet">
    </head>

    <body>
        <div class="container" id="blur">
            <header>
                <p class="user_topbar">Quản lý cấp số</p>
            </header>

            <main id="user">
                <h1 id="main_top">CẤP SỐ MỚI</h1>
                <form action="index.php" method="POST" id="user">

                    <h2 class="top">Dịch vụ khách hàng lựa chọn</h2>

                    <input type="hidden" name="progressID" value="<?php echo $progressID_form ?>" ?>

                    <select name="user_service" id="user_service">
                        <option value="" class="deco" disabled selected>Chọn dịch vụ</option>
                        <?php
                        $sql_service = "SELECT * FROM service";
                        $query_service = mysqli_query($conn, $sql_service);

                        while ($row_service = mysqli_fetch_assoc($query_service)) {
                            $serviceID_select = $row_service['serviceID'];
                            $serviceName = $row_service['serviceName'];

                            echo "<option value='$serviceID_select'>$serviceName</option>";
                        }
                        ?>
                    </select>

                    <span class="popup_info" id="popupInfo">
                        <h1>Điền thông tin của bạn</h1>

                        <div id="customerName">
                            <label for="customerName">Họ và tên <span class="required">*</span></label>
                            <input type="text" name="customerName" placeholder="Nhập họ và tên của bạn">
                        </div>

                        <div id="customerPhone">
                            <label for="customerPhone">Số điện thoại <span class="required">*</span></label>
                            <input type="text" name="customerPhone" placeholder="Nhập số điện thoại của bạn">
                        </div>

                        <div id="email">
                            <label for="email">Email</label>
                            <input type="text" name="email" placeholder="Nhập Email của bạn">
                        </div>

                        <div class="note">
                            <span class="required">*</span>
                            <p>Là trường thông tin bắt buộc</p>
                        </div>

                        <div class="btn_info">
                            <input type="submit" class="submit_info" value="Xác nhận" name="submit">


                            <a href="index.php" class="cancel">Hủy bỏ</a>
                        </div>

                    </span>
                </form>

                <div class="btn" onclick="popup_info()">
                    <input type="submit" class="submit" value="Xác nhận">
                </div>

            </main>

            <nav class="slidebar">
                <ul>
                    <img src="../picture/Logo alta.png" alt="logo" class="logo">

                    <li><a href="" id="user_progress"><img src="../picture/component/progression.png" alt="progression"> Cấp
                            số </a>
                    </li>
                </ul>
            </nav>
        </div>

        <?php
        $sql_popup = "SELECT * FROM progression";
        $query_popup = mysqli_query($conn, $sql_popup);
        while ($row_popup = mysqli_fetch_assoc($query_popup)) {
            $serviceID_popup = $row_popup['serviceID'];
            $progressID_popup = $row_popup['progressID'];

            $sell_date_popup = date_create($row_popup['sellDate']);
            $sell_date_format = date_format($sell_date_popup, "H:i d/m/Y");

            $use_date_popup = date_create($row_popup['useDate']);
            $use_date_format = date_format($use_date_popup, "H:i d/m/Y");

            $sql_service_popup = "SELECT serviceName FROM progression, service WHERE $serviceID_popup = service.serviceID";
            $query_service_popup = mysqli_query($conn, $sql_service_popup);
            while ($row_service_popup = mysqli_fetch_assoc($query_service_popup)) {
                $serviceName_popup = $row_service_popup['serviceName'];
            }
        }
        ?>

        <span class="popuptext-progress" id="popupProgress">
            <a href="index.php" class="iconx"><img src="../picture/component/fi_x.png" alt=""></a>
            <h1>Số thứ tự được cấp</h1>
            <p><?php echo $progressID_popup ?></p>
            <h5>DV: <?php echo $serviceName_popup; ?> <h4>(tại quầy số 1)</h4>
            </h5>
            <div class="footer">
                <div class="order-time">
                    <label>Thời gian cấp: </label>
                    <p><?php echo $sell_date_format; ?></p>
                </div>

                <div class="use-time">
                    <label>Hạn sử dụng: </label>
                    <p><?php echo $use_date_format; ?></p>
                </div>
            </div>
        </span>

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