<?php
session_start();
require_once "../dao/pdo.php";
require_once "../dao/global.php";
checkLogin();

require_once "thongke.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../content/css/index.css">
    <?php include_once "../content/layout/style.php" ?>
</head>

<body>

    <?php if (isset($_SESSION['khachhang'])) : ?>
        <?php include_once "../content/layout/header2.php" ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['admin'])) : ?>
        <?php include_once "../admin/layout/header2.php" ?>
    <?php endif; ?>
    <?php if (!isset($_SESSION['khachhang']) && !isset($_SESSION['admin'])) : ?>
        <?php include_once "../content/layout/header.php" ?>
    <?php endif; ?>
    <?php include_once "../content/layout/danhmuc.php" ?>
    <div class="container-fluid">
        <div class="container">
            
            <div class="row">
                <div class="col-xl-12">
                    
                    <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) : ?>
                        <div class="hopchua" style="text-align:center;">
                       <img src="<?php echo BASE_URL."content/image/dung/dayhang.png" ?>" style="margin:0px auto;;margin-top:50px;width:190px;" alt="">
                      
                       <p style="margin-top:15px;margin-bottom:30px;">  Không có sản phẩm nào trong giỏ hàng của bạn .</p>
                       <a class="btn btn-primary" href="<?php echo BASE_URL."index.php"?>"  style="color:white;width:300px;margin-bottom:30px;" role="button">Tiếp tục mua sắm</a>
                       </div>
                    <?php endif; ?>
                    <?php if ( !empty($_SESSION['cart'])) : ?>
                        <table class="table table-stripped">
                            <thead>
                                <th>id</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Số Lượng</th>
                                <th>Đơn Giá</th>
                                <th>Mã sản phẩm </th>
                                <th>Ảnh </th>
                                <th>Ngày Nhập</th>
                                <th>Mô Tả</th>
                                <th>Xóa Sản Phẩm</th>
                            </thead>
                            <tbody>
                                <?php foreach ($cart as $index => $row) : ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['ten_hh'] ?></td>
                                        <td><?= $row['dem'] ?></td>
                                        <td><?= money($row['don_gia']) ." đ" ?></td>
                                        <td><?= $row['ma_loai'] ?></td>
                                        <td>
                                            <img src="<?= BASE_URL . $row['hinh_anh'] ?>" width="100" alt=""> </td>

                                        <td><?= $row['ngay_nhap'] ?></td>
                                        <td><?= $row['mo_ta'] ?></td>
                                        <td> <a href="<?php echo BASE_URL . "cart/xoa.php?id=" . $row['id'] ?>" class="btn btn-sm btn-success" onclick="return confirm('Bạn Có chắc Muốn Sản Phẩm Này Không')">Xóa </a> </td>
                                    </tr>
                                <?php endforeach ?>
                        </table>
                        <?php endif; ?>
                        <?php if (!empty($_SESSION['cart'])) : ?>
                            <h4>Thành tiền:<span style="color:red;"><?php echo money($sotien) . " VNĐ" ?></span></h4>
                        <?php endif; ?>
                </div>
            </div>
        </div>
        <?php include_once "../content/layout/footer.php" ?>
</body>

</html>