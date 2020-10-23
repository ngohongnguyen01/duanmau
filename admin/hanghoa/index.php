<?php
session_start();

require_once "../../dao/pdo.php";
require_once "../../dao/global.php";


$danhmuc = selectAll("select hh.*,lh.ten_loai as ten_loai from hanghoa hh join loaihang lh on hh.ma_loai = lh.id ");
if (isset($_POST['xoaAll'])) {
    if (isset($_POST['delete'])) {
        foreach ($_POST['delete'] as $xoa) {
            insert_delete_update("delete from hanghoa where id =" . $xoa);
        }
    }
}
if (!isset($_GET['p'])) {

    $product = 1;
} elseif (isset($_GET['p'])) {
    $product = $_GET['p'];
} else {
    header("Location:index.php");
}
$data = 6;


$number = dem("SELECT COUNT(*) FROM hanghoa");
$page = ceil($number / $data);
$tin = ($product - 1) * $data;
$sanpham = selectAll("select hh.*,lh.ten_loai as ten_loai from hanghoa hh join loaihang lh on hh.ma_loai = lh.id ORDER BY id DESC   LIMIT $tin,$data");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Mục</title>
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
        <div class="container" style="min-height:1000px;">
            <div class="row">
            <div class="col-xl-12" style="margin-bottom: 40px;position: relative;margin-top: 30px;text-align: center">
                    <div>
                        <h5 class="chutt">Quản  Lý Hàng Hóa</h5>
                        <hr>
                    </div>
                </div>
            
                
                <div class="col-xl-12">
                <?php if (isset($_GET['msg'])) : ?>
                    <span style="color:red;"><?php echo $_GET['msg'] ?> </span>
                <?php endif; ?>
                    <form action="" method="POST">
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>Xóa</th>
                                    <th>id</th>
                                    <th>tên hàng hóa</th>
                                    <th>Đơn Giá</th>
                                    <th>Giảm Giá</th>
                                    <th>Hình Ảnh</th>
                                    <th>Ngày Nhập</th>
                                    <th>Mã Loại</th>
                                    <th>Tên Loại</th>
                                    <th>Đặc Biệt</th>
                                    <th>Số Lượt Xem</th>
                                    <th>Mô Tả</th>
                                    <th>
                                        <a href="<?= BASE_URL ?>admin/hanghoa/them.php" class="btn btn-sm btn-success">Thêm Sản Phẩm
                                        </a>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sanpham as $row) : ?>
                                    <tr>
                                        <td><input name="delete[]" type="checkbox" value="<?php echo $row['id']; ?>" class="delete"></td>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['ten_hh'] ?></td>
                                        <td><?= money($row['don_gia']) ?></td>
                                        <td><?= $row['giam_gia'] ?></td>
                                        <td>
                                            <img src="<?= BASE_URL . $row['hinh_anh'] ?>" width="100px" alt="">
                                        </td>
                                        <td><?= ($row['ngay_nhap']) ?></td>
                                        <td><?= ($row['ma_loai']) ?></td>
                                        <td><?= $row['ten_loai'] ?></td>
                                        <td>
                                            <?php if ($row['dac_biet'] == 0) : ?>
                                                <span><?php echo "Bình Thường" ?></span>
                                            <?php endif; ?>

                                            <?php if ($row['dac_biet'] == 1) : ?>
                                                <span><?php echo "Đặc Biệt" ?></span>
                                            <?php endif; ?>

                                        </td>
                                        <td><?= $row['so_luot_xem'] ?></td>
                                        <td><?= $row['mo_ta'] ?></td>
                                        <td>
                                            <a href="<?= BASE_URL ?>admin/hanghoa/sua.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">Sửa</a>
                                            <a href="<?= BASE_URL ?>admin/hanghoa/xoa.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn Có chắc Muốn Xóa Tài Khoản Này Không')">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach;  ?>
                            </tbody>
                        </table>
                        <input type='submit' id="xoaAll" class="btn btn-sm btn-success" name="xoaAll" value="Xóa Mục Đã chọn ">
                        <button type="button" name="checkAll" id="chonAll" class="btn btn-sm btn-success">Chọn Tất Cả </button>
                        <button type="button" name="checkAll" id="bochonAll" class="btn btn-sm btn-success">Bỏ Chọn Tất Cả </button>
                    </form>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:20px;">
                        <?php
                        for ($t = 1; $t <= $page; $t++) { ?>
                            <a href="index.php?&p=<?= $t ?>" class=" btn btn-primary" style="float:left;margin-left:5px"><?= $t ?></a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "../../content/layout/footer.php" ?>
    <script>
        $(document).ready(function() {
            $("#chonAll").click(function() {
                $(":checkbox").prop("checked", true);
            });
            $("#bochonAll").click(function() {
                $(":checkbox").prop("checked", false);
            });
            $("#xoaAll").click(function() {
                if ($(":checked").length === 0) {
                    alert("Vui lòng chọn ít nhất một mục!");
                    return false;
                }
            });
        });
    </script>
</body>

</html>