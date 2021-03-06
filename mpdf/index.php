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
    return "วันที่ $strDay $strMonthThai $strYear เวลา $strHour:$strMinute น. เป็นต้นไป";
}
ob_start();

?>

<div style="width: 100%;text-align: center;font-size: 21.3333px;"><?=$res_meeting['meeting_name'].' ครั้งที่ '.$res_meeting['meeting_terms'].' ประจำปี '.$res_meeting['meeting_BE'] ?></div>
<div style="width: 100%;text-align: center;font-size: 21.3333px;"><?=DateThai($res_meeting['meeting_date'].' '.$res_meeting['meeting_time']) ?></div>
<div style="width: 100%;text-align: center;font-size: 21.3333px;"><?='ณ ห้อง'.$res_meeting['meeting_room'].' ตึก '.$res_meeting['meeting_building'] ?></div>
<div style="width: 100%;text-align: center;font-size: 21.3333px;">.................................</div>
<table style="width: 100%;">

    <tbody>
        <?php $i=1;while ($res_agenda = mysqli_fetch_assoc($query_agenda)) { ?>
            <tr>
                <td  style="width:30%;text-align: right;font-size: 21.3333px;">ระเบียบวาระที่ <?=$i; ?>  </td>
                <td  style="font-size: 21.3333px;"><?=$res_agenda['agd_name'] ?></td>
            </tr>
            <?php
            $select_list_agenda ="SELECT lagd_id, lagd_order, lagd_name, lagd_details, agd_id, meeting_id FROM list_agenda  WHERE meeting_id = '$meeting_id'  AND  agd_id = '".$res_agenda['agd_id']."'";
            $query_list_agenda = mysqli_query($conn,$select_list_agenda);
            while ($res_list_agenda = mysqli_fetch_assoc($query_list_agenda)) {
                ?>
                <tr>
                    <td></td>
                    <td style="font-size: 21.3333px;">
                        <?=$res_list_agenda['lagd_order'].' '.$res_list_agenda['lagd_name'].'<br/>'?>
                        <div style="width: 100%;overflow:wrap;margin-left: 40px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=str_replace('<br/>','<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$res_list_agenda['lagd_details']);  ?></div>

                    </td>
                </tr>
            <?php } $i++;} ?>
        </tbody>
    </table>
    <div style="width: 100%;text-align: center;font-size: 21.3333px;">.................................</div>

    <?php
    $html=ob_get_contents();
    ob_end_clean();
    $mpdf->WriteHTML($html,2);
    $mpdf->Output("mpdf.pdf",'I');
    $mpdf->Output();
    ?>