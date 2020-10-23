<?php

session_start();
require_once "../dao/global.php";
require_once "../dao/pdo.php";
require_once "../cart/thongke.php";

if (isset($_POST['gui'])) {
    $checkSdt = '/^0+(32|33|34|35|36|37|38|39|56|58|59|70|76|77|78|79|81|82|83|84|85|86|88|89|90|91|92|93|94|96|97|98|99)+[0-9]{7}$/';


    $checkErr = "";
    $emailErr = "";
    $noidungErr = "";
    $tieudeErr = "";
    $sdtErr = "";
    $tenErr = "";


    if (empty($_POST['email'])) {
        $emailErr = "Xin mời bạn nhập email";
    } else {
        $emailUsers = $_POST['email'];
        if (!filter_var($emailUsers, FILTER_VALIDATE_EMAIL)) {
            $emailErr = " Email không hợp kệ";
        }
    }
    if (empty($_POST['ten'])) {
        $tenErr = "Xin mời bạn nhập tên ";
    } else {
        $ten = $_POST['ten'];
        if (!preg_match("/^[a-zA-Z-'(àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD) ]*$/", $ten)) {
            $tenErr = "Tên khách hàng không hợp lệ";
        }
    }

    if (empty($_POST['nd'])) {
        $noidungErr = "Xin mời bạn nhập nội dung ";
    } else {
        $noidung = $_POST['nd'];
    }
    if (empty($_POST['tieude'])) {
        $tieudeErr = "Xin mời bạn nhập tiêu đề";
    } else {
        $tieude = $_POST['tieude'];
    }
    if (empty($_POST['sdt'])) {
        $sdtErr = "Xin mời bạn nhập số điện thoại";
    } else {
        $sdt = $_POST['sdt'];
        if (!preg_match($checkSdt, $sdt)) {
            $sdtErr = "Chưa đúng định dạng số điện thoại";
        }
    }
    if ($sdtErr . $emailErr . $noidungErr . $tieudeErr . $tenErr != "") {
        header("location:" . BASE_URL . "site/lienhe.php?sdterr=$sdtErr&emailErr=$emailErr&noidungErr=$noidungErr&tieudeErr=$tieudeErr&tenErr=$tenErr");
        die;
    } else {
        // $SENDGRID_API_KEY =  "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";
        // $SENDGRID_API_KEY = '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';
        $SENDGRID_API_KEY = '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';
        // $SENDGRID_API_KEY = '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';
        require '../content/sendmail-sendgrid/vendor/autoload.php';
        $email = new \SendGrid\Mail\Mail();
        ///------- bạn chỉnh sửa các thông tin dưới đây cho phù hợp với mục đích cá nhân
        // Thông tin người gửi
        // $email->setFrom("viettuyet10072001@gmail.com",  'khách hàng');
        $email->setFrom("nguyennhph11479@fpt.edu.vn",  'khách hàng');
        // Tiêu đề thư
        $email->setSubject("$tieude");
        // Thông tin người nhận
        $email->addTo("ngohongnguyen016774@gmail.com", "Nguyên");
        // Soạn nội dung cho thư
        // $email->addContent("text/plain", "Nội dung text thuần không có thẻ html");
        $email->addContent(
            "text/html",
            "<h2 >$noidung</h2>",
            " Email : $emailUsers
            Số điện thoại liên hệ :  $sdt
             "

        );

        // tiến hành gửi thư
        $sendgrid = new \SendGrid($SENDGRID_API_KEY);

        try {

            $response = $sendgrid->send($email);
            //--- mấy dòng print này thích in ra thì in.
            //--- mấy dòng print này thích in ra thì in.
            
            header("location:" . BASE_URL . "site/lienhe.php?msg=Gửi email thành công");
            //--- mấy dòng print này thích in ra thì in.

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
    <title>Thêm Khách Hàng</title>
    <?php include_once "../content/layout/style.php" ?>
    <link rel="stylesheet" href="../content/css/index.css">
</head>

<body>


    <?php if (isset($_SESSION['khachhang'])) : ?>
        <?php include_once "../content/layout/header2.php" ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['admin'])) : ?>
        <?php include_once "../admin/layout/header2.php" ?>
    <?php endif; ?>

    <?php if (!isset($_SESSION['khachhang']) && !isset($_SESSION['admin'])) : ?>
        <?php include_once "../content/layout/header.php" ?>
    <?php endif; ?>

    <?php include_once "../content/layout/danhmuc.php" ?>
    <hr>
    <div class="container-fluid" style="background-color:#FDFDFD">
        <div class="container" style="margin-bottom: 60px;">
            <?php if (isset($_GET['msg'])) { ?>
                <span style="color:red;"><?php echo $_GET['msg']; ?></span>
            <?php } ?>
            <div class="row" style="margin-top:30px">
                <div class="col-xl-12" style="margin-bottom:20px">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d228.1587794540472!2d105.36079847611805!3d21.258702517316834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31348c8966c3d8ab%3A0x8d711c9bdb5a62c3!2zUGhvbmcgVsOibiwgQmEgVsOsLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e1!3m2!1svi!2s!4v1602170609986!5m2!1svi!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">

                    <h5>Liên Hệ Với Chúng Tôi </h5>
                    <p style="width:80%">Cảm ơn bạn đã góp ý cho chúng tôi . Chúng tôi sẽ cố gắng làm cho sản phẩm của chúng tôi tốt nhất và làm hài lòng bạn . "Chúng ta đều đi những con đường khác nhau trong đời nhưng cho dù đi đến đâu , chúng ta cũng mang theo mình một phần của nhau."</p>
                    <div class="hop">
                        <div class="icon" style="width:40px;float:left;margin-left:20px;"><i class="fas fa-map-marker-alt" style="font-size:40px;margin-top: 5px;color:#b2b2b2;"></i></div>
                        <div style="width:300px;float:left;margin-left:20px;" class="dichi">
                            <p> <span style="color:#b2b2b2;"> Địa Chỉ</span>
                                <br>
                                <span style="font-size: 18px;color: #252525;">21-68 Đường Cầu Diễn - Phúc Diễn</span>
                            </p>
                        </div>
                    </div>
                    <div class="hop">
                        <div class="icon" style="width:40px;float:left;margin-left:20px;"><i class="fas fa-mobile-alt" style="font-size:40px;margin-top: 5px;color:#b2b2b2;"></i></div>
                        <div style="width:300px;float:left;margin-left:20px;" class="dichi">
                            <p> <span style="color:#b2b2b2;"> Số Điện Thoại</span>
                                <br>
                                <span style="font-size: 18px;color: #252525;">082 88 908 96</span>
                            </p>
                        </div>
                    </div>
                    <div class="hop">
                        <div class="icon" style="width:40px;float:left;margin-left:20px;"><i class="far fa-envelope" style="font-size:40px;margin-top: 5px;color:#b2b2b2;"></i></div>
                        <div style="width:300px;float:left;margin-left:20px;" class="dichi">
                            <p> <span style="color:#b2b2b2;"> Email </span>
                                <br>
                                <span style="font-size: 18px;color: #252525;">ngohongnguyen016774@gmail.com</span>
                            </p>

                        </div>
                    </div>
                    <div class="hop">
                        <div class="icon" style="width:40px;float:left;margin-left:20px;"><i class="fas fa-building" style="font-size:40px;margin-top: 5px;color:#b2b2b2;"></i></div>
                        <div style="width:300px;float:left;margin-left:20px;" class="dichi">
                            <p> <span style="color:#b2b2b2;"> Công Ty</span>
                                <br>
                                <span style="font-size: 18px;color: #252525;">CÔNG TY TNHH 1 THÀNH VIÊN</span>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <h5>Để lại bình luận</h5>
                    <p>Nhân viên của chúng tôi sẽ gọi lại và giải đáp thắc mắc của bạn trong thời gian gần nhất</p>
                    <form action="" method="POST">
                        <div class="chua">
                            <div class="form-group">
                                <input type="text" name="ten" placeholder="Tên của bạn" class="form-control" style="   color: #636363;
    height: 50px;
    border: 1px solid #ebebeb;
    border-radius: 5px;
    padding-left: 20px;
    margin-bottom: 10px;">
                                <?php if (isset($_GET['tenErr'])) : ?>
                                    <span style="color:red"><?php echo $_GET['tenErr'] ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" placeholder="Email của bạn" class="form-control" style="   color: #636363;
    height: 50px;
    border: 1px solid #ebebeb;
    border-radius: 5px;
    padding-left: 20px;
    margin-bottom: 10px;">
                                <?php if (isset($_GET['emailErr'])) : ?>
                                    <span style="color:red"><?php echo $_GET['emailErr'] ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="tieude" placeholder="Tiêu Đề" style="margin-bottom:20px;height:50px" class="form-control">
                            <?php if (isset($_GET['tieudeErr'])) : ?>
                                <span style="color:red"><?php echo $_GET['tieudeErr'] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <input type="text" name="sdt" placeholder="Số điện thoại" style="margin-bottom:20px;height:50px" class="form-control">
                            <?php if (isset($_GET['sdterr'])) : ?>
                                <span style="color:red"><?php echo $_GET['sdterr'] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <textarea name="nd" placeholder="Tin nhắn của bạn" cols="25" class="form-control" rows="8"></textarea>
                            <?php if (isset($_GET['noidungErr'])) : ?>
                                <span style="color:red"><?php echo $_GET['noidungErr'] ?></span>
                            <?php endif; ?>
                        </div>
                        <input type="submit" name="gui" width="300px" class="nut" value="Gửi">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "../content/layout/footer.php" ?>
</body>

</html>