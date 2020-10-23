<?php 

require_once "../../dao/global.php";
require_once "../../dao/pdo.php";


$id = $_GET['id'];

insert_delete_update("delete  from binhluan where id =$id");

header("Location:".BASE_URL."admin/binhluan/index.php?msg=Bạn đã xóa thành công");

?>