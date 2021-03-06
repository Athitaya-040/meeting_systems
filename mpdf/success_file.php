<?php 
$meeting_id = $_GET['meeting_id'];
include '../view/connect.php';
require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf'

        ]
    ],
    'default_font' => 'sarabun'
]);


$select_meeting = "SELECT meeting_name,  meeting_date,  meeting_time,  meeting_room,  meeting_building,  meeting_BE,  meeting_terms,  meeting_order FROM add_meeting WHERE meeting_id = '$meeting_id'";
$query_meeting = mysqli_query($conn,$select_meeting);
$res_meeting = mysqli_fetch_assoc($query_meeting);


$select_agenda = "SELECT agd_id,  agd_name FROM agenda";
$query_agenda = mysqli_query($conn,$select_agenda);
$query_agenda2 = mysqli_query($conn,$select_agenda);

$select_president = "SELECT title.title_name,`user`.user_title,`user`.user_fname,`user`.user_lname FROM attendance INNER JOIN `user` ON attendance.user_id = `user`.user_id INNER JOIN title ON `user`.user_title = title.user_title WHERE
    attendance.meeting_id = '$meeting_id' AND attendance.position_id = '1'";
$query_president = mysqli_query($conn,$select_president);
$res_president = mysqli_fetch_assoc($query_president);

$select_partaker = "SELECT title.title_name, `user`.user_fname, `user`.user_lname, position.position_name FROM attendance INNER JOIN `user` ON attendance.user_id = `user`.user_id INNER JOIN title ON `user`.user_title = title.user_title INNER JOIN position ON attendance.position_id = position.position_id WHERE
    attendance.meeting_id = '$meeting_id'  AND attendance.position_id <> '1'  AND attendance.attendance_status = '1' ORDER BY position.position_id ASC";
$query_partaker = mysqli_query($conn,$select_partaker);

$select_partaker2 = "SELECT title.title_name, `user`.user_fname, `user`.user_lname, position.position_name, 
	attendance.attendance_note FROM attendance INNER JOIN `user` ON attendance.user_id = `user`.user_id INNER JOIN title ON `user`.user_title = title.user_title INNER JOIN position ON attendance.position_id = position.position_id WHERE
    attendance.meeting_id = '$meeting_id'  AND attendance.position_id <> '1'  AND attendance.attendance_status = '0' ORDER BY position.position_id ASC";
$query_partaker2 = mysqli_query($conn,$select_partaker2);



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
    return "วันที่ $strDay $strMonthThai $strYear";
    
}

function mati($agd_id,$status){

    if($agd_id == 1 || $agd_id == 3){
        switch ($status) {
            case '1':
                return 'ที่ประชุมรับทราบ';
                break;
            
            default:
                return 'อื่นๆ';
                break;
        }
    }
    if($agd_id == 2){
        switch ($status) {
            case '1':
                return 'ที่ประชุมรับรองรายงานการประชุมโดยไม่มีการแก้ไข';
                break;
            
           case '2':
                return 'ที่ประชุมรับรองรายงานการประชุมโดยให้แก้ไขรายงานการประชุม';
                break;
        }
    }

    if($agd_id == 4){
        switch ($status) {
            case '1':
                return 'ที่ประชุมมีมติอนุมัติตามที่เสนอ';
                break;
            
           case '2':
                return 'ที่ประชุมพิจารณาแล้วมีมติดังนี้';
                break;
           case '3':
                return 'ที่ประชุมมีมติไม่เห็นชอบ';
                break;
        }
    }

}
ob_start();

?>

<div style="width: 100%;text-align: center;font-size: 21.3333px;">รายงานการประชุม<?=$res_meeting['meeting_name'].' <br/> ครั้งที่ '.$res_meeting['meeting_terms'].' ประจำปี '.$res_meeting['meeting_BE'] ?></div>
<div style="width: 100%;text-align: center;font-size: 21.3333px;"><?=DateThai($res_meeting['meeting_date']) ?></div>
<div style="width: 100%;text-align: center;font-size: 21.3333px;"><?='ณ ห้อง'.$res_meeting['meeting_room'].' ตึก '.$res_meeting['meeting_building'] ?></div>
<div style="width: 100%;text-align: center;font-size: 21.3333px;">................................................................................................................................................................</div>
<table style="width: 100%;">
<tbody>
<tr>
<td  style="width:30%;text-align: left;font-size: 21.3333px;">ประธานการประชุม : <?=$res_president['title_name'].$res_president['user_fname'].'  '.$res_president['user_lname'];?></td>
</tr>
</tbody>
</table>
<table style="width: 100%;">
<tbody>
<tr>
    <td style="width:100%;text-align: left;font-size: 21.3333px;" colspan="4">ผู้มาประชุม</td>
</tr>
<?php $i=1; while($res_partaker = mysqli_fetch_assoc($query_partaker)){?>
<tr>
    <td style="width:5%;text-align: right;font-size: 21.3333px;"><?=$i++;?></td>
    <td style="width:40%;text-align: left;font-size: 21.3333px;"><?=$res_partaker['title_name'].$res_partaker['user_fname'];?></td>
    <td style="width:20%;text-align: left;font-size: 21.3333px;"><?=$res_partaker['user_lname'];?></td>
    <td style="width:30%;text-align: left;font-size: 21.3333px;"><?=$res_partaker['position_name'];?></td>    
</tr>
<?php } ?>
</tbody>
</table>
<table style="width: 100%;">
<tbody>
<tr>
    <td style="width:100%;text-align: left;font-size: 21.3333px;" colspan="4">ผู้ไม่มาประชุม</td>
</tr>
<?php $i=1; while($res_partaker = mysqli_fetch_assoc($query_partaker2)){?>
<tr>
    <td style="width:5%;text-align: right;font-size: 21.3333px;"><?=$i++;?></td>
    <td style="width:40%;text-align: left;font-size: 21.3333px;"><?=$res_partaker['title_name'].$res_partaker['user_fname'];?></td>
    <td style="width:20%;text-align: left;font-size: 21.3333px;"><?=$res_partaker['user_lname'];?></td>
    <td style="width:30%;text-align: left;font-size: 21.3333px;"><?=$res_partaker['position_name'];?></td>    
</tr>
<tr>
    <td style="width:5%;text-align: right;font-size: 21.3333px;"></td>
    <td style="width:40%;text-align: left;font-size: 21.3333px;"></td>
    <td style="width:20%;text-align: left;font-size: 21.3333px;"></td>
    <td style="width:30%;text-align: right;font-size: 21.3333px;">( <?=$res_partaker['attendance_note']?> )</td>    
</tr>
<?php } ?>
</tbody>
</table>

<table style="width: 100%;">


    <tbody>
        <?php $i=1;while ($res_agenda = mysqli_fetch_assoc($query_agenda2)) { ?>
            <tr>
                <td  style="width:100%;text-align: left;font-size: 21.3333px;" colspan="2">ระเบียบวาระที่ <?=$i; ?>  <?=$res_agenda['agd_name'] ?> </td>
                
            </tr>
            <?php
            $select_list_agenda ="SELECT lagd_id, lagd_order, lagd_name, lagd_details, agd_id, meeting_id,lagd_status,lagd_note FROM list_agenda  WHERE meeting_id = '$meeting_id'  AND  agd_id = '".$res_agenda['agd_id']."'";
            $query_list_agenda = mysqli_query($conn,$select_list_agenda);
            while ($res_list_agenda = mysqli_fetch_assoc($query_list_agenda)) {
                ?>
                <tr>
                    <td style="width:10%;text-align: left;font-size: 21.3333px;"></td>
                    <td style="font-size: 21.3333px;">
                    
                        <?php if ($res_list_agenda['lagd_order']== 'ไม่มี' OR $res_list_agenda['lagd_order'] == '-') { echo "-";}else{ ?>
                        วาระย่อยที่ <?=$res_list_agenda['lagd_order'].' '.$res_list_agenda['lagd_name'].'<br/>' ?>                        
                        <div style="width: 100%;overflow:wrap;margin-left: 40px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=str_replace('<br/>','<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$res_list_agenda['lagd_details']);  ?></div>
                        <?php }?>
                    </td>
                </tr>
                <?php if($res_list_agenda['lagd_note'] !=''){ ?>
                <tr>
                    <td style="width:10%;text-align: left;font-size: 21.3333px;"></td>
                    <td style="font-size: 21.3333px;"><div style="width: 100%;overflow:wrap;margin-left: 40px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=str_replace('<br/>','<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$res_list_agenda['lagd_note']);  ?></div></td>
                    
                </tr>
                <?php } if ($res_list_agenda['agd_id'] != 5 && ($res_list_agenda['lagd_order']!= 'ไม่มี' OR $res_list_agenda['lagd_order'] != '-')) {?>

                <tr>
                    <td style="width:10%;text-align: left;font-size: 21.3333px;"colspan="2">มติ <?=mati($res_list_agenda['agd_id'],$res_list_agenda['lagd_status'])?></td>
                    <
                </tr>
                <?php }?>
            <?php } $i++;} ?>
        </tbody>
    </table>
    <div style="width: 100%;text-align: center;font-size: 21.3333px;">................................................................................................................................................................</div>

    <?php
    $html=ob_get_contents();
    ob_end_clean();
    $mpdf->WriteHTML($html,2);
    $mpdf->Output('รายงานการประชุม'.$res_meeting['meeting_name'].' ครั้งที่ '.$res_meeting['meeting_terms'].' ประจำปี '.$res_meeting['meeting_BE'].".pdf",'I');
    $mpdf->Output();
    ?>