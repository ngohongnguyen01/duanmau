<?php


session_start();

require_once "../../dao/pdo.php";
require_once "../../dao/global.php";
require_once "../../cart/thongke.php";
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}
if (!empty($_GET['maloai'])) {
    $maloai = $_GET['maloai'];
}

if (isset($id) && isset($maloai)) {
    $sanpham = selectAll("SELECT * FROM hanghoa where id =$id");
    $view = 1;
    foreach ($sanpham as $row) {
        $view += $row['so_luot_xem'];
        insert_delete_update("update hanghoa set so_luot_xem=$view where id=$id");
    }

    $sanphamlq = selectAll("SELECT * FROM hanghoa where id !=$id AND ma_loai =$maloai ORDER BY RAND() LIMIT 6  ");

    $khachhang = isset($_SESSION['khachhang']) ? $_SESSION['khachhang'] : "";

    $admin = isset($_SESSION['admin']) ? $_SESSION['admin'] : "";

    // lấy tất cả bình luận của bảng bình luận

    $binhluan = selectAll("select * from binhluan where ma_hh=$id");
} else {
    header("Location:" . BASE_URL . "index.php");
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link rel="stylesheet" href="../../content/css/index.css">
    <?php include_once "../../content/layout/style.php" ?>
    <style>
        .zoom {
            display: inline-block;
            position: relative;
        }

        /* magnifying glass icon */

        .zoom:after {
            content: '';
            display: block;
            width: 33px;
            height: 33px;
            position: absolute;
            top: 0;
            right: 0;

        }

        .zoom img {
            display: block;
        }

        .zoom img::selection {
            background-color: transparent;
        }
    </style>
</head>

<body>
    <script>
        $(document).ready(function() {
            $('#ex1').zoom();
            $('#ex2').zoom({
                on: 'grab'
            });

        });
    </script>
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
    <div class="container" style="min-height:1100px;">
        <div class="row hang3">
            <div class="col-xl-3">

                <h4>Sản Phẩm Liên Quan</h4>
                <?php foreach ($sanphamlq as $row) : ?>
                    <ul class="nav flex-column">
                        <li style="border-bottom:1px solid gray;margin-top:5px;">
                            <a style="color:black" href="<?php echo BASE_URL . "site/hanghoa/chitiet.php?id=" . $row['id'] . "&maloai=" . $row['ma_loai'] ?>" class="nav-link"> <img src="<?php echo BASE_URL . $row['hinh_anh'] ?>" width="40px" alt=""> <span style="margin-left:15px"><?php echo $row['ten_hh'] ?></span> </a>
                        </li>
                    </ul>
                <?php endforeach; ?>

            </div>
            <div class="col-xl-9">
                <?php foreach ($sanpham as $row) : ?>
                    <div class="chu1">
                        <span style="font-size: 26px;margin-top: 15px;"> <?php echo $row['ten_hh'] ?></span> <span><?php echo "(mã sản phẩm :" . $row['id'] . ")" ?></span>
                        <p>Số lượt xem :<span style="font-size: 20px;margin-top: 15px;"> <?= $row['so_luot_xem'] ?></span></p>
                    </div>
                <?php endforeach; ?>
                <hr>
                <div class="col-xl-6" width="300px" style="float:left;">
                    <div class="wraper">
                        <span class='zoom' id='ex1'>
                            <img src="<?php echo BASE_URL . $row['hinh_anh'] ?>" width="370px" height="490px" alt="">

                        </span>
                    </div>
                    <div class="mieuta">
                        <h4 style="margin-top:20px">Miêu Tả</h4>
                        <ul>
                            <?php foreach ($sanpham as $row) : ?>
                                <li style="color:red"> <a style="color:black;"><?= $row['mo_ta'] ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="col-xl-6" style="float:left;">
                    <?php foreach ($sanpham as $row) : ?>
                        <p class="tensp" style="font-size:26px;"><?php echo $row['ten_hh'] ?></p>
                        <p>Giá Cũ :<span style="color:red;"> <del><?php echo money($row['don_gia']) ?></del> đ </span> </p>
                        <p><span style="margin-bottom:10px;"> Giá :<?= money($row['don_gia'] - ($row['don_gia']) * ($row['giam_gia'] / 100))  ?> đ </span></p>
                        <p style="margin-bottom:10px;"><i style="color:red;" class="fas fa-piggy-bank"></i> Tiết kiệm đến : <?php echo $row['giam_gia'] ?>%</p>
                        <p><i style="color:red;" class="fas fa-check-circle"></i> Tình trạng : Còn Hàng</p>
                        <p style="margin-top:10px;"> <span style="border:1px solid gray;padding:5px 10px;margin-top:10px;">
                                <i class="fas fa-broom" style="color: red;"></i> Giao Hàng 63 Tỉnh Thành Trong 12 Giờ
                        </p>
                        </span></p>
                        <div class="box1">
                            <p class="chukm">Khuyến Mại Sự Kiện Đặc Biệt</p>
                            <ul class="dskm">
                                <li>
                                    <a href="">Tặng Combo Set Quần Áo </a>
                                </li>
                                <li>
                                    <a href="">Tặng Vé Xem Phim Miễn Phí</a>
                                </li>
                                <li>
                                    <a href="">Tặng Người Yêu Miễn Phí</a>
                                </li>
                                <li>
                                    <a href="">Có Cơ Hội Nhận Được xe SH</a>
                                </li>
                            </ul>
                        </div>
                        <a href="<?= BASE_URL . "cart/add.php?id=" ?><?= $row['id'] ?>" class="btn btn-primary" style="margin-top:10px;width:85%"> <i class="fas fa-cart-arrow-down"></i> Thêm vào giỏ hàng</a>
                        <div class="clearfix"></div>
                    <?php endforeach; ?>
                </div>


            </div>

        </div>
        <br>
        <br>
        <h3>Bình Luận</h3>
        <hr>
        <div class="row" style="margin-top:50px;">
            <div class="col-xl-12">
                <?php if ($khachhang != "") : ?>
                    <form action="<?php echo BASE_URL . "site/hanghoa/binhluan.php?id=$id&mkh=" . $khachhang['id'] . "&maloai=$maloai" ?>" method="post">
                        <?php if ($khachhang != "") : ?>
                            <img src="<?php echo BASE_URL . $khachhang['hinh'] ?>" width="50px" style="border-radius:50px;margin-top:-40px" alt="">
                            <textarea name="bl" id="" cols="130" rows="2" placeholder="Thêm bình luận.." style="border:none;border-bottom:1px solid gray;margin-left:20px;"></textarea>
                            <input type="submit" style="margin-left:935px;" value="Bình luận" class="btn btn-primary">
                        <?php endif; ?>

                    </form>
                <?php endif; ?>
                <?php if ($admin != "") : ?>
                    <form action="<?php echo BASE_URL . "site/hanghoa/binhluan.php?id=$id&mkh=" . $admin['id'] . "&maloai=$maloai" ?>" method="post">
                        <?php if ($admin != "") : ?>
                            <img src="<?php echo BASE_URL . $admin['hinh'] ?>" width="50px" style="border-radius:50px;margin-top:-40px" alt="">
                            <textarea name="bl" id="" cols="130" rows="2" placeholder="Thêm bình luận.." style="border:none;border-bottom:1px solid gray;margin-left:20px;"></textarea>
                            <input type="submit" style="margin-left:935px;" value="Bình luận" class="btn btn-primary">
                        <?php endif; ?>
                        <?php if ($khachhang == "" && $admin == "") : ?>
                            <span>Xin lỗi bạn không được bình luận</span>
                        <?php endif; ?>
                        <br>
                    </form>
                <?php endif; ?>
                <?php if (selectAll("select COUNT(noi_dung) from binhluan where id=$id") < 0) : ?>
                    <span>Chưa có bình luận</span>
                <?php endif; ?>
                <br>
                <?php if (isset($_GET['msg'])) : ?>
                    <p style="color:red;"> <?php echo $_GET['msg'] ?></p>
                <?php endif; ?>
            </div>
            <hr>
            <div class="col-xl-12">
                <?php foreach ($binhluan as $bl) {
                    $makh = "";
                    $makh = $bl['ma_kh'];
                    $anhkh = selectAll("SELECT * FROM khachhang where id = '$makh' ");
                    foreach ($anhkh as $kh) { ?>
                        <div class="allbl" style="width:1000px;margin-top:25px;">
                            <div class="anh" style="float:left;width:70px">
                                <img src="<?php echo BASE_URL . $kh['hinh'] ?>" width="50" style="border-radius:50px;" alt="">
                            </div>
                            <div class="thongtin" style="float:left;width:500px">
                                <span><?php echo $kh['ho_ten'] ?> </span> <span style="font-size:13px;"><?php echo $bl['ngay_bl'] ?></span>
                                <br>
                                <span style="margin-bottom:15px;"> <?php echo $bl['noi_dung'] ?></span>
                                <br>
                                <br>
                                <a href="" style="color:gray;"><i class="fas fa-thumbs-up"></i></a>
                                <a href="" style="margin-left:15px;color:gray;"> <i class="fas fa-thumbs-down"></i></a>
                                <a onclick="return confirm('Bạn có muồn xóa bình luận này không ?')" href="<?php echo BASE_URL . "site/hanghoa/xoa.php?id=" . $bl['id'] . "&idsp=" . $bl['ma_hh'] . "&maloai=$maloai" ?>" style="margin-left:15px;color:gray;">
                                    <?php if (isset($_SESSION['khachhang']['id']) == $bl['ma_kh']) : ?>
                                        <i class="fas fa-trash-alt"></i>
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['admin'])) : ?>
                                        <i class="fas fa-trash-alt"></i>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php } ?>
                <?php } ?>
                <a href="" class="btn btn-primary" style="width:100%;margin-top:30px;"> Tải Thêm Bình Luận </a>
            </div>

        </div>
        <?php include_once "../../content/layout/footer.php" ?>
        <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
        <script src='<?php echo BASE_URL ?>content/zoom-master/jquery.zoom.js'></script>

</body>

</html>