<?php 

if (isset($_GET['add_member_id'])) {
  $add_member_id = mysqli_real_escape_string($conn,$_GET['add_member_id']);
  $select_member = "SELECT
`user`.user_id, 
title.title_name, 
`user`.user_fname, 
`user`.user_lname, 
program.program_name
FROM
`user`
INNER JOIN
title
ON 
`user`.user_title = title.user_title
INNER JOIN
program
ON 
`user`.user_program = program.user_program
WHERE user_id = '$add_member_id'";
$query_member =mysqli_query($conn,$select_member);
$res_member  = mysqli_fetch_array($query_member);

  
}
if (isset($_POST['submit_attendance'])) {

  $user_id = $res_member['user_id'];
  $position_id = mysqli_real_escape_string($conn,$_POST['position_id']);
  $meeting_id = mysqli_real_escape_string($conn,$_GET['meeting_id']);

  $insert_attendance = "INSERT INTO attendance(user_id,position_id,meeting_id) VALUES ('$user_id','$position_id','$meeting_id')";
  $query_attendance = mysqli_query($conn,$insert_attendance); 
  echo "<script>window.location.href='?page=Attendance&meeting_id=$meeting_id'</script>";
}


if(isset ($_POST['find_name'])) {
  $find_name=explode(' ', $_POST['find_name']);
  $fname = mysqli_real_escape_string($conn,$find_name[0]);
  @$lname = mysqli_real_escape_string($conn,$find_name[1]);
$select_attendance = "SELECT
`user`.user_id, 
title.title_name, 
`user`.user_fname, 
`user`.user_lname, 
program.program_name
FROM
`user`
INNER JOIN
title
ON 
`user`.user_title = title.user_title
INNER JOIN
program
ON 
`user`.user_program = program.user_program
WHERE user_fname LIKE '%".$fname."%' OR user_lname LIKE '%".$lname."%'";
$query_attendance =mysqli_query($conn,$select_attendance);
}
 $select_position="SELECT * FROM position";
 $query_position=mysqli_query($conn,$select_position);

?>

<div class="row">
  <div class="col-sm-12">
    <div class="content-header">เพิ่มผู้เข้าร่วมประชุม</div>
  </div>
</div>
<section id="grid-option">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="row match-height">
          <div class="col-md-12">
            <div class="card">
              <div class="card-content">
                <div class="px-3">
                  <form action="" method="POST" >
                    <div class="row justify-content-md-center">
                      <div class="col-md-8">
                        <div class="form-body">
                         
                            <!-- <?php $i//=1; while($res_attendance = mysqli_fetch_array($query_attendance)) {?> -->
                            <fieldset>
                              <div class="form-group row">
                                <label class="col-md-2" for="eventInput1">ชื่อ - นามสกุล</label>
                                <div class="col-md-10">
                                  <div class="input-group-append"> 
                                    <input  class="form-control" placeholder="ค้นหารายชื่อ" aria-describedby="button-addon2" name="find_name">
                                    <button class="btn btn-raised btn-info" name="submit">ค้นหา</button>
                                  </div>
                                </div>
                              </div>
                            </fieldset>

                            <?php if (isset($_POST['find_name'])) { ?>
                             <table class="table text-center">
                              <thead>
                                <tr>
                                  <th>ชื่อ-นามสกุล</th>
                                  <th>สาขาวิชา</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php  $i=1; while ($res_attendance = mysqli_fetch_array($query_attendance)) { ?>
                                  <tr>
                                    <td><?=$res_attendance['title_name'].$res_attendance['user_fname']."&nbsp;&nbsp;".$res_attendance['user_lname']?> </td>
                                    <td><?=$res_attendance['program_name']?></td>
                                    <td><a href="?page=Add_Attendance&meeting_id=<?=$_GET['meeting_id'] ?>&add_member_id=<?=$res_attendance['user_id'] ?>" class="btn btn-success">เลือก</a></td>
                                  </tr>
                                  <?php $i++;} ?>  
                                </tbody>
                              </table> 
                            <?php } ?> 

                            <?php if (isset($_GET['add_member_id'])) {
                              
                             ?>

                            <p>ข้อมูลผู้เข้าประชุม</p>
                            <p>ชื่อ <?=$res_member['user_fname'] ?> นามสกุล <?=$res_member['user_lname'] ?></p>
                            <p>สาขา <?=$res_member['program_name'] ?> </p>
                           <?php } ?>
                            <div class="form-group row">
                              <label class="col-md-2 label-control" for="projectinput6">ตำแหน่งการประชุม </label>
                              <div class="col-md-10">
                                <select  name="position_id" id="inputposition_id" class="form-control" required="required">
                                  <option value="none" selected="" disabled="">ไม่มี</option>
                                  <?php  while ($res_position = mysqli_fetch_array($query_position)) {
                                    ?>
                                    <option value="<?=$res_position['position_id']?>"><?=$res_position['position_name']?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-actions center">
                      <a href="?page=Set_meeting" type="button" class="btn btn-raised btn-secondary mr-1">
                        <i class="ft-x"></i> ยกเลิก
                      </a>
                      <button  class="btn btn-raised btn-success" name="submit_attendance">
                        <i class="fa fa-check-square-o"></i> บันทึกข้อมูล
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
