<?php
require_once "../../dao/pdo.php";
require_once "../../dao/global.php";


if (isset($_POST['gui'])) {

    $ttkh = selectAll("select * from khachhang");

    $matkhau = uniqid();

    $makhErr = "";

    $emailNhanErr = "";
    if (empty($_POST['makh'])) {
        $makhErr = "Xin mời bạn nhập mã khách hàng";
    } else {
        $makh = $_POST['makh'];
        $layKh = selectAll("select * from khachhang where id='$makh'");
        if (!$layKh) {
            $makhErr = "Mã Khách Hàng Không Tồn Tại";
        }
    }

    if (empty($_POST['emailnhan'])) {
        $emailNhanErr = "Xin mời bạn nhập email";
    } else {
        $emailNhan = $_POST['emailnhan'];
        if (!filter_var($emailNhan, FILTER_VALIDATE_EMAIL)) {
            $emailNhanErr = " Email không hợp kệ";
        }
    }

    if ($makhErr . $emailNhanErr != "") {
        header("Location:" . BASE_URL . "site/dangnhap/quyenmatkhau.php?makhErr=$makhErr&emailnhanErr=$emailNhanErr");
        die;
    } else {

        $SENDGRID_API_KEY = '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';
        // $SENDGRID_API_KEY = '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';
        require '../../content/sendmail-sendgrid/vendor/autoload.php';
        $email = new \SendGrid\Mail\Mail();
        ///------- bạn chỉnh sửa các thông tin dưới đây cho phù hợp với mục đích cá nhân
        // Thông tin người gửi
        $email->setFrom("nguyennhph11479@fpt.edu.vn",  'Admin');
        // Tiêu đề thư
        $email->setSubject("Lấy Lại Mật Khẩu");
        // Thông tin người nhận
        $email->addTo($emailNhan, "Khách Hàng");
        // Soạn nội dung cho thư
        // $email->addContent("text/plain", "Nội dung text thuần không có thẻ html");
        $email->addContent(
            "text/html",
            "<h2>Mật khẩu của bạn là : $matkhau </h2>",
            "<h2>Xin bạn đăng nhập và đổi mật khẩu</h2>"
        );

        // tiến hành gửi thư
        $sendgrid = new \SendGrid($SENDGRID_API_KEY);
        try {
            $mahoaMk = password_hash($matkhau, PASSWORD_DEFAULT);
            $response = $sendgrid->send($email);
            //--- mấy dòng print này thích in ra thì in.
            insert_delete_update("update khachhang set mat_khau='$mahoaMk' where id='$makh'");
            header("Location:" . BASE_URL . "index.php");
        } catch (Exception $e) {

            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quyên Mật Khẩu</title>
    <link rel="stylesheet" href="public/css/dangnhap.css">
    <?php include_once "../../content/layout/style.php" ?>

</head>

<body>
    <div class="container-fluid backgroud">
        <div class="container chua">
            <div class="hopchua" style=" position: absolute;top: 100px;right: 509px;"></div>
            <div class="hop">
                <h2 class="ten" style="color:white;">Quên Mật Khẩu</h2>
                <?php if (isset($_GET['smg'])) : ?>
                    <span style="color:red"><?php echo $_GET['smg'] ?></span>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" class="input" name="makh" placeholder="Tên đăng nhập"> <i class="fas fa-user" style="width:20px;"></i>
                        <?php if (isset($_GET['makhErr'])) { ?>
                            <p style="color:red"><?php echo $_GET['makhErr'] ?></p>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <input type="text" class="input" name="emailnhan" placeholder="Email nhận"> <i class="fas fa-envelope-open-text" style="width:20px;"></i>
                        <?php if (isset($_GET['emailnhanErr'])) { ?>
                            <p style="color:red"><?php echo $_GET['emailnhanErr'] ?></p>
                        <?php } ?>
                    </div>
                    <div class="form-group" style="margin-top:50px;">
                        <input class="input2" name="gui" type="submit" value="GỬI">
                    </div>

                </form>
                <div class="form-groud" style="margin-top:35px;">
                        <a style="color:white;margin-left: 85px;" href="<?php echo BASE_URL . "index.php" ?>" class=""><i class="fas fa-arrow-alt-circle-left"></i> Quay lại</span>
                           
                    </div>
            </div>
        </div>
    </div>

</body>

</html>