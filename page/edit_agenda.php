
<?php 
$lagd_id = $_GET['list_agenda'];
$meeting_id = $_GET['meeting_id'];
if (isset($_POST['submit_agenda'])) {
$lagd_order = mysqli_real_escape_string($conn,$_POST['lagd_order']);
$lagd_name = mysqli_real_escape_string($conn,$_POST['lagd_name']);
$lagd_details = mysqli_real_escape_string($conn,$_POST['lagd_details']);

  $update_list_agenda = "UPDATE list_agenda SET 
  lagd_order = '$lagd_order', 
  lagd_name = '$lagd_name', 
  lagd_details = '$lagd_details'
  WHERE lagd_id = '$lagd_id'
  ";

  mysqli_query($conn,$update_list_agenda);
  echo '<script>swal("แก้ไขข้อมูลสำเร็จ", {
    icon: "success",
  }).then((willDelete)=>{window.location.href="?page=manage_meeting&meeting_id='.$meeting_id.'" });
  </script>';
}

if(isset($_GET['list_agenda'])) {
  
  $select_list_agenda = "SELECT * FROM list_agenda WHERE lagd_id = '$lagd_id'";
  $query_list_agenda = mysqli_query($conn,$select_list_agenda);
  $res_list_agenda = mysqli_fetch_assoc($query_list_agenda);
}

$select_agenda =  "SELECT * FROM agenda";
$query_agenda = mysqli_query($conn,$select_agenda);


?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="row">
  <div class="col-sm-12">
    <div class="content-header">จัดการวาระการประชุม</div>
  </div>
</div>
<section id="grid-option">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-content">
        </div>

        <div class="row match-height">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title" id="basic-layout-form-center">แก้ไขวาระการประชุม</h1>
              </div>
              <div class="card-content">
                <div class="px-3">
                  <form class="form" action="" method="POST">
                    <div class="row justify-content-md-center">
                      <div class="col-md-8">
                        <div class="form-body">
                          <div class="form-group row">
                            <label class="col-md-2" for="eventInput1">ระเบียบวาระที่</label>
                            <div class="col-md-10">

                              <select name="agd_id" id="agd_id" class="form-control" required="required" onchange="select_agenda()">
                                <option value="" disabled selected hidden>กรุณาเลือก</option>
                                <?php while ($res_agenda =mysqli_fetch_array($query_agenda)){?>
                                  <option value="<?=$res_agenda['agd_id']?>" <?php if ($res_list_agenda['agd_id']==$res_agenda['agd_id']) {echo 'selected';} ?>><?=$res_agenda['agd_id'].' '.$res_agenda['agd_name']?></option>
                                <?php } ?>
                              </select>
                              
                            </div>
                            <br><br>
                            <label class="col-md-2" for="eventInput1">เรื่อง</label>
                            <div class="col-md-10">
                              <p id="agd_name"></p>
                            </div>
                          </div>
                        </div>
                      </div> 
                      <div class="form-group fieldGroup">
                        <div class="input-group ">
                          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <label for="eventInput1" >วาระย่อยที่</label>                              
                          </div>   
                          <div class="col-xs-4 col-sm-4 col-md-10 col-lg-10">
                            <input type="text" id="eventInput1" class="form-control" name="lagd_order"  value="<?=$res_list_agenda['lagd_order']  ?>">
                          </div><br><br>    
                          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <label for="eventInput1" >เรื่อง</label>                           
                          </div>  
                          <div class="col-xs-4 col-sm-4 col-md-10 col-lg-10">
                            <input type="text" id="eventInput1" class="form-control " name="lagd_name" value="<?=$res_list_agenda['lagd_name']  ?>">
                          </div><br><br>  
                          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <label for="eventInput1" >รายละเอียด</label>                              
                          </div>
                          <div class="col-xs-4 col-sm-4 col-md-10 col-lg-10">
                            <textarea rows="10" class="form-control" name="lagd_details"> <?=$res_list_agenda['lagd_details']  ?></textarea><br> 
                          </div>             
                      </div>
                    </div>
                  </div>

                  <div class="form-actions center"> 
                    <a href="?page=manage_meeting" class="btn btn-secondary  mr-1" >
                      <i class="ft-x"></i> ยกเลิก
                    </a>
                    <button type="submit" class="btn btn-raised btn-success" name="submit_agenda" >
                      <i class="fa fa-check-square-o"></i> อัพเดตข้อมูล
                    </button>
                  </div>
                </form>
                

                <div class="form-group fieldGroupCopy" style="display: none;">
                  <div class="input-group">   
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                      <label for="eventInput1" >วาระย่อยที่</label>                              
                    </div>   
                    <div class="col-xs-4 col-sm-4 col-md-10 col-lg-10">
                      <input type="text" id="eventInput1" class="form-control" name="lagd_order[]" >
                    </div><br><br>    
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                      <label for="eventInput1" >เรื่อง</label>                           
                    </div>  
                    <div class="col-xs-4 col-sm-4 col-md-10 col-lg-10">
                      <input type="text" id="eventInput1" class="form-control " name="lagd_name[]">
                    </div><br><br>  
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                      <label for="eventInput1" >รายละเอียด</label>                              
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-10 col-lg-10">
                      <textarea rows="10" class="form-control" name="lagd_details[]"> </textarea><br> 
                    </div> 
                    <div class="d-grid gap-2 col-1 mx-auto ">
                     <div class="input-group-addon"> 
                      <a href="javascript:void(0)" class="btn btn-danger remove" style="width: 100px;"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> ลบ</a>
                    </div>                     
                  </div>
                </div>
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
<script>
  function select_agenda(){
    var agd_id = document.getElementById("agd_id").value;
    if (agd_id==1) {
      document.getElementById("agd_name").innerHTML = "เรื่องแจ้งเพื่อทราบ";
    }else if(agd_id==2){
      document.getElementById("agd_name").innerHTML = "เรื่องพิจารณารับรองรายงานการประชุม";

    }else if(agd_id==3){
      document.getElementById("agd_name").innerHTML = "เรื่องสืบเนื่อง";
      
    }else if(agd_id==4){
      document.getElementById("agd_name").innerHTML = "เรื่องเสนอเพื่อพิจารณา";
      
    }else if(agd_id==5){
      document.getElementById("agd_name").innerHTML = "เรื่องอื่นๆ";
    }

  }

</script>

<script type="text/javascript">
 $(document).ready(function(){
    //group add limit
    var maxGroup = 10;
    
    //add more fields group
    $(".addMore").click(function(){
      if($('body').find('.fieldGroup').length < maxGroup){
        var fieldHTML = '<div class="form-group fieldGroup ">'+$(".fieldGroupCopy").html()+'</div>';
        $('body').find('.fieldGroup:last').after(fieldHTML);
      }else{
        alert('Maximum '+maxGroup+' groups are allowed.');
      }
    });
    
    //remove fields group
    $("body").on("click",".remove",function(){ 
      $(this).parents(".fieldGroup").remove();
    });
  });
</script>

