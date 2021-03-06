<?php 
$select_user = "SELECT
title.title_name, 
`user`.user_fname, 
`user`.user_lname, 
program.program_name, 
`user`.user_name, 
`user`.user_tel, 
`user`.user_id
FROM
`user`
INNER JOIN
title
ON 
`user`.user_title = title.user_title
INNER JOIN
program
ON 
`user`.user_program = program.user_program";
$query_user = mysqli_query($conn,$select_user);

if (isset($_GET['deluser_id'])) {
  $deluser_id= mysqli_real_escape_string($conn,$_GET['deluser_id']);
  $del = "DELETE FROM user WHERE user_id ='$deluser_id'";
  mysqli_query($conn,$del);
  echo '<script>swal("ลบข้อมูลสำเร็จ", {
    icon: "error",
  }).then((willDelete)=>{window.location.href="?page=manage_members" });
  </script>';
}

?>

<div class="row">
  <div class="col-sm-12">
    <div class="content-header">จัดการสมาชิก</div>
  </div>
</div>
<section id="extended">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body table-responsive">
            <a href="?page=add_members" class="btn btn-raised btn-primary btn-min-width mr-1 mb-1">
              <i class="ft-plus-circle"></i> เพิ่มสมาชิก
            </a>
            <table class="table text-center">
              <thead>
                <tr>
                  <th>ลำดับที่</th>
                  <th>ชื่อผู้ใช้</th>
                  <th>ชื่อ-สกุล</th>
                  <th>สาขาวิชา</th>
                  <th>เบอร์โทรศัพท์</th>
                  <th>แก้ไข</th>
                  <th>ลบ</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; while ($res_user = mysqli_fetch_array($query_user)){
                  ?>
                <tr>
                  <td><?=$i;?></td>
                  <td><?=$res_user['user_name']?></td>
                  <td>
                    <?=$res_user['title_name'].$res_user['user_fname']."&nbsp;&nbsp;".$res_user['user_lname']?>
                  </td>
                  <td><?=$res_user['program_name']?></td>
                  <td><?=$res_user['user_tel']?></td>
                  <td>
                    <a href="?page=edit_members&user_id=<?php echo $res_user["user_id"] ?>" class="secondary p-0">
                      <i class="ft-edit-2 font-medium-3 mr-2"></i>
                    </a>
                  </td>
                  <td>
                    <a href="?page=manage_members&deluser_id=<?php echo $res_user["user_id"] ?>" class="success p-0">
                      <i class="ft-trash-2 font-medium-3 mr-2"></i>
                    </a>
                  </td>
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