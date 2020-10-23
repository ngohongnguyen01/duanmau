<!-- phần liên hệ -->
<div class="container-fluid khoi1">
    <div class="container">
        <div class="row hang">
            <div class="col-xl-9">
                <span class="sdt"> <i class="fas fa-phone-alt"></i>Hotline : 082 88 908 96</span>
            </div>
            <div class="col-xl-3">
                <ul class="nav nav1">

                    <li class="nav-item">
                        <?php if (!isset($_SESSION['admin']) && !isset($_SESSION['khachhang'])) : ?>
                            <a href="<?php echo BASE_URL ?>site/dangnhap/index.php" class="nav-link"><i class="fas fa-user-edit"></i></i>Đăng Nhập</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <?php if (!isset($_SESSION['admin']) && !isset($_SESSION['khachhang'])) : ?>
                            <a href="<?php echo BASE_URL . "admin/khachhang/dangky.php" ?>" class="nav-link"><i class="fas fa-user-edit"></i>Đăng Ký</a>
                        <?php endif; ?>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- kết thúc phần liên hệ -->

<!-- phần tìm kiếm -->
<div class="container-fluid">
    <div class="container">
        <div class="row hang2">
            <div class="col-xl-2">
                <a href="<?php echo BASE_URL ?>">
                    <img src="<?php echo BASE_URL ?>content/image/dung/logo3.jpg" alt="" width="150px">
                </a>
            </div>
            <div class="col-xl-7">
                <div class="tk">
                    <form action="<?php echo BASE_URL . "site/hanghoa/timkiem.php" ?>" method="POST">
                        <input type="text" name="timkiem" class="nutim">
                        <input type="submit" class="gui" value="Tìm kiếm">
                        <?php if (isset($_GET['tkErr']) ){ ?>
                            <span style="color:red;"><?php echo $_GET['tkErr'] ?></span>
                        <?php } ?>
                    </form>
                </div>
            </div>
            <div class="col-xl-3">
                <ul class="nav nav2">
                    <li class="nav-item">
                        <a href="<?php echo BASE_URL . "cart/listcart.php" ?>" class="nav-link"><i class="fas fa-cart-arrow-down"></i><span class="dh"><?php if (isset($_SESSION['cart'])) {
                                                                                                                                                            echo $_SESSION['cart']['soluong'];
                                                                                                                                                        } else {
                                                                                                                                                            echo 0;
                                                                                                                                                        } ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['admin'])) : ?>
                            <a href="" class="nav-link">
                                <img src="<?php echo BASE_URL . $_SESSION['admin']['hinh'] ?>" width="40px" height="40px" style="border-radius:40px;" alt="">
                                <?php echo "Admin" ?>
                            </a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['khachhang'])) : ?>
                            <a href="<?php echo BASE_URL . "site/khachhang/tt.php?id=" . $_SESSION['khachhang']['id'] ?>" class="nav-link">
                                <img src="<?php echo BASE_URL . $_SESSION['khachhang']['hinh'] ?>" width="40px" height="40px" style="border-radius:40px;" alt="">
                                <?php echo $_SESSION['khachhang']['ho_ten'] ?>
                                <ul style="margin-left:30px;margin-top:-40px;" class="dskh">
                                    <li class="thelikh">
                                        <a  class="theakh" href="">nguyên</a>
                                    </li>
                                    <li class="thelikh">
                                        <a  class="theakh" href="">nguyên</a>
                                    </li>
                                </ul>
                            </a>
                           
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--lết thúc phần tìm kiếm -->
<!-- phần liveshow -->
<div class="container-fluid" style="margin: 10px 0px;">
    <div class="container">
        <div class="row ">
            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-interval="10000">
                        <img src="<?php echo BASE_URL . "content/image/dung/banner.jpg" ?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img src="<?php echo BASE_URL . "content/image/dung/banner2.jpg" ?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-interval="10000">
                        <img src="<?php echo BASE_URL . "content/image/dung/banner4.jpg" ?>" class="d-block w-100" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- kết thúc phần lideshow -->