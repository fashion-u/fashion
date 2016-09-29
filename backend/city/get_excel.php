<?php
header ('Content-Type: text/html; charset=utf8');
include('../../config.php');
include('../config.php');

$pp = DB_PREFIX;

$sql = 'SELECT 	*
                FROM '.DB_PREFIX.'citys
                ORDER BY CityLable ASC;';
$citys = $mysqli->query($sql) or die($sql);

require_once ('../libs/docs/PHPExcel/IOFactory.php');

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Fashion")
	 ->setLastModifiedBy("Fashion")
	 ->setTitle("Fashion")
	 ->setSubject("Fashion")
	 ->setDescription("Fashion");

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()
	->setTitle('Sheet1')
	->setCellValue('A1', "CityID")
	->setCellValue('B1', "Domain")
	->setCellValue('C1', "CityLable")
	->setCellValue('D1', "CityLableKuda")
	->setCellValue('E1', "CityLablePoChemu")
	->setCellValue('F1', "CityLableChego")
    ->setCellValue('G1', "Region")
    ->setCellValue('H1', "poRegionu")
    ->setCellValue('I1', "ChegoRegiona")
    ->setCellValue('J1', "People")
    ->setCellValue('K1', "LitlleCity")
    ->setCellValue('L1', "KodGoroda")
    ->setCellValue('M1', "Population");
	
$objPHPExcel->getActiveSheet()->getStyle('A1:AA1')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(35);


// Пишем основные данные
$L = 2;
while($row = $citys->fetch_assoc()){
   
	//$objPHPExcel->getActiveSheet()->setCellValueExplicit('A'.$L, $Product['id'], PHPExcel_Cell_DataType::TYPE_STRING);
	//$objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$L, $Product['model'], PHPExcel_Cell_DataType::TYPE_STRING);
	
    $objPHPExcel->getActiveSheet()
	            ->setCellValue('A'.$L, $row["CityID"])
                ->setCellValue('B'.$L, $row["Domain"])
                ->setCellValue('C'.$L, $row["CityLable"])
                ->setCellValue('D'.$L, $row["CityLableKuda"])
                ->setCellValue('E'.$L, $row["CityLablePoChemu"])
                ->setCellValue('F'.$L, $row["CityLableChego"])
                ->setCellValue('G'.$L, $row["Region"])
                ->setCellValue('H'.$L, $row["poRegionu"])
                ->setCellValue('I'.$L, $row["ChegoRegiona"])
                ->setCellValue('J'.$L, $row["People"])
                ->setCellValue('K'.$L, $row["LitlleCity"])
                ->setCellValue('L'.$L, $row["KodGoroda"])
                ->setCellValue('M'.$L, $row["Population"])
                ;
	$L++;
}

		
//Данные

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('../tmp/Fashion-citys.xls');


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Fashion-citys.xls');
header('Cache-Control: max-age=0');
readfile('../tmp/Fashion-citys.xls');
unlink('../tmp/Fashion-citys.xls');

?>