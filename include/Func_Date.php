<?php
/* --------------------------------------------------------------
    PAYROLL
    Func_Date.php
    01
    include:
   -------------------------------------------------------------- */

function f_DaysDif($StartDate, $EndDate) {
  extract($GLOBALS);
  // Format Date='dd/mm/yyyy'
  $date_start=explode('/', $StartDate);
  $date_end=explode('/', $EndDate);
  $start_date=mktime(12,0,0,$date_start[1],$date_start[0],$date_start[2]);
  $end_date=mktime(12,0,0,$date_end[1],$date_end[0],$date_end[2]);
  $totdays=($end_date-$start_date)/86400;
  return $totdays;
}

function f_DateDif($StartDate, $EndDate) {
  extract($GLOBALS);
  // Format Date='dd/mm/yyyy'
  $totdays=f_DaysDif($StartDate, $EndDate);
  $years=floor($totdays/365);
  $Rest=$totdays % 365;
  $months=floor($Rest/30);
  $days=$Rest % 30;
  return $years.'-'.$months.'-'.$days;
}

function f_DaysSimDif($StartDate, $EndDate) {
  extract($GLOBALS);
  // Simigi Afairesi imerominion
  // Format Date='dd/mm/yyyy'
  $date_start=explode('/', $StartDate);
  $date_end=explode('/', $EndDate);
  if ($date_start[0]>$date_end[0]) {
    $date_end[0] +=30;
    $date_end[1] -=1;
  }
  $Days_Dif=$date_end[0]-$date_start[0];
  if ($date_start[1]>$date_end[1]) {
    $date_end[1] +=12;
    $date_end[2] -=1;
  }
  $Months_Dif=$date_end[1]-$date_start[1];
  $Years_Diff=$date_end[2]-$date_start[2];
  $Dif_in_days=$Years_Diff*365+$Months_Dif*30+$Days_Dif;
  return array($Years_Diff,$Months_Dif,$Days_Dif,$Dif_in_days);
}

function f_Date2TS($vDate) {
  extract($GLOBALS);
  // Format Date='dd/mm/yyyy'
  $date_array=explode('/', $vDate);
  return mktime(12,0,0,$date_array[1],$date_array[0],$date_array[2]);
}

function G_WeekDay($vDate) {
  // Format Date='dd/mm/yyyy'
  $date_array = explode('/',$vDate);
  $weekday = mktime(3,0,0,$date_array[1],$date_array[0],$date_array[2]);
  return strftime ( "%w", $weekday );
}


?>