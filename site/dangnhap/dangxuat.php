
  <?php
   require_once "../../dao/pdo.php";
   require_once "../../dao/global.php";
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <link rel="stylesheet" href="public/css/doimk.css">
    <?php include_once "../../content/layout/style.php"?>
</head>
<body>
<div class="container-fluid backgroud" >
        <div class="container chua"></div>
            <div class="hopchua2" style=" position: absolute;
    top: 100px;
    right: 509px;"></div>
            <div class="hop"  >
              
                <h2 class="ten" style="color:white;">Đổi Mật Khẩu</h2>
                <form action="#">
                    <div class="form-group">
                        <input type="text" class="input" name="name" placeholder="Usersname"> <i class="fas fa-user" style="width:20px;"></i>
                    </div>
                    <div class="form-group">
                        <input type="password" class="input" name="password" placeholder="Mật Khẩu Hiện Tại"> <i class="fas fa-user-lock"></i>
                    </div>
                    <div class="form-group">
                        <input type="password" class="input" name="password" placeholder="Mật Khẩu Mới"> <i class="fas fa-lock"></i>
                    </div>
                    <div class="form-group">
                        <input type="password" class="input" name="password" placeholder="Nhập Lại Mât Khẩu"> <i class="fas fa-user-lock"></i>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="check" style="margin-left:4px;margin-right:10px;"> <span class="span"> Nhớ Mật Khẩu</span>
                        <a href="#" class="qmk">Quên Mật Khẩu</a>
                    </div>
                    <div class="form-group">
                        <input class="input2" type="submit" value="GỬI">
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
</body>

</html>