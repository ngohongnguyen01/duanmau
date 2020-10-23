<?php

session_start();
require_once "../../dao/pdo.php";
require_once "../../dao/global.php";

$id = $_GET['id'];

$admin = $_SESSION['admin'];

if ($id == $admin['id']) {
    header("location:" . BASE_URL . "admin/khachhang/index.php?msg=Bạn không thể xóa được chính mình");
    die;
}

insert_delete_update("delete from khachhang where id ='$id'");
header("Location:" . BASE_URL . 'admin/khachhang/index.php?msg=Xóa thông tin  thành công');
