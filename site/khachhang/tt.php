<?php

session_start();
require_once "../../dao/global.php";
require_once "../../dao/pdo.php";
require_once "../../cart/thongke.php";

$id = $_GET['id'];

$thongtin = selectAll("select * from khachhang where id ='$id'");


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
    <?php if (isset($_SESSION['khachhang'])) : ?>
        <?php include_once "../../content/layout/header2.php" ?>
    <?php endif; ?>
    <?php if (!isset($_SESSION['khachhang'])) : ?>
        <?php include_once "../../content/layout/header.php" ?>
    <?php endif; ?>
    <?php include_once "../../content/layout/danhmuc.php" ?>
    <hr>
    <div class="container-fluid">
        <div class="container" style="margin-bottom: 60px;">
            <div class="col-xl-12" style="margin-bottom: 40px;position: relative;margin-top: 30px;">
                <div>
                    <h5 class="chutt" style="top:-19px;" align="center">Thông tin khách hàng</h5>
                    <hr>
                </div>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <?php foreach ($thongtin as $row) : ?>
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="">Mã khách hàng</label>
                                <input type="text" name="makh" class="form-control" value="<?php echo $row['id'] ?>">

                            </div>
                            <div class="form-group">
                                <label for="">Họ tên</label>
                                <input type="text" name="hoten" class="form-control" value="<?php echo $row['ho_ten'] ?>">

                            </div>

                            <div class="form-group">
                                <label for=""> Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>">

                            </div>





                            <div class="form-group">
                                <img src="<?php echo BASE_URL . $row['hinh'] ?>" alt="" style="border-radius:100px;" width="100px" height="100px">
                                <label for="">Ảnh</label>
                            </div>


                        </div>
                    <?php endforeach; ?>
            </form>
        </div>
    </div>
    <?php include_once "../../content/layout/footer.php" ?>
</body>

</html>