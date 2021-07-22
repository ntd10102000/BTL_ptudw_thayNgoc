<?php
require("../config/connect.php");
require("tele.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d3fa3cecaa.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Upload</title>
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center;color: #000;margin-bottom:100px">Trang Thêm Content</h1>
        <form action="slide.php" method="post" enctype="multipart/form-data">
            <select name="ma_dm">
                <option>Chọn danh mục...</option>
                <?php
                $sql_select = "select * from tbl_danhmuc LIMIT 13 OFFSET 16";
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
            <br /><br />
            Tiêu đề(nếu có):
            <br />
            <input type="text" name="title" />
            <br /><br />
            Nội dung(nếu có):
            <br />
            <textarea name="noidung"></textarea>
            <br /><br />
            Hình ảnh(nếu có):
            <br />
            <input type="file" name="hinhanh" />
            <br /><br />
            <input type="submit" name="insert" value="Thêm mới" class="btn btn-primary" />
            <?php
            if (isset($_POST["insert"])) {
                //lấy thông tin hình ảnh và upload
                $target_dir = "uploads/";
                //đường dẫn file đồng thời sẽ lưu đường dẫn này vào csdl
                $target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
                //lấy ra thành phần mở rộng của tệp tin như pdf, docx, jpg
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpeg") {
                    echo "File của bạn k pải ảnh";
                } else {
                    if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                        echo "Upload thành công";
                        $ma_dm = $_POST["ma_dm"];
                        $tieude = $_POST["title"];
                        $noidung = $_POST["noidung"];
                        //toàn bộ pần code insert vào trong bảng tin tức sẽ nằm trong đây
                        $sql_insert = "INSERT INTO `tbl_slide`(`ID_DanhMuc`, `Ten_Slide`, `MoTa`, `HinhAnh`) VALUES ($ma_dm,'$tieude','$noidung','$target_file')";
                        if (mysqli_query($conn, $sql_insert)) {
                            echo "Thêm mới dữ liệu thành công";
                            //tránh insert lặp dữ liệu
                            header("Location:slide.php");
                        } else {
                            echo "Thất bại" . mysqli_error($conn);
                        }
                    } else {
                        echo "Upload file thất bại";
                    }
                }
            }
            ?>
        </form>
    </div>
</body>

</html>