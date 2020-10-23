<?php




require_once "../../dao/pdo.php";
require_once "../../dao/global.php";

$idloaihang = "";
foreach (selectAll("select * from loaihang") as $thongke) {
    $idloaihang = $thongke['id'];
}

$thongke = selectAll("SELECT lh.id, lh.ten_loai,
COUNT(*) so_luong,
MIN(hh.don_gia) gia_min,
MAX(hh.don_gia) gia_max,
AVG(hh.don_gia) gia_avg
FROM hanghoa hh 
JOIN loaihang lh ON lh.id=hh.ma_loai
GROUP BY lh.id, lh.ten_loai
");

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
                        <h5 class="chutt">Thống Kê Hàng Hóa</h5>
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
                                <th>Loại Hàng</th>
                                <th>Số lượng</th>
                                <th>Gía trung bình</th>
                                <th>Giá cao nhất</th>
                                <th>Giá thấp nhất</th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($thongke as $row) {
                                extract($row);
                            ?>
                                <tr>
                                    <td><?= $ten_loai ?></td>
                                    <td><?= $so_luong ?></td>
                                    <td><?= money($gia_avg) . "đ" ?></td>
                                    <td><?= money($gia_max) . "đ" ?></td>
                                    <td><?= money($gia_min) . "đ" ?></td>

                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                    <a href="<?= BASE_URL ?>admin/thongke/bieudo.php" class="btn btn-sm btn-success">Biểu Đồ</a>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:20px;">

                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include_once "../../content/layout/footer.php" ?>

</body>

</html>