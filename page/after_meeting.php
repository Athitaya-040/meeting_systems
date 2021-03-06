<?php

$select_meeting = "SELECT
add_meeting.*
FROM
add_meeting
WHERE
meeting_id NOT IN (SELECT meeting_id FROM google_speech)";

$query_meeting = mysqli_query($conn, $select_meeting);


$select_meet_complete = "SELECT
add_meeting.meeting_name, 
add_meeting.meeting_id, 
add_meeting.meeting_BE, 
google_speech.speech_name
FROM
add_meeting
INNER JOIN
google_speech
ON 
  add_meeting.meeting_id = google_speech.meeting_id
";

$query_meet_complete = mysqli_query($conn,$select_meet_complete);

if(isset($_GET['delmeeting_id'])) {
  $delmeeting_id=mysqli_real_escape_string($conn,$_GET['delmeeting_id']);
  $del = "DELETE FROM add_meeting WHERE meeting_id= '$delmeeting_id'";
  mysqli_query($conn,$del);
  echo '<script>swal("ลบข้อมูลสำเร็จ", {
    icon: "error",
  }).then((willDelete)=>{window.location.href="?page=Set_meeting" });
  </script>';

}



?>
<div class="row">
  <div class="col-sm-12">
    <div class="content-header">จัดการเอกสารหลังการประชุม</div>
  </div>
</div>

<section id="extended">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <ul class="nav nav-tabs  nav-justified">
              <li class="nav-item">
                <a class="nav-link active" id="profile-tab3" data-toggle="tab" href="#profile3" aria-controls="profile3"
                  aria-expanded="false">เอกสารไม่สำเร็จ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="home-tab3" data-toggle="tab" href="#home3" aria-controls="home3"
                  aria-expanded="true">เอกสารเสร็จสมบูรณ์</a>
              </li>
            </ul>
            <div class="tab-content px-1 pt-1">
              <div class="tab-pane active show" id="profile3" role="tabpanel" aria-labelledby="profile-tab3"
                aria-expanded="false">
                <div class="card-body table-responsive">
                  <table class="table text-center">
                    <thead>
                      <tr>
                        <th>ลำดับที่</th>
                        <th>ชื่อการประชุม</th>
                        <th>ประจำปี</th>
                        <!-- <th>เลขที่คำสั่ง</th> -->
                        <th>บันทึกข้อมูลหลังการประชุม</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;
                      while ($res_meeting = mysqli_fetch_array($query_meeting)) {
                      ?>
                      <tr>
                        <td><?= $i; ?></td>
                        <td><?= $res_meeting['meeting_name'] ?></td>
                        <td><?= $res_meeting['meeting_BE'] ?></td>
                      
                        <td>
                          <a href="http://127.0.0.1:5000/?meeting_id=<?php echo $res_meeting['meeting_id']?>"
                            class="info p-0" data-original-title="" title="">
                            <i class="ft-save font-medium-3 mr-2"></i>
                          </a>
                        </td>
                      </tr>
                      <?php $i++;
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="home3" aria-labelledby="home-tab3" aria-expanded="true">
                <div class="card-body table-responsive">
                  <table class="table text-center">
                    <thead>
                      <tr>
                        <th>ลำดับที่</th>
                        <th>ชื่อการประชุม</th>
                        <th>ประจำปี</th>
                        <!-- <th>เลขที่คำสั่ง</th> -->
                       
                        <th>รายงานการประชุม</th>
                        <th>ไฟล์เสียง</th>
                        <th>ไฟล์ข้อความที่ได้จากการถอดเสียง</th>
                        <th>ลบ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; while($res_meet_complete = mysqli_fetch_array($query_meet_complete)) { ?>
                      <tr>
                        <td><?=$i;?></td>
                        <td>
                        <?=$res_meet_complete['meeting_name'];?>
                        </td>
                        <td><?=$res_meet_complete['meeting_BE'];?></td>
                        <td>
                          <a href="mpdf/success_file.php?meeting_id=<?=$res_meet_complete['meeting_id'];?>" class="info p-0" data-original-title="" title="">
                            <i class="ft-file font-medium-3 mr-2"></i>
                          </a>
                        </td>
                        <td>
                          <a href="download.php?name=<?=$res_meet_complete['speech_name'];?>" class="secondary p-0" data-original-title=""
                            title="">
                            <i class="fa fa-music font-medium-3 mr-2"></i>
                          </a>
                        </td>
                        <td>
                          <a href="writetoFile.php?name=<?=$res_meet_complete['meeting_id'];?>" class="info p-0" data-original-title="" title="">
                            <i class="ft-file-text font-medium-3 mr-2"></i>
                          </a>
                        </td>
                        <td>
                          <a href="?page=after_meeting&delmeeting_id=<?php echo $res_meet_complete["meeting_id"] ?>" class="success p-0" data-original-title="" title="">
                            <i class="ft-trash-2 font-medium-3 mr-2"></i>
                          </a>
                        </td>
                      </tr>
                      <?php $i++;} ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>