<?php

require_once "../../dao/pdo.php";
require_once "../../dao/global.php";
$loai = selectAll("select * from loaihang");


if (isset($_POST['gui'])) {


    if (empty($_POST['ten_hh'])) {
        $ten_hhErr = "Xin mời nhập tên hàng hóa";
    } else {
        $ten_hh = $_POST['ten_hh'];
        if (strlen($ten_hh) < 3) {
            $ten_hhErr = "Xin mời nhập tên hàng hóa trên 3 ký tự";
        }
    }

    if (empty($_POST['don_gia'])) {
        $don_giaErr = "Xin mời nhập đơn hàng hóa";
    } else {
        $don_gia = $_POST['don_gia'];
        if ($don_gia <= 0) {
            $don_giaErr = "Xin mời nhập  đơn giá lớn hơn 0";
        }
    }

    if (empty($_POST['giam_gia'])) {
        $giam_giaErr = "Xin mời nhập giảm giá";
    } else {
        $giam_gia = $_POST['giam_gia'];
        if ($giam_gia < 0) {
            $giam_giaErr = "Xin mời nhập  đơn giảm giá lớn hơn hoặc bằng  0";
        }
    }

    // if (empty($_POST['ngay_nhap'])) {
    //     $ngay_nhapErr = "Xin mời nhập ngày";
    // } else {
    //     $ngay_nhap = $_POST['ngay_nhap'];
    //     $arr = explode("/", $ngay_nhap); // cái này đang là mảng 
    //     $mm = $arr[0]; // first element of the array is month
    //     $dd = $arr[1]; // second element is date
    //     $yy = $arr[2]; // third element is year
    //     if (!checkdate($mm, $dd, $yy)) {
    //         $ngay_nhapErr = "Vui lòng nhập ngày tháng năm chính xác !";
    //     }
    //     if (!preg_match("/(^0[0-9]{1}|1[0-9]{1}|2[0-9]{1}|3[0-2]{1})\/(0[0-9]{1}|1[1-2]{1})\/([0-9]{4})$/", $ngay_nhap)) {
    //         $ngay_nhapErr = 'Xin mời nhập ngày tháng năm theo định dạng dd/mm/yyyy ';
    //     } else {
    //         $bh = date("Y-m-d");
    //         $tg = strtotime($bh);

    //         $nhap = strtotime($ngay_nhap);
    //         echo $nhap;
    //         die;
    //         if ($tg  - $nhap < 0) {
    //             $ngay_nhapErr = "Xin mời ngày nhập phải trước ngày hôm nay";
    //         }
    //         $tmp = explode('/', $ngay_nhap);
    //         $tmp = array_reverse($tmp);
    //         $ngay_thangluu = implode('-', $tmp);
    //     }
    // }
    if (empty($_POST['ngay_nhap'])) {
        $ngay_nhapErr = "Xin mời nhập ngày ";
    } else {
        $ngay_nhap = $_POST['ngay_nhap'];
        $mang = explode("/", $ngay_nhap); // cái này đang là mảng 
        $m = $mang[0];
        $d = $mang[1];
        $y = $mang[2];
        if (!vali($ngay_nhap, 'd/m/Y')) {
            $ngay_nhapErr = 'Xin mời nhập ngày tháng năm theo định dạng dd/mm/yyyy ';
        }
        if (!checkdate($m, $d, $y)) {
            $ngay_nhapErr = "Vui lòng nhập ngày tháng năm chính xác !";
        }
        if (strtotime("now")  - strtotime($ngay_nhap)  < 0) {
            $ngay_nhapErr = 'Ngày nhập không hợp lệ ';
        } else {
            $tmp = explode('/', $ngay_nhap);
            $tmp = array_reverse($tmp);
            $ngay_thangluu = implode('-', $tmp);
        }
    }




    $anh = $_FILES['hinh_anh'];
    $sizeanh = 1500000;
    $anhErr="";
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
    



    if (empty($_POST['ma_loai'])) {
        $ma_loaiErr = "Xin mời nhập mã loại hàng";
    } else {
        $ma_loai = $_POST['ma_loai'];
    }



    $dac_biet = $_POST['dac_biet'];
    if (($_POST['dac_biet']) == "") {
        $dac_bietErr = "Xin mời nhập kiểu hàng";
    }


    if (empty($_POST['mo_ta'])) {
        $mo_taErr = "Xin mời nhập mô tả sản phẩm";
    } else {
        $mo_ta = $_POST['mo_ta'];
    }


    if ($ten_hhErr . $don_giaErr . $giam_giaErr . $ngay_nhapErr . $hinh_anhErr . $ma_loaiErr . $dac_bietErr . $mo_taErr != "") {
        header("location:" . BASE_URL . "admin/hanghoa/them.php?ten_hhErr=$ten_hhErr&don_giaErr=$don_giaErr&giam_giaErr=$giam_giaErr&ngay_nhapErr=$ngay_nhapErr&hinh_anhErr=$anhErr&ma_loaiErr=$ma_loaiErr&dac_bietErr=$dac_bietErr&mo_taErr=$mo_taErr");
        die;
    }

    insert_delete_update("insert into hanghoa(ten_hh,don_gia,giam_gia,hinh_anh,ngay_nhap,ma_loai,dac_biet,so_luot_xem,mo_ta) 
    values('$ten_hh','$don_gia','$giam_gia','$path','$ngay_thangluu','$ma_loai',$dac_biet,'0','$mo_ta')");
    header("location:" . BASE_URL . "admin/hanghoa/index.php?msg=Thêm Sản Phẩm Thành Công");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
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
    <div class="container-fliud">
        <div class="container">
            <div class="row" style="min-height:1000px">
                <div class="col-xl-12" style="margin-bottom: 40px;position: relative;margin-top: 30px;text-align: center">
                    <div>
                        <h5 class="chutt">Thêm hàng hóa</h5>
                        <hr>
                    </div>
                </div>
                <div class="col-xl-12">

                    <form action="<?php echo BASE_URL . "admin/hanghoa/them.php" ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Tên Hàng Hóa:</label>
                            <input type="text" name="ten_hh" class="form-control">
                            <?php if (isset($_GET["ten_hhErr"])) : ?>
                                <span style="color:red;"><?= $_GET["ten_hhErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Đơn Giá:</label>
                            <input type="number" name="don_gia" class="form-control">
                            <?php if (isset($_GET["don_giaErr"])) : ?>
                                <span style="color:red;"> <?= $_GET["don_giaErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Giảm Giá:</label>
                            <input type="number" name="giam_gia" class="form-control">
                            <?php if (isset($_GET["giam_giaErr"])) : ?>
                                <span style="color:red;"><?= $_GET["giam_giaErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh :</label>
                            <input type="file" name="hinh_anh" class="form-control">
                            <?php if (isset($_GET["hinh_anhErr"])) : ?>
                                <span style="color:red;"><?= $_GET["hinh_anhErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Ngày Nhập:</label>
                            <input type="text" name="ngay_nhap" class="form-control">
                            <?php if (isset($_GET["ngay_nhapErr"])) : ?>
                                <span style="color:red;"><?= $_GET["ngay_nhapErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Mã Loại:</label>
                            <select name="ma_loai">
                                <?php foreach ($loai as $lh) : ?>
                                    <option value="<?php echo $lh['id'] ?>">
                                        <?= $lh['ten_loai'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($_GET["ma_loaiErr"])) : ?>
                                <span style="color:red;"><?= $_GET["ma_loaiErr"] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="">Lựa Chọn:</label>
                            <div class="form-control">
                                <input type="radio" name="dac_biet" value="1"> Đặc Biệt
                                <input type="radio" name="dac_biet" value="0"> Bình Thường
                            </div>
                            <?php if (isset($_GET["dac_bietErr"])) : ?>
                                <span style="color:red;"><?= $_GET["dac_bietErr"] ?></span>
                            <?php endif; ?>

                        </div>
                        <div class="form-group">
                            <label for="">Số Lượt Xem:</label>
                            <input type="text" name="so_luot_xem" class="form-control" value="0" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Mô Tả:</label>
                            <textarea name="mo_ta" class="form-control"></textarea>
                            <?php if (isset($_GET["mo_taErr"])) : ?>
                                <span style="color:red;"><?= $_GET["mo_taErr"] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-info" name="gui">Lưu</button>
                            &nbsp;
                            <a href="<?= BASE_URL . "admin/hanghoa/index.php" ?>" class="btn btn-sm btn-danger">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "../../content/layout/footer.php" ?>
</body>

</html>