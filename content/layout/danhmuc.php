<div class="container-fluid" style="background-color:blue;margin-top:35px;">
  <div class="container">
    <div class="row">
      <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto" style="position:relative;">
            <li class="nav-item ">
              <a class="nav-link dm" style="color:white;" href="<?php echo BASE_URL ?>index.php">Trang Chủ </a>
            </li>
            <li class="nav-item">
              <a class="nav-link dm"  style="color:white;" href="<?php echo BASE_URL ?>site/lienhe.php">Liên Hệ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link dm"  style="color:white;" href="thu.php">Thông Tin</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle dm"   style="color:white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Danh Mục
              </a>
              <div class="dropdown-menu" style="background-color:initial;;border:none;margin-top:0px;" aria-labelledby="navbarDropdown">
                <ul class="drop">
                  <?php foreach (selectAll("select * from loaihang") as $loai) : ?>
                    <li >
                      <a  href="<?= BASE_URL . "site/hanghoa/index.php?id=" . $loai['id'] ?>"><?php echo $loai['ten_loai'] ?></a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </li>
          </ul>

        </div>
      </nav>
    </div>
  </div>
</div>