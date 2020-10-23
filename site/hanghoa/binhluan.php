<?php

session_start();

require_once "../../dao/global.php";
require_once "../../dao/pdo.php";
require_once "../../cart/thongke.php";

$binhluan = $_POST['bl'];
$binhluanErr = "";
$id_khachhang = $_GET['mkh'];
$idsp = $_GET['id'];
$khachhang = isset($_SESSION['khachhang']) ? $_SESSION['khachhang'] : $_SESSION['admin'];
$day = date("Y-m-d");
$maloai = $_GET['maloai'];

if ($khachhang == "") {
    header("location:" . BASE_URL . "site/hanghoa/chitiet.php?msg=Bạn phải đăng nhập dưới dạng khách hàng&id=$idsp&maloai=$maloai");
    die;
}

if ($binhluan == "") {
    $binhluanErr = "Xin mời bạn nhập bình luận";
    header("location:" . BASE_URL . "site/hanghoa/chitiet.php?id=$idsp&maloai=$maloai&msg=Xin mời nhập bình luạn");
    die;
}

insert_delete_update("insert into binhluan(noi_dung,ma_hh,ma_kh,ngay_bl) values('$binhluan','$idsp','$id_khachhang','$day')");
header("location:" . BASE_URL . "site/hanghoa/chitiet.php?id=$idsp&maloai=$maloai");
