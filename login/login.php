<?php
session_start();
require_once "../dao/pdo.php";
require_once "../dao/global.php";

$makh = $_POST['makh'];
$password = $_POST['password'];
$user = select_once("select * from khachhang where id = '$makh'");


if ($user  && $user['vai_tro'] == 1 && (password_verify($password, $user['mat_khau'])) && $user['kich_hoat'] == 1) {
    $_SESSION['admin'] = [
        "id" => $user['id'],
        "matkhau" => $user['mat_khau'],
        "ho_ten" => $user['ho_ten'],
        "kich_hoat" => $user['kich_hoat'],
        "hinh" => $user['hinh'],
        "email" => $user['email'],
        "vai_tro" => $user['vai_tro']
    ];
    header("location:" . BASE_URL . "admin/hanghoa/index.php?smg=Đăng Nhập thành công");

    die();
} else if ($user && (password_verify($password, $user['mat_khau'])) && $user['vai_tro'] == 0  && $user['kich_hoat'] == 1) {
    $_SESSION['khachhang'] =
        [
            "id" => $user['id'],
            "matkhau" => $user['mat_khau'],
            "ho_ten" => $user['ho_ten'],
            "kich_hoat" => $user['kich_hoat'],
            "hinh" => $user['hinh'],
            "email" => $user['email'],
            "vai_tro" => $user['vai_tro']
        ];
    header("location:" . BASE_URL . "?smg=Đăng Nhập Thành Công");
    die();
} else if (!$user) {
    header("location:" . BASE_URL . "site/dangnhap/index.php?smg=Xin lỗi tài khoản không tồn tại ");
    die();
} else if ($user['kich_hoat'] == 0) {
    header("location:" . BASE_URL . "site/dangnhap/index.php?smg=Xin lỗi tài khoản đã bị khóa ");
    die();
} else {
    header("location:" . BASE_URL . "site/dangnhap/index.php?smg=Đăng Nhập Thất Bại ");
    die();
}
