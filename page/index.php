<?php 
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
ob_start();

?>

<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Title Page</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100&display=swap" rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
 		<!--[if lt IE 9]>
 			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
 			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
 		<![endif]-->
 	</head>
 	<style>
 		body{
 			font-family: 'Sarabun', sans-serif;
 		}
 		
 	</style>
 	<body>
 		<h1 class="text-center">Hello World</h1>
 		<!-- <table class="table table-hover">
 			<thead>
 				<tr>
 					<th></th>
 					<th></th>
 					<th></th>
 					<th></th>
 				</tr>
 			</thead>
 			<tbody>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>

 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>
 				<tr>
 					<td>กดืก้ดีรด</td>
 					<td>หกหกหกหก</td>
 					<td>กดกดกด</td>
 					<td>หกดหกดกดด</td>
 				</tr>

 			</tbody>
 		</table> -->
 		<a href="mpdf.pdf"  class="btn btn-primary">Downlode เอกสาร</a>	
 		<?php
 		$html=ob_get_contents();
 		$mpdf->WriteHTML($html);
 		$mpdf->Output("mpdf.pdf");
 		ob_end_flush();
 		?>
 		

 	</body>
 	<!-- jQuery -->
 	<script src="//code.jquery.com/jquery.js"></script>
 	<!-- Bootstrap JavaScript -->
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
 	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 	</html>