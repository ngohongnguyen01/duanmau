<?php
session_start();

require_once "dao/pdo.php";
require_once "dao/global.php";
require_once "cart/thongke.php";

$spmoi = selectAll("SELECT * FROM hanghoa ORDER BY id DESC LIMIT 12");

$spdb = selectAll("SELECT * FROM hanghoa WHERE dac_biet = 1   LIMIT 12");

$spyt = selectAll("SELECT * FROM hanghoa ORDER BY so_luot_xem DESC   LIMIT 12");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trang chủ</title>
    <link rel="stylesheet" href="content/css/index.css">
    <?php include_once "content/layout/style.php" ?>
    <style>
        .con:hover {
            box-shadow: 0px 3px 7px 3px #d7d5d5;
        }

        .container-fluid>.container>.hang2>.col-xl-3>.nav2>.nav-item>.nav-link:hover .dskh {
            display: block;
        }
        .owl-item{
            width:274px;
        }
        .owl-carousel.owl-loaded{
            width:98%;
            margin-left: 30px;
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['khachhang'])) : ?>
        <?php include_once "content/layout/header2.php" ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['admin'])) : ?>
        <?php include_once "admin/layout/header2.php" ?>
    <?php endif; ?>
    <?php if (!isset($_SESSION['khachhang']) && !isset($_SESSION['admin'])) : ?>
        <?php include_once "content/layout/header.php" ?>
    <?php endif; ?>
    <?php include_once "content/layout/danhmuc.php" ?>
    <div class="container-fluid hang1">
        <div class="container hang2" style="min-height:1100px;margin-bottom:60px;">
            <div class="row hang3">
                <div class="col-xl-12" style="margin-bottom: 40px;position: relative;margin-top: 30px;">
                    <div>
                        <h5 class="chutt">Sản phẩm mới về</h5>
                        <hr>
                    </div>
                </div>
                <div class="col-xl-12 hang4 ">
                    <div class="row hangsp" style="width:100%">
                        <div class="owl-carousel owl-theme" width="97%">
                            <?php
                            foreach ($spmoi as $row) : ?>
                                <div class="item" style="width:272px">
                                    <div class="bo" style="margin-bottom:20px;width:255px;height:470px;margin-right:10px; ">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 con" style="border:1px solid #cdcdcd;height:470px;padding-top: 10px;">
                                            <a href="<?php echo BASE_URL . "site/hanghoa/chitiet.php?id=" . $row['id'] . "&maloai=" . $row['ma_loai'] ?>"><img class="anhdm" src="<?php echo BASE_URL . $row['hinh_anh'] ?>" width="200px" height="300px" style="margin-top:10px" alt="" /></a>
                                            <span style="position:absolute;top:3px;right:5px;color:white;font-size:20px;width:40px ; height:40px; border-radius:40px;background-color:red;;text-align:center;line-height:40px;"><?= $row['giam_gia'] ?>%</span>
                                            <div class="grid-chain-bottom" style="text-align: center">
                                                <h6><a href="<?php echo BASE_URL . "site/hanghoa/chitiet.php?id=" . $row['id'] . "&maloai=" . $row['ma_loai'] ?>"><?= $row['ten_hh'] ?></a></h6>
                                                <div class="gia">
                                                    <span style="color:red;font-weight:bold;"><?= money($row['don_gia'] - ($row['don_gia'] * ($row['giam_gia'] / 100))) . " đ" ?></span>
                                                    <i><del style="font-size:15px;"><?= money($row['don_gia']) ?>đ</del></i><br>
                                                    <p><?= $row['so_luot_xem'] ?> lượt xem</p>
                                                    <a href="<?= BASE_URL . "cart/add.php?id=" ?><?= $row['id'] ?>" class="btn btn-primary">Thêm vào giỏ hàng</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row hang3">
                <div class="col-xl-12" style="margin-bottom: 40px;position: relative;margin-top: 30px;">
                    <div>
                        <h5 class="chutt">Sản Phẩm Đặc Biệt</h5>
                        <hr>
                    </div>
                </div>
                <div class="col-xl-12 hang4 ">
                    <div class="row hangsp" style="width:100%">
                        <div class="owl-carousel owl-theme">
                            <?php
                            foreach ($spdb as $row) : ?>
                                <div class="item" style="width:250px">
                                    <div class="bo" style="margin-bottom:20px;width:255px;height:470px;margin-right:10px; ">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 con" style="border:1px solid #cdcdcd;height:470px;padding-top: 10px;">
                                            <a href="<?php echo BASE_URL . "site/hanghoa/chitiet.php?id=" . $row['id'] . "&maloai=" . $row['ma_loai'] ?>"><img class="anhdm" src="<?php echo BASE_URL . $row['hinh_anh'] ?>" width="200px" height="300px" style="margin-top:10px" alt="" /></a>
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
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row hang3">
                <div class="col-xl-12" style="margin-bottom: 40px;position: relative;margin-top: 30px;">
                    <div>
                        <h5 class="chutt">Sản Phẩm Yêu Thích</h5>
                        <hr>
                    </div>
                </div>
                <div class="col-xl-12 hang4 ">
                    <div class="row hangsp" style="width:100%">
                        <div class="owl-carousel owl-theme">
                            <?php
                            foreach ($spyt as $row) : ?>
                                <div class="item" style="width:250px">
                                    <div class="bo" style="margin-bottom:20px;width:255px;height:470px;margin-right:10px; ">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 con" style="border:1px solid #cdcdcd;height:470px;padding-top: 10px;">
                                            <a href="<?php echo BASE_URL . "site/hanghoa/chitiet.php?id=" . $row['id'] . "&maloai=" . $row['ma_loai'] ?>"><img class="anhdm" src="<?php echo BASE_URL . $row['hinh_anh'] ?>" width="200px" height="300px" style="margin-top:10px" alt="" /></a>
                                            <span style="position:absolute;top:3px;right:5px;color:white;font-size:20px;width:40px ; height:40px; border-radius:40px;background-color:red;;text-align:center;line-height:40px;"><?= $row['giam_gia'] ?>%</span>
                                            <div class="grid-chain-bottom" style="text-align: center">
                                                <h6><a href="<?php echo BASE_URL . "site/hanghoa/chitiet.php?id=" . $row['id'] . "&maloai=" . $row['ma_loai'] ?>"><?= $row['ten_hh'] ?></a></h6>
                                                <div class="gia">
                                                    <span style="color:red;font-weight:bold;"><?= money($row['don_gia'] - ($row['don_gia'] * ($row['giam_gia'] / 100))) . " đ" ?></span>
                                                    <i><del style="font-size:15px;"><?= money($row['don_gia']) ?>đ</del></i><br>
                                                    <p><?= $row['so_luot_xem'] ?> lượt xem</p>
                                                    <a href="<?= BASE_URL . "cart/add.php?id=" ?><?= $row['id'] ?>" class="btn btn-primary">Thêm vào giỏ hàng</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include_once "content/layout/footer.php" ?>



    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            })
        });
    </script>
</body>

</html>