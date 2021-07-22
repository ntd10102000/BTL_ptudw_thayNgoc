<?php
    session_start();
    if (isset($_GET["task"]) && $_GET["task"] == "logout") {
        session_unset();
    }
    if (!$_SESSION["username"]) {
        header("location:login.php");
    } else {
        echo "<i class='fas fa-user-secret' style='margin: 20px 5px 0 20px;font-size:1.5em;color:#000'></i>" . $_SESSION["username"];
        echo "<a class='btn btn-danger' href='login.php?task=logout' style='margin:20px;'>Đăng xuất <i class='far fa-share-square'></i></a>";
        echo "<a class='btn btn-primary' href='brands.php' style='margin:20px;'>Quản Lý Hãng <i class='fab fa-bandcamp'></i></a>";
        echo "<a class='btn btn-secondary' href='category.php' style='margin:20px;'>Quản Lý Danh Mục <i class='fas fa-calendar-week'></i></a>";
        echo "<a class='btn btn-success' href='content.php' style='margin:20px;'>Quản Lý Content <i class='fas fa-desktop'></i></a>";
        echo "<a class='btn btn-warning' href='pro.php' style='margin:20px;'>Quản Lý Sản Phẩm <i class='fab fa-product-hunt'></i></a>";
        echo "<a class='btn btn-info' href='product.php' style='margin:20px;'>Thêm Sản Phẩm <i class='fas fa-plus-circle'></i></a>";
        echo "<a class='btn btn-dark' href='slide.php' style='margin:20px;'>Thêm Content <i class='far fa-plus-square'></i></a>";
    }
?>