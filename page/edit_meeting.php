<?php 

if (isset($_GET['meeting_id'])) {
  $meeting_id = $_GET['meeting_id'];
  $select_meeting = "SELECT
  add_meeting.*, 
  file_input.file_name
  FROM
  add_meeting
  INNER JOIN
  file_input
  ON 
  add_meeting.meeting_id = file_input.meeting_id 
  WHERE add_meeting.meeting_id = '".$meeting_id."' ";

  $query_meeting = mysqli_query($conn,$select_meeting);
  $meeting_result = mysqli_fetch_array($query_meeting);

}

if(isset($_POST['submit_meeting']))
{
  // && ($_FILES['file']['type']=="application/pdf")

  // $typename=array("pdf");
  // $temp=explode(".", $_FILES['file']['name']);
  // $extention=end($temp);
  // $file_type =$_FILES['file']['type'];

  $meeting_name = mysqli_real_escape_string($conn,$_POST['meeting_name']);
  $meeting_BE = mysqli_real_escape_string($conn,$_POST['meeting_BE']);
  $meeting_terms = mysqli_real_escape_string($conn,$_POST['meeting_terms']);
  $meeting_order = '';
  $meeting_date = mysqli_real_escape_string($conn,$_POST['meeting_date']);
  $meeting_time = mysqli_real_escape_string($conn,$_POST['meeting_time']);
  $meeting_room = mysqli_real_escape_string($conn,$_POST['meeting_room']);
  $meeting_building = mysqli_real_escape_string($conn,$_POST['meeting_building']);

  $insert_meeting = "UPDATE `meeting`.`add_meeting` SET `meeting_name` = '$meeting_name', `meeting_BE` = '$meeting_BE', `meeting_terms` = '$meeting_terms', `meeting_order` = '$meeting_order', `meeting_date` = '$meeting_date', `meeting_time` = '$meeting_time', `meeting_room` = '$meeting_room', `meeting_building` = '$meeting_building' WHERE `meeting_id` = '$meeting_id'";

  $query_meeting = mysqli_query($conn,$insert_meeting);

  echo '<script>swal("แก้ไขข้อมูลสำเร็จ", {
    icon: "success",
  }).then((willDelete)=>{window.location.href="?page=Set_meeting" });
  </script>';


  $last_id = mysqli_insert_id($conn);

  // $pname = rand(1000,10000)."_".$_FILES["file"]["name"];
  // $target= "upload/";
  // move_uploaded_file($_FILES['file']['tmp_name'],$target.$pname);

  // $insert_file_input = "INSERT INTO  file_input(`file_name`,`file_format`,`file_datetime`,`meeting_id` ) VALUES('$pname','$file_type',NOW(),'$last_id')";

  // $query_file_input = mysqli_query($conn,$insert_file_input);

 }//else{
//   echo "0";
// }

// $select_meeting = "SELECT
//   *
// FROM
// `add_meeting`
// INNER JOIN
// file_input
// ON 
// `add_meeting`.meeting_id = file_input.meeting_id
// WHERE
// file_input.meeting_id = '$meeting_id' ";



?>

<div class="row">
  <div class="col-sm-12">
    <div class="content-header">แก้ไขการประชุม</div>
  </div>
</div>
<section id="grid-option">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-content">
         <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-content">
                <div class="px-3">
                  <form class="form form-horizontal" method="POST">
                    <div class="form-body">
                      <h4 class="form-section"><i class="ft-user"></i> ข้อมูลการประชุม</h4>
                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput1">ชื่อการประชุม: </label>
                        <div class="col-md-9">
                          <input type="text" id="projectinput1" class="form-control" name="meeting_name" value="<?php echo $meeting_result["meeting_name"] ?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput2">ประจำปี พ.ศ.: </label>
                        <div class="col-md-9">
                          <input type="number" id="projectinput2" class="form-control" name="meeting_BE"value="<?php echo $meeting_result["meeting_BE"] ?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput2">ครั้งที่ประชุม: </label>
                        <div class="col-md-9">
                          <input type="number" id="projectinput2" class="form-control" name="meeting_terms"value="<?php echo $meeting_result["meeting_terms"] ?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="timesheetinput3">วันที่นัดประชุม: </label>
                        <div class="col-md-9">
                          <div class="position-relative has-icon-left">
                            <input type="date" id="timesheetinput3" class="form-control" name="meeting_date"value="<?php echo $meeting_result["meeting_date"] ?>">
                            <div class="form-control-position">
                              <i class="ft-message-square"></i>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="timesheetinput5">เวลาที่นัดประชุม: </label>
                        <div class="col-md-9">
                          <div class="position-relative has-icon-left">
                            <input type="time" id="timesheetinput5" class="form-control" name="meeting_time"value="<?php echo $meeting_result["meeting_time"] ?>">
                            <div class="form-control-position">
                              <i class="ft-clock"></i>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput1">ห้อง: </label>
                        <div class="col-md-9">
                          <input type="text" id="projectinput1" class="form-control" name="meeting_room"value="<?php echo $meeting_result["meeting_room"] ?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput1">อาคาร: </label>
                        <div class="col-md-9">
                          <input type="text" id="projectinput1" class="form-control" name="meeting_building"value="<?php echo $meeting_result["meeting_building"] ?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-3 label-control">เอกสารการประชุมฉบับเต็ม: </label>
                        <div class="col-md-9">
                          <label id="projectinput8" class="file "value="<?php echo $meeting_result["meeting_name"] ?>">
                            <input type="file" id="file">
                            <span class="file-custom"></span>
                          </label>
                        </div>
                      </div>

                      <div class="form-actions">
                        <a href="?page=Set_meeting" class="btn btn-raised btn-secondary mr-1" name="submit_user">
                          <i class="ft-x"></i> ยกเลิก
                        </a>
                        <button class="btn btn-raised btn-success" name="submit_meeting">
                          <i class="fa fa-check-square-o"></i> อัพเดตข้อมูล
                        </button>
                      </div>
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
</div>
</section>
