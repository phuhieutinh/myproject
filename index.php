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
    <form action="dashboard/info.php" method="">
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

</body>

</html>