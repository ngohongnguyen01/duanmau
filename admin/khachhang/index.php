<?php
session_start();

require_once "../../dao/pdo.php";
require_once "../../dao/global.php";
$admin = $_SESSION['admin'];

$khachhang = selectAll("select * from khachhang");
if (isset($_POST['xoaAll'])) {
    if (isset($_POST['delete'])) {
        foreach ($_POST['delete'] as $xoa) {
            if ($xoa == $admin['id']) {
                header("location:" . BASE_URL . "admin/khachhang/index.php?msg=Bạn không thể xóa được chính mình");
                die;
            }
            insert_delete_update("delete from khachhang where id = '$xoa' ");
            header("location:" . BASE_URL . "admin/khachhang/index.php");
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


$number = dem("SELECT COUNT(*) FROM khachhang");
$page = ceil($number / $data);
$trang = ($product - 1) * $data;
$khachhang2 = selectAll("SELECT * FROM khachhang ORDER BY id DESC   LIMIT $trang,$data");

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

        <div class="row">
        <div class="col-xl-12" style="margin-bottom: 40px;position: relative;margin-top: 30px;text-align: center">
                    <div>
                        <h5 class="chutt">Quản Lý Khách Hàng</h5>
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
                                <th>Họ Tên</th>
                                <th> Kích Hoạt</th>
                                <th> Hình</th>
                                <th> Email</th>
                                <th>Vai Trò</th>
                                <th>
                                    <a href="<?= BASE_URL ?>admin/khachhang/them.php" class="btn btn-sm btn-success">Thêm Tài Khoản
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($khachhang2 as $row) : ?>
                                <tr>
                                    <td><input name="delete[]" type="checkbox" value="<?php echo $row['id']; ?>" class="delete"></td>

                                    <td><?= $row['ho_ten'] ?></td>
                                    <td>
                                        <?php if ($row['kich_hoat'] == 1) {
                                            echo "Kích Hoạt";
                                        } ?>
                                        <?php if ($row['kich_hoat'] == 0) {
                                            echo "Đã Khóa";
                                        } ?>
                                    </td>
                                    <td>
                                        <img src="<?php echo BASE_URL . $row['hinh'] ?>" width="100px" alt="">
                                    </td>

                                    <td><?= $row['email'] ?></td>
                                    <td>

                                        <?php if ($row['vai_tro'] == 1) {
                                            echo "Admin";
                                        } ?>

                                        <?php if ($row['vai_tro'] == 0) {
                                            echo "Khách Hàng";
                                        } ?>
                                    </td>

                                    <td>
                                        <a href="<?= BASE_URL ?>admin/khachhang/sua.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">Sửa</a>
                                        <a href="<?= BASE_URL ?>admin/khachhang/xoa.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn Có chắc Muốn Xóa Tài Khoản Này Không')">Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach;  ?>
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