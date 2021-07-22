<?php
require("../config/connect.php");
$error = '';

if (isset($_POST["retrieval"])) {
    $us = $_POST["us"];
    $email = $_POST["email"];
    $sdt = $_POST["sdt"];
    $qw = $_POST["q_w"];
    $tl = $_POST["tl"];
    $sql = "select * from tbl_user where us like '$us' and CauHoi like '$qw' and CauTraLoi like '$tl' and Email like '$email' and SDT = $sdt;";
    $sql_query = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($sql_query);
    if ($num > 0) {
        header("Location:forgot.php");
    } else {
        $error = "Tài khoản không tồn tại or câu hỏi , câu tl không đúng";
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
    <title>Retrieval</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>

<body>
    <div class="loginbox" style="padding-bottom: 30px">
        <img src="../imgs/avatar.png" class="avatar">
        <h1>Forgot password</h1>
        <form action="retrieval.php" method="post">
            <p>User name</p>
            <input type="text" name="us" placeholder="Enter Username..." required>
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
            <input type="submit" name="retrieval" value="Next" required>
            <input type="reset" name="reset" value="Re-register" required>
        </form>
        <h3 style="color:red"><?php echo $error ?></h3>
    </div>
</body>

</html>