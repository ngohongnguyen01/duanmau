<?php
define('BASE_URL', 'http://ngohongnguyen.com/duanmau/');


function money($money)
{

    return number_format($money, 0, '.', ',');
}
function day($time)
{
    return $ngay = $time->format('dd-mm-YYYY');
}
// kiểm tra đăng nhập

function checkLogin()
{
    if (isset($_SESSION['admin'])) {
        header("locaton:" . BASE_URL . "admin/hanghoa/index.php");
    } elseif (isset($_SESSION['khachhang'])) {
        header("locaton:" . BASE_URL);
    } else {
        header('location: ' . BASE_URL . 'site/dangnhap/index.php');
        die;
    }
}
function checkUser()
{
    if ((isset($_SESSION['khachhang']))) {
    } else {
        header('location: ' . BASE_URL . "site/dangnhap/index.php?smg=Xin bạn đăng nhập dưới dạng khách hàng ");
        die;
    }
}
function day2($time)
{
    $tmp = explode('-', $time);
    $tmp = array_reverse($tmp);
    return   $ngay_thangluu = implode('/', $tmp);
}
function vali($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
