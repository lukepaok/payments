<?php
/* ----------------------------------------------------------------------------------------------------------------------------
    PAYROLL
    Rep_logo_head.inc
    03-13/02/2013
   ---------------------------------------------------------------------------------------------------------------------------- */
if ($PaperSize == 'A4_P') {
  $FontSize_Logo=9;
  $XPos_Logo  = 145;
  $XPos_Logo1 = 145;
  $XPos_Logo2 = 275;
  $YPos_Logo  = $YPos;
  $Ypos_Next  = $Page_Height - $Top_Margin - 70;
  }
elseif ($PaperSize == 'A3_L') {
  $FontSize_Logo=10;
  $XPos_Logo  = 155;
  $XPos_Logo1 = 20;
  $XPos_Logo2 = 250;
  $YPos_Logo  = $YPos+20;
  $Ypos_Next  = $Page_Height - $Top_Margin - 50;
}
else {
  $FontSize_Logo=9;
  $XPos_Logo  = 145;
  $XPos_Logo1 = 10;
  $XPos_Logo2 = 275;
  $YPos_Logo  = $YPos;
  $Ypos_Next  = $Page_Height - $Top_Margin - 70;
}

if ($Logo_head_print==2 && $PageNumber>1 ) {
  $YPos = $Page_Height - $Top_Margin + 10;
  $pdf->setFont('arial');
  $XPos = $Page_Width-$Right_Margin-60;
  $pdf->addText($XPos, $YPos+10,$FontSize_Logo-2, date('d-m-Y'));
  $XPos = $Page_Width-$Right_Margin-60;
  $pdf->addText($XPos, $YPos,$FontSize_Logo-2,_('Σελίδα').': '.$PageNumber);
}
else {
  $pdf->addJpegFromFile('images/Ethnosimo.jpg',$XPos_Logo,$YPos_Logo,0,19);
  $pdf->setFont('timesbold');
  $pdf->addTextWrap($XPos_Logo1, $YPos_Logo-10, 300, $FontSize_Logo, $Sign_L1[$_SESSION['ForeasID']], 'center');
  $pdf->addTextWrap($XPos_Logo2, $YPos_Logo-15, $Page_Width-$Right_Margin-400, $FontSize_Logo+6, _($ReportTitle), 'center');
  $pdf->addTextWrap($XPos_Logo1, $YPos_Logo-20, 300, $FontSize_Logo, $Sign_L2[$_SESSION['ForeasID']], 'center');
  $pdf->addTextWrap($XPos_Logo1, $YPos_Logo-30, 300, $FontSize_Logo,$Sign_L3[$_SESSION['ForeasID']], 'center');
  $pdf->addTextWrap($XPos_Logo2, $YPos_Logo-30, $Page_Width-$Right_Margin-400,$FontSize_Logo+2, _($ReportTitle2), 'center');
  $pdf->addTextWrap($XPos_Logo1, $YPos_Logo-40, 300, $FontSize_Logo,$Sign_L4[$_SESSION['ForeasID']], 'center');
  $pdf->addTextWrap($XPos_Logo2, $YPos_Logo-42, $Page_Width-$Right_Margin-400,$FontSize_Logo, _($ReportTitle3), 'center');
  $pdf->addTextWrap($XPos_Logo1, $YPos_Logo-50,  300, $FontSize_Logo,$Sign_L5[$_SESSION['ForeasID']], 'center');
  $pdf->setFont('arial');
  $XPos = $Page_Width-$Right_Margin-60;
  $pdf->addText($XPos, $YPos-30,$FontSize_Logo-2, date('d-m-Y'));
  $XPos = $Page_Width-$Right_Margin-60;
  $pdf->addText($XPos, $YPos-40,$FontSize_Logo-2,_('Σελίδα').': '.$PageNumber);
  $YPos = $Ypos_Next;
}
?>