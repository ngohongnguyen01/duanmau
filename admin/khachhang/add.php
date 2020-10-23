<?php
require_once "../../dao/pdo.php";
require_once "../../dao/global.php";



$khachhang = insert_delete_update("select * khachhang");

if (empty($_POST['makh'])) {
    $makhErr = "Xin mời nhập mã khách hàng";
} else {
    $makh = $_POST['makh'];
    $bieu_thuc = '/^[a-zA-Z0-9_]{5,30}$/';
    if (!preg_match($bieu_thuc, $makh)) {
        $makhErr = "Mã khách hàng k hợp lệ";
    }
    if (strlen($makh) < 5 || strlen($makh) > 30) {
        $makhErr = "Xin mời nhập mật khẩu trên 5 ký tự và dưới 30 ký tự";
    }
    foreach (selectAll("select * from khachhang") as $khachhang) {
        if ($makh == $khachhang['id']) {
            $makhErr = " xin lỗi mã tài khoản đã tồn tại";
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

if (($_POST['kichhoat']) == "") {
    $kichhoatErr = "Xin mời bạn nhập trạng thái của mình";
} else {
    $kichhoat = $_POST['kichhoat'];
}

if (($_POST['vaitro']) == "") {
    $vaitroErr  = "Xin mời bạn nhập vai trò của mình";
} else {
    $vaitro = $_POST['vaitro'];
}


if (empty($_POST['hoten'])) {
    $nameErr = "Xin mời nhập họ tên";
} else {
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

if ($makhErr . $mkErr . $emailErr . $kichhoatErr . $nameErr . $nlmkErr . $anhErr . $vaitroErr != "") {
    header("Location:" . BASE_URL . "admin/khachhang/them.php?makhErr=$makhErr&mkErr=$mkErr&emailErr=$emailErr&kichhoatErr=$kichhoatErr&nameErr=$nameErr&nlmkErr=$nlmkErr&anhErr=$anhErr&vaitroErr=$vaitroErr");
    die;
}
insert_delete_update("insert into khachhang(id,mat_khau,ho_ten,kich_hoat,hinh,email,vai_tro) values('$makh','$mahoaMk','$name',$kichhoat,'$path','$email',$vaitro)");
header("location:" . BASE_URL . "admin/khachhang/index.php?msg=Thêm thông tin thành công");
