<?php
require("../config/connect.php");
require("tele.php");

if (isset($_POST["insert"])) {
    //lấy thông tin hình ảnh và upload
    $target_dir = "uploads/";
    //đường dẫn file đồng thời sẽ lưu đường dẫn này vào csdl
    $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
    $target_file1 = $target_dir . basename($_FILES["hinhanh1"]["name"]);
    //lấy ra thành phần mở rộng của tệp tin như pdf, docx, jpg
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpeg" && $imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "gif" && $imageFileType1 != "jpeg" && $target_file != $target_file1) {
        echo "File của bạn k pải ảnh or ảnh sp bị trùng nhau";
    } else {
        if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file) && move_uploaded_file($_FILES["hinhanh1"]["tmp_name"], $target_file1)) {
            echo "Upload thành công";
            $ma_dm = $_POST["ma_dm"];
            $ma_h = $_POST["ma_h"];
            $tensp = $_POST["title"];
            $gia = $_POST["gia"];
            $mota = $_POST["noidung"];
            $soluong = $_POST["soluong"];
            //toàn bộ pần code insert vào trong bảng tin tức sẽ nằm trong đây
            $sql_insert = "INSERT INTO `tbl_sanpham`(`ID_DanhMuc`, `ID_Hang`, `Ten_SanPham`, `AnhSP`, `AnhSP1`, `Gia`, `Mota`, `SoLuong`) VALUES ($ma_dm,$ma_h,'$tensp','$target_file','$target_file1','$gia','$mota','$soluong')";
            if (mysqli_query($conn, $sql_insert)) {
                echo "Thêm mới dữ liệu thành công";
                //tránh insert lặp dữ liệu
                header("Location:product.php");
            } else {
                echo "Thất bại" . mysqli_error($conn);
            }
        } else {
            echo "Upload file thất bại";
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
    <title>Product</title>
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center;color: #000;margin-bottom:100px">Trang Thêm Sản Phẩm</h1>
        <form action="product.php" method="post" enctype="multipart/form-data">
            Chọn danh mục sản phẩm:
            <select name="ma_dm">
                <option>Chọn danh mục...</option>
                <?php
                $sql_select = "select * from tbl_danhmuc LIMIT 16";
                //đổ dữ liệu sau khi truy vấn vào kết quả
                $ketqua = mysqli_query($conn, $sql_select);
                //kiểm tra xem kết quả có dữ liệu hay k
                if (mysqli_num_rows($ketqua) > 0) {
                    while ($row = mysqli_fetch_assoc($ketqua)) {
                        echo "<option value='" . $row["ID_DanhMuc"] . "'>" . $row["Ten_DanhMuc"] . "</option>";
                    }
                }
                ?>
            </select>
            Chọn hãng sản phẩm:
            <select name="ma_h">
                <option>Chọn hãng...</option>
                <?php
                $sql_select = "select * from tbl_hang";
                //đổ dữ liệu sau khi truy vấn vào kết quả
                $ketqua = mysqli_query($conn, $sql_select);
                //kiểm tra xem kết quả có dữ liệu hay k
                if (mysqli_num_rows($ketqua) > 0) {
                    while ($row = mysqli_fetch_assoc($ketqua)) {
                        echo "<option value='" . $row["ID_Hang"] . "'>" . $row["Ten_Hang"] . "</option>";
                    }
                }
                ?>
            </select>
            <br /><br />
            Tên Sản Phẩm:
            <br />
            <input type="text" name="title" />
            <br /><br />
            Giá sản phẩm:
            <br />
            <input type="number" name="gia" />
            <br /><br />
            Mô tả sản phẩm:
            <br />
            <textarea name="noidung"></textarea>
            <br /><br />
            Hình ảnh sản phẩm:
            <br />
            <input type="file" name="hinhanh" />
            <br /><br />
            Hình ảnh sản phẩm:
            <br />
            <input type="file" name="hinhanh1" />
            <br /><br />
            Số lượng:
            <br />
            <input type="number" name="soluong" />
            <br /><br />
            <input type="submit" name="insert" value="Thêm mới" class="btn btn-primary" />
        </form>
    </div>
</body>

</html>