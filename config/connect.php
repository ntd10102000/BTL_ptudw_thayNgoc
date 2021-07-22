<?php
//khai báo các tham số kết nối với mysql
$servername = "localhost";
$username = "root";
$password = "";
//tham số kết nối đến tên db
$db = "ad3h_store";

//khởi tạo biến kết nối đến CSDL
$conn = mysqli_connect($servername,$username,$password,$db);

//kiểm tra kết nối
if(!$conn){
    echo "lỗi kết nối cơ sở dữ liệu". mysqli_connect_error();
} else {
    // echo "kết nối cơ sở dữ liệu thành công";
}
?>