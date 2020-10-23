<?php
 
 require_once "pdo.php";
 require_once "global.php";
// xóa và thêm dữ liệu, update dữ liệu
 function loai_insert_update_delete($sql){
   return insert_delete_update($sql);
 }
 // xem 1

   function loai_xem1($sql){
       return select_once($sql);
   }
   // xem all

   function loai_xemAll($sql){
       return selectall($sql);
   }
   
?>