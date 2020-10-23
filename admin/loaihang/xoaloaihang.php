<?php 

require_once "../../dao/pdo.php";
require_once "../../dao/global.php";
$id = $_GET['id'];

 insert_delete_update("delete from loaihang where id = '$id' ");
header("Location:".BASE_URL."admin/loaihang/index.php?msg=Xóa Thành Công");

?>