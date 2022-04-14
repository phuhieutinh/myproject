<?php
require_once 'dbconnect.php';

$conn = connect_db();

session_start();

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username && $password) {
        $sql = "SELECT * FROM user WHERE username = '$username' AND pw = '$password'";

        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) == 0) {
            header("location: wrongpw.php");
        } else {
            while ($row = mysqli_fetch_assoc($query)) {
                $userID = $row['userID'];
                $user_role = $row['user_role'];
            }
            switch ($user_role) {
                case "admin";
                    $_SESSION["admin_login"] = $username;
                    $_SESSION["userID"] = $userID;
                    header("location: ../dashboard/index.php");
                    break;
                case "user";
                    $_SESSION["user_login"] = $username;
                    $_SESSION["userID"] = $userID;
                    header("location: ../user/index.php");
                    break;
                default;
                    echo "wrong email or password or role";
                    break;
            }
        }
    }
}

if (isset($_SESSION['admin_login'])) {
    header("location: dashboard/index.php");
} else if (isset($_SESSION['user_login'])) {
    header("location: user/index.php");
} else {

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link href="css/login.css" rel="stylesheet">
</head>

<body>
    <img src="picture/Logo alta.png" alt="logo" class="logo">
    <main>

    </main>
    <div class="login">
        <img src="picture/Group 341.png" alt="pic" class="pic">
        <p class="system">Hệ Thống</p>
        <p class="manage">Quản Lý Xếp Hàng</p>

    </div>
    <form action="index.php" method="POST">
        <div class="username">
            <label for="username" class="username">Tên Đăng Nhập *</label>
            <input type="text" name="username" class="username">
        </div>
        <div class="pw">
            <label for="password" class="pw">Mật Khẩu *</label>
            <input type="password" name="password" class="pw">
        </div>
        <button type="submit" name="login" class="login">Đăng nhập</button>
    </form>
    <a href="login/forget.php" class="forget">Quên mật khẩu?</a>
    <?php
}
    ?>
</body>

</html>