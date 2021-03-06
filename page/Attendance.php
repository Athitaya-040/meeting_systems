<?php 

$meeting_id = mysqli_real_escape_string($conn,$_GET['meeting_id']);
$select_attendance = "SELECT
attendance.attendance_id,
title.title_name,
`user`.user_fname,
`user`.user_lname,
position.position_name,
program.program_name 
FROM
attendance
INNER JOIN `user` ON attendance.user_id = `user`.user_id
INNER JOIN position ON attendance.position_id = position.position_id
INNER JOIN program ON `user`.user_program = program.user_program
INNER JOIN title ON `user`.user_title = title.user_title 
WHERE
attendance.meeting_id = '$meeting_id'";
$query_attendance = mysqli_query($conn,$select_attendance);

if (isset($_GET['delattendance_id'])) {
  $meeting_id = $_GET['meeting_id'];  
  $delattendance_id =  mysqli_real_escape_string($conn,$_GET['delattendance_id']);
  $del = "DELETE FROM  attendance WHERE attendance_id = '$delattendance_id'";
  mysqli_query($conn,$del);
  echo "<script>window.location.href='?page=Attendance&meeting_id=$meeting_id'</script>";
}


?>
<div class="row">
  <div class="col-sm-12">
    <div class="content-header">ผู้เข้าร่วมประชุม</div>
  </div>
</div>
<section id="grid-option">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body table-responsive">
          <a href="?page=Add_Attendance&meeting_id=<?php echo $_GET['meeting_id'] ?>" class="btn btn-raised btn-primary btn-min-width mr-1 mb-1" ><i class="ft-plus-circle"></i> เพิ่มผู้เข้าร่วมประชุม</a>
          <table class="table text-center">
            <thead>
              <tr>
                <th>ลำดับที่</th>
                <th>ชื่อ-นามสกุล</th>
                <th>ตำแหน่งการประชุม</th>
                <th>สาขาวิชา</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; while ($res_attendance = mysqli_fetch_array($query_attendance)) {?>
                <tr>
                  <td><?=$i; ?></td>
                  <td><?=$res_attendance['title_name'].$res_attendance['user_fname'].' '.$res_attendance['user_lname'] ?></td>
                  <td><?=$res_attendance['position_name'] ?></td>
                  <td><?=$res_attendance['program_name'] ?></td>
                  <td>
                    <a href="?page=edit_Attendance&meeting_id=<?=$_GET['meeting_id']?>&attendance_id=<?=$res_attendance['attendance_id']?>" class="info p-0" data-original-title="" title="">
                      <i class="ft-edit-2 font-medium-3 mr-2"></i>
                    </a>
                  </td>
                  <td>
                    <a href="?page=Attendance&meeting_id=<?php echo $_GET['meeting_id']; ?>&delattendance_id=<?php echo $res_attendance['attendance_id']; ?>" class="success p-0" data-original-title="" title="">
                      <i class="ft-trash-2 font-medium-3 mr-2"></i>
                    </a>
                  </td>
                </tr>
                <?php $i++;} ?>
              </tbody>
            </table>
            <a href="?page=Set_meeting" type="button" class="btn btn-info">กลับ</a>
          </div>
        </div>
      </div>
    </div>
  </section>