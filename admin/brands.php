<?php
require("../config/connect.php");
require("tele.php");

//thêm mới dữ liệu
if (isset($_POST["insert"])) {
    //khai báo biến thực hiện câu truy vấn sql insert data
    $sql_insert = "insert into tbl_hang(ID_DanhMuc,Ten_Hang,TrangThai) values('" . $_POST["ma_dm"] . "','" . $_POST["tenh"] . "',1)";
    if (mysqli_query($conn, $sql_insert)) {
        echo "Thêm mới dữ liệu thành công";
        //tránh insert lặp dữ liệu
        header("Location:brands.php");
    } else {
        echo "Thêm dữ liệu thất bại" . mysqli_error($conn);
    }
}
//delete dữ liệu theo mã
//kiểm tra xem thao tác của người dùng có pải là update hay k
if (isset($_GET["task"]) && $_GET["task"] == "delete") {
    $id_hang = $_GET["id"];
    //khởi tạo câu lệnh xóa dữ liệu
    $sql_delete = "delete from tbl_hang where ID_Hang = " . $id_hang;
    if (mysqli_query($conn, $sql_delete)) {
        echo "Xóa dữ liệu thành công";
    } else {
        echo "Xóa dữ liệu thất bại" . mysqli_error($conn);
    }
}

//cập nhật
if (isset($_POST["btn_update"])) {
    $sql_update = "update tbl_hang set Ten_Hang = N'" . $_POST["ten_hang"] . "', ID_DanhMuc = '".$_POST["id_dm"]."' where ID_Hang = " . $_POST["id_hang"];
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
        <h1 style="text-align: center;color: #000;margin-bottom:100px">Trang Quản Trị Hãng</h1>
        <!-- insert -->
        <div class="row">
            <form action="brands.php" method="post">
                <select name="ma_dm">
                    <option>Chọn danh mục...</option>
                    <?php
                    $sql_select = "select * from tbl_danhmuc LIMIT 13";
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
                <input type="text" name="tenh">
                <input type="submit" name="insert" value="thêm mới">
            </form>
        </div>
        <!-- hiển thị và thao tác với dữ liệu -->
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Mã hãng</th>
                        <th scope="col">Tên hãng</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Danh Mục</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    //khởi tạo biến lưu chuỗi truy vấn dữ liệu
                    $sql_select = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc order by ID_Hang DESC";
                    //đổ dữ liệu sau khi truy vấn vào kết quả
                    $ketqua = mysqli_query($conn, $sql_select);
                    //kiểm tra xem kết quả có dữ liệu hay k
                    if (mysqli_num_rows($ketqua) > 0) {
                        //nếu có dữ liệu thì tiến hành duyệt mảng kết quả
                        while ($row = mysqli_fetch_assoc($ketqua)) {
                            echo "<tr>";
                            echo "<td>" . $row["ID_Hang"] . "</td>";
                            if (isset($_GET["task"]) && $_GET["task"] == "update") {
                                if ($_GET["id"] == $row["ID_Hang"]) {
                                    //nếu task = update, id = ID_Hang thì in ra màn
                                    echo "<form action='brands.php' method='post'>";
                                    echo "<td><input type='text' name='ten_hang' value = '" . $row["Ten_Hang"] . "'>";
                                    echo "</td>";
                                    echo "<input type='hidden' name='id_hang' value='" . $row["ID_Hang"] . "'>";
                                    echo "<td>" . $row["TrangThai"] . "</td>";
                                    echo "<td><select name='id_dm'>";
                                    echo "<option value='" . $row["ID_DanhMuc"] . "'>" . $row["Ten_DanhMuc"] . "</option>";
                                    //khởi tạo biến lưu chuỗi truy vấn dữ liệu
                                    $sql_select1 = "select * from tbl_danhmuc LIMIT 13";
                                    //đổ dữ liệu sau khi truy vấn vào kết quả
                                    $ketqua1 = mysqli_query($conn, $sql_select1);
                                    if (mysqli_num_rows($ketqua1) > 0) {
                                        while ($row = mysqli_fetch_assoc($ketqua1)) {
                                            echo "<option value='" . $row["ID_DanhMuc"] . "'>" . $row["Ten_DanhMuc"] . "</option>";
                                        }
                                    }
                                    echo "</select></td>";
                                    echo "<td style='width:200px'>";
                                    echo "<input type='submit' name='btn_update' value='Cập nhật' class='btn btn-primary' style='margin-right:10px'>";
                                    echo "<a href='brands.php' class='btn btn-danger'>Hủy</a>";
                                    echo "</td></form>";
                                } else {
                                    echo "<td>" . $row["Ten_Hang"] . "</td>";
                                    echo "<td>" . $row["TrangThai"] . "</td>";
                                    echo "<td>" . $row["Ten_DanhMuc"] . "</td>";
                                    echo "<td style='width:200px'>";
                                    echo "<a href='brands.php?task=update&id=" . $row["ID_Hang"] . "' class='btn btn-warning' style='margin-right:10px'>Cập nhật</a>
                                    <a href='brands.php?task=delete&id=" . $row["ID_Hang"] . "' class='btn btn-danger'>Xóa</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<td>" . $row["Ten_Hang"] . "</td>";
                                echo "<td>" . $row["TrangThai"] . "</td>";
                                echo "<td>" . $row["Ten_DanhMuc"] . "</td>";
                                echo "<td style='width:200px'>";
                                echo "<a href='brands.php?task=update&id=" . $row["ID_Hang"] . "' class='btn btn-warning' style='margin-right:10px'>Cập nhật</a>
                                <a href='brands.php?task=delete&id=" . $row["ID_Hang"] . "' class='btn btn-danger'>Xóa</a></td>";
                                echo "</tr>";
                            }
                        }
                    } else {
                        echo "Bảng k chứa dữ liệu";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>