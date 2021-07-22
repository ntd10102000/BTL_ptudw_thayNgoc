<?php
require("config/connect.php");
session_start();
if (isset($_GET["task"]) && $_GET["task"] == "logout_khach") {
    session_unset();
}
if (!$_SESSION) {
    header("location:admin/login_khach.php");
} else {
}
require("data_menu.php");

if (isset($_POST["insert-cart"])) {
    //khai báo biến thực hiện câu truy vấn sql insert data
    $sql_insert = "insert into tbl_giohang(ID_SanPham, ID_Khach) values(" . $_POST["id_sp"] . ", " . $_SESSION["id_khach"] . ");";
    if (mysqli_query($conn, $sql_insert)) {
        //tránh insert lặp dữ liệu
        echo "thêm mới dữ liệu thành công";
        header("location:cart.php");
    } else {
        echo "thất bại" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AD3H Store</title>
    <?php require("head.php"); ?>
    <link rel="stylesheet" href="css/home.css">
</head>

<style>
    .box-star {
        float: right;
        width: 100px;
        height: 20px;
        background-image: url("imgs/anh-1.png");
        background-size: 20px 20px;
        background-repeat: repeat-x;
    }

    .box-star .star1 {
        float: left;
        height: 20px;
        background-image: url("imgs/anh-2.png");
        background-size: 20px 20px;
        background-repeat: repeat-x;
    }
</style>

<body>
    <?php require("menu.php"); ?>

    <section class="col-xl-12 slide1">
        <div class="container-fluid">
            <div class="row">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <?php
                    $sql_select_slide1 = "select * from tbl_slide where ID_Slide = 3";
                    $ketqua_slide1 = mysqli_query($conn, $sql_select_slide1);
                    $slide1 = mysqli_fetch_assoc($ketqua_slide1);
                    $sql_select_slide2 = "select * from tbl_slide where ID_Slide = 4";
                    $ketqua_slide2 = mysqli_query($conn, $sql_select_slide2);
                    $slide2 = mysqli_fetch_assoc($ketqua_slide2);
                    $sql_select_slide3 = "select * from tbl_slide where ID_Slide = 5";
                    $ketqua_slide3 = mysqli_query($conn, $sql_select_slide3);
                    $slide3 = mysqli_fetch_assoc($ketqua_slide3);
                    ?>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="imgs/phono-slider-1_2000x.jpg">
                            <div class="slide_left col-xl-7 slide_right animated wow fadeInRight" style="float: right">
                                <h5 class="slide-text" style="display:inline-block;font-size: 20px;color:#ffffff;font-weight: 600;margin-bottom: 25px">
                                    <?php
                                    echo $slide1["Ten_Slide"];
                                    ?>
                                </h5>
                                <h2 class="slide-heading" style="font-size: 50px;color:#ffffff;font-weight: 700;">
                                    <?php
                                    echo $slide1["MoTa"];
                                    ?>
                                </h2>
                                <a href="#" class="slide-button btn">
                                    BUY NOW
                                </a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="imgs/phono-slider-2_2000x.jpg">
                            <div class="slide_left col-xl-7 animated wow fadeInLeft">
                                <h5 class="slide-text" style="display:inline-block;font-size: 20px;color:#212121;font-weight: 600;margin-bottom: 25px">
                                    <?php
                                    echo $slide2["Ten_Slide"];
                                    ?>
                                </h5>
                                <h2 class="slide-heading" style="font-size: 50px;color:#212121;font-weight: 700;">
                                    <?php
                                    echo $slide2["MoTa"];
                                    ?>
                                </h2>
                                <a href="" class="slide-button btn">
                                    BUY NOW
                                </a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="imgs/phono-slider-3_2000x.jpg">
                            <div class="slide_left col-xl-7 slid    e_right animated wow fadeInRight" style="float: right">
                                <h5 class="slide-text" style="display:inline-block;font-size: 20px;color:#ffffff;font-weight: 600;margin-bottom: 25px">
                                    <?php
                                    echo $slide3["Ten_Slide"];
                                    ?>
                                </h5>
                                <h2 class="slide-heading" style="font-size: 50px;color:#ffffff;font-weight: 700;">
                                    <?php
                                    echo $slide3["MoTa"];
                                    ?>
                                </h2>
                                <a href="" class="slide-button btn" style="border: 2px solid #ffffff;background-color: #111113;color: #ffffff">
                                    BUY NOW
                                </a>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev slide_arrow" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <i class="fas fa-chevron-left" style="margin-right: 100px"></i>
                    </a>
                    <a class="carousel-control-next slide_arrow" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <i class="fas fa-chevron-right" style="margin-left: 100px"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="col-xl-12 slide2">
        <div class="container">
            <div class="content">
                <?php
                $sql_support = "select * from tbl_slide where ID_DanhMuc = 18";
                $support = mysqli_query($conn, $sql_support);
                if (mysqli_num_rows($support) > 0) {
                    while ($row = mysqli_fetch_assoc($support)) {
                        echo "<div class='col-xl-4 service'>
                                <img src='admin/" . $row["HinhAnh"] . "'>
                                <div class='content_service'>
                                    <h6>" . $row["Ten_Slide"] . "</h6>
                                    <p>" . $row["MoTa"] . "</p>
                                </div>
                            </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-xl-12 slide3">
        <div class="container" style="padding: 0">
            <div class="slide_heading">
                <h2>WHAT MAKES THE ESSENTIAL DIFFERENT?</h2>
                <p>EXPERIENCE HIGH PERFORMANCE AND SECURE</p>
            </div>
            <div class="col-xl-12" style="padding: 0">
                <div class="row animated wow fadeInUp">
                    <?php
                    $sql_different = "select * from tbl_slide where ID_DanhMuc = 19";
                    $different = mysqli_query($conn, $sql_different);
                    if (mysqli_num_rows($different) > 0) {
                        while ($row = mysqli_fetch_assoc($different)) {
                            echo " <div class='col-xl-4 slide3_content'>
                            <img src='admin/" . $row["HinhAnh"] . "'>
                            <h2>" . $row["Ten_Slide"] . "</h2>
                            <p>
                            " . $row["MoTa"] . "</p>
                        </div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 slide4">
        <div class="container-fluid" style="padding: 0">
            <div class="slide_heading">
                <h2>FIND YOUR PERFECT MATCH</h2>
                <p>EXPLORE AND FIND RIGHT ONE</p>
            </div>
            <div class="row">
                <div class="tab-content">
                    <div class="cinema" id="cinema">
                        <?php
                        $sql_match = "select * from tbl_slide where ID_DanhMuc = 20";
                        $match = mysqli_query($conn, $sql_match);
                        if (mysqli_num_rows($match) > 0) {
                            while ($row = mysqli_fetch_assoc($match)) {
                                echo "<div id='1' class='tab'>
                                        <img src='admin/" . $row["HinhAnh"] . "'>
                                        <div class='bg'></div>
                                    </div>";
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="nav">
                    <button onclick="tabs(this,0)" class="item">
                        <i style="float: right" class="fas fa-long-arrow-alt-left"></i>
                    </button>
                    <button onclick="tabs(this,1)" class="item">
                        <i style="float: left;" class="fas fa-long-arrow-alt-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 slide5">
        <div class="container" style="padding: 0">
            <div class="slide_heading">
                <h2>POSSIBILITIES. PERFORMANCE. POWER.</h2>
                <p>FASTER PROCESSING WITH LESS POWER</p>
            </div>
            <div class="row">
                <div class="hoizontal">
                    <img src="imgs/horizontal-phone_1920X.png">
                </div>
                <?php
                $sql_power = "select * from tbl_slide where ID_DanhMuc = 21";
                $power = mysqli_query($conn, $sql_power);
                if (mysqli_num_rows($power) > 0) {
                    while ($row = mysqli_fetch_assoc($power)) {
                        echo "<div class='col-xl-3 slide5_content animated wow fadeInUp'>
                        <div class='chi'>
                            <div class='hat'></div>
                        </div>
                        <img src='admin/" . $row["HinhAnh"] . "'>
                        <h2>" . $row["Ten_Slide"] . "</h2>
                        <p>" . $row["MoTa"] . "</p>
                    </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-xl-12 slide6">
        <div class="container-fluid" style="padding: 0">
            <div class="slide6_content">
                <?php
                $sql_uniform = "select * from tbl_slide where ID_DanhMuc = 22";
                $uniform = mysqli_query($conn, $sql_uniform);
                $row = mysqli_fetch_assoc($uniform);
                ?>
                <p><?php echo $row["Ten_Slide"]; ?></p>
                <h2><?php echo $row["MoTa"]; ?></h2>
                <a href="#" class="btn">View More</a>
            </div>
        </div>
    </div>
    <div class="col-xl-12 slide7" style="padding: 0">
        <div class="container" style="padding: 0">
            <div class="slide_heading" style="margin: 600px 0 70px 0">
                <h2>RAISE YOUR EXPECTATIONS</h2>
                <p>REFINED VIEWING EXPERIENCE</p>
            </div>
            <div class="row">
                <div class="slide7_left col-xl-6">
                    <?php
                    $sql_expectation = "select * from tbl_slide where ID_DanhMuc = 23";
                    $expectation = mysqli_query($conn, $sql_expectation);
                    $row = mysqli_fetch_assoc($expectation);
                    ?>
                    <h2><?php echo $row["Ten_Slide"]; ?></h2>
                    <p><?php echo $row["MoTa"]; ?></p>
                </div>
                <div class="slide7_right col-xl-6">
                    <img src="admin/<?php echo $row["HinhAnh"]; ?>" />
                </div>
            </div>
        </div>
        <div class="col-xl-12 slide8" style="padding: 0">
            <div class="container">
                <div class="slide_heading">
                    <h2 style="color: #fff;padding-top: 100px">LOSE YOURSELF IN ENTERTAINMENT</h2>
                    <p>SPEND LESS ENJOY MORE</p>
                </div>
                <?php
                $sql_entertainment = "select * from tbl_slide where ID_DanhMuc = 24";
                $entertainment = mysqli_query($conn, $sql_entertainment);
                if (mysqli_num_rows($entertainment) > 0) {
                    while ($row = mysqli_fetch_assoc($entertainment)) {
                        echo "<div class='col-xl-4' style='float: left'>
                        <div class='slide8_content animated wow fadeInUp'>
                            <span>" . $row["ID_Slide"] . "</span>
                            <h2>" . $row["Ten_Slide"] . "</h2>
                            <p>" . $row["MoTa"] . "</p>
                            <a href='#'>View More</a>
                        </div>
                    </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-xl-12 slide9">
        <div class="container">
            <div class="slide_heading">
                <h2>INNOVATIVE QUALITIES & FEATURES</h2>
                <p>SHOW YOURS TO THE WORLD</p>
            </div>
            <div class="col-xl-4 slide9_left animated wow fadeInLeft">
                <?php
                $sql_innovative = "select * from tbl_slide where ID_DanhMuc = 25 limit 3";
                $innovative = mysqli_query($conn, $sql_innovative);
                if (mysqli_num_rows($innovative) > 0) {
                    while ($row = mysqli_fetch_assoc($innovative)) {
                        echo "<div class='left_content slide9_content'>
                        <img src='admin/" . $row["HinhAnh"] . "'>
                        <h2>" . $row["Ten_Slide"] . "</h2>
                        <p>" . $row["MoTa"] . "</p>
                    </div>";
                    }
                }
                ?>
            </div>
            <div class="col-xl-4 slide9_mid">
                <img src="imgs/center-img_eb064c43-efaf-4d56-90df-f89acfdf85fe_grande.png" />
            </div>
            <div class="col-xl-4 slide9_rigth animated wow fadeInRight">
                <?php
                $sql_innovative = "select * from tbl_slide where ID_DanhMuc = 25 limit 3, 4";
                $innovative = mysqli_query($conn, $sql_innovative);
                if (mysqli_num_rows($innovative) > 0) {
                    while ($row = mysqli_fetch_assoc($innovative)) {
                        echo "<div class='right_content slide9_content'>
                        <img src='admin/" . $row["HinhAnh"] . "'>
                        <h2>" . $row["Ten_Slide"] . "</h2>
                        <p>" . $row["MoTa"] . "</p>
                    </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-xl-12 slide10">
        <div class="container">
            <div class="slide_heading">
                <h2>NEW ARRIVALS</h2>
                <p>FIND THE PERFECT PHONE FOR YOU</p>
            </div>
            <div class="tab-content1 animated wow fadeInUp">
                <div class="cinema1" id="cinema1">
                    <?php
                    $sql_product = "select * from tbl_sanpham limit 6";
                    $product = mysqli_query($conn, $sql_product);
                    if (mysqli_num_rows($product) > 0) {
                        while ($row = mysqli_fetch_assoc($product)) {
                            echo "<div class='product'>
                            <div class='slide10_product'>
                                <div class='image1'>
                                    <img src='admin/" . $row["AnhSP"] . "' />
                                    <div class='image'>
                                        <img src='admin/" . $row["AnhSP1"] . "'>
                                    </div>
                                    <div class='atc'>
                                        <a href='product.php?id=" . $row["ID_SanPham"] . "'>Quick View</a>
                                        <form action='index_khach.php' method='post'>
                                        <input type='hidden' name='id_sp' value='" . $row["ID_SanPham"] . "'/>
                                        <input type='submit' name='insert-cart' style='background-color: #ffffff;color: #333333;width:50%;border:0;' value='Add to cart'/>
                                        </form>
                                    </div>
                                </div>
                                <div class='information_product'>
                                    <a href='#'>" . $row["Ten_SanPham"] . "</a>
                                    <h2>$" . $row["Gia"] . "</h2>
                                    <div class='box-star' style='margin-top:8px;margin-right:75px'>
                                        <div class='star1' style='width: " . $row["SoSao"] / 5 * 100 . "%;'></div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="nav1">
                <button onclick="tabs1(this,0)" class="item">
                    <i style="float: right" class="fas fa-long-arrow-alt-left"></i>
                </button>
                <button onclick="tabs1(this,1)" class="item">
                    <i style="float: left;" class="fas fa-long-arrow-alt-right"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="slide11">
        <div class="container-fluid" style="padding: 0">
            <div class="slide11_left">
                <?php
                $sql_view1 = "select * from tbl_slide where ID_Slide = 31";
                $ketqua_view1 = mysqli_query($conn, $sql_view1);
                $view1 = mysqli_fetch_assoc($ketqua_view1);
                $sql_view2 = "select * from tbl_slide where ID_Slide = 32";
                $ketqua_view2 = mysqli_query($conn, $sql_view2);
                $view2 = mysqli_fetch_assoc($ketqua_view2);
                $sql_view3 = "select * from tbl_slide where ID_Slide = 33";
                $ketqua_view3 = mysqli_query($conn, $sql_view3);
                $view3 = mysqli_fetch_assoc($ketqua_view3);
                $sql_view4 = "select * from tbl_slide where ID_Slide = 34";
                $ketqua_view4 = mysqli_query($conn, $sql_view4);
                $view4 = mysqli_fetch_assoc($ketqua_view4);
                $sql_view5 = "select * from tbl_slide where ID_Slide = 35";
                $ketqua_view5 = mysqli_query($conn, $sql_view5);
                $view5 = mysqli_fetch_assoc($ketqua_view5);
                ?>
                <div class="content_1">
                    <img src="admin/<?php
                                    echo $view1["HinhAnh"];
                                    ?>" />
                    <div class="img_content">
                        <div class="text">
                            <h6><?php
                                echo $view1["Ten_Slide"];
                                ?></h6>
                            <h2><?php
                                echo $view1["MoTa"];
                                ?></h2>
                            <a href="#" class="btn">View More</a>
                        </div>
                    </div>
                </div>
                <div class="content_2">
                    <img src="admin/<?php
                                    echo $view2["HinhAnh"];
                                    ?>" />
                    <div class="img_content">
                        <div class="text" style="left: 50%">
                            <h6><?php
                                echo $view2["Ten_Slide"];
                                ?></h6>
                            <h2><?php
                                echo $view2["MoTa"];
                                ?></h2>
                            <a href="#" class="btn">View More</a>
                        </div>
                    </div>
                </div>
                <div class="content_2">
                    <img src="admin/<?php
                                    echo $view3["HinhAnh"];
                                    ?>" />
                    <div class="img_content">
                        <div class="text" style="left: 50%">
                            <h6><?php
                                echo $view3["Ten_Slide"];
                                ?></h6>
                            <h2><?php
                                echo $view3["MoTa"];
                                ?></h2>
                            <a href="#" class="btn">View More</a>
                        </div>
                    </div>
                </div>
                <div class="content_1">
                    <img src="admin/<?php
                                    echo $view4["HinhAnh"];
                                    ?>" />
                    <div class="img_content">
                        <div class="text">
                            <h6><?php
                                echo $view4["Ten_Slide"];
                                ?></h6>
                            <h2><?php
                                echo $view4["MoTa"];
                                ?></h2>
                            <a href="#" class="btn">View More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide11_right">
                <div class="content_3">
                    <img src="admin/<?php
                                    echo $view5["HinhAnh"];
                                    ?>" />
                    <div class="img_content">
                        <div class="text" style="top: 80%">
                            <h6><?php
                                echo $view5["Ten_Slide"];
                                ?></h6>
                            <h2><?php
                                echo $view5["MoTa"];
                                ?></h2>
                            <a href="#" class="btn">View More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="slide12">
        <div class="container" style="padding: 0">
            <div class="slide_heading" style="margin-top: 100px">
                <h2 style="color: #ffffff">SEE WHY CUSTOMERS LOVE THE OUR MOBILES</h2>
                <p style="color: #ffffff">DESIGNED TO PERFECTION</p>
            </div>
            <div class="slide12_left animated wow fadeInLeft">
                <img src="imgs/tab-image_1920x.png" />
            </div>
            <div class="slide12_right animated wow fadeInRight" style="margin-top: 50px">
                <?php
                $sql_our = "select * from tbl_slide where ID_DanhMuc = 28;";
                $our = mysqli_query($conn, $sql_our);
                if (mysqli_num_rows($our) > 0) {
                    while ($row = mysqli_fetch_assoc($our)) {
                        echo "<div class='box'>
                        <div class='h5 main-block'>
                            <h5>" . $row["Ten_Slide"] . "</h5>
                            <div class='block'>
                                <p class='sub-block'>" . $row["MoTa"] . "</p>
                            </div>
                        </div>
                    </div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="slide13">
        <div class="container">
            <div class="slide_heading" style="margin-top: 100px">
                <h2>WELCOME TO PHONO SUPPORT. WE'RE HERE TO HELP.</h2>
                <p>ALWAYS ON YOUR SIDE WHEN YOU NEED HELP</p>
            </div>
            <div class="slide13_left">
                <img src="imgs/phone-icn_75x75.png">
                <div class="telchat">
                    <h6>Have Any Doubts?</h6>
                    <h2>Call Us Now</h2>
                    <p>This Number is Toll Free<br />0962681496</p>
                </div>
                <div class="more">
                    <a href="#">Know More</a>
                </div>
            </div>
            <div class="slide13_right">
                <img src="imgs/chat-icn_75x75.png">
                <div class="telchat">
                    <h6>WANNA TALK TO US?</h6>
                    <h2>LIVE CHAT NOW</h2>
                    <p>Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.</p>
                </div>
                <div class="more">
                    <a href="#">Know More</a>
                </div>
            </div>
        </div>
    </div>
    <?php require("footer.php"); ?>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-long-arrow-alt-up"></i></button>
</body>
<script type="text/javascript" src="js/index.js"></script>

</html>