<?php
session_start();

require_once "../../dao/pdo.php";
require_once "../../dao/global.php";



if (!isset($_GET['p'])) {
    $product = 1;
} elseif (isset($_GET['p'])) {
    $product = $_GET['p'];
} else {
    header("Location:index.php");
}

$binhluan3 = selectAll("SELECT DISTINCT ma_hh FROM binhluan");

$data = 6;
foreach ($binhluan3 as $bl) {

    $number = dem("SELECT  COUNT(DISTINCT ma_hh) FROM binhluan where ma_hh=" . $bl['ma_hh']);

    $page = ceil($number / $data);
    $tin = ($product - 1) * $data;
    $binhluan2 = selectAll("SELECT * FROM binhluan  LIMIT $tin,$data");
}

$tongbl = 0;
if (isset($_POST['xoaAll'])) {
    if (isset($_POST['delete'])) {
        foreach ($_POST['delete'] as $xoa) {
            if ($xoa == $admin['id']) {
                header("location:" . BASE_URL . "admin/khachhang/index.php?msg=Bạn không thể xóa được chính mình");
                die;
            }
            insert_delete_update("delete from binhluan where id = '$xoa' ");
            header("location:" . BASE_URL . "admin/khachhang/index.php");
        }
    }
}
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
        <div class="container" style="min-height:700px;">

            <div class="row">
                <div class="col-xl-12" style="margin-bottom: 40px;position: relative;margin-top: 30px;text-align: center">
                    <div>
                        <h5 class="chutt">Quản Lý Bình Luận</h5>
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
                                    <td>Xóa</td>
                                    <th>Sản Phẩm</th>
                                    <th> Số Bình Luận</th>
                                    <th>Ngày Bình Luận Mới Nhất </th>
                                    <th>Ngày Bình Luận Cũ Nhất</th>

                                    <th>


                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($binhluan3 as $row) {
                                    $id = "";
                                    $id = $row['ma_hh']; ?>
                                    <?php foreach (selectAll("select * from hanghoa where id =" . $row['ma_hh']) as $sanpham) {
                                        $tongbl = dem("select count(*) from binhluan where ma_hh=" . $row['ma_hh']);
                                    ?>
                                        <?php foreach (selectAll("SELECT * from binhluan where ma_hh =$id ORDER BY id DESC LIMIT 1") as $time) : ?>
                                            <?php foreach (selectAll("SELECT * from binhluan where ma_hh =$id ORDER BY id ASC LIMIT 1") as $time2) : ?>
                                                <tr>
                                                    <td><input name="delete[]" type="checkbox" value="<?php echo $row['id']; ?>" class="delete"></td>
                                                    <td><?= $sanpham['ten_hh'] ?></td>
                                                    <td><?= $tongbl ?></td>
                                                    <td><?= $time['ngay_bl'] ?></td>
                                                    <td><?= $time2['ngay_bl'] ?></td>
                                                    <td>
                                                        <a href="<?= BASE_URL ?>admin/binhluan/chitiet.php?id=<?= $row['ma_hh'] ?>" class="btn btn-sm btn-success">Chi Tiết</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                        <input type='submit' id="xoaAll" class="btn btn-sm btn-success" name="xoaAll" value="Xóa Mục Đã chọn ">
                        <button type="button" name="checkAll" id="chonAll" class="btn btn-sm btn-success">Chọn Tất Cả </button>
                        <button type="button" name="checkAll" id="bochonAll" class="btn btn-sm btn-success">Bỏ Chọn Tất Cả </button>
                    </form>
                </div>
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