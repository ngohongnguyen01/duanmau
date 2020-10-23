<?php

require_once "../../dao/pdo.php";
require_once "../../dao/global.php";

$khachhang = insert_delete_update("select * khachhang");
if (isset($_POST['gui'])) {

    if (empty($_POST['makh'])) {
        $makhErr = "Xin mời nhập mã khách hàng";
    } else {
        $makh = $_POST['makh'];
        $bieu_thuc = '/^[a-zA-Z0-9_]{5,30}$/';
        if (!preg_match($bieu_thuc, $makh)) {
            $makhErr = "Mã khách hàng không hợp lệ";
        }
        if (strlen($makh) < 5 || strlen($makh) > 30) {
            $makhErr = "Xin mời nhập mật khẩu trên 5 ký tự và dưới 30 ký tự";
        }
        foreach (selectAll("select * from khachhang") as $khachhang) {
            if ($makh == $khachhang['id']) {
                $makhErr = " Xin lỗi tài khoản đã tồn tại";
            }
        }
    }



    if (empty($_POST['email'])) {
        $emailErr = "Xin mời nhập email";
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = " Email không hợp kệ";
        }
        foreach (selectAll("select * from khachhang") as $khachhang) {
            if ($email == $khachhang['email']) {
                $emailErr = " xin lỗi email này đã đăng ký";
            }
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


    if (empty($_POST['hoten'])) {
        $nameErr = "Xin mời nhập họ tên";
    } else {
        $name = $_POST['hoten'];

        $name = $_POST['hoten'];
        if (!preg_match("/^[a-zA-Z-'(àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD) ]*$/", $name)) {
            $nameErr = "Tên khách hàng không hợp lệ";
        }
    }


    $anh = $_FILES['hinh_anh'];
    $sizeanh = 1500000;


    if ($_FILES['hinh_anh']['size'] <= 0) {
        $anhErr = "xin mời bạn nhập ảnh";
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

    // mã hóa mk 
    $mahoaMk = password_hash($mk, PASSWORD_DEFAULT);
    if ($makhErr . $mkErr . $emailErr . $nameErr . $nlmkErr . $anhErr  != "") {
        header("Location:" . BASE_URL . "admin/khachhang/dangky.php?makhErr=$makhErr&mkErr=$mkErr&emailErr=$emailErr&nameErr=$nameErr&nlmkErr=$nlmkErr&anhErr=$anhErr");
        die;
    }
    insert_delete_update("insert into khachhang(id,mat_khau,ho_ten,kich_hoat,hinh,email,vai_tro) values('$makh','$mahoaMk','$name',1,'$path','$email',0)");
    header("location:" . BASE_URL . "index.php?msg=Bạn đăng ký thành công");
}

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
    <?php include_once "../../content/layout/header.php" ?>
    <?php include_once "../../content/layout/danhmuc.php" ?>
    <div class="container-fluid">
        <div class="container">

        </div>
    </div>
    <div class="container-fluid">
        <div class="container" style="height:565px">
            <div class="col-xl-12" style="margin-bottom: 40px;position: relative;margin-top: 30px;text-align: center">
                <div>
                    <h5 class="chutt" style="margin-top:-20px">Đăng Ký Khách Hàng</h5>
                    <hr>
                </div>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
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


                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label for=""> Email</label>
                            <input type="text" name="email" class="form-control">
                            <?php if (isset($_GET["emailErr"])) : ?>
                                <span style="color:red;"><?= $_GET["emailErr"] ?></span>
                            <?php endif; ?>
                        </div>
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

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-info" name="gui">Lưu</button>
                            &nbsp;
                            <a href="<?= BASE_URL . "index.php" ?>" class="btn-sm btn-danger">Hủy</a>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <?php include_once "../../content/layout/footer.php" ?>
</body>

</html>