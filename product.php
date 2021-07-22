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

// Nếu id k tồn tại hoặc id ko phải là số thì sẽ báo lỗi
// Nếu ko hợp lệ lập tức quay trở về trang index_khach để kiểm tra lại dữ liệu
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    $_SESSION["err"] = 'ID ko hợp lệ';
    header("Location:index_khach.php");
    exit();
}
$id = $_GET["id"];
// Tạo câu truy vấn
$sql_product = "SELECT * FROM tbl_sanpham WHERE ID_SanPham = $id;";
// Thực hiện câu truy vấn
$result_one = mysqli_query($conn, $sql_product);
// Vì khi bấm kiểm tra thì sẽ kiểm tra từng bảng 1
// Trả về mảng 1 chiều
$product = mysqli_fetch_assoc($result_one);
// kiểm tra xem nếu không có sản phẩm thì sẽ báo lỗi
if (empty($product)) {
    echo "Không có dữ liệu tương ứng với bản ghi có id = $id";

    return;
}

//sản phẩm liên quan
$sql_lienquan = "SELECT * FROM tbl_sanpham WHERE ID_DanhMuc = " . $product["ID_DanhMuc"] . " limit 4 offset 1;";
$kq_lienquan = mysqli_query($conn, $sql_lienquan);

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

//đánh giá sản phẩm
$sql_reviews = "select * from tbl_danhgiasanpham inner join tbl_khach on tbl_danhgiasanpham.ID_Khach = tbl_khach.ID_Khach where tbl_danhgiasanpham.ID_SanPham = " . $id . ";";
$kq_reviews = mysqli_query($conn, $sql_reviews);



//thêm mới dữ liệu
if (isset($_POST["review"])) {
    //kiem tra xem da mua hang hay chua
    $sql_kiemtra = "select * from tbl_damua where ID_SanPham = $id and ID_Khach = " . $_SESSION["id_khach"] . ";";
    $kiemtra = mysqli_query($conn, $sql_kiemtra);
    //kiểm tra xem kết quả có dữ liệu hay k
    if (mysqli_num_rows($kiemtra) > 0) {
        //khai báo biến thực hiện câu truy vấn sql insert data
        $sql_insert_reviews = "INSERT INTO `tbl_danhgiasanpham`(`ID_Khach`, `ID_SanPham`, `NhanXet`, `SoSaoDanhGia`) VALUES (" . $_POST["id_spdg"] . "," . $_POST["id_k"] . " ,'" . $_POST["nhanxet"] . "' ," . $_POST["star"] . ");";
        if (mysqli_query($conn, $sql_insert_reviews)) {
            echo "thêm mới dữ liệu thành công";
        } else {
            echo "theem moi thất bại" . mysqli_error($conn);
        }
        //trung binh sao khi cap nhat khi co them danh gia
        $sql_countstar = "SELECT AVG(SoSaoDanhGia) as SSTB FROM tbl_danhgiasanpham where ID_SanPham = $id;";
        $kq_countstar = mysqli_query($conn, $sql_countstar);
        $countstar = mysqli_fetch_assoc($kq_countstar);
        //update so sao
        $sql_updatestar = "UPDATE `tbl_sanpham` SET `SoSao`= " . $countstar["SSTB"] . " WHERE ID_SanPham = $id;";
        if (mysqli_query($conn, $sql_updatestar)) {
            echo "update dữ liệu thành công";
            //tránh insert lặp dữ liệu
            header("Location:product.php?id=" . $id . "");
        } else {
            echo "thất bại" . mysqli_error($conn);
        }
    } else {
        echo "ban chua mua hang nen khon the nhan xet";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AD3H Shop</title>
    <?php require("head.php"); ?>
    <link rel="stylesheet" href="css/home.css">
</head>
<style>
    .up:hover {
        color: #eb0028;
    }

    .cart-title {
        width: 100%;
        float: left;
        padding: 50px 0;
        color: #000000;
        background-color: #f4f4f4;
        margin-bottom: 30px;
    }

    .cart-title h2 {
        font-size: 20px;
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: 0.08em;
        width: 100%;
        text-align: center;
    }

    .cart-title p,
    a {
        padding-right: 4px;
        margin-right: 4px;
        font-size: 14px;
        color: #000000;
        text-align: center;
        letter-spacing: 0em;
        font-weight: normal;
        width: 100%;
    }

    .notification {
        position: relative;
    }

    .notification .badge {
        position: absolute;
        top: -10px;
        right: -13px;
        padding: 5px 7px;
        border-radius: 50%;
        background-color: red;
        color: white;
    }

    .product-details {
        width: 100%;
        float: left;
        margin-top: 80px;
    }

    .product_left {
        width: 50%;
        float: left;
        padding-right: 15px;
    }

    .product_left img {
        max-width: 100%;
    }

    .product_right {
        width: 50%;
        float: left;
        padding-left: 15px;
    }

    .name_product {
        width: 100%;
        float: left;
    }

    .name_product h2 {
        width: 70%;
        float: left;
        margin-top: 7px;
        margin-bottom: 24px;
        font-size: 40px;
        font-weight: 500;
        line-height: 100%;
        color: #2b2b2b;
        font-family: 'Merriweather', serif;
    }

    .name_product h2:hover {
        color: #eb0028;
    }

    .star {
        width: 30%;
        float: right;
    }

    .star i {
        float: right;
    }

    .star p {
        font-size: 15px;
        float: right;
    }

    .price {
        width: 100%;
        color: #eb0028;
        font-size: 25px;
        line-height: 100%;
        font-weight: 500;
        font-family: 'Merriweather', serif;
        float: left;
    }

    .check {
        width: 100%;
        color: #909090;
        font-size: 15px;
        font-weight: 400;
        line-height: 1.6;
    }

    .check_icon {
        border-radius: 100%;
        color: #eb0028;
        width: 18px;
        height: 18px;
        line-height: 18px;
        text-align: center;
        box-shadow: 0 0 5px 0 rgba(27, 27, 27, .3);
        display: inline-block;
        margin-right: 10px;
    }

    .description {
        width: 100%;
        font-size: 15px;
        font-weight: 400;
        line-height: 1.6;
        color: #666;
        float: left;
        margin: 20px 0;
    }

    .add-to-cart {
        width: 500px;
    }

    .add-to-cart a {
        color: #fff;
        background-color: #eb0028;
        font-size: 18px;
        font-weight: 400;
        line-height: 38px;
        text-decoration: none;
        margin-right: 20px;
        width: 10%;
    }

    .add-to-cart a:hover {
        background-color: #f63c43;
    }

    .add-to-cart input {
        padding: 8px 30px;
        color: #fff;
        background-color: #eb0028;
        font-size: 22px;
        font-weight: 400;
        line-height: 38px;
        text-decoration: none;
        margin-right: 20px;
    }

    .add-to-cart input:hover {
        background-color: #f63c43;
    }

    h4 {
        font-size: 15px;
        margin-top: 15px;
    }

    .product-meta {
        margin-top: 40px;
        font-size: 15px;
        color: #2b2b2b;
        ;
        line-height: 1.6;
    }

    .product-meta a {
        font-weight: 300;
        margin-left: 10px;
        text-decoration: none;
        color: #666666;
    }

    .product-meta a:hover {
        color: #eb0028;
    }

    .h2_gach {
        width: 70px;
        height: 2px;
        background: #eb0028;
        margin-bottom: 50px;
    }




    .reviews {
        width: 100%;
        margin-top: 80px;
        font-size: 15px;
    }

    .review-item {
        width: 100%;
        float: left;
        color: #666666;
        margin-bottom: 60px;
    }

    .avartar {
        width: 80px;
        height: 80px;
        border-radius: 100%;
        background-color: #eb0028;
        color: #ffffff;
        text-align: center;
        float: left;
        margin-top: 15px;
    }

    .avartar i {
        font-size: 2.2em;
        margin-top: 23px;
    }

    .comment {
        width: 100%;
        margin-top: 5px;
    }

    .time_star {
        width: 1060px;
        float: left;
        padding-left: 30px;
        color: #2b2b2b;
        font-weight: 500;
    }

    .time {
        width: 300px;
        margin: 0;
        color: #666;
    }

    .review {
        width: 1060px;
        float: left;
        padding-left: 30px;
        color: #666;
        font-weight: 500;
    }

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

    .box-star-x {
        background: transparent;
        width: 50%;
        margin-bottom: 50px;
        float: left;
    }

    .box-star .star-x {
        float: left;
        width: 26px;
        background-color: #ffffff;
        color: #666666;
    }

    .box-star .star-x.active {
        color: orange !important;
    }

    .nhanxet {
        margin-bottom: 25px;
        border: 1px solid #eb0028;
    }

    .submit {
        font-size: 15px;
        font-weight: 500;
        padding: 0 40px;
        height: 40px;
        float: left;
        color: #fff;
        text-transform: uppercase;
        transition: all .3s ease;
        background-color: #eb0028;
        margin-top: 25px;
    }

    .submit:hover {
        background: #f63c43;
        color: #fff;
    }

    .add-reviews input {
        border: 1px solid #eb0028;
    }
</style>

<body>
    <?php require("menu.php"); ?>
    <section class="cart-title">
        <div class="container-fluid">
            <div class="row">
                <h2>PRODUCT DETAILS</h2>
                <p><a href="index_khach">Home </a> / Product details</p>
            </div>
        </div>
    </section>
    <section class="sectional slide2">
        <div class="container">
            <div class="row">
                <div class="product-details">
                    <div class="product_left">
                        <img src="admin/<?php echo $product["AnhSP"] ?>">
                    </div>
                    <div class="product_right">
                        <div class="name_product">
                            <h2><?php echo $product["Ten_SanPham"] ?></h2>
                            <div class="star1">
                                <i>
                                    <div class="box-star">
                                        <div class="star1" style="width: <?php echo $product["SoSao"] / 5 * 100 ?>%;"></div>
                                    </div>
                                </i>
                                <p></p>
                            </div>
                            <div class="price">$<?php echo $product["Gia"] ?></div>
                        </div>
                        <hr style="margin-top: 120px">
                        <div class="check">
                            <div class="check_icon">
                                <i class="fas fa-check-circle" style="margin-left: 1px;margin-top: 1px"></i>
                            </div>
                            <span>In Stock</span>
                        </div>
                        <div class="description">
                            <p><?php echo $product["MoTa"] ?></p>
                        </div>
                        <div class="add-to-cart">
                            <a href="#" style="padding: 8px;float:right;margin-right:270px"><i class="far fa-heart" style="font-size: 1.3em;margin-top: 3px"></i></a>
                            <form style="width: 100px;margin:0;" action="index_khach.php" method="post">
                                <input type='hidden' name="id_sp" value="<?php echo $product["ID_SanPham"] ?>" />
                                <input class="a" type="submit" name="insert-cart" style="border:0;" value="Add to cart" />
                            </form>
                        </div>
                        <hr style="margin-top: 35px">
                        <div class="product-meta">
                            <h4>Category: <a href="#">Smart Phone</a></h4>
                            <h4>Share:
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                <a href="#"><i class="fab fa-invision"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="related-products">
                    <h2>Related Products</h2>
                    <div style="margin-bottom: 20px" class="h2_gach"></div>
                    <?php
                    if (mysqli_num_rows($kq_lienquan) > 0) {
                        while ($lienquan = mysqli_fetch_assoc($kq_lienquan)) {
                            echo "<div class='product'>
                            <div class='slide10_product'>
                                <div class='image1'>
                                    <img src='admin/" . $lienquan["AnhSP"] . "' />
                                    <div class='image'>
                                        <img src='admin/" . $lienquan["AnhSP1"] . "'>
                                    </div>
                                    <div class='atc'>
                                        <a href='product.php?id=" . $lienquan["ID_SanPham"] . "' style='margin-right:-4px;'>Quick View</a>
                                        <form action='index_khach.php' method='post'>
                                        <input type='hidden' name='id_sp' value='" . $lienquan["ID_SanPham"] . "'/>
                                        <input type='submit' name='insert-cart' style='background-color: #ffffff;color: #333333;width:50%;border:0;' value='Add to cart'/>
                                        </form>
                                    </div>
                                </div>
                                <div class='information_product'>
                                    <a href='#'>" . $lienquan["Ten_SanPham"] . "</a>
                                    <h2>$" . $lienquan["Gia"] . "</h2>
                                    <div class='box-star' style='margin-top:8px;margin-right:75px'>
                                        <div class='star1' style='width: " . $lienquan["SoSao"] / 5 * 100 . "%;'></div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                        }
                    }
                    ?>

                </div>
                <div class="reviews">
                    <h2 style="font-weight: 700;">Reviews</h2>
                    <div style="margin-bottom: 50px" class="h2_gach"></div>
                    <?php
                    if (mysqli_num_rows($kq_reviews) > 0) {
                        while ($review = mysqli_fetch_assoc($kq_reviews)) {
                            echo '<div class="review-item">
                                    <div class="avartar">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="comment">
                                        <div class="time_star">
                                            <h3 class="user" style="font-size: 15px;width: 70%;float: left">' . $review["us_khach"] . ' -<i class="time"> ' . $review["DateTime"] . '</i></h3>
                                            <div class="box-star">
                                                <div class="star1" style="width: ' . $review["SoSaoDanhGia"] / 5 * 100 . '%;"></div>
                                            </div>
                                        </div>
                                        <p class="review">
                                            ' . $review["NhanXet"] . '
                                        </p>
                                    </div>
                                    <hr style="width: 1030px;float: right">
                                </div>';
                        }
                    } else {
                        echo "Chưa có đánh giá.";
                    }
                    ?>
                </div>
                <div class="add-reviews">
                    <h2 style="font-weight: 700;">Add A Review</h2>
                    <div style="margin-bottom: 50px" class="h2_gach"></div>
                    <form method="post" action="product.php?id=<?php echo $id; ?>">
                        <div class="form-group">
                            <div class="box-star box-star-x">
                                <div class="star-x" onmouseenter="checkStar(1)"><i class="fas fa-star"></i></div>
                                <div class="star-x" onmouseenter="checkStar(2)"><i class="fas fa-star"></i></div>
                                <div class="star-x" onmouseenter="checkStar(3)"><i class="fas fa-star"></i></div>
                                <div class="star-x" onmouseenter="checkStar(4)"><i class="fas fa-star"></i></div>
                                <div class="star-x" onmouseenter="checkStar(5)"><i class="fas fa-star"></i></div>
                            </div>
                        </div>
                        <input type="hidden" name="id_spdg" value="<?php echo $id; ?>" required />
                        <input type="hidden" name="star" id="star" required />
                        <input type="hidden" name="id_k" value="<?php echo $_SESSION["id_khach"]; ?>" required />
                        <textarea class="form-control nhanxet" name="nhanxet" class="nhanxet" rows="8" cols="124" placeholder="You Review"></textarea>
                        <button class="btn submit" type="submit" name="review">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div style="margin-top: 2500px;">
        <?php require("footer.php"); ?>
    </div>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-long-arrow-alt-up"></i></button>
</body>
<script type="text/javascript">
    function checkStar(n) {
        let s = document.getElementsByClassName("star-x");
        for (let i = 1; i <= s.length; i++) {
            s[i - 1].classList.remove("active");
        }
        for (let i = 1; i <= n; i++) {
            s[i - 1].classList.add("active");
        }
        document.getElementById("star").value = n;
    }
</script>
<script type="text/javascript" src="js/index.js"></script>

</html>