<!-- phần liên hệ -->
<div class="container-fluid khoi1">
    <div class="container">
        <div class="row hang">

            <div class="col-xl-7">
                <span class="sdt"> <i class="fas fa-phone-alt"></i>Hotline : 082 88 908 96</span>
            </div>
            <div class="col-xl-5">
                <ul class="nav nav1">
                    <li class="nav-item">
                        <a href="<?php echo BASE_URL . "index.php" ?>" class="nav-link"><i class="fas fa-book-open"></i>Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['admin'])) : ?>
                            <a href="<?php echo BASE_URL ?>admin/hanghoa/index.php" class="nav-link"><i class="fas fa-tasks"></i> Quản Trị</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">

                        <a href="<?php echo BASE_URL ?>login/logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Đăng Xuất</a>

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
                        <input type="submit" class="gui" value="tìm kiếm">
                    </form>
                </div>
            </div>
            <div class="col-xl-3">
                <ul class="nav nav2">
                    <li class="nav-item">
                        <a href="" class="nav-link"><i class="fas fa-cart-arrow-down"></i><span class="dh">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['admin'])) : ?>
                            <a href="" class="nav-link">
                                <img src="<?php echo BASE_URL . $_SESSION['admin']['hinh'] ?>" width="40px" height="40px" style="border-radius:20px;" alt="">
                                <?php echo "Admin" ?>
                            </a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <?php if (isset($_SESSION['khachhang'])) : ?>
                            <a href="" class="nav-link">
                                <img src="<?php echo BASE_URL . $_SESSION['khachhang']['hinh'] ?>" width="40px" height="40px" style="border-radius:20px;" alt="">
                                <?php echo $_SESSION['khachhang']['ho_ten'] ?>
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


<!-- kết thúc phần lideshow -->