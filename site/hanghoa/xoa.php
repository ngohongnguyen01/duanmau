<?php
session_start();

require_once "../../dao/pdo.php";
require_once "../../dao/global.php";
$id = $_GET['id'];

$idsp = $_GET['idsp'];
$maloai = $_GET['maloai'];

insert_delete_update("delete  from binhluan where id =$id");

header("Location:".BASE_URL."site/hanghoa/chitiet.php?msg=Bạn đã xóa thành công&id=$idsp&maloai=$maloai");


?>