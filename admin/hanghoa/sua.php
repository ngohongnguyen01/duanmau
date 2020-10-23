<?php

require_once "../../dao/pdo.php";
require_once "../../dao/global.php";
$id = $_GET['id'];
$row = select_once("select * from hanghoa where id ='$id'");

$loai = selectAll("select * from loaihang ");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin hàng hóa</title>
    <?php include_once "../../content/layout/style.php" ?>
    <link rel="stylesheet" href="../../content/css/index.css">
</head>

<body>
    <?php include_once "../layout/header.php" ?>
    <div class="container-fluid" style="background-color:blue;margin: 15px 0px;">
        <div class="container">
            <?php include_once "../layout/danhmuc.php" ?>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">

            <div class="row" style="height:1000px;">
                <div class="col-xl-12" style="margin-bottom: 40px;position: relative;margin-top: 30px;text-align: center">
                    <div>
                        <h5 class="chutt">Sửa Thông Tin Hàng Hóa</h5>
                        <hr>
                    </div>
                </div>
                <div class="col-xl-12">
                    <form action="<?= BASE_URL . "admin/hanghoa/edit.php?id=" . $row['id'] ?>" method="POST" id="formdl" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Tên Hàng Hóa:</label>
                            <input type="text" name="ten_hh" value="<?php echo $row['ten_hh'] ?>" class="form-control">
                            <?php if (isset($_GET["ten_hhErr"])) : ?>
                                <span style="color:red;"><?= $_GET["ten_hhErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Đơn Giá:</label>
                            <input type="number" name="don_gia" value="<?php echo $row['don_gia'] ?>" class="form-control">
                            <?php if (isset($_GET["don_giaErr"])) : ?>
                                <span style="color:red;"><?= $_GET["don_giaErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Giảm Giá:</label>
                            <input type="text" name="giam_gia" value="<?php echo $row['giam_gia'] ?>" class="form-control">
                            <?php if (isset($_GET["giam_giaErr"])) : ?>
                                <span style="color:red;"><?= $_GET["giam_giaErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Ngày Nhập:</label>
                            <label for="">Ngày Nhập:</label>
                            <input type="text" name="ngay_nhap" class="form-control" value="<?php echo day2($row['ngay_nhap']) ?>">
                            <?php if (isset($_GET["ngay_nhapErr"])) : ?>
                                <span style="color:red;"><?= $_GET["ngay_nhapErr"] ?></span>
                            <?php endif; ?>

                        </div>
                        <div class="form-group">
                            <label for="">Ảnh :</label>
                            <img src="<?= BASE_URL . $row['hinh_anh'] ?>" width="100px" alt="">
                            <input type="file" name="hinh" class="form-control">
                            <?php if (isset($_GET["hinh_anhErr"])) : ?>
                                <span style="color:red;"><?= $_GET["hinh_anhErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Mã Loại:</label>
                            <select name="ma_loai">
                                <?php foreach ($loai as $lh) : ?>
                                    <option value="<?php echo $lh['id'] ?>" <?php if ($lh['id'] == $row['ma_loai']) {
                                                                                echo 'selected';
                                                                            } ?>>
                                        <?= $lh['ten_loai'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($_GET["ma_loaiErr"])) : ?>
                                <span style="color:red;"><?= $_GET["ma_loaiErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Đặc Biệt:</label>
                            <input type="radio" value="1" name="dac_biet" <?php if ($row['dac_biet'] == 1) {
                                                                                echo 'checked';
                                                                            } ?>> Đặc Biệt
                            <input type="radio" value="0" <?php if ($row['dac_biet'] == 0) {
                                                                echo 'checked';
                                                            } ?> name="dac_biet"> Bình Thường
                        </div>
                        <div class="form-group">
                            <label for="">Số Lượt Xem:</label>
                            <input type="text" name="so_luot_xem" value="<?php echo $row['so_luot_xem'] ?>" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Mô Tả:</label>
                            <textarea name="mo_ta" class="form-control"><?php echo $row['mo_ta'] ?></textarea>
                            <?php if (isset($_GET["mo_taErr"])) : ?>
                                <span style="color:red;"><?= $_GET["mo_taErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-info">Lưu</button>
                            &nbsp;
                            <a href="<?= BASE_URL . "admin/hanghoa/index.php" ?>" id="guidl" class="btn btn-sm btn-danger">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "../../content/layout/footer.php" ?>
    <!-- <script>
        $(document).ready(function() {
            $('#guidl').click(function() {
                $.ajax({
                    url: 'edit.php',
                    type: 'post',
                    data: $('#formdl').serialize(),
                    success: function(res) {
                        alert(res);
                    }
                })
            });
        });
    </script> -->
</body>

</html>