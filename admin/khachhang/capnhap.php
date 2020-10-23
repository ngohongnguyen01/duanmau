<?php

session_start();
require_once "../../dao/pdo.php";
require_once "../../dao/global.php";
require_once "../../cart/thongke.php";


$id = "";
if (isset($_SESSION['khachhang'])) {
    $id = $_SESSION['khachhang']['id'];
}


$khachhang = selectAll("select * from khachhang where id='$id'");

if (isset($_POST['gui'])) {
    $name = $_POST['hoten'];
    $nameErr = "";
    if ($name == "") {
        $nameErr = "Xin mời bạn nhập họ tên";
    }
    if (!preg_match("/^[a-zA-Z-'(àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD) ]*$/", $name)) {
        $nameErr = "Tên khách hàng không hợp lệ";
    }

    $email = $_POST['email'];
    $emailErr = "";
    if ($email == "") {
        $emailErr = "Xin mời bạn nhập email";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = " Email không hợp kệ";
    }
    foreach (selectAll("select * from khachhang") as $khachhang) {
        if ($email == $khachhang['email']) {
            $emailErr = " xin lỗi email này đã đăng ký";
        }
    }

    if (empty($_POST['mk'])) {
        $mkErr = "Xin mời nhập mật khẩu";
    } else {
        $mk = $_POST['mk'];
        if (strlen($mk) < 6 || strlen($mk) > 30) {
            $mkErr = "Xin mời nhập mật khẩu trên 6 ký tự và dưới 30 ký tự";
        }
    }


    if (empty($_POST['nlmk'])) {
        $nlmkErr = "Xin mời nhập  mật khẩu";
    } else {
        $nlmk = $_POST['nlmk'];
        if ($nlmk !== $mk) {
            $nlmkErr = "Xin mời bạn nhập mật khẩu đúng với mật khẩu đã nhập";
        }
    }


    $anh = $_FILES['hinh_anh'];
    $anhErr = "";
    foreach ($khachhang as $ha) {
        $path = $ha['hinh'];
    }



    $filename = "";
    $anh = $_FILES['hinh_anh'];
    $sizeanh = 1500000;
    if ($_FILES['hinh_anh']['size'] <= 0) {
        $path = $ha['hinh'];
    } elseif (getimagesize($anh['tmp_name']) == false) {
        $anhErr = "xin mời bạn nhập file ảnh";
    } elseif ($_FILES['hinh_anh']['size'] >= $sizeanh) {
        $anhErr = "xin mời bạn nhập ảnh size nhỏ hơn 1.5mb";
    } else {
        $dir = "../../content/image/users/";
        $target_file = $dir . basename($anh['name']);
        $filename = "";
        $path = "";
        $typeanh = ['jpg', 'png', 'bmp'];
        $kieu = pathinfo($target_file, PATHINFO_EXTENSION);
        if (!in_array($kieu, $typeanh)) {
            $anhErr = "Chỉ được upload các định dạng JPG, PNG, JPEG";
        } elseif ($anh['size'] > 0 || $anh['size'] < $sizeanh) {
            $filename = uniqid() . "_" . $anh['name'];
            move_uploaded_file($anh['tmp_name'], "../../content/image/users/" . $filename);
            $path = "content/image/users/" . $filename;
        } else {
            $anhErr = "";
        }
    }

    if ($emailErr . $nameErr .  $anhErr  != "") {
        header("Location:" . BASE_URL . "admin/khachhang/capnhap.php?emailErr=$emailErr&nameErr=$nameErr&anhErr=$anhErr&id=$id");
        die;
    }

    insert_delete_update("update khachhang set  ho_ten='$name',hinh= '$path',email='$email' where id ='$id'");
    header("location:" . BASE_URL . "index.php?msg=Sửa Thông Tin Thành Công");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhập tài khoản</title>
    <?php include_once "../../content/layout/style.php" ?>
    <link rel="stylesheet" href="../../content/css/index.css">
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
        <div class="container">


            <div class="col-xl-12" style="margin-bottom: 40px;position: relative;margin-top: 30px;text-align: center">
                <div>
                    <h5 class="chutt" style="top:-15px;">Sửa Thông Tin</h5>
                    <hr>
                </div>
            </div>
            <form action="<?php echo BASE_URL . "admin/khachhang/capnhap.php?id=" ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xl-12">
                        <?php foreach ($khachhang as $row) : ?>
                            <div class="form-group">
                                <label for="">Mã khách hàng</label>
                                <input type="text" name="makh" class="form-control" value="<?php echo $row['id'] ?>" disabled>
                                <?php if (isset($_GET["makhErr"])) : ?>
                                    <span style="color:red;"><?= $_GET["makhErr"] ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="">Họ tên</label>
                                <input type="text" name="hoten" class="form-control" value="<?php echo $row['ho_ten'] ?>">
                                <?php if (isset($_GET["nameErr"])) : ?>
                                    <span style="color:red;"><?= $_GET["nameErr"] ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for=""> Email</label>
                                <input type="text" name="email" class="form-control" value="<?php echo $row['email'] ?>">
                                <?php if (isset($_GET["emailErr"])) : ?>
                                    <span style="color:red;"><?= $_GET["emailErr"] ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="">Ảnh</label>
                                <img src="<?php echo BASE_URL . $row['hinh'] ?>" alt="" width="150px">
                                <input type="file" name="hinh_anh" class="form-control">
                                <?php if (isset($_GET["anhErr"])) : ?>
                                    <span style="color:red;"><?= $_GET["anhErr"] ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-sm btn-info" name="gui">Lưu</button>
                                &nbsp;
                                <a href="<?= BASE_URL . "admin/khachhang/index.php" ?>" class="btn-sm btn-danger">Hủy</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
            </form>
        </div>
    </div>
    <?php include_once "../../content/layout/footer.php" ?>
</body>

</html>