<?php
/* --------------------------------------------------------------
    PAYROLL
    Out_Efimeries.php
    01-30/08/2011
    include:
   -------------------------------------------------------------- */
include ($HeaderFile);
$Diax_line='- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -';

unset($MasterTable);
$MasterTable = array();
fillMasterTable();
$MasterSums = array();
$TotalSums = array();
//echo "<pre>";print_r($MasterTable).'ddd<BR>'; echo "</pre>";die();
foreach ($MasterTable as $myrow) {
  set_time_limit(0);
  unset($DetailTable);
//  unset($DetailTable2);
  $DetailTable = array();
//  $DetailTable2 = array();
  fillDetailTable($myrow);
  if (count($DetailTable)==0)  continue;
  $AccumTotalDetail =0;
  $DetailSums=array();
//echo "<pre>";print_r($DetailTable).'ddd<BR>'; echo "</pre>";die();
  $YPos -= 0.3*$Line_Height;
  $i=0;
  $myLeftMargin = $Left_Margin;
  foreach( $Part_Head AS $myText ) {
    $pdf->addTextWrap($myLeftMargin+5,$YPos,$Part_Width[$i],$FontSize,$Part_Head[$i].': '.$myrow[$Part_Name[$i]], 'left');
    $myLeftMargin = $myLeftMargin+$Part_Width[$i];
    if (($myLeftMargin+5+$Part_Width[$i])>($Page_Width-$Right_Margin)) {
      $myLeftMargin = $Left_Margin;
      $YPos -= ($Line_Height);
    }
    $i++;
  }
  $YPos -= ($Line_Height);
  $pdf->addTextWrap($Left_Margin, $YPos, $Page_Width-$Right_Margin-$Left_Margin-15, $FontSize, $Diax_line, 'L');
  if ($YPos - (2 *$Line_Height) < $Bottom_Margin){
    $PageNumber++;
    include ($HeaderFile);
  }

  // Print The Header
  $YPos -= ($Line_Height);
  $i=0;
  $myLeftMargin = $Left_Margin;
  foreach( $Det_Head AS $myText ) {
    if (($myLeftMargin+5+$Det_Width[$i])<($Page_Width-$Right_Margin)) {
      $pdf->addTextWrap($myLeftMargin+5,$YPos,$Det_Width[$i],$FontSize,$myText, 'left');
      $myLeftMargin = $myLeftMargin+$Det_Width[$i];
    }
    $i++;
  }
  $pdf->SetDrawColor(200);
  $pdf->line($Left_Margin+5, $YPos, $Page_Width-$Right_Margin-$Left_Margin, $YPos);
  $pdf->SetDrawColor(0);
  $YPos -= ($Line_Height);
  foreach ($DetailTable as $DetailRow) {
    // Print 1st line
    $i=0;
    $myLeftMargin = $Left_Margin;
    $memoLeftOvers = array();
    unset($memoLeftOvers);
    foreach( $Det_Head AS $myText ) {
      if (($myLeftMargin+5+$Det_Width[$i])<($Page_Width-$Right_Margin)) {
        if     ($Det_Type[$i]=='DATE')     { $LeftOvers = $pdf->addTextWrap($myLeftMargin+5,$YPos,$Det_Width[$i],$FontSize,ConvertSQLDate($DetailRow[$Det_Name[$i]]), 'left'); }
        elseif ($Det_Type[$i]=='MEMO')     { $memoLeftOvers[$i] = $pdf->addTextWrap($myLeftMargin+5,$YPos,$Det_Width[$i],$FontSize,$DetailRow[$Det_Name[$i]], 'left'); }
        elseif ($Det_Type[$i]=='CURRENCY') { $memoLeftOvers[$i] = $pdf->addTextWrap($myLeftMargin+5,$YPos,$Det_Width[$i],$FontSize,number_format($DetailRow[$Det_Name[$i]], 2, ',', '.'), 'right'); }
        elseif ($Det_Type[$i]=='RIGHT') { $LeftOvers[$i] = $pdf->addTextWrap($myLeftMargin+5,$YPos,$Det_Width[$i],$FontSize,$DetailRow[$Det_Name[$i]], 'right'); }
        else { $LeftOvers = $pdf->addTextWrap($myLeftMargin+5,$YPos,$Det_Width[$i],$FontSize,$DetailRow[$Det_Name[$i]], 'left'); }
        $myLeftMargin = $myLeftMargin+$Det_Width[$i];
        if (in_array($Det_Name[$i],$Det_Sum)) {
          $DetailSums[$Det_Name[$i]] = $DetailSums[$Det_Name[$i]] + $DetailRow[$Det_Name[$i]];
          $TotalSums[$Det_Name[$i]] = $TotalSums[$Det_Name[$i]] + $DetailRow[$Det_Name[$i]];
        }
      }
      $i++;
    }
    $YPos -= ($Line_Height);
    if ($YPos - (2 *$Line_Height) < $Bottom_Margin){
      $PageNumber++;
      include ($HeaderFile);
    }
  }
  $pdf->line($Left_Margin+5, $YPos, $Page_Width-$Right_Margin-$Left_Margin, $YPos);
  $YPos -= ($Line_Height);
}
//------------------------------- END OF REPORT ENGINE
$pdfcode = $pdf->output();
$len = strlen($pdfcode);
header('Content-type: application/pdf');
header('Content-Length: ' . $len);
header("Content-Disposition: attachment; filename=Employees.pdf");
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
$pdf->stream();
?>