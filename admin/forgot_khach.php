<?php
require("../config/connect.php");
$error = '';

if (isset($_POST["forgot"])) {
    $us = $_POST["us"];
    $pa = $_POST["pa"];
    $rpa = $_POST["rpa"];
    // Kiểm tra điều kiện
    if (strlen($pa) < 6) {
        $error = "Mật khẩu pải lớn hơn 6 kí tự";
    }
    // Kiểm tra 2 mật khẩu xem có trùng không
    elseif ($pa != $rpa) {
        $error = "Mật khẩu không trùng nhau";
    } else {
        //kiểm tra xem tài khoản có đúng không
        $sql = "select * from tbl_khach where us_khach like '$us';";
        $sql_query = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($sql_query);
        if ($num > 0) {
            $md5pa = md5($pa);
            $sql_update = "UPDATE tbl_khach SET pa_khach = '$md5pa' where us_khach like '$us';";
            $is_update = mysqli_query($conn, $sql_update);
            if ($is_update) {
                header("Location:login_khach.php");
            } else {
                $error = "Lấy mk thất bại";
            }
        } else {
            $error = "Tài khoản không tồn tại";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d3fa3cecaa.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>

<body>
    <div class="loginbox" style="padding-bottom: 30px">
        <img src="../imgs/avatar.png" class="avatar">
        <h1>Forgot password</h1>
        <form action="forgot_khach.php" method="post">
            <p>User name</p>
            <input type="text" name="us" placeholder="Enter Username..." required>
            <p>Enter password new</p>
            <input type="password" name="pa" placeholder="Enter Password New..." required>
            <p>Enter the password</p>
            <input type="password" name="rpa" placeholder="Enter the password..." required>
            <input type="submit" name="forgot" value="Forgot" required>
            <input type="reset" name="reset" value="Retype" required>
        </form>
        <h3 style="color:red"><?php echo $error ?></h3>
    </div>
</body>

</html>