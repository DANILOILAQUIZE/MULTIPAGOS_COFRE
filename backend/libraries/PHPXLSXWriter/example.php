<?php
include_once("xlsxwriter.class.php");
include '../../classes/class.repositorio.php';

  ini_set('display_errors', 0);
  ini_set('log_errors', 1);
  error_reporting(E_ALL & ~E_NOTICE);

  $filename = 'Reporte Movimientos Plano Cultivo.xlsx';
  header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
  header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
  header('Content-Transfer-Encoding: binary');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');

  $repositorio = new Repositorio;
  $conec = $repositorio->connectDB(); 

  $header = array("string", "string", "string", "string", "string", "string", "string", "string", "string");
  $sheet_name = 'Hoja1';
  $writer = new XLSXWriter();
  $writer->writeSheetHeader($sheet_name, $header, $suppress_header_row = true);
  $writer->writeSheetRow($sheet_name, array('REPORTE MOVIMIENTOS PLANO CULTIVO (DESDE '.$_GET['fInicio'].' HASTA '.$_GET['fFin'].')'));
  $writer->writeSheetRow($sheet_name, array('Fecha Edicion','Finca','Bloque','Variedad','Plantas','Metros','Camas','Estado','Fecha Estado'));
  $sql = "SELECT cp.FechaEdicion,f.Finca,b.Bloque,v.Variedad,cp.Plantas,cp.Metros,cp.Camas,cp.Estado,cp.FechaEstado FROM cul_planocultivo_log cp, fincas f, cul_bloques b, variedades v WHERE cp.FechaEdicion BETWEEN '2021-12-01' AND '2021-12-14' AND cp.Finca=f.Id AND cp.Bloque=b.Id AND cp.Variedad=v.Id ORDER BY cp.IdRegistro ASC, cp.FechaEdicion DESC, cp.Id ASC";
  $cons = $conec->query($sql);
  while($resp = $cons->fetch_assoc()){
    $writer->writeSheetRow($sheet_name, array($resp['FechaEdicion'],$resp['Finca'],$resp['Bloque'],$resp['Variedad'],$resp['Plantas'],$resp['Metros'],$resp['Camas'],$resp['Estado'],$resp['FechaEstado']));
  }
  $writer->markMergedCell($sheet_name, $start_row = 0, $start_col = 0, $end_row = 0, $end_col = 8);
  $writer->writeToStdOut();
  exit(0);


