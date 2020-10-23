<?php
session_start();

 $id = $_GET['id'];
require_once "../dao/pdo.php";
require_once "../dao/global.php";
checkLogin();
 $cart = $_SESSION['cart'];
 foreach ($cart as  $index => $row){
 if($row['id'] ==$id ){
        unset($_SESSION['cart'][$index]);
 }
 }

 header('location:'.BASE_URL);