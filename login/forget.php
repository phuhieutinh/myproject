<?php
require_once '../dbconnect.php';

$conn = connect_db();

session_start();


if (isset($_POST['email'])) {
    $email = $_POST['email'];

    if ($email) {
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) == 0) {
            echo '<script>alert("does not have email and please enter email again")</script>';
            session_destroy();
        } else {
            while ($row = mysqli_fetch_assoc($query)) {
                $userID = $row['userID'];
            }
            $_SESSION["userID"] = $userID;
            header("location: ../login/updatepw.php");
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
    <form action="forget.php" method="POST">
        <p class="pw">Đặt lại mật Khẩu</p>
        <label for="username" class="email">Vui lòng nhập email để đặt lại mật khẩu của bạn *</label>
        <input type="text" name="email" class="email">
        <button type="submit" class="continue">Tiếp tục</button>
    </form>
    <a href="../logout.php"><button class="cancel">Hủy</button></a>
</body>

</html>