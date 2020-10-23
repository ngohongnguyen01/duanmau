<?php
session_start();

require_once "../dao/pdo.php";
require_once "../dao/global.php";
checkUser();
$id = $_GET['id'];

$hanghoa = selectAll("select * from hanghoa where id = $id");

$cart = $_SESSION['cart'];

$product = [];
// kiem tra xem cos 
foreach ($hanghoa as $item) {
    if ($item['id'] == $id) {
        $product = $item;
        break;
    }
}

$flag = -1;

foreach ($cart as $index => $item) {
    if ($item['id'] == $product['id']) {
        $flag = $index;
        break;
    }
}

if($flag == -1){
    $product['dem'] =1;
    $cart[] = $product;
}
else{
    $cart[$flag]['dem']++;
}
$_SESSION['cart'] = $cart;

header('location:'.BASE_URL."index.php");