<?php 
$meeting_id = $_GET['meeting_id'];
$attendance_id = $_GET['attendance_id'];

if(isset($_POST['submit_attendance'])){
  $position_id = mysqli_real_escape_string($conn,$_POST['position_id']);

  $update_attendance = "UPDATE `meeting`.`attendance` SET `position_id` = '$position_id' WHERE attendance_id = '$attendance_id'";
  mysqli_query($conn,$update_attendance);
  echo '<script>swal("แก้ไขข้อมูลสำเร็จ", {
    icon: "success",
  }).then((willDelete)=>{window.location.href="?page=Attendance&meeting_id='.$meeting_id.'" });
  </script>';
}

if(isset($_GET['attendance_id'])){
  $select_attendance = "SELECT
  attendance.*, 
  `position`.position_name, 
  `user`.user_fname, 
  `user`.user_lname, 
  `title`.title_name,
  `program`.program_name
FROM
  attendance
  INNER JOIN
  position
  ON 
    `attendance`.position_id = `position`.position_id
  INNER JOIN
  `user`
  ON 
    `attendance`.user_id = `user`.user_id
  INNER JOIN
  title
  ON 
    `user`.user_title = `title`.user_title
  INNER JOIN
  program
  ON 
    `user`.user_program = `program`.user_program
  WHERE attendance_id = '$attendance_id'";

    $query_attendance = mysqli_query($conn,$select_attendance);
    $res_attendance = mysqli_fetch_assoc($query_attendance);
}

$select_position = "SELECT * FROM position";
$query_position = mysqli_query($conn,$select_position);

?>

<div class="row">
  <div class="col-sm-12">
    <div class="content-header">แก้ไขผู้เข้าร่วมประชุม</div>
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
                  <form class="form" method="POST">
                    <div class="row justify-content-md-center">
                      <div class="col-md-8">
                        <div class="form-body">
                          <fieldset>
                            <div class="form-group row">
                              <label class="col-md-2" for="eventInput1">ชื่อ - นามสกุล</label>
                              <div class="col-md-10">
                                <div class="input-group-append"> 
                                  <input type="text" class="form-control" placeholder="ค้นหารายชื่อ" name="user_fname" aria-describedby="button-addon2" value="<?=$res_attendance['title_name']?><?=$res_attendance['user_fname']?>  <?=$res_attendance['user_lname']?>">
                                </div>
                              </div>
                            </div>
                          </fieldset>
                          <div class="form-group row">
                              <label class="col-md-2 label-control" for="projectinput6">ตำแหน่งการประชุม </label>
                              <div class="col-md-10">
                                <select  name="position_id" id="position_id" class="form-control" required="required" onchange="select_position()">
                                  <option value="" disabled selected hidden>กรุณาเลือก</option>
                                  <?php  while ($res_position = mysqli_fetch_array($query_position)) {?>
                                    <option value="<?=$res_position['position_id']?>" <?php if($res_attendance['position_id']==$res_position['position_id']) {echo 'selected';} ?>><?=$res_position['position_name']?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          <div class="form-group row">
                            <label class="col-md-2 label-control" for="projectinput6">สาขาวิชา </label>
                            <div class="col-md-10">
                              <input type="text" class="form-control" placeholder="ค้นหารายชื่อ" name="user_program" aria-describedby="button-addon2" value="<?=$res_attendance['program_name']?>">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-actions center">
                      <a href="?page=Attendance" type="button" class="btn btn-raised btn-warning mr-1">
                        <i class="ft-x"></i> ยกเลิก
                      </a>
                      <button type="submit" class="btn btn-raised btn-primary" name="submit_attendance">
                        <i class="fa fa-check-square-o"></i> อัพเดตข้อมูล
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
<script>
  function select_position() {
    var position_id = document.getElementById("position_id").value;
    if(position_id==1){
      document.getElementById("position_name").innerHTML = "ประธานกรรมการ";
    }else if(position_id==2){
      document.getElementById("position_name").innerHTML = "รองประธานกรรมการ";
    }else if(position_id==3){
      document.getElementById("position_name").innerHTML = "ที่ปรึกษา";
    }else if(position_id==4){
      document.getElementById("position_name").innerHTML = "กรรมการ";
    }else if(position_id==5){
      document.getElementById("position_name").innerHTML = "กรรมการและเลขานุการ";
    }else{
      document.getElementById("position_name").innerHTML = "กรรมการและผู้ช่วยเลขานุการ";
    }
  }
</script>