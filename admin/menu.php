<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d3fa3cecaa.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <?php
        session_start();
        if (isset($_GET["task"]) && $_GET["task"] == "logout") {
            session_unset();
        }
        if (!$_SESSION) {
            header("location:login.php");
        } else {
            echo "<i class='fas fa-user-secret' style='margin: 100px 5px 0 490px;font-size:9em;color:#000'></i><br>";
            echo "<h1 style='font-size:30px;margin:20px 0;width:100%;text-align:center;'>Welcome ".$_SESSION["username"]." !</h1><br>";
            echo"<p style='text-align:center'>Select the website you want to go to:</p>";
            echo "<a class='btn btn-danger' href='login.php?task=logout' style='margin:20px 20px 20px 80px;'>Đăng xuất <i class='far fa-share-square'></i></a>";
            echo "<a class='btn btn-primary' href='brands.php' style='margin:20px;'>Quản Lý Hãng <i class='fab fa-bandcamp'></i></a>";
            echo "<a class='btn btn-secondary' href='category.php' style='margin:20px;'>Quản Lý Danh Mục <i class='fas fa-calendar-week'></i></a>";
            echo "<a class='btn btn-success' href='content.php' style='margin:20px;'>Quản Lý Content <i class='fas fa-desktop'></i></a>";
            echo "<a class='btn btn-warning' href='pro.php' style='margin:20px;'>Quản Lý Sản Phẩm <i class='fab fa-product-hunt'></i></a>";
            echo "<a class='btn btn-info' href='product.php' style='margin:20px 20px 20px 380px;'>Thêm Sản Phẩm <i class='fas fa-plus-circle'></i></a>";
            echo "<a class='btn btn-dark' href='slide.php' style='margin:20px;'>Thêm Content <i class='far fa-plus-square'></i></a>";
        }
        ?>
    </div>
</body>

</html>