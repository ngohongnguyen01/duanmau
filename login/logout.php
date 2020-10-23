<?php 
session_start();
require_once "../dao/pdo.php";
require_once "../dao/global.php";
if(isset($_SESSION['admin'])){
    unset($_SESSION['admin']);
    unset($_SESSION['cart']);
    header("Location:".BASE_URL);
}
if(isset($_SESSION['khachhang'])){
    unset($_SESSION['khachhang']);
    unset($_SESSION['cart']);
    header("Location:".BASE_URL);
}
