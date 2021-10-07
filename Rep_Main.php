<?php
/* --------------------------------------------------------------
    PAYROLL
    Rep_Main.php
    01-29/10/2011
    include:
   -------------------------------------------------------------- */



$empwhere='';
$emporder='';
include ('include/Rep_sql_where.php');
if ($Periods == 1) {
  $PatTo=$PatFrom;
  $PatYearFrom=$PatYear;
  $PatYearTo=$PatYear;
}

  if ($HeaderFile == '') { $HeaderFile = 'include/Rep_Page_Header.inc'; }
  include('include/PDFStarter.php');
  $pdf->addinfo('Title',_($ReportTitle));
  if ($New_Left_Margin>0)  { $Left_Margin = $New_Left_Margin; }
  if ($New_Right_Margin>0) { $Right_Margin = $New_Right_Margin; }
  $PageNumber   =  1;
  $Line_Height  = $FontSize+1;
  if (isset($CreateFile)) {
    if ($CreateFile == '') { include ('include/Rep_Create_PDF.php'); }
    elseif ($CreateFile == 'self') { }
    else { include ($CreateFile); }
  }
  else { include ('include/Rep_Create_PDF.php'); }


?>