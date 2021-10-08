<?php
/* ----------------------------------------------------------------------------------------------------------------------------
    PAYROLL
    Rep_Page_Header.inc
    01
    include:
   ---------------------------------------------------------------------------------------------------------------------------- */
if ($PageNumber>1) { $pdf->newPage(); }
$YPos = $Page_Height - $Top_Margin;
if ($PageTitles!='no') {
  if ($PageLogo!='no') { include('include/Rep_logo_head.inc'); }
  if ($Rep_Type==1 || $Rep_Type==2) {
    $FontSize=10;
    $myLeftMargin = $Left_Margin+5;
    $pdf->addTextWrap($myLeftMargin,$YPos,500,$FontSize,$ReportPageTitle, 'left');
    $FontSize=8;
    $XPos = $Left_Margin;
    $YPos -= 0.3*$Line_Height;
    $pdf->line($myLeftMargin-5, $YPos,$Page_Width-$Right_Margin-$Left_Margin+5, $YPos);
    $YPos -= $Line_Height;
    if ($Rep_Type==1) {
      for ($j = 1; $j <=$Print_lines; $j++)  {
        $i=0;
        $myLeftMargin = $Left_Margin+5;
        foreach( $Det_Head[$j] AS $key ) {
          $pdf->addTextWrap($myLeftMargin,$YPos,$FWD[$i],8,$key, 'left');
          $myLeftMargin = $myLeftMargin+$FWD[$i];
          $i++;
        }
        $YPos -= $Line_Height;
      }
      $myLeftMargin = $Left_Margin;
      $YPos += ($Line_Height);
      $pdf->line($myLeftMargin, $YPos,$Page_Width-$Right_Margin-$Left_Margin+5, $YPos);
      $YPos -= 1.2*($Line_Height);
    }
  }
}
$NewPage=true;
?>