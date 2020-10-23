<?php


require_once "../../dao/global.php";
require_once "../../dao/pdo.php";

$id = $_GET['id'];

$tonghop = selectAll("select * from binhluan where ma_hh =$id");

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
                        <h5 class="chutt">Chi tiết Bình Luận</h5>
                        <hr>
                    </div>
                </div>
                <div class="col-xl-12">
                    <?php if (isset($_GET['msg'])) : ?>
                        <span style="color:red;"><?php echo $_GET['msg'] ?> </span>
                    <?php endif; ?>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>Nội Dung</th>
                                <th> Ngày Bình Luận</th>
                                <th>Người Bình Luận </th>
                                <th> </th>

                                <th>


                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tonghop as $row) {
                                $ma_kh = "";
                                $ma_kh = $row['ma_kh'];
                            ?>
                                <?php foreach (selectAll("select * from khachhang where id = '$ma_kh'") as $kh) : ?>
                                    <tr>
                                        <td><?= $row['noi_dung'] ?></td>
                                        <td><?= $row['ngay_bl'] ?></td>
                                        <td><?= $kh['ho_ten'] ?></td>
                                        <td> <a href="<?= BASE_URL ?>admin/binhluan/xoa.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success" onclick="return confirm('Bạn Có chắc Muốn Xóa Tài Khoản Này Không')">Xóa</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include_once "../../content/layout/footer.php" ?>
</body>

</html>