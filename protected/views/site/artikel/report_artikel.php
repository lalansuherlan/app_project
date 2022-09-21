<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set("Asia/Jakarta");

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
//require_once dirname(__FILE__) . '/class/PHPExcel.php';
require_once('class/PHPExcel.php');

$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Lalan Suherlan")
							->setLastModifiedBy("Lalan Suherlan")
							->setTitle("Data Deposit CA")
							->setSubject("PT. Gerbang Sinergi prima")
							->setDescription("Data Webmon SCA ")
							->setKeywords("PHPExcel php")
							->setCategory("Umum");
							

$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'PROJECT ID')
        ->setCellValue('A2', 'Data Artikel')
        ->setCellValue('A3', 'Tanggal : '.date('Y-m-d'));	
							
// mulai dari baris ke 6
$row = 6;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$row, 'JUDUL')
            ->setCellValue('B'.$row, 'DESKRIPSI')
            ->setCellValue('C'.$row, 'TANGGAL');
			
$style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

$objPHPExcel->getActiveSheet()->getStyle('A6:C6')->applyFromArray($style);		
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(100);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);

$urut = 1;
$k=1;
$row++;

//print_r($rekap['judul']);die;
foreach ($rekap as $rekap) {
	
	$k=$urut+4;
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$row, $rekap['judul'])
            ->setCellValue('B'.$row, $rekap['deskripsi'])
            ->setCellValue('C'.$row, $rekap['tanggal']);		
	$row++;		
	$urut++;
	
}




$last = $k+2; 
$styleArray = array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	)
);

$objPHPExcel->getActiveSheet()->getStyle('A6:C'.$last)->applyFromArray($styleArray);
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('REPORT DATA ARTIKEL');

// Set sheet yang aktif adalah index pertama, jadi saat dibuka akan langsung fokus ke sheet pertama
$objPHPExcel->setActiveSheetIndex(0);




// Simpan ke Excel 2007
/* $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('data.xlsx'); */

// Simpan ke Excel 2003
/* $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('data.xls'); */


// Download (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="REPORT DATA ARTIKEL.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 

$objWriter->save('php://output');
exit;


/* 
// Download (Excel2003)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 

$objWriter->save('php://output');
exit;
 */
?>