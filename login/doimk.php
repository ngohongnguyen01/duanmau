<?php
session_start();
require_once "../dao/pdo.php";
require_once "../dao/global.php";
require_once "../cart/thongke.php";

$dulieu = isset($_SESSION['khachhang']) ? $_SESSION['khachhang'] : $_SESSION['admin'];

$id = $dulieu['id'];

if (isset($_POST['gui'])) {

    $matkhaucuERR = "";
    if (empty($_POST['mkcu'])) {
        $matkhaucuERR = "Xin mời nhập mật khẩu";
    } else {
        $matkhaucu = $_POST['mkcu'];
        if (password_verify($matkhaucu, $dulieu['matkhau']) == false) {
            $matkhaucuERR = "Xin lỗi mật khẩu không đúng";
        }
    }

    if (empty($_POST['mkmoi'])) {
        $matkhaumoiErr = "Xin mời nhập mật khẩu";
    } else {
        $matkhaumoi = $_POST['mkmoi'];
        if (strlen($matkhaumoi) < 6 || strlen($matkhaumoi) > 30) {
            $matkhaumoiErr = "Xin mời nhập mật khẩu trên 6 ký tự và dưới 30 ký tự";
        }
    }

    if (empty($_POST['nlmk'])) {
        $nhaplaimatkhauErr  = "Xin mời nhập mật khẩu";
    } else {
        $nhaplaimatkhau = $_POST['nlmk'];
        if ($matkhaumoi !== $nhaplaimatkhau) {
            $nhaplaimatkhauErr  = "Nhập sai mật khẩu";
        }
    }


    if ($matkhaucuERR . $matkhaumoiErr . $nhaplaimatkhauErr != "") {
        header("location:" . BASE_URL . "login/doimk.php?mkcu=$matkhaucuERR&mkmoi=$matkhaumoiErr&nlmk=$nhaplaimatkhauErr");
        die;
    }
    $mat_khau = password_hash($nhaplaimatkhau, PASSWORD_DEFAULT);
    insert_delete_update("update khachhang set mat_khau='$mat_khau' where id ='$id'");
    header("location:" . BASE_URL . "site/dangnhap/index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <?php include_once "../content/layout/style.php" ?>
    <link rel="stylesheet" href="../content/css/index.css">
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
    <div class="container-fluid">
        <div class="container">
            <?php include_once "../content/layout/danhmuc.php" ?>
            <div class="row">
                <div class="col-xl-12">
                    <h2>Đổi Mật Khẩu</h2>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="">Mã Khách Hàng</label>
                            <input type="text" placeholder="<?php echo $dulieu['id']; ?>" disabled class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="">Mật khẩu cũ</label>
                            <input type="password" placeholder="nhập mật khẩu cũ" name="mkcu" class="form-control">
                            <?php if (isset($_GET['mkcu'])) : ?>
                                <span style="color:red;"><?php echo $_GET['mkcu']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Mật khẩu mới</label>
                            <input type="password" placeholder="nhập mật khẩu mới" name="mkmoi" class="form-control">
                            <?php if (isset($_GET['mkmoi'])) : ?>
                                <span style="color:red;"><?php echo $_GET['mkmoi']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Nhập Lại Mật khẩu</label>
                            <input type="password" placeholder="nhập lại mật khẩu " name="nlmk" class="form-control">
                            <?php if (isset($_GET['nlmk'])) : ?>
                                <span style="color:red;"><?php echo $_GET['nlmk']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-info" name="gui">Lưu</button>
                            &nbsp;
                            <a href="<?= BASE_URL . "index.php" ?>" class="btn btn-sm btn-danger">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "../content/layout/footer.php" ?>
</body>

</html>