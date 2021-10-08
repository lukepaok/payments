<?
/* --------------------------------------------------------------
    PAYROLL
    sql_where_out.php
    01
   -------------------------------------------------------------- */

if (isset($CodeFrom) && $CodeFrom!='') { $empwhere = $empwhere." AND EMPLOYEES.EMP_PAYROLL_CODE >= '".$CodeFrom."'"; }
if (isset($CodeTo) && $CodeTo!='')     { $empwhere = $empwhere." AND EMPLOYEES.EMP_PAYROLL_CODE <= '".$CodeTo."'"; }
if (isset($ErgCatID) && $ErgCatID!='All')   { $empwhere = $empwhere." AND EMPLOYEES.ECAT_ID1 = ".$ErgCatID; }
if (isset($ErgKladID) && $ErgKladID!='All')   { $empwhere = $empwhere." AND EMPLOYEES.EKLAD_ID1 = ".$ErgKladID; }
if (isset($NMCathgID) && $NMCathgID!='All') { $empwhere = $empwhere." AND EMPLOYEES.NMK_ID = ".$NMCathgID; }
if (isset($ErgCraftID) && $ErgCraftID!='All') { $empwhere = $empwhere." AND EMPLOYEES.ECRAFT_ID1 = ".$ErgCraftID; }
if (isset($YphrID) && $YphrID!='All')   { $empwhere = $empwhere." AND EMPLOYEES.YPHR_ID = ".$YphrID; }
if (isset($DieyID) && $DieyID!='All')   { $empwhere = $empwhere." AND EMPLOYEES.DIEY_ID = ".$DieyID; }
if (isset($TomID) && $TomID!='All')     { $empwhere = $empwhere." AND EMPLOYEES.TOM_ID = ".$TomID; }
if (isset($GrafID) && $GrafID!='All')   { $empwhere = $empwhere." AND EMPLOYEES.GRAF_ID = ".$GrafID; }
if (isset($TmhmID) && $TmhmID!='All')   { $empwhere = $empwhere." AND EMPLOYEES.TMHM_ID = ".$TmhmID; }
if (isset($Paycat) && $Paycat!='All')   { $empwhere = $empwhere." AND EMPLOYEES.EMP_PAYCAT = ".$Paycat; }
if (isset($Paytime) && $Paytime!='All') { $empwhere = $empwhere." AND EMPLOYEES.EMP_PAYTIME = ".$Paytime; }
if (isset($ErgKrit1ID) && $ErgKrit1ID!='All') { $empwhere = $empwhere." AND EMPLOYEES.EKRIT1_ID = ".$ErgKrit1ID; }
if (isset($ErgKrit2ID) && $ErgKrit2ID!='All') { $empwhere = $empwhere." AND EMPLOYEES.EKRIT2_ID = ".$ErgKrit2ID; }
if (isset($ErgKrit3ID) && $ErgKrit3ID!='All') { $empwhere = $empwhere." AND EMPLOYEES.EKRIT3_ID = ".$ErgKrit3ID; }
if (isset($ErgKrit4ID) && $ErgKrit4ID!='All') { $empwhere = $empwhere." AND EMPLOYEES.EKRIT4_ID = ".$ErgKrit4ID; }
if (isset($ErgWorkrelID) && $ErgWorkrelID!='All') { $empwhere = $empwhere." AND EMPLOYEES.EWREL_ID = ".$ErgWorkrelID; }
if (!isset($Inactive) || $Inactive!='1') { $empwhere = $empwhere." AND EMPLOYEES.EMP_ACTIVE = 1"; }
if (isset($EAPDKritID) && $EAPDKritID!='All') { $empwhere = $empwhere." AND EMPLOYEES.EAPD_KRIT_ID = ".$EAPDKritID; }
if ($_SESSION['GLInstall'] != 'DRAMANOSOK'){
if (!isset($FieldCheck2) || $FieldCheck2!='1') { $empwhere = $empwhere." AND EMPLOYEES.FOR_ID =".$_SESSION['ForeasID']; }
}
if ($_SESSION['GLInstall'] == 'DRAMANOSOK') {
if (isset($ForeisID)) {
  $Recs_no=count($_POST['ForeisID']);
  $is_all=$_POST["$ForeisID"][0];
  if ($is_all!='All'){
    $ForeisID_in='(';
    for ($i=0; $i < $Recs_no;$i++)  {
      $ForeisID_in=$ForeisID_in.$_POST["ForeisID"][$i];
      if ($Recs_no-1!=$i) {
        $ForeisID_in=$ForeisID_in.',';
      }
    }
    $ForeisID_in=$ForeisID_in.')';
    $empwhere = $empwhere."  AND EMPLOYEES.FOR_ID in ".$ForeisID_in." ";
  }
 }
}
//print '<pre>';print_r($ForeisID);print '</pre>';die();

// Order
for ($i=0;$i<10;$i++) {
  $fld='sorting'.$i.'FLD';
  if (isset($$fld) && $$fld!='All') {
    if ($emporder!='') { $emporder = $emporder.', '; }
    $emporder = $emporder.$$fld."";
  }
}
?>