<?php
require_once '../dbconnect.php';

$conn = connect_db();

if (isset($_POST['submit'])) {
    $update = $_POST['controlUpdate'];
    $userID = $_POST['accountID'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $comfirmpw = $_POST['comfirmpw'];
    $email = $_POST['email'];
    $roleID = $_POST['roleID'];
    $status = $_POST['status'];

    if ($update == 1) {
        if ($password != $comfirmpw) {
            echo '<script>alert("comfirm password does not equal password")</script>';
            session_destroy();
            header("location:../dashboard/add/addaccount.php");
        }
        if ($email) {
            $callquery = "SELECT * FROM user WHERE email = '$email'";
            $mailresult = mysqli_query($conn, $callquery);
            if (mysqli_num_rows($mailresult) == 2) {
                echo '<script>alert("Email have been registered")</script>';
            } else {
                //decrease quantity
                $sql_user = "SELECT * FROM user where userID = $userID";
                $result_user = mysqli_query($conn, $sql_user);
                $row_user = mysqli_fetch_assoc($result_user);

                $user_roleID = $row_user['roleID'];
                $sql_role = "SELECT * FROM role where roleID = $user_roleID";
                $result_role = mysqli_query($conn, $sql_role);
                $row_role = mysqli_fetch_assoc($result_role);
                $quantity = $row_role['quantity'];
                $total_quantity = $quantity - 1;

                $update = "UPDATE role SET quantity = '$total_quantity 'WHERE roleID = $user_roleID";
                mysqli_query($conn, $update);

                //update user
                $sql = "UPDATE user SET name='$name', username='$username', phone='$phone', pw='$password', email='$email', roleID='$roleID', status='$status' WHERE userID=$userID";

                //inscrease quantity
                $sql_role = "SELECT * FROM role where roleID = $roleID";
                $result_role = mysqli_query($conn, $sql_role);
                $row_role = mysqli_fetch_assoc($result_role);

                $quantity = $row_role['quantity'];
                $total_quantity = $quantity + 1;

                $update = "UPDATE role SET quantity = '$total_quantity 'WHERE roleID = $roleID";
                mysqli_query($conn, $update);
            }
        }
    } else {
        if ($password != $comfirmpw) {
            echo '<script>alert("comfirm password does not equal password")</script>';
        } else {
            $callquery = "SELECT * FROM user WHERE email = '$email'";
            $mailresult = mysqli_query($conn, $callquery);
            if (mysqli_num_rows($mailresult) == 1) {
                echo '<script>alert("Email have been registered")</script>';
                session_destroy();
                header("location: ../dashboard/add/addaccount.php");
            } else {
                $sql = "INSERT into user(userID ,name, username, phone, pw, email, roleID, status) VALUES('$userID', '$name', '$username', '$phone', '$password', '$email', '$roleID', '$status')";

                $sql_role = "SELECT * FROM role where roleID = $roleID";
                $result_role = mysqli_query($conn, $sql_role);
                $row_role = mysqli_fetch_assoc($result_role);

                $quantity = $row_role['quantity'];
                $total_quantity = $quantity + 1;

                $update = "UPDATE role SET quantity = '$total_quantity 'WHERE roleID = $roleID";
                mysqli_query($conn, $update);
            }
        }
    }


    if (mysqli_query($conn, $sql)) {
        header('location:../dashboard/submenu/maccount.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        header('location:../dashboard/add/addaccount.php');
    }
}