<?php
$sql_select_ssd = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 1 order by ID_Hang DESC limit 5";
$ketqua_ssd = mysqli_query($conn, $sql_select_ssd);
$sql_select_power = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 2 order by ID_Hang DESC limit 5";
$ketqua_power = mysqli_query($conn, $sql_select_power);
$sql_select_earphone = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 3 order by ID_Hang DESC limit 5";
$ketqua_earphone = mysqli_query($conn, $sql_select_earphone);
$sql_select_android = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 4 order by ID_Hang DESC limit 5";
$ketqua_android = mysqli_query($conn, $sql_select_android);
$sql_select_smartphone = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 5 order by ID_Hang DESC limit 5";
$ketqua_smartphone = mysqli_query($conn, $sql_select_smartphone);
$sql_select_headphone = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 6 order by ID_Hang DESC limit 5";
$ketqua_headphone = mysqli_query($conn, $sql_select_headphone);
$sql_select_pen = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 7 order by ID_Hang DESC limit 5";
$ketqua_pen = mysqli_query($conn, $sql_select_pen);
$sql_select_key = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 8 order by ID_Hang DESC limit 5";
$ketqua_key = mysqli_query($conn, $sql_select_key);
$sql_select_touch = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 9 order by ID_Hang DESC limit 5";
$ketqua_touch = mysqli_query($conn, $sql_select_touch);
$sql_select_smartphone2 = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 5 order by ID_Hang DESC limit 5, 6";
$ketqua_smartphone2 = mysqli_query($conn, $sql_select_smartphone2);
$sql_select_glass = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 10 order by ID_Hang DESC limit 5";
$ketqua_glass = mysqli_query($conn, $sql_select_glass);
$sql_select_screen = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 11 order by ID_Hang DESC limit 5";
$ketqua_screen = mysqli_query($conn, $sql_select_screen);
$sql_select_guard = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 12 order by ID_Hang DESC limit 5";
$ketqua_guard = mysqli_query($conn, $sql_select_guard);
$sql_select_mini = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 13 order by ID_Hang DESC limit 5";
$ketqua_mini = mysqli_query($conn, $sql_select_mini);
$sql_select_power2 = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 2 order by ID_Hang DESC limit 5, 6";
$ketqua_power2 = mysqli_query($conn, $sql_select_power2);
$sql_select_earphone2 = "select * from tbl_hang inner join tbl_danhmuc on tbl_hang.ID_DanhMuc = tbl_danhmuc.ID_DanhMuc where tbl_hang.ID_DanhMuc = 3 order by ID_Hang DESC limit 5, 6";
$ketqua_earphone2 = mysqli_query($conn, $sql_select_earphone2);
//cập nhật gio hang
$sql_count = "SELECT COUNT(ID_GioHang) AS abc FROM tbl_giohang where ID_Khach = " . $_SESSION["id_khach"] . ";";
//đổ dữ liệu sau khi truy vấn vào kết quả
$count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($count)
?>