<?php
require("../config/connect.php");
require("tele.php");

//thêm mới dữ liệu
if (isset($_POST["insert"])) {
    //khai báo biến thực hiện câu truy vấn sql insert data
    $sql_insert = "insert into tbl_danhmuc(Ten_DanhMuc,TrangThai) values(N'" . $_POST["tendm"] . "',1)";
    if (mysqli_query($conn, $sql_insert)) {
        echo "thêm mới dữ liệu thành công";
        //tránh insert lặp dữ liệu
        header("Location:category.php");
    } else {
        echo "thất bại" . mysqli_error($conn);
    }
}
//delete dữ liệu theo mã
//kiểm tra xem thao tác của người dùng có pải là update hay k
if (isset($_GET["task"]) && $_GET["task"] == "delete") {
    $ma_dm = $_GET["id"];
    //khởi tạo câu lệnh xóa dữ liệu
    $sql_delete = "delete from tbl_danhmuc where ID_DanhMuc = " . $ma_dm;
    if (mysqli_query($conn, $sql_delete)) {
        echo "xóa dữ liệu thành công";
    } else {
        echo "xóa dữ liệu thất bại" . mysqli_error($conn);
    }
}

//cập nhật
if (isset($_POST["btn_update"])) {
    $sql_update = "update tbl_danhmuc set Ten_DanhMuc = N'" . $_POST["update"] . "' where ID_DanhMuc = " . $_POST["id_dm"];
    if (mysqli_query($conn, $sql_update))
        echo "Cập nhật thành công";
    else
        echo "Cập nhật thất bại " . mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d3fa3cecaa.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Demo_php</title>
</head>

<body>
    <div class="container">
        <h1 style="text-align: center;color: #000;margin-bottom:100px">Trang Quản Trị Danh Mục</h1>
        <div class="row">
            <form action="category.php" method="post">
                <input type="text" name="tendm">
                <input type="submit" name="insert" value="thêm mới">
            </form>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Mã danh mục</th>
                        <th scope="col">Tên danh mục</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    //khởi tạo biến lưu chuỗi truy vấn dữ liệu
                    $sql_select = "select * from tbl_danhmuc order by ID_DanhMuc DESC";
                    //đổ dữ liệu sau khi truy vấn vào kết quả
                    $ketqua = mysqli_query($conn, $sql_select);
                    //kiểm tra xem kết quả có dữ liệu hay k
                    if (mysqli_num_rows($ketqua) > 0) {
                        while ($row = mysqli_fetch_assoc($ketqua)) {
                            echo "<tr>";
                            echo "<td>" . $row["ID_DanhMuc"] . "</td>";
                            if (isset($_GET["task"]) && $_GET["task"] == "update") {
                                if ($_GET["id"] == $row["ID_DanhMuc"]) {
                                    echo "<form action='category.php' method='post'><td>";
                                    echo "<input type='text' name='update' value = '" . $row["Ten_DanhMuc"] . "'>";
                                    echo "</td>";
                                    echo "<input type='hidden' name='id_dm' value='" . $row["ID_DanhMuc"] . "'>";
                                    echo "<td>" . $row["TrangThai"] . "</td>";
                                    echo "<td style='width:200px'>";
                                    echo "<input type='submit' name='btn_update' value='Cập nhật' class='btn btn-primary' style='margin-right:10px'>";
                                    echo "<a href='category.php' class='btn btn-danger'>Hủy</a>";
                                    echo "</td></form>";
                                } else {
                                    echo "<td>" . $row["Ten_DanhMuc"] . "</td>";
                                    echo "<td>" . $row["TrangThai"] . "</td>";
                                    echo "<td style='width:200px'>";
                                    echo "<a href='category.php?task=update&id=" . $row["ID_DanhMuc"] . "' class='btn btn-warning' style='margin-right:10px'>Cập nhật</a>
                                    <a href='category.php?task=delete&id=" . $row["ID_DanhMuc"] . "' class='btn btn-danger'>Xóa</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<td>" . $row["Ten_DanhMuc"] . "</td>";
                                echo "<td>" . $row["TrangThai"] . "</td>";
                                echo "<td style='width:200px'>";
                                echo "<a href='category.php?task=update&id=" . $row["ID_DanhMuc"] . "' class='btn btn-warning' style='margin-right:10px'>Cập nhật</a>
                                <a href='category.php?task=delete&id=" . $row["ID_DanhMuc"] . "' class='btn btn-danger'>Xóa</a></td>";
                                echo "</tr>";
                            }
                        }
                    } else {
                        echo "bảng k chứa dữ liệu";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>