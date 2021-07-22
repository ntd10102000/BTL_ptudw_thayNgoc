<?php
require("../config/connect.php");
//khởi tạo session ,tắt trình duyệt là out
session_start();


if (isset($_POST["login"])) {
    $us = $_POST["us"];
    $pa = $_POST["pa"];
    $md5pa = md5($pa);
    $sql = "select * from tbl_khach where us_khach like '$us' and pa_khach like '$md5pa'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION["khach"] = $us;
        $row = mysqli_fetch_assoc($result);
        $_SESSION["id_khach"] = $row["ID_Khach"];
        header("Location:../index_khach.php");
    } else {
        echo "Tài khoản hoặc mật khẩu của bạn không đúng";
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
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>

<body>
    <div class="loginbox" style="margin-top: 0;">
        <img src="../imgs/avatar.png" class="avatar">
        <h1>Login Here</h1>
        <form action="login_khach.php" method="post">
            <p>Username</p>
            <input type="text" name="us" placeholder="Enter Username..." required>
            <p>Password</p>
            <input type="password" name="pa" placeholder="Enter Password..." required>
            <input type="submit" name="login" value="Login">
            <a href="retrieval_khach.php">Lost your password?</a><br>
            <a href="signup_khach.php">Don't have an account?</a>
        </form>
    </div>
</body>

</html>