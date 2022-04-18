<?php
require_once '../dbconnect.php';

$conn = connect_db();

session_start();


if (
    isset($_SESSION['userID'])
    && isset($_POST['updatepassword'])
    && isset($_POST['comfirmpassword'])
) {
    $id = $_SESSION['userID'];
    $updatepassword = $_POST['updatepassword'];
    $comfirmpassword = $_POST['comfirmpassword'];

    if ($updatepassword !== $comfirmpassword) {
        echo '<script>alert("mật khẩu không trùng khớp")</script>';
    } else {
        $sql = "UPDATE user SET pw='$comfirmpassword' WHERE userID=$id";
        if (mysqli_query($conn, $sql)) {
            header('location:../logout.php');
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget password</title>
    <link href="../css/login.css" rel="stylesheet">
</head>

<body>
    <img src="../picture/Logo alta.png" alt="logo" class="logo">
    <main>

    </main>
    <div class="hello">
        <img src="../picture/Frame.png" alt="pic" class="pic">
    </div>
    <form action="updatepw.php" method="POST">
        <p class="updatepw">Đặt lại mật Khẩu mới</p>
        <label for="updatepassword" class="updatepassword">Mật Khẩu</label>
        <input type="password" name="updatepassword" class="updatepassword">
        <div class="comfirmpassword" for="comfirmpassword">
            <label for="comfirmpassword" class="comfirmpassword">Nhập lại mật khẩu</label>
            <input type="password" name="comfirmpassword" class="comfirmpassword">
        </div>
        <button type="submit" class="comfirm">Xác nhận</button>
    </form>

</body>

</html>