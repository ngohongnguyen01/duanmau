<?php

require_once "../../dao/pdo.php";
require_once "../../dao/global.php";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khách Hàng</title>
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
        <div class="container" style="height:565px">
            <div class="col-xl-12" style="margin-bottom: 40px;position: relative;margin-top: 30px;text-align: center">
                <div>
                    <h5 class="chutt" style="margin-top:-20px;">Thêm Khách Hàng</h5>
                    <hr>
                </div>
            </div>
            <form action="<?php echo BASE_URL ?>/admin/khachhang/add.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Mã khách hàng</label>
                            <input type="text" name="makh" class="form-control">
                            <?php if (isset($_GET["makhErr"])) : ?>
                                <span style="color:red;"><?= $_GET["makhErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Mật Khẩu</label>
                            <input type="password" name="mk" class="form-control">
                            <?php if (isset($_GET["mkErr"])) : ?>
                                <span style="color:red;"><?= $_GET["mkErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Nhập Lại Mật Khẩu</label>
                            <input type="password" name="nlmk" class="form-control">
                            <?php if (isset($_GET["nlmkErr"])) : ?>
                                <span style="color:red;"><?= $_GET["nlmkErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for=""> Email</label>
                            <input type="text" name="email" class="form-control">
                            <?php if (isset($_GET["emailErr"])) : ?>
                                <span style="color:red;"><?= $_GET["emailErr"] ?></span>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for="">Họ tên</label>
                            <input type="text" name="hoten" class="form-control">
                            <?php if (isset($_GET["nameErr"])) : ?>
                                <span style="color:red;"><?= $_GET["nameErr"] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="">Ảnh</label>
                            <input type="file" name="hinh_anh" class="form-control">
                            <?php if (isset($_GET["anhErr"])) : ?>
                                <span style="color:red;"><?= $_GET["anhErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Vai Trò</label>
                            <div class="form-control">
                                <input type="radio" name="vaitro" value="0">Khách hàng
                                <input type="radio" name="vaitro" value="1">Quản Trị
                                <?php if (isset($_GET["vaitroErr"])) : ?>
                                    <p style="color:red;"><?= $_GET["vaitroErr"] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng Thái</label>
                            <div class="form-control">
                                <input type="radio" name="kichhoat" value="0"> Chưa Kích Hoạt
                                <input type="radio" name="kichhoat" value="1"> Kích Hoạt
                                <?php if (isset($_GET["kichhoatErr"])) : ?>
                                    <p style="color:red;"><?= $_GET["kichhoatErr"] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-info" name="gui">Lưu</button>
                            &nbsp;
                            <a href="<?= BASE_URL . "admin/khachhang/index.php" ?>" class="btn-sm btn-danger">Hủy</a>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <?php include_once "../../content/layout/footer.php" ?>
</body>

</html>