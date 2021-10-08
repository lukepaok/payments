<?php
/* --------------------------------------------------------------
    PAYROLL
    Rep_Create_PDF.php
    02-30/06/2012
    include:
   -------------------------------------------------------------- */
//include ($HeaderFile);
$Diax_line='- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - '.
           '- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -';
unset($MasterTable);
$MasterTable = array();
fillMasterTable();
$TotalSums = array();
$AccumTotalDetail =0;
if ($Analysi_Efim == 'YES') {
  $Sum_Energ  = array_fill(0, 5, 0);
  $Sum_Mikt   = array_fill(0, 5, 0);
  $Sum_Etoim  = array_fill(0, 5, 0);
  $Efim_name  = array(0=>'Κ:',1=>'Σ:',2=>'Κ/Α:',3=>'Α:',4=>'Α/Α:');
}
if ($Rep_Type==1) {
  foreach ($MasterTable as $myrow) {
    set_time_limit(0);
    unset($DetailTable);
    $DetailTable = array();
    $Errors_msg=array();
    $ReportPageTitle=$myrow['PAY_COMMENTS'];
    include ($HeaderFile);
    fillDetailTable($myrow);
    if (count($DetailTable)==0)  continue;
    $Print_poso=0;
    foreach ($DetailTable as $DetailRow) {
      if ($Analysi_Efim == 'YES') {
        $Sum_Energ[0] += $DetailRow['ANALEK'];
        $Sum_Energ[1] += $DetailRow['ANALES'];
        $Sum_Energ[2] += $DetailRow['ANALEX'];
        $Sum_Energ[3] += $DetailRow['ANALEA'];
        $Sum_Energ[4] += $DetailRow['ANALEZ'];
        $Sum_Mikt[0]  += $DetailRow['ANALMK'];
        $Sum_Mikt[1]  += $DetailRow['ANALMS'];
        $Sum_Mikt[2]  += $DetailRow['ANALMX'];
        $Sum_Mikt[3]  += $DetailRow['ANALMA'];
        $Sum_Mikt[4]  += $DetailRow['ANALMZ'];
        $Sum_Etoim[0] += $DetailRow['ANALTK'];
        $Sum_Etoim[1] += $DetailRow['ANALTS'];
        $Sum_Etoim[2] += $DetailRow['ANALTX'];
        $Sum_Etoim[3] += $DetailRow['ANALTA'];
        $Sum_Etoim[4] += $DetailRow['ANALTZ'];
      }
      if ($Compute_Payroll==1) { $Print_poso += $DetailRow['T_EKKATHARISMENO']; }   // EPO ENTELOMENO EGINE EKATHARISMENO GIATI EKATHARISMENO=ENTELOMENO-KATALOGISMOS
      elseif ($Compute_Payroll==2) { $Print_poso += $DetailRow['A_ENTELOM']; }
	  if ($FieldCheck1==1) {
	  require_once ('include/Analysi_Anadromikon_new.inc');
      $YPos -= 0.4*$line_height;
      include ('include/Analysi_Anadromikon_new.php');
	  $YPos=$YPos-15;
    }
      elseif (in_array($Compute_Payroll,array('4','7'))) { $Print_poso += $DetailRow['P_ENTELOM']; }
	  elseif (in_array($Compute_Payroll,array('10','12'))) { $Print_poso += $DetailRow['C_ENTELOM']; }
	  
	
      for ($j=1;$j<=$Print_lines;$j++) {
	  
        $i=0;
        $RepLMargin = $Left_Margin;
        foreach( $Det_Head[$j] AS $myText ) {
          if (($RepLMargin+5+$Det_Width[$j][$i])<($Page_Width-$Right_Margin)) {
            if ($Det_Type[$j][$i]=='DATE')     { $pdf->addTextWrap($RepLMargin+5,$YPos,$Det_Width[$j][$i],$FontSize,ConvertSQLDate($DetailRow[$Det_Name[$j][$i]]),'left'); }
            elseif ($Det_Type[$j][$i]=='CURRENCY') { $pdf->addTextWrap($RepLMargin+5,$YPos,$Det_Width[$j][$i],$FontSize,number_format($DetailRow[$Det_Name[$j][$i]],2,',','.'),'right'); }
            elseif ($Det_Type[$j][$i]=='CENTER')   { $pdf->addTextWrap($RepLMargin+5,$YPos,$Det_Width[$j][$i],$FontSize,$DetailRow[$Det_Name[$j][$i]],'center'); }
            elseif ($Det_Type[$j][$i]=='RIGHT')    { $pdf->addTextWrap($RepLMargin+5,$YPos,$Det_Width[$j][$i],$FontSize,$DetailRow[$Det_Name[$j][$i]],'right'); }
            elseif ($Det_Type[$j][$i]=='RED') {
              $pdf->SetTextColor(255,0,0);
              $pdf->addTextWrap($RepLMargin+5,$YPos,$Det_Width[$j][$i],$FontSize,$DetailRow[$Det_Name[$j][$i]],'left');
              $pdf->SetTextColor(0,0,0);
            }
            else { $pdf->addTextWrap($RepLMargin+5,$YPos,$Det_Width[$j][$i],$FontSize,$DetailRow[$Det_Name[$j][$i]],'left'); }
            $RepLMargin = $RepLMargin+$Det_Width[$j][$i];
            if (in_array($Det_Name[$j][$i],$Det_Sum[$j])) { $TotalSums[$Det_Name[$j][$i]] = $TotalSums[$Det_Name[$j][$i]] + $DetailRow[$Det_Name[$j][$i]]; }
          }
          $i++;
        }
        $YPos -= ($Line_Height);
      }
      if ($HG_Line==1) { $pdf->line($Left_Margin+5, $YPos+8,$Page_Width-$Right_Margin-$Left_Margin, $YPos+8); }
      $YPos -= 0.5*($Line_Height);
      if ($YPos - (($Print_lines-1) * $Line_Height) < $Bottom_Margin) {
        $PageNumber++;
        include ($HeaderFile);
      }
      $AccumTotalDetail++;
    }
    if ($HG_Line!=1) { $pdf->line($Left_Margin+5, $YPos+8,$Page_Width-$Right_Margin-$Left_Margin, $YPos+8); }
    if (count($DetailTable)>0 && $Gen_Sums!='NO') {
      //SUMS
      $YPos -= 0.4*($Line_Height);
      $RepLMargin = $Left_Margin;
      $pdf->addTextWrap($RepLMargin+50,$YPos,200,$FontSize+4,_('Σύνολα'), 'left');
      $YPos -= 0.3*($Line_Height);
      $pdf->SetDrawColor(220);
      $pdf->line($Left_Margin+5, $YPos, $Page_Width-$Right_Margin-$Left_Margin, $YPos);
      $pdf->SetDrawColor(0);
//           $pdf->line($Left_Margin+5, $YPos,$Page_Width-$Right_Margin-$Left_Margin, $YPos);
      $YPos -= 1.2*$Line_Height;
      for ($j=1;$j<=$Print_lines;$j++) {
        $i=0;
        $RepLMargin = $Left_Margin;
        foreach( $Det_Head[$j] AS $myText ) {
          if (($RepLMargin+5+$Det_Width[$j][$i])<($Page_Width-$Right_Margin)) {
            if (in_array($Det_Name[$j][$i],$Det_Sum[$j])) {
              if ($Det_Type[$j][$i]=='CURRENCY') { $pdf->addTextWrap($RepLMargin+5,$YPos,$Det_Width[$j][$i],$FontSize,number_format($TotalSums[$Det_Name[$j][$i]],2,',','.'),'right'); }
              else { $pdf->addTextWrap($RepLMargin+5,$YPos,$Det_Width[$j][$i],$FontSize,$TotalSums[$Det_Name[$j][$i]],'left'); }
            }
            $RepLMargin = $RepLMargin+$Det_Width[$j][$i];
          }
          $i++;
        }
        $YPos -= ($Line_Height);
      }
      $YPos += 0.8*($Line_Height);
      $pdf->line($Left_Margin+5, $YPos,$Page_Width-$Right_Margin-$Left_Margin, $YPos);
    }
    $YPos -= 1.3*($Line_Height);
    if ($YPos - (2 * $Line_Height) < $Bottom_Margin) {
      $PageNumber++;
      include ($HeaderFile);
    }
    $pdf->addTextWrap($Left_Margin+35,$YPos,100,$FontSize,_('Πλήθος Εγγραφών'), 'left');
    $pdf->addTextWrap($Left_Margin+135,$YPos,80,$FontSize,$AccumTotalDetail, 'left');
    $YPos -= 0.8*($Line_Height);
    $pdf->line($Left_Margin+5, $YPos,$Page_Width-$Right_Margin-$Left_Margin, $YPos);
    $PageNumber++;
  }
  if ($YPos - (12 * $Line_Height) < $Bottom_Margin) {
    $PageTitles='no';
    include ($HeaderFile);
  }
  if ($LastFile!='') { include $LastFile; }
  if ($YPos - (12 * $Line_Height) < $Bottom_Margin) {
    $PageTitles='no';
    include ($HeaderFile);
  }
  if ($Print_poso>0) {
    $YPos -= 3*($Line_Height);
    $pdf->addTextWrap($Left_Margin+100,$YPos,500,$FontSize,$Text_Line.number_format($Print_poso,2,',','.'), 'left');
    $funcsql = "SELECT NumToWord(".$Print_poso.") AS POSO FROM DUAL";
    $funcres = DB_query($funcsql, $db);
    $funcrow = DB_fetch_array($funcres);
    $Ologr   = $funcrow['POSO'];
    $YPos -= 1.5*$Line_Height;
    $pdf->addTextWrap($Left_Margin+100,$YPos,500,$FontSize,"( ".$Ologr." )", 'left');
    $YPos -= 2*$Line_Height;
    if ($SignFile!='') {
      include 'params/signs/'.$SignFile;
      $pdf->addTextWrap($Left_Margin+30,$YPos,$Page_Width-$Right_Margin-50,$FontSize,$Line1, 'left');
      $YPos -= $Line_Height;
      $pdf->addTextWrap($Left_Margin+30,$YPos,$Page_Width-$Right_Margin-50,$FontSize,$Line2, 'left');
      $YPos -= $Line_Height;
      $pdf->addTextWrap($Left_Margin+30,$YPos,$Page_Width-$Right_Margin-50,$FontSize,$Line3, 'left');
      $YPos -= $Line_Height;
      $pdf->addTextWrap($Left_Margin+30,$YPos,$Page_Width-$Right_Margin-50,$FontSize,$Line4, 'left');
      $YPos -= $Line_Height;
      $pdf->addTextWrap($Left_Margin+30,$YPos,$Page_Width-$Right_Margin-50,$FontSize,$Line5, 'left');
      $YPos -= $Line_Height;
      $pdf->addTextWrap($Left_Margin+30,$YPos,$Page_Width-$Right_Margin-50,$FontSize,$Line6, 'left');
      $YPos -= $Line_Height;
      $pdf->addTextWrap($Left_Margin+30,$YPos,$Page_Width-$Right_Margin-50,$FontSize,$Line7, 'left');
    }
    else {
      $pdf->addTextWrap($Left_Margin+30,$YPos,300,$FontSize,$Edra, 'left');
      $pdf->addTextWrap($Left_Margin+100,$YPos,300,$FontSize,$Ekathar_Title, 'center');
      $pdf->addTextWrap($Left_Margin+400,$YPos,300,$FontSize,$Diefth_Title, 'center');
      $pdf->addTextWrap($Left_Margin+800,$YPos,300,$FontSize,$Logist_Title, 'center');
      $YPos -= $Line_Height;
      $pdf->addTextWrap($Left_Margin+30,$YPos,100,$FontSize,date('d-n-Y'), 'left');
      $YPos -= 6*$Line_Height;
      $pdf->addTextWrap($Left_Margin+100,$YPos,300,$FontSize,$Ekathar_Sign, 'center');
      $pdf->addTextWrap($Left_Margin+400,$YPos,300,$FontSize,$Diefth_Sign, 'center');
      $pdf->addTextWrap($Left_Margin+800,$YPos,300,$FontSize,$Logist_Sign, 'center');
    }
  }
}
elseif ($Rep_Type==2) {
  foreach ($MasterTable as $myrow) {
    set_time_limit(0);
    unset($DetailTable);
//    unset($DetailTable2);
    $DetailTable = array();
    $ReportPageTitle=$myrow['PAY_COMMENTS'];
    include ($HeaderFile);
//    $DetailTable2 = array();
    fillDetailTable($myrow);
    if (count($DetailTable)==0)  continue;
    $AccumTotalDetail =0;
    $DetailSums=array();
//    $YPos -= 0.3*$Line_Height;
//    $i=0;
//    $RepLMargin = $Left_Margin;
//    foreach( $Mast_Head AS $myText ) {
//      $pdf->addTextWrap($RepLMargin+5,$YPos,$Mast_Width[$i],$FontSize,$Mast_Head[$i].': '.$myrow[$Mast_Name[$i]], 'left');
//      $RepLMargin = $RepLMargin+$Mast_Width[$i];
//      if (($RepLMargin+5+$Mast_Width[$i])>($Page_Width-$Right_Margin)) {
//        $RepLMargin = $Left_Margin;
//        $YPos -= ($Line_Height);
//      }
//      $i++;
//    }
//    $YPos -= ($Line_Height);
//    $pdf->addTextWrap($Left_Margin, $YPos, $Page_Width-$Right_Margin-$Left_Margin-15, $FontSize, $Diax_line, 'L');
//    if ($YPos - (2 *$Line_Height) < $Bottom_Margin){
//      $PageNumber++;
//      include ($HeaderFile);
//    }

    // Print The Header
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
    $pdf->SetDrawColor(200);
    $YPos -= 0.3*$Line_Height;
//    $YPos -= ($Line_Height);
//    $pdf->addTextWrap($Left_Margin, $YPos, $Page_Width-$Right_Margin-$Left_Margin-15, $FontSize, $Diax_line, 'L');
    $pdf->line($Left_Margin+5, $YPos, $Page_Width-$Right_Margin-$Left_Margin, $YPos);
    $pdf->SetDrawColor(0);
    $YPos -= ($Line_Height);
    if ($YPos - (2 *$Line_Height) < $Bottom_Margin){
      $PageNumber++;
      include ($HeaderFile);
    }

    // Print The Header
//    $YPos -= ($Line_Height);
    $i=0;
    $myLeftMargin = $Left_Margin;
    foreach( $Det_Head AS $myText ) {
      if (($myLeftMargin+5+$Det_Width[$i])<($Page_Width-$Right_Margin)) {
        $pdf->addTextWrap($myLeftMargin+5,$YPos,$Det_Width[$i],$FontSize,$myText, 'left');
        $myLeftMargin = $myLeftMargin+$Det_Width[$i];
      }
      $i++;
    }
    $YPos -= 0.5*$Line_Height;
//    $pdf->SetDrawColor(200);
    $pdf->addTextWrap($Left_Margin, $YPos, $Page_Width-$Right_Margin-$Left_Margin-15, $FontSize, $Diax_line, 'L');
//    $pdf->line($Left_Margin+5, $YPos, $Page_Width-$Right_Margin-$Left_Margin, $YPos);
//    $pdf->SetDrawColor(0);
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
  if ($SignFile!='') { 'include/signs/'.$SignFile; }
}
elseif ($Rep_Type==3) {
  unset($DetailTable);
  $DetailTable = array();
  $ReportPageTitle=$myrow['PAY_COMMENTS'];
  include ($HeaderFile);
  fillDetailTable($myrow);
  if (count($DetailTable)==0)  continue;
//echo "<pre>";print_r($DetailTable).'ddd<BR>'; echo "</pre>";die();
  foreach ($DetailTable as $DetailRow) {
    set_time_limit(0);
    for ($j=1;$j<=$Print_lines;$j++) {
      $i=0;
      $RepLMargin = $Left_Margin;
      foreach( $Det_Head[$j] AS $myText ) {
        if (($RepLMargin+5+$Det_Width[$j][$i])<($Page_Width-$Right_Margin)) {
          if ($Det_Type[$j][$i]=='DATE')     { $pdf->addTextWrap($RepLMargin+5,$YPos,$Det_Width[$j][$i],$FontSize,ConvertSQLDate($DetailRow[$Det_Name[$j][$i]]),'left'); }
          elseif ($Det_Type[$j][$i]=='CURRENCY') { $pdf->addTextWrap($RepLMargin+5,$YPos,$Det_Width[$j][$i],$FontSize,number_format($DetailRow[$Det_Name[$j][$i]],2,',','.'),'right'); }
          else { $pdf->addTextWrap($RepLMargin+5,$YPos,$Det_Width[$j][$i],$FontSize,$DetailRow[$Det_Name[$j][$i]],'left'); }
          $RepLMargin = $RepLMargin+$Det_Width[$j][$i];
          if (in_array($Det_Name[$j][$i],$Det_Sum[$j])) { $TotalSums[$Det_Name[$j][$i]] = $TotalSums[$Det_Name[$j][$i]] + $DetailRow[$Det_Name[$j][$i]]; }
        }
        $i++;
      }
      $YPos -= ($Line_Height);
    }
    if ($HG_Line==1) {
      $pdf->line($Left_Margin+5, $YPos+8,$Page_Width-$Right_Margin-$Left_Margin, $YPos+8);
      $YPos -= 0.5*($Line_Height);
    }
    else {
      if ($Space_Line==1) { $YPos -= 0.5*($Line_Height); }
      else { $YPos += 0.2*($Line_Height); }
    }
    if ($YPos - (($Print_lines-1) * $Line_Height) < $Bottom_Margin) {
      $PageNumber++;
      include ($HeaderFile);
    }
    $AccumTotalDetail++;
  }
  if ($HG_Line!=1) { $pdf->line($Left_Margin+5, $YPos+8,$Page_Width-$Right_Margin-$Left_Margin, $YPos+8); }
  if (count($DetailTable)>0) {
    //SUMS
    $YPos -= 0.4*($Line_Height);
    $RepLMargin = $Left_Margin;
    $pdf->addTextWrap($RepLMargin+50,$YPos,200,$FontSize+4,_('Σύνολα'), 'left');
    $YPos -= 0.3*($Line_Height);
    $pdf->SetDrawColor(220);
    $pdf->line($Left_Margin+5, $YPos, $Page_Width-$Right_Margin-$Left_Margin, $YPos);
    $pdf->SetDrawColor(0);
//           $pdf->line($Left_Margin+5, $YPos,$Page_Width-$Right_Margin-$Left_Margin, $YPos);
    $YPos -= 1.2*$Line_Height;
    for ($j=1;$j<=$Print_lines;$j++) {
      $i=0;
      $RepLMargin = $Left_Margin;
      foreach( $Det_Head[$j] AS $myText ) {
        if (($RepLMargin+5+$Det_Width[$j][$i])<($Page_Width-$Right_Margin)) {
          if (in_array($Det_Name[$j][$i],$Det_Sum[$j])) {
            if ($Det_Type[$j][$i]=='CURRENCY') { $pdf->addTextWrap($RepLMargin+5,$YPos,$Det_Width[$j][$i],$FontSize,number_format($TotalSums[$Det_Name[$j][$i]],2,',','.'),'right'); }
            else { $pdf->addTextWrap($RepLMargin+5,$YPos,$Det_Width[$j][$i],$FontSize,$TotalSums[$Det_Name[$j][$i]],'left'); }
          }
          $RepLMargin = $RepLMargin+$Det_Width[$j][$i];
        }
        $i++;
      }
      $YPos -= ($Line_Height);
    }
    $YPos += 0.8*($Line_Height);
    $pdf->line($Left_Margin+5, $YPos,$Page_Width-$Right_Margin-$Left_Margin, $YPos);
  }
  $YPos -= 1.3*($Line_Height);
  if ($YPos - (2 * $Line_Height) < $Bottom_Margin) {
    $PageNumber++;
    include ($HeaderFile);
  }
  $pdf->addTextWrap($Left_Margin+35,$YPos,100,$FontSize,_('Πλήθος Εγγραφών'), 'left');
  $pdf->addTextWrap($Left_Margin+135,$YPos,80,$FontSize,$AccumTotalDetail, 'left');
  $YPos -= 0.8*($Line_Height);
  $pdf->line($Left_Margin+5, $YPos,$Page_Width-$Right_Margin-$Left_Margin, $YPos);
}

if ($Errors_msg[0]!='') {
  $pdf->newPage();
  $YPos = $Page_Height - $Top_Margin;
  foreach ($Errors_msg as $key=>$value) {
    foreach ($value as $line) {
      $pdf->addText(30, $YPos, 8, $line);
      $YPos -= 9;
      if ($YPos<30) {
        $YPos = $Page_Height - $Top_Margin;
        $pdf->newPage();
      }
    }
//    $pdf->addText(30, $YPos, 8, '----------------------------------------------------------------------');
    $pdf->line($Left_Margin+5, $YPos,$Page_Width-$Right_Margin-$Left_Margin, $YPos);
    $YPos -= 9;
  }
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