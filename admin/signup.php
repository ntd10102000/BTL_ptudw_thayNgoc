<?php
require("../config/connect.php");
$error = '';

if (isset($_POST["signup"])) {
    $us = $_POST["us"];
    $pa = $_POST["pa"];
    $rpa = $_POST["rpa"];
    $email = $_POST["email"];
    $sdt = $_POST["sdt"];
    $qw = $_POST["q_w"];
    $tl = $_POST["tl"];
    // Kiểm tra điều kiện
    if (strlen($pa) < 6) {
        $error = "Mật khẩu pải lớn hơn 6 kí tự";
    }
    // Kiểm tra 2 mật khẩu xem có trùng không
    elseif ($pa != $rpa) {
        $error = "Mật khẩu không trùng nhau";
    } else {
        //kiểm tra xem tài khoản tồn tại hay chưa
        $sql = "select * from tbl_user where us like '$us';";
        $sql_query = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($sql_query);
        if ($num == 0) {
            $md5pa = md5($pa);
            $sql_insert = "INSERT INTO tbl_user(`Email`,`SDT`,`us`,`pa`,`CauHoi`,`CauTraLoi`)
            VALUES('$email','$sdt','$us','$md5pa','$qw','$tl')";
            $is_insert = mysqli_query($conn, $sql_insert);
            if ($is_insert) {
                header("Location:login.php");
            } else {
                $error = "Đăng ký thất bại";
            }
        } else {
            $error = "Tài khoản đã tồn tại";
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
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>

<body>
    <div class="loginbox" style="padding-bottom: 30px">
        <img src="../imgs/avatar.png" class="avatar">
        <h1>register here</h1>
        <form action="signup.php" method="post">
            <p>User name</p>
            <input type="text" name="us" placeholder="Enter Username..." required>
            <p>Enter password</p>
            <input type="password" name="pa" placeholder="Enter Password..." required>
            <p>Enter the password</p>
            <input type="password" name="rpa" placeholder="Enter the password..." required>
            <p>Email</p>
            <input type="email" name="email" placeholder="Email..." required>
            <p>Phone number</p>
            <input type="tel" name="sdt" placeholder="Phone number..." required>
            <p>Choose a question</p>
            <select name="q_w">
                <option>Choose a question</option>
                <option value="Which school do you go to?">Which school do you go to?</option>
                <option value="where are you?">where are you?</option>
                <option value="when were you born?">when were you born?</option>
            </select>
            <p>Answer</p>
            <input type="text" name="tl" placeholder="Answer..." required>
            <input type="submit" name="signup" value="Sign Up" required>
            <input type="reset" name="reset" value="Re-register" required>
        </form>
        <h3 style="color:red"><?php echo $error ?></h3>
    </div>

</body>
</head>

</html>