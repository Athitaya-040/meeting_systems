<?php

if(isset($_POST['text_search'])){
  $text_search = $_POST['text_search'];
$select_meeting = "SELECT * FROM add_meeting WHERE add_meeting.meeting_name LIKE '%$text_search%'";
$query_meeting = mysqli_query($conn,$select_meeting);
}

?>
<section id="grid-option">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">ค้นหาการประชุม</h4>
        </div>
        <div class="card-content">
          <form action="" method="POST" role="form">
            <div class="card-body row">
              <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11">
                <div class="form-group">
                  <input type="text" class="form-control" id="" name="text_search" placeholder="ค้นหาการประชุม">
                </div>
              </div>

              <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
                <button class="btn btn-info">ค้นหาข้อมูล</button>
              </div>
            </div>
          </form>

          <div class="card-body row">
            <table class="table text-center">
              <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>ชื่อการประชุม</th>
                  <th>หนังสือเชิญการประชุม</th>
                  <th>รายงานการประชุม</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                if(isset($_POST['text_search'])){
                  $i=1;
                while($res_meeting = mysqli_fetch_assoc($query_meeting)){
                ?>
                <tr>
                  <td><?=$i;?></td>
                  <td>
                    <label><?=$res_meeting['meeting_name'];?></label>
                  </td>
                  <td>
                    <a href="mpdf/?meeting_id=<?=$res_meeting['meeting_id'];?>" class="primary p-0"
                      data-original-title="" title="หนังสือเชิญการประชุม" target="_blank">
                      <i class="ft-file"></i>
                    </a>
                  </td>
                  <td>
                    <a href="mpdf/success_file.php?meeting_id=<?=$res_meeting['meeting_id'];?>" class="danger p-0" data-original-title="" title="รายงานการประชุม" target="_blank">
                      <i class="ft-file-text"></i>
                    </a>
                  </td>
                </tr>
                <?php $i++;}}?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>