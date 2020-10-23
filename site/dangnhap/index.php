<?php
require_once "../../dao/pdo.php";
require_once "../../dao/global.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="public/css/dangnhap.css">
    <?php include_once "../../content/layout/style.php" ?>

</head>

<body>
    <div class="container-fluid backgroud">
        <div class="container chua">
            <div class="hopchua" style=" position: absolute;top: 100px;right: 509px;"></div>
            <div class="hop">
                <h2 class="ten" style="color:white;">Đăng Nhập</h2>
                <?php if (isset($_GET['smg'])) : ?>
                    <span style="color:red"><?php echo $_GET['smg'] ?></span>
                <?php endif; ?>

                <form action="<?php echo BASE_URL . "login/login.php" ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="input" name="makh" placeholder="Mã khách hàng"> <i class="fas fa-user" style="width:20px;"></i>
                    </div>
                    <div class="form-group">
                        <input type="password" class="input" name="password" placeholder="Password"> <i class="fas fa-user-lock"></i>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="check" style="margin-left:4px;margin-right:10px;"> <span class="span"> Nhớ Mật Khẩu</span>
                        <a href="<?php echo BASE_URL . "site/dangnhap/quyenmatkhau.php" ?>" class="qmk">Quên Mật Khẩu</a>
                    </div>
                    <div class="form-group">
                        <input class="input2" type="submit" value="GỬI">
                    </div>
                    <div class="form-groud" style="margin-top:35px;">
                        <a style="color:white;margin-left: 85px;" href="<?php echo BASE_URL . "index.php" ?>" class=""><i class="fas fa-arrow-alt-circle-left"></i> Quay lại</span>
                            <a href=""><img src="public/image/logofacebook.png" width="50px" height="36" style="margin-left:50px;" alt=""></a>
                            <a href=""><img src="public/image/gg.jpg" width="50px" style="margin-left:10px;" alt=""></a>
                            <a href=""><img src="public/image/tt.jpg" width="50px" style="margin-left:10px;" alt=""></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>