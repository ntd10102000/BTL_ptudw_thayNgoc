<?php
require("../config/connect.php");
require("tele.php");

//delete dữ liệu theo mã
//kiểm tra xem thao tác của người dùng có pải là update hay k
if (isset($_GET["task"]) && $_GET["task"] == "delete") {
    $id_slide = $_GET["id"];
    //khởi tạo câu lệnh xóa dữ liệu
    $sql_delete = "delete from tbl_slide where ID_Slide = " . $id_slide;
    if (mysqli_query($conn, $sql_delete)) {
        echo "xóa dữ liệu thành công";
    } else {
        echo "xóa dữ liệu thất bại" . mysqli_error($conn);
    }
}
//cập nhật
if (isset($_POST["btn_update"])) {
    //lấy thông tin hình ảnh và upload
    $target_dir = "uploads/";
    //đường dẫn file đồng thời sẽ lưu đường dẫn này vào csdl
    $target_file = $target_dir . basename($_FILES["hinhanh-update"]["name"]);
    //lấy ra thành phần mở rộng của tệp tin như pdf, docx, jpg
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpeg") {
        echo "File của bạn k pải ảnh";
    } else {
        if (move_uploaded_file($_FILES["hinhanh-update"]["tmp_name"], $target_file)) {
            echo "Cập nhật thành công";
            $sql_update = "UPDATE `tbl_slide` SET `Ten_Slide`= '" . $_POST["title-update"] . "',`MoTa`= '" . $_POST["content-update"] . "',`HinhAnh`= '$target_file',`ID_DanhMuc`= '" . $_POST["id_dm"] . "' where ID_Slide = " . $_POST["id_slide"] . ";";
            if (mysqli_query($conn, $sql_update)) {
                header("Location:content.php");
                echo "Cập nhật thành công";
            } else
                echo "Cập nhật thất bại " . mysqli_error($conn);
        } else {
            echo "Cập nhật file thất bại";
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
    <title>Content</title>
</head>

<body>
    <h1 style="text-align: center;color: #000;margin-bottom:100px">Trang Quản Trị Content</h1>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Mã Tin Tức</th>
                <th scope="col">Tiêu Đề</th>
                <th scope="col">Hình Ảnh</th>
                <th scope="col">Nội Dung</th>
                <th scope="col">Tên Danh Mục</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_select = "select * from tbl_slide inner join tbl_danhmuc on tbl_slide.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc order by ID_Slide DESC";
            //đổ dữ liệu sau khi truy vấn vào kết quả
            $ketqua = mysqli_query($conn, $sql_select);
            //kiểm tra xem kết quả có dữ liệu hay k
            if (mysqli_num_rows($ketqua) > 0) {
                while ($row = mysqli_fetch_assoc($ketqua)) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $row["ID_Slide"] . "</th>";
                    if (isset($_GET["task"]) && $_GET["task"] == "u") {
                        if ($_GET["id"] == $row["ID_Slide"]) {
                            echo "<form action='content.php' method='post' enctype='multipart/form-data'>";
                            echo "<input type='hidden' name='id_slide' value='" . $row["ID_Slide"] . "'>";
                            echo "<td><input type='text' name='title-update' value = '" . $row["Ten_Slide"] . "'></td>";
                            echo "<td><input type='file' name='hinhanh-update'></td>";
                            echo "<td><input type='text' name='content-update' value = '" . $row["MoTa"] . "' style='width:500px;height:100px'></td>";
                            echo "<td><select name='id_dm'>";
                            echo "<option value='" . $row["ID_DanhMuc"] . "'>" . $row["Ten_DanhMuc"] . "</option>";
                            $sql_select1 = "select * from tbl_danhmuc LIMIT 13 OFFSET 16";
                            //đổ dữ liệu sau khi truy vấn vào kết quả
                            $ketqua1 = mysqli_query($conn, $sql_select1);
                            if (mysqli_num_rows($ketqua1) > 0) {
                                while ($row = mysqli_fetch_assoc($ketqua1)) {
                                    echo "<option value='" . $row["ID_DanhMuc"] . "'>" . $row["Ten_DanhMuc"] . "</option>";
                                }
                            }
                            echo "</select></td>";
                            echo "<td style='width:180px'>";
                            echo "<input type='submit' name='btn_update' value='Cập nhật' class='btn btn-primary' style='margin-right:10px'>";
                            echo "<a href='content.php' class='btn btn-danger'>Hủy</a>";
                            echo "</td>";
                            echo "</form>";
                            echo "</tr>";
                        } else {
                            echo "<td>" . $row["Ten_Slide"] . "</td>";
                            echo "<td><img src='" . $row["HinhAnh"] . "' style='max-height:100px;'/></td>";
                            echo "<td>" . $row["MoTa"] . "</td>";
                            echo "<td>" . $row["Ten_DanhMuc"] . "</td>";
                            echo "<td style='width:180px'>";
                            echo "<a href='content.php?task=u&id=" . $row["ID_Slide"] . "' class='btn btn-warning' style='margin-right:10px'>Cập nhật</a>";
                            echo "<a href='content.php?task=delete&id=" . $row["ID_Slide"] . "' class='btn btn-danger'>Xóa</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<td>" . $row["Ten_Slide"] . "</td>";
                        echo "<td><img src='" . $row["HinhAnh"] . "' style='max-height:100px;'/></td>";
                        echo "<td>" . $row["MoTa"] . "</td>";
                        echo "<td>" . $row["Ten_DanhMuc"] . "</td>";
                        echo "<td style='width:180px'>";
                        echo "<a href='content.php?task=u&id=" . $row["ID_Slide"] . "' class='btn btn-warning' style='margin-right:10px'>Cập nhật</a>";
                        echo "<a href='content.php?task=delete&id=" . $row["ID_Slide"] . "' class='btn btn-danger'>Xóa</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
            } else {
                echo "Bảng không chứa dữ liệu";
            }
            ?>
        </tbody>
        <!-- //md5, shd1 -->
    </table>
</body>

</html>