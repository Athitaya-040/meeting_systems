<?php 

function DateThai($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));
  $strHour= date("H",strtotime($strDate));
  $strMinute= date("i",strtotime($strDate));
  $strSeconds= date("s",strtotime($strDate));
  $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}

if(isset($_POST['submit_meeting']) && ($_FILES['file']['type']=="application/pdf"))
{
  $typename=array("pdf");
  $temp=explode(".", $_FILES['file']['name']);
  $extention=end($temp);
  $file_type =$_FILES['file']['type'];
  $meeting_name = mysqli_real_escape_string($conn,$_POST['meeting_name']);
  $meeting_BE = mysqli_real_escape_string($conn,$_POST['meeting_BE']);
  $meeting_terms = mysqli_real_escape_string($conn,$_POST['meeting_terms']);
  $meeting_order = '';
  $meeting_date = mysqli_real_escape_string($conn,$_POST['meeting_date']);
  $meeting_time = mysqli_real_escape_string($conn,$_POST['meeting_time']);
  $meeting_room = mysqli_real_escape_string($conn,$_POST['meeting_room']);
  $meeting_building = mysqli_real_escape_string($conn,$_POST['meeting_building']);

   $insert_meeting = "INSERT INTO `add_meeting`(`meeting_name`, `meeting_BE`, `meeting_terms`, `meeting_order`, `meeting_date`, `meeting_time`, `meeting_room`, `meeting_building`) VALUES ('$meeting_name', '$meeting_BE', '$meeting_terms', '$meeting_order', NOW(), NOW(), '$meeting_room', '$meeting_building')";

  $query_meeting = mysqli_query($conn,$insert_meeting);
  $last_id = mysqli_insert_id($conn);

  echo $pname = rand(1000,10000)."_".$_FILES["file"]["name"];
  $target= "upload/";
   move_uploaded_file($_FILES['file']['tmp_name'],$target.$pname);

   $insert_file_input = "INSERT INTO  file_input(`file_name`,`file_format`,`file_datetime`,`meeting_id` ) VALUES('$pname','$file_type',NOW(),'$last_id')";

  $query_file_input = mysqli_query($conn,$insert_file_input);
  echo '<script>swal("บันทึกข้อมูลสำเร็จ", {
    icon: "success",
    }).then((willDelete)=>{window.location.href="?page=Set_meeting" });
    </script>';
  }
  ?>

  <div class="row">
    <div class="col-sm-12">
      <div class="#000000 ">เพิ่มการประชุม</div>
    </div>
  </div>
  <section id="grid-option">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-content">
          </div>
          <div class="card-content">
           <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-content">
                  <div class="px-3">
                    <form action="" method="POST" enctype="multipart/form-data">
                      <div class="form-body">
                        <h4 class="form-section"><i class="ft-user"></i> ข้อมูลการประชุม</h4>
                        <div class="form-group row">
                          <p class="col-md-3 label-control" for="projectinput1">ชื่อการประชุม: </p>
                          <div class="col-md-9">
                            <input type="text" id="projectinput1" class="form-control" name="meeting_name">
                          </div>
                        </div>

                        <div class="form-group row">
                          <p class="col-md-3 label-control" for="projectinput2">ประจำปี พ.ศ.: </p>
                          <div class="col-md-9">
                            <input type="number" id="projectinput2" class="form-control" name="meeting_BE">
                          </div>
                        </div>

                        <div class="form-group row">
                          <p class="col-md-3 label-control" for="projectinput2">ครั้งที่ประชุม: </p>
                          <div class="col-md-9">
                            <input type="number" id="projectinput2" class="form-control" name="meeting_terms">
                          </div>
                        </div>
                        <div class="form-group row">
                          <p class="col-md-3 label-control" for="timesheetinput3">วันที่นัดประชุม: </p>
                          <div class="col-md-9">
                            <div class="position-relative has-icon-left">
                              <input type="date" id="timesheetinput3" class="form-control" name="meeting_date">
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <p class="col-md-3 label-control" for="timesheetinput5">เวลาที่นัดประชุม: </p>
                          <div class="col-md-9">
                            <div class="position-relative has-icon-left">
                              <input type="time" id="timesheetinput5" class="form-control" name="meeting_time">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <p class="col-md-3 label-control" for="projectinput1">อาคาร: </p>
                          <div class="col-md-9">
                            <select id="select1" name="meeting_building" onchange="addOption(this)" class="form-control">
                            <option value="อาคารวิทยาศาสตร์สุขภาพ" selected>อาคารวิทยาศาสตร์สุขภาพ</option> 
                              <option value="ศูนย์วิทยาศาสตร์และวิทยาศาสตร์ประยุกต์">ศูนย์วิทยาศาสตร์และวิทยาศาสตร์ประยุกต์</option> 
                            </select> 
                            
                          </div>
                        </div>

                        <div class="form-group row">
                          <p class="col-md-3 label-control" for="projectinput1">ห้อง: </p>
                          <div class="col-md-9">
                            <select id="select2" name="meeting_room"  class="form-control"> 
                            <option value="ห้องพุดน้ำบุษย์">ห้องพุดน้ำบุษย์  </option>
                            </select> 
                           
                          </div>
                        </div>



                        <div class="form-group row">
                          <p class="col-md-3 label-control">เอกสารการประชุมฉบับเต็ม: </p>
                          <div class="col-md-9">
                          
                          <label id="projectinput8" class="file ">
                            <input type="file" id="file" name="file" required><br>
                            <span class="file-custom"></span>
                          </label>
                        

                          </div>
                        </div>

                        <div class="form-actions" align="center">
                          <a href="?page=Set_meeting" class="btn btn-raised btn-secondary mr-1">
                            <i class="ft-x"></i> ยกเลิก
                          </a>
                          <button  class="btn btn-raised btn-success" name="submit_meeting">
                            <i class="fa fa-check-square-o"></i> บันทึกข้อมูล
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
<script type="text/javascript"> 
  function addOption(x) { 
    $("#select2 option").remove();
    console.log(x.value)
if(x.value == 'อาคารวิทยาศาสตร์สุขภาพ'){
  
  $('#select2').append(`<option value="ห้องพุดน้ำบุษย์" selected> 
     ห้องพุดน้ำบุษย์ 
     </option>`); 
}
if(x.value == 'ศูนย์วิทยาศาสตร์และวิทยาศาสตร์ประยุกต์'){
  
  $('#select2').append(`
  <option value="ห้องดาวเรือง" selected>ห้องดาวเรือง</option>
  <option value="ทานตะวัน">ทานตะวัน</option>
  <option value="ทองอุไร">ทองอุไร</option>
  `); 
}
    

  } 
</script> 