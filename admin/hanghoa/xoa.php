<?php 

require_once "../../dao/pdo.php";
require_once "../../dao/global.php";
$id = $_GET['id'];

 insert_delete_update("delete from hanghoa where id = '$id' ");
header("Location:".BASE_URL."admin/hanghoa/index.php?msg=Xóa Thành Công");

?>