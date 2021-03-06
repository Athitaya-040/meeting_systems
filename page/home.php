<?php 


$select_count = "SELECT COUNT( lagd_id ) AS count_lagd,lagd_name FROM list_agenda WHERE lagd_name <> '' GROUP BY lagd_name ORDER BY
count_lagd DESC LIMIT 5";
$query_count = mysqli_query($conn,$select_count);

function DateThai($strDate)
  {
    
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strDate];
    return "$strMonthThai";
  }

$Search=isset($_GET['search']) ?$_GET['search']:'';
$sql="SELECT * FROM data WHERE meeting_name LIKE '%$Search%'";
$select_meeting = "SELECT
  COUNT(meeting_id) AS count_meeting, 
  MONTH ( meeting_date ) AS meeting_date
FROM
  add_meeting
WHERE
  MONTH ( meeting_date ) AND YEAR (NOW())
  GROUP BY
  MONTH ( meeting_date )";
  $query_meeting = mysqli_query($conn,$select_meeting);
$i=0;
  while ($res_meeting = mysqli_fetch_assoc($query_meeting)) {
    $arr_meeting[$i]['count_meeting'] = $res_meeting['count_meeting'];
    $arr_meeting[$i]['meeting_date'] = DateThai($res_meeting['meeting_date']);
    $i++;


      
  }
 


?>

<section id="grid-option">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h2>ข่าวสาร</h2>
          <h3>การประชุมครั้งล่าสุด</h3>
        </div>
        <div class="card-content">
          <div class="card-body row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 ">
              <div class="card">
                <!-- เริ่มต้น -->
                <div class="card-content">
                  <div class="card-img">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                          <img src="image/1.jpg" width=“200” height=“500” alt="First slide">
                        </div>
                        <div class="carousel-item">
                          <img src="image/2.jpg" width=“200” height=“500” alt="Second slide">
                        </div>
                        <div class="carousel-item">
                          <img src="image/3.jpg" width=“200” height=“500” class="d-block w-100" alt="Third slide">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="fa fa-angle-left icon-prev" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="fa fa-angle-right icon-next" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <h4 class="card-title">วาระการประชุม คณะกรรมการบริหารความเสี่ยงคณะวิทยาศาสตร์</h4>
                    <p class="card-text">ประธานและคณะอนุกรรมการบริหารความเสี่ยง ระดับมหาวิทยาลัย
                      ได้วิเคาระห์ความเสี่ยงประจำปี
                      งบประมาณ 2563 จากทุกหน่วยงาน (ทั้งหมด 61 โครงการ) </p>
                    <a href="?page=last_meeting" class="btn btn-raised btn-warning">อ่านเพิ่มเติม</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
              <div class="card">
                <!-- เริ่มต้น -->
                <div class="card-content">
                  <div class="card-img">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                          <img src="image/1.jpg" width=“200” height=“500” alt="First slide">
                        </div>
                        <div class="carousel-item">
                          <img src="image/2.jpg" width=“200” height=“500” alt="Second slide">
                        </div>
                        <div class="carousel-item">
                          <img src="image/3.jpg" width=“200” height=“500” alt="Third slide">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="fa fa-angle-left icon-prev" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="fa fa-angle-right icon-next" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <h4 class="card-title">วาระการประชุม คณะกรรมการบริหารความเสี่ยงคณะวิทยาศาสตร์</h4>
                    <p class="card-text">ประธานและคณะอนุกรรมการบริหารความเสี่ยง ระดับมหาวิทยาลัย
                      ได้วิเคาระห์ความเสี่ยงประจำปี
                      งบประมาณ 2563 จากทุกหน่วยงาน (ทั้งหมด 61 โครงการ) </p>
                    <a href="?page=last_meeting" class="btn btn-raised btn-warning">อ่านเพิ่มเติม</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
              <div class="card">
                <!-- เริ่มต้น -->
                <div class="card-content">
                  <div class="card-img">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                          <img src="image/1.jpg" class="d-block w-100" alt="First slide">
                        </div>
                        <div class="carousel-item">
                          <img src="image/2.jpg" class="d-block w-100" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                          <img src="image/3.jpg" class="d-block w-100" alt="Third slide">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="fa fa-angle-left icon-prev" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="fa fa-angle-right icon-next" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <h4 class="card-title">วาระการประชุม คณะกรรมการบริหารความเสี่ยงคณะวิทยาศาสตร์</h4>
                    <p class="card-text">ประธานและคณะอนุกรรมการบริหารความเสี่ยง ระดับมหาวิทยาลัย
                      ได้วิเคาระห์ความเสี่ยงประจำปี
                      งบประมาณ 2563 จากทุกหน่วยงาน (ทั้งหมด 61 โครงการ) </p>
                    <a href="?page=last_meeting" class="btn btn-raised btn-warning">อ่านเพิ่มเติม</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-body row">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
            <div class="card">
              <div class="card-header">
                <h3>สถิติการประชุมรายเดือน</h63>
              </div>
              <div class="card-content">
                <div id="chartdiv" class="height-400 Stackbarchart mb-2">
                </div>

              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
              <div class="card-content">
                <div class="card-body">
                  <h3>Top 5 การประชุมบ่อยครั้ง </h3>
                </div>
                <ul class="list-group">
                  <?php while ($res_count = mysqli_fetch_assoc($query_count)) {?>
                  <li class="list-group-item">
                    <span class="badge bg-primary float-right" style="color: #000"><?=$res_count['count_lagd'] ?></span>
                    <?=$res_count['lagd_name'] ?>
                  </li>
                  <?php } ?>

                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</section>
<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>


<!-- Chart code -->
<script>
  am4core.ready(function () {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartdiv", am4charts.XYChart);
    chart.scrollbarX = new am4core.Scrollbar();

    // Add data
    chart.data = [{
      "country": "<?=$arr_meeting[0]['meeting_date'] ?>",
      "visits": '<?=$arr_meeting[0]['count_meeting'] ?>'
    }, {
      "country": "<?=$arr_meeting[1]['meeting_date'] ?>",
      "visits": '<?=$arr_meeting[1]['count_meeting'] ?>'
    }, {
      "country": "<?=$arr_meeting[2]['meeting_date'] ?>",
      "visits": '<?=$arr_meeting[2]['count_meeting'] ?>'
    }, {
      "country": "<?=$arr_meeting[3]['meeting_date'] ?>",
      "visits": '<?=$arr_meeting[3]['count_meeting'] ?>'
    }, {
      "country": "<?=$arr_meeting[4]['meeting_date'] ?>",
      "visits": '<?=$arr_meeting[4]['count_meeting'] ?>'
    }, {
      "country": "<?=$arr_meeting[5]['meeting_date'] ?>",
      "visits": '<?=$arr_meeting[5]['count_meeting'] ?>'
    }];

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;
    categoryAxis.renderer.labels.template.horizontalCenter = "right";
    categoryAxis.renderer.labels.template.verticalCenter = "middle";
    categoryAxis.renderer.labels.template.rotation = 270;
    categoryAxis.tooltip.disabled = true;
    categoryAxis.renderer.minHeight = 110;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minWidth = 50;

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.sequencedInterpolation = true;
    series.dataFields.valueY = "visits";
    series.dataFields.categoryX = "country";
    series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
    series.columns.template.strokeWidth = 0;

    series.tooltip.pointerOrientation = "vertical";

    series.columns.template.column.cornerRadiusTopLeft = 10;
    series.columns.template.column.cornerRadiusTopRight = 10;
    series.columns.template.column.fillOpacity = 0.8;

    // on hover, make corner radiuses bigger
    var hoverState = series.columns.template.column.states.create("hover");
    hoverState.properties.cornerRadiusTopLeft = 0;
    hoverState.properties.cornerRadiusTopRight = 0;
    hoverState.properties.fillOpacity = 1;

    series.columns.template.adapter.add("fill", function (fill, target) {
      return chart.colors.getIndex(target.dataItem.index);
    });

    // Cursor
    chart.cursor = new am4charts.XYCursor();

  }); // end am4core.ready()
</script>