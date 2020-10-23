<?php
require_once "../../dao/pdo.php";
require_once "../../dao/global.php";
$id = $_GET['id'];
$loai = select_once("select * from loaihang where id = '$id'");

if (isset($_POST['gui'])) {
    $name = $_POST['ten_loai'];
    $err = "";
    if ($loai['ten_loai'] == $name) {
        header("Location:" . BASE_URL . "admin/loaihang/sua.php?msg=Xin Lỗi Trùng Tên Loại Hàng&id=$id");
        die;
    }
    insert_delete_update("update  loaihang set ten_loai='$name' where id='$id'");
    header("Location:" . BASE_URL . "admin/loaihang/index.php?msg=Sửa Thành Công");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Loại Hàng</title>
    <?php include_once "../../content/layout/style.php" ?>
    <link rel="stylesheet" href="../../content/css/index.css">
</head>

<body>
    <?php include_once "../layout/header.php" ?>
    <div class="container-fluid">
        <div class="container">
        <div class="col-xl-12" style="margin-bottom: 40px;position: relative;margin-top: 30px;text-align: center">
                    <div>
                        <h5 class="chutt">Sửa Loại Hàng</h5>
                        <hr>
                    </div>
                </div>
            <div class="row">

                <div class="col-xl-3">
                    <?php include_once "../layout/danhmuc.php" ?>
                </div>
                <div class="col-xl-9">
                    <form action="" method="POST">
                        <?php if (isset($_GET['msg'])) : ?>
                            <span> <?php echo $_GET['msg'] ?></span>
                        <?php endif; ?>
                        <input type="text" name="ten_loai" value="<?php echo $loai['id'];  ?>" class="form-control" style="margin-bottom:10px" disabled>
                        <input type="text" name="ten_loai" value="<?php echo $loai['ten_loai'];  ?>" class="form-control" style="margin-bottom:10px">
                        <input type="submit" name="gui" value="Gửi" class="btn btn-sm btn-success">
                        <a href="<?php echo BASE_URL . 'admin/loaihang/index.php' ?>" class="btn btn-sm btn-success">Quay Lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "../../content/layout/footer.php" ?>
</body>

</html>