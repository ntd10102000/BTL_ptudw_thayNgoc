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
//cập nhật
if (isset($_POST["btn_update"])) {
    $sql_update = "update tbl_giohang set `SoLuongMua` = '" . $_POST["soluong-update"] . "', `Total` = '" . $_POST["total-update"] . "' where ID_GioHang = " . $_POST["id_gh"] . ";";
    if (mysqli_query($conn, $sql_update))
        echo "Cập nhật thành công";
    else
        echo "Cập nhật thất bại " . mysqli_error($conn);
}

//delete dữ liệu theo mã
//kiểm tra xem thao tác của người dùng có pải là update hay k
if (isset($_GET["task"]) && $_GET["task"] == "delete") {
    $ma_gh = $_GET["id"];
    //khởi tạo câu lệnh xóa dữ liệu
    $sql_delete = "delete from tbl_giohang where ID_GioHang = " . $ma_gh;
    if (mysqli_query($conn, $sql_delete)) {
        echo "xóa dữ liệu thành công";
    } else {
        echo "xóa dữ liệu thất bại" . mysqli_error($conn);
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
</style>

<body>
    <?php require("menu.php"); ?>
    <section class="cart-title">
        <div class="container-fluid">
            <div class="row">
                <h2>YOUR SHOPPING CART</h2>
                <p><a href="index_khach">Home </a> / Your Shopping Cart</p>
            </div>
        </div>
    </section>
    <section class="cart">
        <div class="container">
            <div class="row">
                <?php
                $giohang = "select * from tbl_giohang inner join tbl_khach on tbl_giohang.ID_Khach = tbl_khach.ID_Khach where tbl_khach.ID_Khach = " . $_SESSION['id_khach'] . " order by ID_GioHang DESC";
                $kq_giohang = mysqli_query($conn, $giohang);
                //kiểm tra xem kết quả có dữ liệu hay k
                if (mysqli_num_rows($kq_giohang) > 0) {
                    if (isset($_POST["buy"])) {
                        while ($row_gh = mysqli_fetch_assoc($kq_giohang)) {
                            $sql_order = "UPDATE `tbl_sanpham` SET `SoLuong` = (`SoLuong` - " . $row_gh["SoLuongMua"] . ")  WHERE `ID_SanPham` = " . $row_gh["ID_SanPham"] . ";";
                            mysqli_query($conn, $sql_order);
                            $sql_damua = "INSERT INTO `tbl_damua`(`ID_Khach`, `ID_SanPham`, `SoLuongDaMua`, `GiaDaMua`)
                             VALUES (" . $row_gh["ID_Khach"] . "," . $row_gh["ID_SanPham"] . "," . $row_gh["SoLuongMua"] . "," . $row_gh["Total"] . ");";
                            mysqli_query($conn, $sql_damua);
                        }
                        $sql_buy = "DELETE FROM `tbl_giohang` WHERE ID_Khach = " . $_SESSION["id_khach"] . ";";
                        if (mysqli_query($conn, $sql_buy))
                            echo "Đặt hàng thành công";
                        else
                            echo "Đặt hàng thất bại " . mysqli_error($conn);
                    }
                }
                ?>
                <table class="table" style="font-family: 'Rajdhani', sans-serif;font-size:25px;font-weight:400;text-align:center;border:1px solid #000">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="background-color: #000;font-size:20px;font-weight:500;padding:6px;text-align:center">PRODUCT</th>
                            <th scope="col" style="background-color: #000;font-size:20px;font-weight:400;padding:6px;text-align:center">PRICE</th>
                            <th scope="col" style="background-color: #000;font-size:20px;font-weight:400;padding:6px;text-align:center">QUANTITY</th>
                            <th scope="col" style="background-color: #000;font-size:20px;font-weight:400;padding:6px;text-align:center">TOTAL</th>
                            <th scope="col" style="background-color: #000;font-size:20px;font-weight:400;padding:6px;text-align:center">REMOVE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $sql_select = "select * from tbl_giohang inner join tbl_sanpham on tbl_giohang.ID_SanPham = tbl_sanpham.ID_SanPham inner join tbl_khach on tbl_giohang.ID_Khach = tbl_khach.ID_Khach where tbl_khach.ID_Khach = " . $_SESSION['id_khach'] . " order by ID_GioHang DESC";
                            //đổ dữ liệu sau khi truy vấn vào kết quả
                            $ketqua = mysqli_query($conn, $sql_select);
                            //kiểm tra xem kết quả có dữ liệu hay k
                            if (mysqli_num_rows($ketqua) > 0) {
                                while ($row = mysqli_fetch_assoc($ketqua)) {
                                    $price = $row["Gia"] * $row["SoLuongMua"];
                                    echo '<th scope="row" style="font-size:16px;font-weight:600;text-align:center">
                                    <img src="admin/' . $row["AnhSP"] . '" style="max-width:120px"/>
                                    <h2 style="font-weight:500;font-size:20px">' . $row["Ten_SanPham"] . '</h2>
                                    </th>
                                    <td style="font-size:20px;font-weight:600;text-align:center;padding-top:80px">$' . $row["Gia"] . '</td>';
                                    if (isset($_GET["task"]) && $_GET["task"] == "update") {
                                        if ($_GET["id"] == $row["ID_GioHang"]) {
                                            echo "<form action='cart.php' method='post'><td style='font-size:20px;font-weight:600;text-align:center;padding-top:80px'>";
                                            echo "<input type='number' name='soluong-update' value='" . $row["SoLuongMua"] . "'>";
                                            echo "</td>";
                                            echo "<input type='hidden' name='id_gh' value='" . $row["ID_GioHang"] . "'>";
                                            echo "<input type='hidden' name='total-update' value='" . $price . "'/>";
                                            echo "<td></td>";
                                            echo "<td style='font-size:20px;font-weight:600;text-align:center;padding-top:70px'>";
                                            echo "<input type='submit' name='btn_update' value='Update' class='btn-dark' style='font-size:18px;padding:5px;margin-right:10px'>";
                                            echo "<a class='up' href='cart.php' style='font-size:1.6em;'><i class='far fa-window-close'></i></a>";
                                            echo "</td></form>";
                                            echo "</tr>";
                                        } else {
                                            echo '<td style="font-size:20px;font-weight:500;text-align:center;padding-top:80px">' . $row["SoLuongMua"] . '</td>
                                            <td style="font-size:20px;font-weight:600;text-align:center;padding-top:80px">$' . $price . '</td>
                                            <td style="font-size:20px;font-weight:500;text-align:center;padding-top:70px">
                                            <a class="up" href="cart.php?task=update&id=' . $row["ID_GioHang"] . '" style="margin-right:10px;font-size:1.6em;"><i class="far fa-edit"></i></a>
                                            <a class="up" href="cart.php?task=delete&id=' . $row["ID_GioHang"] . '" style="font-size:1.6em;"><i class="far fa-times-circle"></i></a>
                                            </td></tr>';
                                        }
                                    } else {
                                        echo '<td style="font-size:20px;font-weight:500;text-align:center;padding-top:80px">' . $row["SoLuongMua"] . '</td>
                                        <td style="font-size:20px;font-weight:600;text-align:center;padding-top:80px">$' . $price . '</td>
                                        <td style="font-size:20px;font-weight:500;text-align:center;padding-top:70px">
                                        <a class="up" href="cart.php?task=update&id=' . $row["ID_GioHang"] . '" style="margin-right:10px;font-size:1.6em;"><i class="far fa-edit"></i></a>
                                        <a class="up" href="cart.php?task=delete&id=' . $row["ID_GioHang"] . '" style="font-size:1.6em;"><i class="far fa-times-circle"></i></a>
                                        </td></tr>';
                                    }
                                }
                            }
                            ?>
                    </tbody>
                </table>
                <form action="cart.php" method="post" style="float:right;margin-left:944px">
                    <input class="order" type="submit" name="buy" value="Order" />
                </form>
            </div>
        </div>
    </section>

    <?php require("footer.php"); ?>

    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-long-arrow-alt-up"></i></button>
</body>
<script type="text/javascript" src="js/index.js"></script>

</html>