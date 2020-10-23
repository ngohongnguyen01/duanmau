<?php

require_once "../../dao/pdo.php";
require_once "../../dao/global.php";
$id = $_GET['id'];
$hhh = select_once("select * from hanghoa where id ='$id'");


if (empty($_POST['ten_hh'])) {
    $ten_hhErr = "Xin mời nhập tên hàng hóa";
} else {
    $ten_hh = $_POST['ten_hh'];
    if (strlen($ten_hh) < 3) {
        $ten_hhErr = "Xin mời nhập tên hàng hóa trên 3 ký tự";
    }
}

$don_gia = $_POST['don_gia'];
$don_giaErr = "";

$giam_gia = $_POST['giam_gia'];
$giam_giaErr = "";


$ngay_nhapErr = "";

echo $ten_hh;

if (empty($_POST['ngay_nhap'])) {
    $ngay_nhapErr = "Xin mời nhập ngày ";
} else {
    $ngay_nhap = $_POST['ngay_nhap'];
    $mang = explode("/", $ngay_nhap); // cái này đang là mảng 
    $m = $mang[0];
    $d = $mang[1];
    $y = $mang[2];
    if (!vali($ngay_nhap, 'd/m/Y')) {
        $ngay_nhapErr = 'Xin mời nhập ngày tháng năm theo định dạng dd/mm/yyyy ';
    }
    if (!checkdate($m, $d, $y)) {
        $ngay_nhapErr = "Vui lòng nhập ngày tháng năm chính xác !";
    }
    if (strtotime("now")  - strtotime($ngay_nhap)  < 0) {
        $ngay_nhapErr = 'Ngày nhập không hợp lệ ';
    } else {
        $tmp = explode('/', $ngay_nhap);
        $tmp = array_reverse($tmp);
        $ngay_thangluu = implode('-', $tmp);
    }
}

$filename = "";

$ma_loai = $_POST['ma_loai'];
$ma_loaiErr = "";

$dac_biet = $_POST['dac_biet'];
$dac_bietErr = "";



$mo_ta = $_POST['mo_ta'];
$mo_taErr = "";


if ($don_gia == "") {
    $don_giaErr = "Xin mời nhập  đơn giá ";
}
if ($don_gia <= 0) {
    $don_giaErr = "Xin mời nhập  đơn giá lớn hơn 0";
}
if ($giam_gia == "") {
    $giam_giaErr = "Xin mời nhập  đơn giảm giá ";
}
if ($ma_loai == "") {
    $ma_loaiErr = "Xin mời nhập  mã loại hàng";
}

if ($dac_biet == "") {
    $dac_bietErr = "Xin mời nhập  số đặc biệt";
}
if ($mo_ta == "") {
    $mo_taErr = " Xin mời nhập mô tả sản phẩm";
}

$sizeanh = 1500000;
$anhErr = "";

foreach ($hhh as $hinh) {
    $path = $hinh['hinh_anh'];
}
$filename = "";
$anh = $_FILES['hinh'];
$sizeanh = 1500000;
if ($_FILES['hinh']['size'] <= 0) {
    $path = $hinh['hinh_anh'];
} elseif (getimagesize($anh['tmp_name']) == false) {
    $anhErr = "xin mời bạn nhập file ảnh";
} elseif ($_FILES['hinh']['size'] >= $sizeanh) {
    $anhErr = "xin mời bạn nhập ảnh size nhỏ hơn 1.5mb";
} else {
    $dir = "../../content/image/users/";
    $target_file = $dir . basename($anh['name']);
    $filename = "";
    $path = "";
    $typeanh = ['jpg', 'png', 'bmp'];
    $kieu = pathinfo($target_file, PATHINFO_EXTENSION);
    if (!in_array($kieu, $typeanh)) {
        $anhErr = "Chỉ được upload các định dạng JPG, PNG, JPEG";
    } elseif ($anh['size'] > 0 || $anh['size'] < $sizeanh) {
        $filename = uniqid() . "_" . $anh['name'];
        move_uploaded_file($anh['tmp_name'], "../../content/image/users/" . $filename);
        $path = "content/image/users/" . $filename;
    } else {
        $anhErr = "";
    }
}


if ($ten_hhErr . $don_giaErr . $giam_giaErr . $ngay_nhapErr . $anhErr . $ma_loaiErr . $dac_bietErr . $mo_taErr != "") {
    header("location:" . BASE_URL . "admin/hanghoa/sua.php?ten_hhErr=$ten_hhErr&don_giaErr=$don_giaErr&giam_giaErr=$giam_giaErr&ngay_nhapErr=$ngay_nhapErr&hinh_anhErr=$anhErr&ma_loaiErr=$ma_loaiErr&dac_bietErr=$dac_bietErr&mo_taErr=$mo_taErr&id=$id");
    die;
}

insert_delete_update("update hanghoa set ten_hh='$ten_hh' , don_gia ='$don_gia' , giam_gia='$giam_gia',hinh_anh = '$path',ngay_nhap='$ngay_thangluu',ma_loai='$ma_loai',dac_biet= $dac_biet ,mo_ta='$mo_ta' where id =$id");
header("location:" . BASE_URL . "admin/hanghoa/index.php?msg=Sửa Thông Tin Thành Công");
