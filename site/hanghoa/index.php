<?php
session_start();
require_once "../../dao/pdo.php";
require_once "../../dao/global.php";
require_once "../../cart/thongke.php";
$id = $_GET['id'];

$data = 8;
if (isset($_GET['id']) && !isset($_GET['p'])) {
    $id = $_GET['id'];
    $product = 1;
} elseif (isset($_GET['id']) && isset($_GET['p'])) {
    $product = $_GET['p'];
    $id = $_GET['id'];
} else {
    header("Location:index.php");
}
$sql = "SELECT COUNT(*) FROM hanghoa WHERE ma_loai = '$id'";
$conn = connect();
$stmt = $conn->prepare($sql);
$stmt->execute();
$number = $stmt->fetchColumn();
$page = ceil($number / $data);
$tin = ($product - 1) * $data;
$sanpham = selectAll("SELECT * FROM hanghoa where ma_loai =$id ORDER BY id DESC LIMIT $tin,$data");


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
    <div class="container-fluid">
        <div class="container" style="min-height:100px;margin-bottom: 60px;">

            <div class="row hang3">
                <div class="col-xl-12" style="margin-bottom: 40px;position: relative;margin-top: 30px;text-align: center">
                    <div>
                        <?php foreach (selectAll("select * from loaihang where id =$id") as  $value) : ?>
                            <h5 class="chutt" style="left:510px"><?php echo $value['ten_loai'] ?></h5>
                            <hr>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="row hangsp">
                    <?php
                        foreach ($sanpham as $row) : ?>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 bo" style=" margin-bottom: 50px;">
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
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:20px;">
                            <?php
                            for ($t = 1; $t <= $page; $t++) { ?>
                                <a href="index.php?id=<?= $id ?>&p=<?= $t ?>" class=" btn btn-primary" style="float:left;margin-left:5px"><?= $t ?></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php include_once "../../content/layout/footer.php" ?>
</body>

</html>