<?php 

$user_id  = mysqli_real_escape_string($conn,$_GET['user_id']);

if (isset($_POST['submit_user'])) {

  $user_title = mysqli_real_escape_string($conn,$_POST['user_title']);
  $user_fname = mysqli_real_escape_string($conn,$_POST['user_fname']);
  $user_lname = mysqli_real_escape_string($conn,$_POST['user_lname']);
  $user_program = mysqli_real_escape_string($conn,$_POST['user_program']);
  $user_tel = mysqli_real_escape_string($conn,$_POST['user_tel']);
  $user_email = mysqli_real_escape_string($conn,$_POST['user_email']);
  $user_name = mysqli_real_escape_string($conn,$_POST['user_name']);
  $user_password = mysqli_real_escape_string($conn,$_POST['user_password']);
  $type_id = mysqli_real_escape_string($conn,$_POST['type_id']);


  $insert_user = " UPDATE user SET user_title = '$user_title', user_fname = '$user_fname', user_lname = '$user_lname', user_program = '$user_program', user_tel = '$user_tel', user_email = '$user_email', user_datetime = NOW(), user_name = '$user_name', user_password = '$user_password', type_id = '$type_id' WHERE  user_id = '$user_id'";

  $query_user = mysqli_query($conn,$insert_user);
  echo '<script>swal("แก้ไขข้อมูลสำเร็จ", {
    icon: "success",
  }).then((willDelete)=>{window.location.href="?page=manage_members" });
  </script>';
}

$select_type = " SELECT * FROM type ";
$query_type =mysqli_query($conn,$select_type);
$select_program = " SELECT * FROM program ";
$query_program =mysqli_query($conn,$select_program);
$select_title = " SELECT * FROM title ";
$query_title =mysqli_query($conn,$select_title);

$select_user = "SELECT
*
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
WHERE user.user_id = '$user_id' ";
$query_user = mysqli_query($conn,$select_user);
$user_result = mysqli_fetch_array($query_user);


?>
<div class="row">
  <div class="col-sm-12">
   <div class="navbar-header">
    <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><span class="d-lg-none navbar-right navbar-collapse-toggle"><a aria-controls="navbarSupportedContent" href="javascript:;" class="open-navbar-container black"><i class="ft-more-vertical"></i></a></span>
    <form role="search" class="navbar-form navbar-right mt-1">
      <div class="position-relative has-icon-right">
        <input type="text" placeholder="Search" class="form-control round"/>
        <div class="form-control-position"><i class="ft-search"></i></div>
      </div>
    </form>
  </div>
</div>
</div>
<section id="grid-option">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">แก้ไขสมาชิก</h4>
        </div>
        <div class="card-content">
          <div class="card-body row">
           <div class="col-md-12">
            <form action="" method="POST" >
              <div class="card">
                <div class="card-header">
                  <!-- <h4 class="card-title" id="basic-layout-colored-form-control">จัดการสมาชิก</h4> -->


                </div>
                <div class="card-content row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="projectinput1">Username</label>
                      <input type="text" id="projectinput1" class="form-control" name="user_name" value="<?php echo $user_result["user_name"] ?>">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="projectinput1">Password</label>
                      <input type="text" id="projectinput1" class="form-control" name="user_password"value="<?php echo $user_result["user_password"] ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="projectinput1">คำนำหน้าชื่อ</label>
                      <select name="user_title" id="inputUser_program" class="form-control" required=""value="<?php echo $user_result["user_password"] ?>">
                       <option value="" disabled selected hidden>กรุณาเลือก</option>
                       <?php while ($res_title = mysqli_fetch_array($query_title)) { ?>
                        <option value="<?=$res_title['user_title'] ?>" <?php if ($res_title['user_title'] == $user_result["user_title"]) {echo "selected";} ?>><?=$res_title['title_name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="projectinput1">ชื่อ</label>
                    <input type="text" id="projectinput1" class="form-control" name="user_fname" value="<?php echo $user_result["user_fname"] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="projectinput1">นามสกุล</label>
                    <input type="text" id="projectinput1" class="form-control" name="user_lname" value="<?php echo $user_result["user_lname"] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="projectinput6">Email</label>
                    <input type="text" id="projectinput1" class="form-control" name="user_email"value="<?php echo $user_result["user_email"] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="projectinput1">สาขาวิชา</label>
                    <select name="user_program" id="inputUser_program" class="form-control" required="required" value="<?php echo $user_result["user_pro
                    "] ?>">
                      <?php while ($res_program = mysqli_fetch_array($query_program)) { ?>
                        <option value="<?=$res_program['user_program'] ?>" <?php if($res_program['user_program'] == $user_result["user_program"]) {echo "selected"; }?>> <?= $res_program['program_name']?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="projectinput1">เบอร์โทรศัพท์</label>
                    <input type="text" id="projectinput1" class="form-control" name="user_tel"value="<?php echo $user_result["user_tel"] ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="projectinput1">ประเภทผู้ใช้</label>
                    <select name="type_id" id="input" class="form-control" required="required"value="<?php echo $user_result["type_id"] ?>">
                      <?php while ($res_type = mysqli_fetch_array($query_type)) {
                        ?>
                        <option value="<?=$res_type['type_id'] ?>" <?php if($res_type['type_id'] == $user_result["type_id"]) {echo "selected";} ?>> <?=$res_type['type_name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-actions" align="center">
                <a href="?page=manage_members"  class="btn btn-raised btn-raised btn-secondary" name="submit_user">
                  <i class="fa fa-check-square-o"></i> กลับ
                </a> 
                &nbsp;&nbsp;&nbsp;
                <button  class="btn btn-raised btn-raised btn-success" name="submit_user">
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
</section>
