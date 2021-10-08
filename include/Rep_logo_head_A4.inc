<?php
/* ----------------------------------------------------------------------------------------------------------------------------
    PAYROLL
    Rep_logo_head_A4.inc
    02-18/10/2010
   ---------------------------------------------------------------------------------------------------------------------------- */
$FontSize_Logo=9;





if ($Logo_head_print==2 && $PageNumber>1 ) {
  $YPos = $Page_Height - $Top_Margin + 10;
  $pdf->setFont('arial');
  $XPos = $Page_Width-$Right_Margin-60;
  $pdf->addText($XPos, $YPos+10,$FontSize_Logo-2, date('d-m-Y'));
  $XPos = $Page_Width-$Right_Margin-60;
  $pdf->addText($XPos, $YPos,$FontSize_Logo-2,_('Σελίδα').': '.$PageNumber);
}
else {
  $pdf->addJpegFromFile('images/Ethnosimo.jpg',$Left_Margin+95,$YPos,0,19);
  $pdf->setFont('timesbold');
  $pdf->addTextWrap($Left_Margin-15, $YPos-$FontSize_Logo, 240, $FontSize_Logo, $Sign_L1[1], 'center');
  $pdf->addTextWrap($Left_Margin+230, $YPos-15, $Page_Width-$Right_Margin-250, $FontSize_Logo+3, _($ReportTitle), 'center');
  $pdf->addTextWrap($Left_Margin-15, $YPos-2*$FontSize_Logo, 240, $FontSize_Logo, $Sign_L2[1], 'center');
  $pdf->addTextWrap($Left_Margin-15, $YPos-3*$FontSize_Logo, 240, $FontSize_Logo,$Sign_L3[1], 'center');
  $pdf->addTextWrap($Left_Margin+230, $YPos-30, $Page_Width-$Right_Margin-250,$FontSize_Logo+1, _($ReportTitle2), 'center');
  $pdf->addTextWrap($Left_Margin-15, $YPos-4*$FontSize_Logo, 240, $FontSize_Logo,$Sign_L4[1], 'center');
  $pdf->addTextWrap($Left_Margin+230, $YPos-45, $Page_Width-$Right_Margin-250,$FontSize_Logo+1, _($ReportTitle3), 'center');
  $pdf->addTextWrap($Left_Margin-15, $YPos-5*$FontSize_Logo,  240, $FontSize_Logo,$Sign_L5[1], 'center');
  $pdf->setFont('arial');
  if ($Head_Page_Date!='no') {
    $XPos = $Page_Width-$Right_Margin-60;
    $pdf->addText($XPos, $YPos-50,$FontSize_Logo-2, date('d-m-Y'));
    $XPos = $Page_Width-$Right_Margin-60;
    $pdf->addText($XPos, $YPos-60,$FontSize_Logo-2,_('Σελίδα').': '.$PageNumber);
    $YPos = $Page_Height - $Top_Margin - 70;
  }
}
?>