<?php 
$select_meeting ="SELECT
  add_meeting.*, 
  file_input.*
FROM
  add_meeting
  INNER JOIN
  file_input
  ON 
    add_meeting.meeting_id = file_input.meeting_id";
$query_meeting = mysqli_query($conn,$select_meeting);

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
  <div class="col-sm-12" >
     <?php if ($_SESSION['type_id']==1) {?>
    <div class="content-header">ตั้งค่าการประชุม</div>
    <?php } ?>
     <?php if ($_SESSION['type_id']==2) {?>
      <div class="content-header">การประชุมของฉัน</div>
<?php } ?>
    
  </div>
</div>

<section id="extended">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body table-responsive">
            <?php if ($_SESSION['type_id']==1) {?>
              <a href="?page=Add_meeting" class="btn btn-raised btn-primary btn-min-width mr-1 mb-1" >
              <i class="ft-plus-circle"></i> เพิ่มการประชุม
            </a>
          <?php } ?>
            
            <table class="table text-center">
              <thead>
                <tr>
                  <th>ลำดับที่</th>
                  <th>ชื่อการประชุม</th>
                  <th>ประจำปี</th>
                  <th>เอกสารประกอบการประชุม</th>
                  <?php if ($_SESSION['type_id']==1) {?>
                    <th>จัดการวาระ</th>
                  <th>ผู้ร่วมประชุม</th>
                  <?php } ?>
                  <th>หนังสือการประชุม</th>
                  <?php if ($_SESSION['type_id']==1) {?>
                    <th>แก้ไข</th>
                  <th>ลบ</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; while ($res_meeting = mysqli_fetch_array($query_meeting)) {
                  ?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$res_meeting['meeting_name']?></td>
                    <td><?=$res_meeting['meeting_BE']?></td>
                   
                    <td>
                      <a href ="upload/<?=$res_meeting['file_name']?>"class="info p-0" data-original-title="" title="">
                        <i class="ft-file-text font-medium-3 mr-2"></i>
                      </a>
                    </td>
                    <?php if ($_SESSION['type_id']==1) {?>
                       <td>
                      <a href = "?page=manage_meeting&meeting_id=<?php echo $res_meeting['meeting_id'] ?>" class="info p-0" data-original-title="" title="">
                        <i class="ft-list font-medium-3 mr-2"></i>
                      </a>
                    </td>
                    <td>
                      <a href="?page=Attendance&meeting_id=<?php echo $res_meeting['meeting_id'] ?>" class="info p-0" data-original-title="" title="">
                        <i class="ft-user font-medium-3 mr-2"></i>
                      </a>
                    </td>
                <?php } ?>
                   
                    <td>
                       <a href = "mpdf/?meeting_id=<?php echo $res_meeting['meeting_id'] ?>"  class="primary p-0" data-original-title="" title="">
                        <i class="ft-file font-medium-3 mr-2"></i>
                      </a>
                    </td>
                    <?php if ($_SESSION['type_id']==1) {?>
                    <td>
                      <a href="?page=edit_meeting&meeting_id=<?php echo $res_meeting['meeting_id']?>" class="secondary p-0" data-original-title="" title="">
                        <i class="ft-edit-2 font-medium-3 mr-2"></i>
                      </a>
                    </td>
                    <td>
                      <a href="?page=Set_meeting&delmeeting_id=<?php echo $res_meeting["meeting_id"] ?>" class="success p-0" data-original-title="" title="">
                        <i class="ft-trash-2 font-medium-3 mr-2"></i>
                      </a>
                    </td>
                  <?php } ?>
                  </tr>
                  <?php $i++;} ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

