<?php
/* --------------------------------------------------------------
    PAYROLL
    Rep_Apod_Plirom.php
   -------------------------------------------------------------- */
$month = substr($_POST['myDate'],0, 2);
$year =  substr($_POST['myDate'],3, 7);
$payroll =$_POST['select'];
$payroll_code=iconv('UTF-8', 'ISO-8859-7', $_POST['payroll']);
$afm_code=$_POST['afm'];
$Compute_Payroll=$payroll;
$PatFrom=$month;
$PatYear=$year;
$payroll_code=$payroll_code;
$PatYearFrom=$PatYear;
$PatYearTo=$PatYear;
$PatTo=$PatFrom;

if($payroll==3){
include('Rep_Apod_Plirom_new.php');
}

else if($payroll==6){
include('Rep_Apod_Plirom_Vardies.php');
}
else if($payroll==9){
include('Rep_Apod_Plirom_Efimeries.php');
}
elseif($payroll==12){

include('Rep_Apod_Plirom_Yperv.php');


}



?>