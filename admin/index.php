<?php
session_start();

require_once "../dao/pdo.php";
require_once "../dao/global.php";


$danhmuc = selectAll("select hh.*,lh.ten_loai as ten_loai from hanghoa hh join loaihang lh on hh.ma_loai = lh.id");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Mục</title>
    <?php include_once "../content/layout/style.php" ?>
    <link rel="stylesheet" href="../content/css/index.css">
</head>

<body>
    <?php include_once "layout/header.php" ?>
    <div class="container-fluid" style="background-color:blue;margin: 15px 0px;">
        <div class="container">
            <?php include_once "layout/danhmuc.php" ?>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container"  style="min-height:1000px;">
            <div class="row">
                
                <?php if (isset($_GET['msg'])) : ?>
                    <span><?php echo $_GET['msg'] ?> </span>
                <?php endif; ?>
                <div class="col-xl-12">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
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
                            <?php foreach ($danhmuc as $row) : ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['ten_hh'] ?></td>
                                    <td><?= money($row['don_gia']) ?></td>
                                    <td><?= $row['giam_gia'] ?></td>
                                    <td>
                                        <img src="<?= BASE_URL . $row['hinh_anh'] ?>" width="100px" alt="">
                                    </td>
                                    <td><?= $row['ngay_nhap'] ?></td>
                                    <td><?= $row['ma_loai'] ?></td>
                                    <td><?= $row['ten_loai'] ?></td>
                                    <td>
                                        
                                    <?php if($row['dac_biet']==0): ?>
                                    <span><?php echo "Bình Thường"?></span>
                                   <?php endif; ?> 
                                    
                                   <?php if($row['dac_biet']==1): ?>
                                    <span><?php echo "Đặc Biệt"?></span>
                                   <?php endif; ?> 
                                  
                                </td>
                                    <td><?= $row['so_luot_xem'] ?></td>
                                    <td><?= $row['mo_ta'] ?></td>
                                    <td>
                                        <a href="<?= BASE_URL ?>admin/hanghoa/sua.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success mb-2">Sửa</a>
                                        <a href="<?= BASE_URL ?>admin/hanghoa/xoa.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success" onclick="return confirm('Bạn Có chắc Muốn Xóa Tài Khoản Này Không')">Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach;  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <?php include_once "../content/layout/footer.php" ?>
</body>

</html>