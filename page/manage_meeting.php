
<?php

$meeting_id = $_GET['meeting_id'];
$select_agenda = "SELECT
  list_agenda.lagd_name, 
  list_agenda.lagd_order, 
  list_agenda.lagd_id,
  
  agenda.agd_id, 
  agenda.agd_name
FROM
  list_agenda
  INNER JOIN
  agenda
  ON 
    list_agenda.agd_id = agenda.agd_id
  INNER JOIN
  add_meeting
  ON 
    list_agenda.meeting_id = add_meeting.meeting_id where list_agenda.meeting_id='$meeting_id'";

$query_agenda = mysqli_query($conn,$select_agenda);

if (isset($_GET['dellagd_id'])) {

  $dellagd_id = $_GET['dellagd_id'];

  $delete = "DELETE FROM `meeting`.`list_agenda` WHERE `lagd_id` =  '$dellagd_id'";
  mysqli_query($conn,$delete);
  echo '<script>swal("ลบข้อมูลสำเร็จ", {
    icon: "error",
  }).then((willDelete)=>{window.location.href="?page=manage_meeting&meeting_id='.$meeting_id.'" });
  </script>';
  
}
 ?>

<div class="row">
  <div class="col-sm-12">
    <div class="content-header">จัดการวาระการประชุม</div>
  </div>
</div>
<section id="grid-option">
  <div class="row">
    <div class="col-12">
      <div class="card">
       
        <div class="card-body table-responsive">
          <a href="?page=Add_agenda&meeting_id=<?php echo $_GET['meeting_id'] ?>" class="btn btn-raised btn-primary btn-min-width mr-1 mb-1"  ><i class="ft-plus-circle"></i> เพิ่มวาระการประชุม</a>
          <table class="table text-center">
            <thead>
              <tr>
                <th>วาระที่</th>
                <th>เรื่อง</th>
                <th>วาระย่อย</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; while ($res_agenda = mysqli_fetch_array($query_agenda)){ ?>
              <tr>
                <td><?=$res_agenda['agd_id'] ?></td>
                <td style="text-align: left"><?=$res_agenda['agd_name'] ?></td>
                <td style="text-align: left"><?=$res_agenda['lagd_order']."&nbsp;&nbsp;".$res_agenda['lagd_name'] ?></td>
                <td>
                  <a href="?page=edit_agenda&meeting_id=<?=$_GET['meeting_id']?>&list_agenda=<?=$res_agenda['lagd_id'] ?>" class="danger p-0" data-original-title="" title="">
                    <i class="ft-edit-2 font-medium-3 mr-2"></i>
                  </a>
                </td>
                <td>
                  <a  href="?page=manage_meeting&meeting_id=<?=$_GET['meeting_id']?>&dellagd_id=<?php echo $res_agenda['lagd_id']?>" class="success p-0" data-original-title="" title="">
                    <i class="ft-trash-2 font-medium-3 mr-2"></i>
                  </a>
                </td>
              </tr>
            <?php $i++; } ?>
            </tbody>
          </table>
          <a href="?page=Set_meeting" type="button" class="btn btn-raised btn-info btn-min-width mr-1 mb-1" >กลับ</a>
        </div>
      </div>
    </div>
  </div>
</section>
