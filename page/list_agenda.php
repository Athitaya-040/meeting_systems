<?php
if(isset($_POST['submit_listagd'])){

  $orderArr = $_POST['lagd_order'];
  $nameArr = $_POST['lagd_name'];
  $detailsArr = $_POST['lagd_details'];
  if(!empty($orderArr)){

    for($i = 0; $i < count($orderArr); $i++){
      if(!empty($orderArr[$i])){
        $lagd_order = mysqli_real_escape_string($conn,$orderArr[$i]);
        $lagd_name = mysqli_real_escape_string($conn,$nameArr[$i]);
        $lagd_details = mysqli_real_escape_string($conn,$detailsArr[$i]);

        $insert_listagd = "INSERT INTO `list_agenda`(`lagd_order`, `lagd_name`,`lagd_details`) VALUES ('$lagd_order', '$lagd_name','$lagd_details')";
        $query_listagd = mysqli_query($conn,$insert_listagd);
                // Database insert query goes here
      }
    }
  }
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="row">
  <div class="col-sm-12">
    <div class="content-header">แก้ไขวาระย่อย</div>
  </div>
</div>
<section id="grid-option">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <a href="javascript:void(0)" class="btn btn-flat btn-primary">ตั้งค่าการประชุม ></a>
            <a href="javascript:void(0)" class="btn btn-flat btn-info">จัดการวาระการประชุม ></a>
            <a href="javascript:void(0)" class="btn btn-flat btn-info">แก้ไขวาระย่อย </a>
          </div>
        </div>
        <div class="row match-height">
          <div class="col-md-12">
            <div class="card">
              <div class="card-content">
                <div class="px-3">
                  <div class="row justify-content-md-center">
                    <!--   <div class="col-md-10"> -->
                      <form action="" method="POST"> 
                        <div class="form-group fieldGroup">
                          <div class="input-group ">

                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                              <label for="eventInput1" class="float-right">วาระย่อยที่</label>                              
                            </div>   
                            <div class="col-xs-4 col-sm-4 col-md-10 col-lg-10">
                              <input type="text" id="eventInput1" class="form-control" name="lagd_order[]" >
                            </div><br><br>    
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                              <label for="eventInput1" class="float-right">เรื่อง</label>                           
                            </div>  
                            <div class="col-xs-4 col-sm-4 col-md-10 col-lg-10">
                              <input type="text" id="eventInput1" class="form-control " name="lagd_name[]">
                            </div><br><br>  
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                              <label for="eventInput1" class="float-right">รายละเอียด</label>                              
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-10 col-lg-10">
                              <textarea rows="10" class="form-control" name="lagd_details[]"> </textarea><br> 
                            </div> 
                            <div class="d-grid gap-2 col-1 mx-auto ">  
                             <div class="input-group-addon"> 
                              <a href="javascript:void(0)" class="btn btn-raised btn-primary addMore" style="width: 100px;"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true" ></span> เพิ่ม</a>
                            </div>  
                          </div>                  

                        </div>
                      </div>
                      <div class="form-actions center"> 
                        <a href="?page=manage_meeting" class="btn btn-raised btn-warning mr-1" >
                        <i class="ft-x"></i> Cancel
                      </a>
                        <button  class="btn btn-raised btn-primary"name="submit_listagd" >
                          <i class="fa fa-check-square-o"></i> บันทึก
                        </button>
                      </div>

                    </form>
                    <div class="form-group fieldGroupCopy" style="display: none;">
                      <div class="input-group">   
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                          <label for="eventInput1" class="float-right">วาระย่อยที่</label>                              
                        </div>   
                        <div class="col-xs-4 col-sm-4 col-md-10 col-lg-10">
                          <input type="text" id="eventInput1" class="form-control" name="lagd_order[]" >
                        </div><br><br>    
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                          <label for="eventInput1" class="float-right">เรื่อง</label>                           
                        </div>  
                        <div class="col-xs-4 col-sm-4 col-md-10 col-lg-10">
                          <input type="text" id="eventInput1" class="form-control " name="lagd_name[]">
                        </div><br><br>  
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                          <label for="eventInput1" class="float-right">รายละเอียด</label>                              
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
                  <!-- </div> -->
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
