<?php
session_start();
require_once "../../dao/pdo.php";
require_once "../../dao/global.php";
require_once "../../cart/thongke.php";

if (isset($_GET['p'])) {
    $product = $_GET['p'];
} else {
    $product = 1;
}
$keyword = isset($_POST['timkiem']) ? $_POST['timkiem']  : $_GET['timkiem'];
$sosp = dem("SELECT COUNT(*) FROM hanghoa WHERE  ten_hh like '%$keyword%'");
$data = 8;
$tongtrang = ceil($sosp / $data);
$tin = ($product - 1) * $data;
$kwErr = "";
if (empty($keyword)) {
    $kwErr = "Xin mời bạn nhập từ khóa";
}

$sp = selectAll("SELECT * FROM `hanghoa` WHERE `ten_hh` LIKE '%$keyword%' ORDER BY id DESC LIMIT $tin,$data");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm</title>
    <link rel="stylesheet" href="../../content/css/index.css">
    <?php include_once "../../content/layout/style.php" ?>
    <style>
        .con:hover {
            box-shadow: 0px 3px 7px 3px #d7d5d5;
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['khachhang'])) : ?>
        <?php include_once "../../content/layout/header2.php" ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['admin'])) : ?>
        <?php include_once "../../admin/layout/header2.php" ?>
    <?php endif; ?>
    <?php if (!isset($_SESSION['khachhang']) && !isset($_SESSION['admin'])) : ?>
        <?php include_once "../../content/layout/header.php" ?>
    <?php endif; ?>
    <?php include_once "../../content/layout/danhmuc.php" ?>
    <div class="container" style="min-height:100px;padding-top:20px;    ">
        <?php if ($sp) { ?>
            <p><i class="fas fa-lightbulb" style="margin-right:10px;font-size:26px;color: #555;"></i><?php echo "Kết quả tìm kiếm cho từ khóa  "; ?><span style="color:blue;font-size:20px;"><?php echo "\" $keyword \" " ?></span></p>
           
        <?php } ?>
        <?php if (!$sp) { ?>
            <img src="../../content/image/dung/tk.png" width="200px" style="margin-left:430px;" alt="">
            <h5 style="text-align:center;;margin:0px auto;"><?php echo "Không tìm thấy sản phẩm nào có từ khóa" . "\" $keyword \" "; ?></h5>
            <p align="center" style="font-size: 1.125rem;color: rgba(0,0,0,.54);">Hãy thử sử dụng các từ khóa chung chung hơn</p>
        <?php } ?>
        <div class="row hang3">
            <?php
            foreach ($sp as $row) : ?>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 bo" style="margin-bottom:50px;">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 con" style="border:1px solid #cdcdcd;height:470px;padding-top: 10px;">
                        <a href="<?php echo BASE_URL . "site/hanghoa/chitiet.php?id=" . $row['id'] . "&maloai=" . $row['ma_loai'] ?>"><img class="anhdm" src="<?php echo BASE_URL . $row['hinh_anh'] ?>" width="200px" height="300px" style="margin:10px" alt="" /></a>
                        <span style="position:absolute;top:3px;right:5px;color:white;font-size:20px;width:40px ; height:40px; border-radius:40px;background-color:red;;text-align:center;line-height:40px;"><?= $row['giam_gia'] ?>%</span>
                        <div class="grid-chain-bottom" style="text-align: center">
                            <h6><a href="<?php echo BASE_URL . "site/hanghoa/chitiet.php?id=" . $row['id'] . "&maloai=" . $row['ma_loai'] ?>"><?= $row['ten_hh'] ?></a></h6>
                            <div class="gia">
                                <span style="color:red;font-weight:bold;"><?= money($row['don_gia'] - ($row['don_gia'] * ($row['giam_gia'] / 100))) . " đ" ?></span>
                                <i><del style="font-size:15px;"><?= money($row['don_gia']) ?>đ</del></i><br>
                                <p><?= $row['so_luot_xem'] ?> lượt xem</p>
                                <a href="<?= BASE_URL . "cart/add.php?id=" ?><?= $row['id'] ?>" class="btn btn-primary">Thêm vào giỏ hàng</a>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php
                for ($t = 1; $t <= $tongtrang; $t++) { ?>
                    <a href="timkiem.php?timkiem=<?= $keyword ?>&p=<?= $t ?>" class=" btn btn-primary" style="float:left;margin-left:5px"><?= $t ?></a>
                <?php
                }
                ?>
            </div>

        </div>

    </div>
    <?php include_once "../../content/layout/footer.php" ?>
</body>

</html>