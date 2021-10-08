<?php
include('config.php');
$ArrayList = array("_GET","_POST");
foreach($ArrayList as $gblArray) {
  $keys = array_keys($$gblArray);
  foreach($keys as $key) { $$key = trim(${$gblArray}[$key]); }
}
if (isset($SessionSavePath)) { session_save_path($SessionSavePath); }
ini_set('session.gc_Maxlifetime',$SessionLifeTime);
ini_set('max_execution_time',$MaximumExecutionTime);
ini_set('session.cache_limiter','');
ini_set('max_execution_time', 1200);
session_name($SessionName);
session_start();
$_SESSION['GLInstall']    = $GLInstall;
$_SESSION['GLVathmos']    = $GLVathmos;
$_SESSION['GLVathmos']    = $GLVathmos;
$_SESSION['GLMonthL']     = $GLMonthL;
$_SESSION['GLYear']       = $GLYear;
$_SESSION['GLDiorismos']  = $GLDiorismos ;
$_SESSION['GLAnefApod']   = $GLAnefApod ;
$_SESSION['GLListIdaxid'] = $GLListIdaxid ;
$_SESSION['GLListIdIatr'] = $GLListIdIatr ;
$_SESSION['GLKatalogismos'] = $GLKatalogismos ;
$_SESSION['GLIdiotikouDikaiou'] = $GLIdiotikouDikaiou;
if (!function_exists('_')) { function _($text){ return $text; } }
include('includes/ConnectDB.inc');
include('includes/DateFunctions.inc');
?>
