<!-- <?php

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] :"";
$soluong = 0;
$sotien = 0;

foreach ($cart as $row){
    $soluong += $row['dem'];
    $sotien += $row['dem'] * $row['don_gia'];
}

?> -->