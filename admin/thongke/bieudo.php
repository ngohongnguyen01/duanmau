<?php
require_once "../../dao/pdo.php";
require_once "../../dao/global.php";
$thongke = selectAll("SELECT lh.id, lh.ten_loai,
COUNT(*) so_luong
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
    <title>Biểu Đồ</title>
    <?php include_once "../../content/layout/style.php" ?>
    <link rel="stylesheet" href="../../content/css/index.css">
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['ten_loai', 'so_luong'],
                <?php
                foreach ($thongke as $item) {
                    echo "['$item[ten_loai]',     $item[so_luong]],";
                }
                ?>
            ]);
            var options = {
                title: 'TỶ LỆ HÀNG HÓA',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
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
                        <h5 class="chutt">Biểu Đồ Thống Kê</h5>
                        <hr>
                    </div>
                </div>
                <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
            </div>
            <?php include_once "../../content/layout/footer.php" ?>
        </div>
    </div>
</body>

</html>