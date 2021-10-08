<?php
//$Compute_Payroll=1; 'All'=>'œÎÂÚ ÔÈ ÃÈÛËÔ‰ÔÛﬂÂÚ','1'=>'‘·ÍÙÈÍﬁ','2'=>'¡Ì·‰ÒÔÏÈÍ‹ ‘·ÍÙÈÍﬁÚ','3'=>'‘·ÍÙÈÍﬁ & ¡Ì·‰ÒÔÏÈÍ‹','4'=>'’ÂÒ˘ÒﬂÂÚ','5'=>'¡Ì·‰ÒÔÏÈÍ‹ ’ÂÒ˘ÒÈ˛Ì','6'=>'’ÂÒ˘ÒﬂÂÚ & ¡Ì·‰ÒÔÏÈÍ‹','7'=>'≈ˆÁÏÂÒﬂÂÚ','8'=>'¡Ì·‰ÒÔÏÈÍ‹ ≈ˆÁÏÂÒÈ˛Ì','9'=>'≈ˆÁÏÂÒﬂÂÚ & ¡Ì·‰ÒÔÏÈÍ‹','10'=>'≈ÈÎ›ÔÌ ≈ˆÁÏÂÒﬂÂÚ','11'=>'¡Ì·‰ÒÔÏÈÍ‹ ≈ÈÎ›ÔÌ ≈ˆÁÏÂÒÈ˛Ì','12'=>'≈ÈÎ›ÔÌ ≈ˆÁÏÂÒﬂÂÚ & ¡Ì·‰ÒÔÏÈÍ‹'
// '13'=>'EÈ‰ÈÍ·ÛË›ÌÙ· ¡Ì·‰ÒÔÏÈÍ‹ '14'=>–ÒÔÛËÂÙÂÚ ¡ÏÔÈ‚ÂÚ (”ıÌÔÎÔ) 15'=>XML –ÒÔÛËÂÙÂÚ ¡ÏÔÈ‚ÂÚ (≈ÈÛÙÁÏÔÌÈÍ¸ –ÒÔÛ˘ÈÍ¸) '16'=>XML ≈÷«Ã≈—…ŸÕ' 
// '17'=>'XML ¬¡—ƒ…ŸÕ ¡Õ¡ƒ—œÃ… ¡' '18'=>'XML ≈÷«Ã≈—…ŸÕ ¡Õ¡ƒ—œÃ… ¡'
// '19'=>'XML ¬¡—ƒ…ŸÕ ◊Ÿ—…” ¡Õ¡ƒ—œÃ… ¡' '20'=>'XML ≈÷«Ã≈—…ŸÕ ◊Ÿ—…” ¡Õ¡ƒ—œÃ… ¡'
// '21'=>'¡Ãœ…¬≈” Ã≈ÀŸÕ ƒ”'

function sinton($FPEmpid) {
  $exsalsql  = " SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS";
  $exsalsql .= " WHERE EMP_ID = ".$FPEmpid." AND ECOP_VARIABLE='”’Õ‘œÕ…”‘«”'";
  $exsalres  = DB_query($exsalsql,$db);
  $exsalrow  = DB_fetch_array($exsalres);
  $sintonistis = $exsalrow['ECOP_VALUE'];
  return $sintonistis;
}


function agrotikos($FPEmpid){


    $exsalsql  = " SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS";
    $exsalsql .= " WHERE EMP_ID = ".$FPEmpid." AND ECOP_VARIABLE='¬¡»Ãœ”_ƒ’'";
    $exsalres  = DB_query($exsalsql,$db);
    $exsalrow  = DB_fetch_array($exsalres);
    $agrotikos = $exsalrow['ECOP_VALUE'];



   return $agrotikos;

}


function plafon_efimerion($descr){


    $exsalsql  = " SELECT PRM_TBL_NVALUED FROM PARAMETERS";
    $exsalsql .= " WHERE PRM_TBL_CVALUE15 ='".$descr."' AND PRM_TBL_FOR=1 AND PRM_DESCR='PLAFON EFIMERION'";
    $exsalres  = DB_query($exsalsql,$db);
    $exsalrow  = DB_fetch_array($exsalres);
    $plafon    = $exsalrow['PRM_TBL_NVALUED'];



   return $plafon;

}

function GetMTEfim($id,$month,$Year) {
$ClientInstall=$_SESSION['GLInstall'];
if ($month<=7 and $Year<=2012){
  $MTEfim = array (
      1 =>  array('254.36','344.06','269.30','369.70','384.64'),
      2 =>  array('196.51','273.42','209.37','295.38','308.24'),
      3 =>  array('168.83','232.96','179.55','251.28','262.00'),
      4 =>  array('127.18','172.04','134.66','184.92','192.40'),
      5 =>  array('205.60','272.80','216.80','292.00','303.20'),
      6 =>  array('227.95','305.52','240.91','327.68','340.64'),
      7 =>  array('106.32','163.02','117.26','189.06','200.00'),
      8 =>  array( '98.88','151.62','109.06','175.90','186.08'),
      9 =>  array( '98.88','151.62','109.06','175.90','186.08'),
     10 =>  array('141.91','193.62','150.57','208.38','217.04'),
     11 =>  array('153.25','210.08','162.69','226.32','235.76'),
    12 =>  array('138.27','188.30','146.65','202.58','210.56'),
    13 =>  array('148.34','202.92','157.42','218.60','227.68')
                  );


              }
else{
$MTEfim = array (
      1 =>  array('150.88','206.62','160.14','222.58','231.84'),
      2 =>  array('145.55','198.94','154.49','214.18','223.12'),
      3 =>  array('130.99','177.66','138.81','190.98','198.80'),
      4 =>  array('106.95','142.52','112.91','152.68','158.64'),
      5 =>  array('131.75','178.72','139.59','192.16','200.00'),
      6 =>  array('141.57','193.06','150.15','207.74','216.32'),
      7 =>  array( '72.48','111.12','79.92','128.96','136.40'),
      8 =>  array( '72.48','111.12','79.92','128.96','136.40'),
      9 =>  array( '72.48','111.12','79.92','128.96','136.40'),
     10 =>  array('111.35','148.90','117.61','159.66','165.92'),
     11 =>  array('117.87','158.48','124.67','170.08','176.88'),
    12 =>  array('138.27','188.30','146.65','202.58','210.56'),
    13 =>  array('148.34','202.92','157.42','218.60','227.68'),
	 21 =>  array('150.88','206.62','160.14','222.58','231.84'),
     22 =>  array('145.55','198.94','154.49','214.18','223.12'),
     23 =>  array('130.99','177.66','138.81','190.98','198.80'),
     24 =>  array('106.95','142.52','112.91','152.68','158.64'),
     25 =>  array('131.75','178.72','139.59','192.16','200.00'),
     26 =>  array('141.57','193.06','150.15','207.74','216.32'),
     27 =>  array( '72.48','111.12','79.92','128.96','136.40'),
     28 =>  array( '72.48','111.12','79.92','128.96','136.40'),
     29 =>  array( '72.48','111.12','79.92','128.96','136.40'),
     30 =>  array('111.35','148.90','117.61','159.66','165.92'),
     31 =>  array('117.87','158.48','124.67','170.08','176.88'),
     32 =>  array('138.27','188.30','146.65','202.58','210.56'),
     33 =>  array('148.34','202.92','157.42','218.60','227.68')
                  );

}
/*         // }
else {
$MTEfim = array (
      1 =>  array('280.60','382.42','297.58','411.50','428.48'),
      2 =>  array('218.94','306.10','233.44','331.10','345.60'),
      3 =>  array('187.62','260.38','199.76','281.22','293.36'),
      4 =>  array('140.30','191.22','148.80','205.82','214.32'),
      5 =>  array('225.07','301.26','237.77','323.06','335.76'),
      6 =>  array('250.55','338.50','265.21','363.66','378.32'),
      7 =>  array('106.32','163.02','117.26','189.06','200.00'),
      8 =>  array( '98.88','151.62','109.06','175.90','186.08'),
      9 =>  array( '98.88','151.62','109.06','175.90','186.08'),
     10 =>  array('157.06','215.66','166.80','232.50','242.24'),
     11 =>  array('169.76','234.26','180.50','252.70','263.44')
                  );             }
   */
  return $MTEfim[$id];


}

function efim_paid ($FPEmpid,$Payid){


    $exsalsql  = " SELECT EXTRA_SALARY.EXSAL_ID FROM EXTRA_SALARY, SALARY ";
    $exsalsql .= " WHERE EXTRA_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA_SALARY.EMP_ID = ".$FPEmpid." AND SALARY.PAY_ID = '".$Payid."'";
    $exsalres  = DB_query($exsalsql,$db);
    $exsalrow  = DB_fetch_array($exsalres);
    $exsal0_id = $exsalrow['EXSAL_ID'];

   if($exsal0_id!=null){

    $tmpsql  = "select sum(exsad_credit) as credit from EXTRA_salary_detail";
    $tmpsql .= " where exsal_id=".$exsal0_id." AND (EXSAD_MODULE='HOUR' OR EXSAD_MODULE='EXTH' OR EXSAD_MODULE='PLAF' OR EXSAD_MODULE='PLAP' OR EXSAD_MODULE='PLAE' OR EXSAD_MODULE='SEVE')";
    $tmpres =DB_query($tmpsql,$db);
    $tmprow =DB_fetch_array($tmpres);
    $sysapa_amount = $tmprow['CREDIT'];

   return $sysapa_amount;
   }
}



function Find_Pericopes($FPEmpid, $Salid, $Payid,$PatFrom,$PatYear) {

include_once ('include/Func_Efimeries.php');


  $Ret_func=array();
  $tmpsql = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$FPEmpid." AND ECOP_VARIABLE='¬¡»Ãœ”_…¡‘—ŸÕ' ";
  $tmpres =DB_query($tmpsql,$db);
  $tmprow =DB_fetch_array($tmpres);
  $Vathmos=$tmprow['ECOP_VALUE'];
  
  if($Vathmos==21) {$Vathmos=1;}
  if($Vathmos==22) {$Vathmos=2;}
  if($Vathmos==23) {$Vathmos=3;}
  if($Vathmos==24) {$Vathmos=4;}
  if($Vathmos==25) {$Vathmos=5;}
  if($Vathmos==26) {$Vathmos=6;}
  if($Vathmos==27) {$Vathmos=7;}
  if($Vathmos==28) {$Vathmos=8;}
  if($Vathmos==29) {$Vathmos=9;}
  if($Vathmos==30) {$Vathmos=10;}
  if($Vathmos==31) {$Vathmos=11;}
  if($Vathmos==32) {$Vathmos=12;}
  if($Vathmos==33) {$Vathmos=13;}
  if($Vathmos==34) {$Vathmos=14;}
  
    
  if ($Vathmos>0) {
    $tmpsql = "SELECT PRM_TBL_NVALUED,PRM_TBL_CVALUE15 FROM PARAMETERS WHERE PRM_TABLE='PLAAP' AND PRM_TBL_ID=".$Vathmos;
    $tmpres =DB_query($tmpsql,$db);
    $tmprow =DB_fetch_array($tmpres);
    $Vathm_descr=$tmprow['PRM_TBL_CVALUE15'];
    $Plafon_AP=$tmprow['PRM_TBL_NVALUED'];

    if ($Plafon_AP>0) {
      $tmpsql = "SELECT EXTRA_SALARY.EXSAL_ID FROM EXTRA_SALARY, SALARY WHERE EXTRA_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA_SALARY.EMP_ID =".$FPEmpid." AND SALARY.PAY_ID=".$Payid;
      $tmpres =DB_query($tmpsql,$db);
      $tmprow =DB_fetch_array($tmpres);
      $Exsalid=$tmprow['EXSAL_ID'];
      if ($Exsalid>0) {
        $tmpsql = "SELECT SUM(EXSAD_CREDIT) AS CREDIT, SUM(EXSAD_DEBIT) AS DEBIT FROM EXTRA_SALARY_DETAIL WHERE EXSAL_ID =".$Exsalid." AND (EXSAD_MODULE='HOUR' OR EXSAD_MODULE='EXTH')";
        $tmpres =DB_query($tmpsql,$db);
        $tmprow =DB_fetch_array($tmpres);
        $Gross_efim = $tmprow['CREDIT']-$tmprow['DEBIT'];
      $tablemasterrow['SYN_AKATH_APOD'] = G_takt_mikta($FPEmpid,$PatFrom,$PatYear);
        $Oikogeneiako = Get_One_BDLRE($FPEmpid,$PatFrom,$PatYear,'BEN','OIKOGEN');
        $Agoni        = Get_One_BDLRE($FPEmpid,$PatFrom,$PatYear,'BEN_RETRO','AGON_PER');
        $Gross_Takt   = G_takt_mikta($FPEmpid,$PatFrom,$PatYear);
       if ($PatYear==2012 && in_array($PatFrom,array(8,9,10,11,12))) { $Gross_Takt= G_takt_mikta($FPEmpid,1,2013); }
        $All_Gross_Takt = $Gross_Takt;
        $Gross_Plaf1=$Gross_Takt+($Agoni/12);
        $Plafon1=0;
        if ($Gross_efim>$Gross_Plaf1) { $Plafon1=$Gross_efim-$Gross_Plaf1; }
        $Plafon2=0;
        $Sum_gross=$Gross_efim+$Gross_Plaf1-$Plafon1-$Oikogeneiako;
        if ($Sum_gross>$Plafon_AP) { $Plafon2=$Sum_gross-$Plafon_AP; }
      }
    }
  }
  $Ret_func=array('vath'=>$Vathmos, 'vadescr'=>$Vathm_descr, 'plaap'=>$Plafon_AP, 'exsalid'=>$Exsalid, 'grefim'=>$Gross_efim,
                  'grtakt'=>$Gross_Takt, 'agonper'=>$Agoni_Perioxi, 'plaf1'=>$Plafon1, 'plaf2'=>$Plafon2,
                  'allgr'=>$All_Gross_Takt, 'oikog'=>$Oikogeneiako, 'telgr'=>$Gross_Plaf1, 'sumgr'=>$Sum_gross);
  return $Ret_func;
}


function Get_Salid($fpc_empid,$fpc_payid) {
  $SQL = "SELECT SALARY.SAL_ID FROM SALARY WHERE SALARY.PAY_ID = ".$fpc_payid." AND SALARY.EMP_ID = ".$fpc_empid;
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  $Func_ret = $ROW['SAL_ID'];
  return $Func_ret;
}

function Get_Mod_VarName($fpc_type,$fpc_mod_id) {
  $SQL = "SELECT BDL_VAR FROM BDLRE_GROUP WHERE BDL_ID='".$fpc_mod_id."' AND BDL_TYPE='".$fpc_type."'";
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  $Func_ret = $ROW['BDL_VAR'];
  if ($Func_ret=='') { $Func_ret = 'AGNOSTO'; }
  return $Func_ret;
}

function G_VarPA($fpc_type,$fpc_mod_id,$fpc_tid) {
  $ProsAmoiv = array(
        27=>'ENERG1',
        28=>'ENERG2',
        31=>'ENERG3',
        32=>'ENERG4',
        33=>'MIKTH1',
        34=>'MIKTH2',
        35=>'MIKTH3',
        36=>'MIKTH4',
        37=>'ETOIM1',
        38=>'ETOIM2',
        39=>'ETOIM3',
        40=>'ETOIM4',
        21=>'KANONIKH',
        30=>'KANONYXT',
        23=>'ARGIA',
        24=>'ARGNYXT',
        25=>'SYMPLHR',
        26=>'SYMPNYXT',
		
		65=>'KANONYPER',
		66=>'KANNYXT',
		67=>'KANARG',
		68=>'KANRGNYXT',
		69=>'KANYPERERG',
		70=>'KANYPERERGNYXT',
		71=>'KANYPERERGARG',
		72=>'KANYPERERGARGNYXT',
		73=>'EXAIRYPER',
		74=>'EXAIRNYXT',
		75=>'EXAIRARG',
		76=>'EXAIRARGNYXT',
		77=>'AMOIBDS',
		78=>'AMOIBDS',
      -123=>'PEREFANADR'
        );
  if ($fpc_type=='HOUR') { $Func_ret = $ProsAmoiv[$fpc_tid]; }
  elseif ($fpc_type=='EXTH') { $Func_ret = 'BONUS'; }
  elseif ($fpc_type=='PLAE') { $Func_ret = 'PER_EFHMAP'; }
  elseif ($fpc_type=='PLAF') { $Func_ret = 'PLAFON'; }
  elseif ($fpc_type=='PLAP') { $Func_ret = 'PER_AP'; }
  elseif ($fpc_type=='SEVE') { $Func_ret = 'SEVEN'; }
  else {
    $SQL = "SELECT BDL_VAR FROM BDLRE_GROUP WHERE BDL_ID='".$fpc_mod_id."' AND BDL_TYPE='".$fpc_type."'";

    $RES = DB_query($SQL,$db);
    $ROW = DB_fetch_array($RES);
    $Func_ret = $ROW['BDL_VAR'];
  }
  if ($Func_ret=='') { $Func_ret = 'AGNOSTO'; }
  return $Func_ret;
}

function Get_Days_kliniko($fpc_empid){
$SQL = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$fpc_empid." AND ECOP_VARIABLE='«Ã≈—≈”_≈—√¡”…¡”_ƒ≈–' ";
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  $days =$ROW['ECOP_VALUE'];
  return $days;
}



function Get_VathmosDescr($fpc_empid) {
  $XML_Vathm_descr=array(1=>'ƒ…≈’»’Õ‘«” √…¡‘—œ” ≈”’',2=>'≈–…Ã≈À«‘«” ¡ ≈”’',3=>'≈–…Ã≈À«‘«” ¬ ≈”’',4=>'≈…ƒ… ≈’œÃ≈Õœ” ≈”’',5=>'¡Õ¡–À«—Ÿ‘«”  ¡»«√«‘«”',6=>' ¡»«√«‘«”',7=>'¡√—œ‘… œ” …¡‘—œ”',8=>'¡√—œ‘… œ” …¡‘—œ”',9=>'¡√—œ‘… œ” …¡‘—œ”',10=>'À≈ ‘œ—¡”',11=>'≈–… œ’—œ”  ¡»«√«‘«”',12=>'≈–…Ã≈À«‘«” ¡ ≈”’',13=>'≈–…Ã≈À«‘«” ¬ ≈”’',14=>'Àœ◊¡√œ”');
  $Func_ret=array();
  $SQL = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$fpc_empid." AND ECOP_VARIABLE='¬¡»Ãœ”_…¡‘—ŸÕ' ";
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  $Vath_iat=$ROW['ECOP_VALUE'];
  if ($Vath_iat>0) {
    $Func_ret['out'] = $_SESSION['GLVathmos'][$ROW['ECOP_VALUE']];
    $Descr_xml_code=$XML_Vathm_descr[$Vath_iat];
  }
  if (!in_array($Vath_iat,array(1,2,3,4,5,6,10,11,12,13,14))) {
    $SQL = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$fpc_empid." AND ECOP_VARIABLE='¬¡»Ãœ”_ƒ’' ";
    $RES = DB_query($SQL,$db);
    $ROW = DB_fetch_array($RES);
    $Vathmos=$ROW['ECOP_VALUE'];
    $SQL = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$fpc_empid." AND ECOP_VARIABLE='Õ≈œ_ À…Ã¡ …œ' ";
    $RES = DB_query($SQL,$db);
    $ROW = DB_fetch_array($RES);
    $Klimakio = $ROW['ECOP_VALUE'];
    $Func_ret['out'] = $Vathmos.' '.$Klimakio;
    $Descr_xml_code=$Vathmos.$Klimakio;

  }
  $SQL = "SELECT EAPD_VATHMOI.EAPD_VA_ID FROM EAPD_VATHMOI WHERE EAPD_VATHMOI.EAPD_VA_DESCR ='".$Descr_xml_code."'";
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  $Func_ret['xml'] = $ROW['EAPD_VA_ID'];
  $Func_ret['vathm'] = $Vath_iat;

  $SQL = "SELECT EAPD_VA_ID FROM EMPLOYEES WHERE EMP_ID ='".$fpc_empid."'";
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  $xml_code = $ROW['EAPD_VA_ID'];

  if($xml_code!=0){$Func_ret['xml'] = $xml_code;}

  return $Func_ret;
}


function Get_VathNotDoctorhistory($fpc_empid) {
  global  $PatFrom, $PatTo, $PatYearFrom, $PatYearTo;
  $XML_Vathm_descr=array('¡'=>1,'¬'=>2,'√'=>3,'ƒ'=>4,'≈'=>5,'”‘'=>6);
  $Rev_Vathm_descr=array(1=>'¡',2=>'¬',3=>'√',4=>'ƒ',5=>'≈',6=>'”‘');
  $Func_ret=array();
  $vath_history=array();
  $SQL = "SELECT ECOP_ID,ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$fpc_empid." AND ECOP_VARIABLE='¬¡»Ãœ”_ƒ’' ";
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);

  $period_start='01-'.$PatFrom.'-'.$PatYearFrom;
  $period_end=getDaysInMonth($period_start_f).'-'.$PatFrom.'-'.$PatYearFrom;
  $period_start_f=strtotime('01-'.$PatFrom.'-'.$PatYearFrom);
  $period_end_f=strtotime(getDaysInMonth($period_start_f).'-'.$PatFrom.'-'.$PatYearFrom);
  $Vath_iat=$ROW['ECOP_VALUE'];
  $ecop_id= $ROW['ECOP_ID'];
  if($ecop_id==null){return 1;}
  else{
  $SQL="select sysreg_validfrom,sysreg_value from system_scd_register where sysreg_table_id=".$ecop_id." ";
  $funcres = DB_query($SQL,$db);
  while ($funcrow=DB_fetch_array($funcres)) {
  $Func_ret[$XML_Vathm_descr[$funcrow['SYSREG_VALUE']]]=date('Y-m-d',strtotime($funcrow['SYSREG_VALIDFROM']));
  }
  $vath_istoriko[]=$Func_ret;


 $vathmoi=array();
  foreach ($vath_istoriko as $vathmos) {
    foreach ($vathmos as $vathm=>$imerom){

    $vathmoi[$vathm]=$imerom;
    }
  }

  $vathmoi_temp=array();
  foreach($vathmoi as $va=>$vathmoi_t){
   if ($va==null){continue;}
   else{
    $vathmoi_temp[$va]=$vathmoi_t;
       }
  }
 unset($vathmoi);
 $vathmoi=$vathmoi_temp;



if (!empty($vathmoi)) {
 $max = max(array_keys($vathmoi));
 $totals=sizeof($vathmoi);
 $i=0;

 while($i<$totals){
 $vathmoi2[$max-$i]=date('Y-m-d', strtotime('-1 day', strtotime($vathmoi[$max-$i-1])));

 if ($vathmoi2[$max-$i]=='1969-12-31'){$vathmoi2[$max-$i]='2030-01-30';}
 $i=$i+1;
 }

 $i=0;
 $vathmoi3=array();

 while($i<$totals){
 $vathmoi2[$max-$i]=$vathmoi2[$max-$i];
 $vathmoi[$max-$i]=$vathmoi[$max-$i];

 if (
    ((strtotime($vathmoi[$max-$i])>($period_start_f) and (strtotime($vathmoi[$max-$i])<($period_end_f) ))
and (((strtotime($vathmoi2[$max-$i])>($period_end_f))) and (strtotime($vathmoi2[$max-$i])>($period_start_f))))
   or
   ((strtotime($vathmoi[$max-$i])<=($period_start_f) and (strtotime($vathmoi[$max-$i])<=($period_end_f) ))
and (((strtotime($vathmoi2[$max-$i])>=($period_end_f))) and (strtotime($vathmoi2[$max-$i])>=($period_start_f))))
   or
   ((strtotime($vathmoi[$max-$i])<($period_start_f) and (strtotime($vathmoi[$max-$i])<($period_end_f) ))
and (((strtotime($vathmoi2[$max-$i])<($period_end_f))) and (strtotime($vathmoi2[$max-$i])>($period_start_f))))
    ) {

      $vathmoi3[$max-$i]=$vathmoi[$max-$i];
     }
 $i=$i+1;


 }


 $final_vathm=array();
 $final_vathm=(array_keys($vathmoi3));
 $final_vathm_teliko=array();
 foreach ($final_vathm as $key=>$value){
 $final_vathm_teliko[$key]=$Rev_Vathm_descr[$value];
 //print '<pre>';print_r($final_vathm_teliko);print '</pre>';die();
 }

  return $final_vathm_teliko;
}

else{return 1;}

}
}

function Get_Klimakiohistory($fpc_empid) {
  global  $PatFrom, $PatTo, $PatYearFrom, $PatYearTo;
  $Func_ret=array();
  $vath_history=array();
  $SQL = "SELECT ECOP_ID,ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$fpc_empid." AND ECOP_VARIABLE='Õ≈œ_ À…Ã¡ …œ' ";
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  $period_start='01-'.$PatFrom.'-'.$PatYearFrom;
  $period_end=getDaysInMonth($period_start_f).'-'.$PatFrom.'-'.$PatYearFrom;
  $period_start_f=strtotime('01-'.$PatFrom.'-'.$PatYearFrom);
  $period_end_f=strtotime(getDaysInMonth($period_start_f).'-'.$PatFrom.'-'.$PatYearFrom);
  $Vath_iat=$ROW['ECOP_VALUE'];
  $ecop_id= $ROW['ECOP_ID'];
  if($ecop_id==null){return 1;}
  else{
  $SQL="select sysreg_validfrom,sysreg_value from system_scd_register where sysreg_table_id=".$ecop_id." ";
  $funcres = DB_query($SQL,$db);
  while ($funcrow=DB_fetch_array($funcres)) {
  $Func_ret[$funcrow['SYSREG_VALUE']]=date('Y-m-d',strtotime($funcrow['SYSREG_VALIDFROM']));

  }
  $vath_istoriko[]=$Func_ret;


  $vathmoi=array();
  foreach ($vath_istoriko as $vathmos) {
    foreach ($vathmos as $vathm=>$imerom){

    $vathmoi[$vathm]=$imerom;
    }
  }

   $vathmoi_temp=array();
  foreach($vathmoi as $va=>$vathmoi_t){
   if ($va==null){continue;}
   else{
    $vathmoi_temp[$va]=$vathmoi_t;
       }
  }
 unset($vathmoi);
 $vathmoi=$vathmoi_temp;
  if (!empty($vathmoi)) {
 $min = min(array_keys($vathmoi));
 $totals=sizeof($vathmoi);
 $i=0;
 while($i<$totals){
 $vathmoi2[$min+$i]=date('Y-m-d', strtotime('-1 day', strtotime($vathmoi[$min+$i+1])));

 if ($vathmoi2[$min+$i]=='1969-12-31'){$vathmoi2[$min+$i]='2030-01-30';}
 $i=$i+1;
 }
 $i=0;
 $vathmoi3=array();

 while($i<$totals){
 $vathmoi2[$min+$i]=$vathmoi2[$min+$i];
 $vathmoi[$min+$i]=$vathmoi[$min+$i];

 if (
    ((strtotime($vathmoi[$min+$i])>($period_start_f) and (strtotime($vathmoi[$min+$i])<($period_end_f) ))
and (((strtotime($vathmoi2[$min+$i])>($period_end_f))) and (strtotime($vathmoi2[$min+$i])>($period_start_f))))
   or
   ((strtotime($vathmoi[$min+$i])<=($period_start_f) and (strtotime($vathmoi[$min+$i])<=($period_end_f) ))
and (((strtotime($vathmoi2[$min+$i])>=($period_end_f))) and (strtotime($vathmoi2[$min+$i])>=($period_start_f))))
   or
   ((strtotime($vathmoi[$min+$i])<($period_start_f) and (strtotime($vathmoi[$min+$i])<($period_end_f) ))
and (((strtotime($vathmoi2[$min+$i])<($period_end_f))) and (strtotime($vathmoi2[$min+$i])>($period_start_f))))
    ) {

      $vathmoi3[$min+$i]=$vathmoi[$min+$i];
     }
 $i=$i+1;


 }


 $final_vathm=array();
 $final_vathm=(array_keys($vathmoi3));

  return $final_vathm;
}
else{return 1;}
}
}

function Get_Vathmoshistory($fpc_empid) {
  global  $PatFrom, $PatTo, $PatYearFrom, $PatYearTo;
  $XML_Vathm_descr=array(1=>'ƒ…≈’»’Õ‘«”',2=>'≈–…Ã≈À.¡',3=>'≈–…Ã≈À.¬',4=>'≈…ƒ… ≈’.',5=>'¡Õ¡–À«—. ¡».',6=>' ¡»«√.',10=>'À≈ ‘.',11=>'≈–… . ¡»«√.',12=>'≈–…Ã≈À.¡ ≈”’',13=>'≈–…Ã≈À.¬ ≈”’',14=>'Àœ◊¡√œ”');
  $Func_ret=array();
  $vath_history=array();
  $SQL = "SELECT ECOP_ID,ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$fpc_empid." AND ECOP_VARIABLE='¬¡»Ãœ”_…¡‘—ŸÕ' ";
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  $period_start='01-'.$PatFrom.'-'.$PatYearFrom;
  $period_end=getDaysInMonth($period_start_f).'-'.$PatFrom.'-'.$PatYearFrom;
  $period_start_f=strtotime('01-'.$PatFrom.'-'.$PatYearFrom);
  $period_end_f=strtotime(getDaysInMonth($period_start_f).'-'.$PatFrom.'-'.$PatYearFrom);
  $Vath_iat=$ROW['ECOP_VALUE'];
  $ecop_id= $ROW['ECOP_ID'];
  if($ecop_id==null){return 1;}
  else{
  $SQL="select sysreg_validfrom,sysreg_value from system_scd_register where sysreg_table_id=".$ecop_id." ";
  $funcres = DB_query($SQL,$db);

  while ($funcrow=DB_fetch_array($funcres)) {
  $Func_ret[$funcrow['SYSREG_VALUE']]=date('Y-m-d',strtotime($funcrow['SYSREG_VALIDFROM']));

  }
  $vath_istoriko[]=$Func_ret;


  $vathmoi=array();
  foreach ($vath_istoriko as $vathmos) {
    foreach ($vathmos as $vathm=>$imerom){
        if ($vathm==0){continue;}
    $vathmoi[$vathm]=$imerom;
    }
  }

   $vathmoi_temp=array();
  foreach($vathmoi as $va=>$vathmoi_t){
   if ($va==null){continue;}
   else{
    $vathmoi_temp[$va]=$vathmoi_t;
       }
  }
 unset($vathmoi);
 $vathmoi=$vathmoi_temp;

  if (!empty($vathmoi)) {
 $max = max(array_keys($vathmoi));
 $totals=sizeof($vathmoi);
 $i=0;
 while($i<$totals){
 $vathmoi2[$max-$i]=date('Y-m-d', strtotime('-1 day', strtotime($vathmoi[$max-$i-1])));

 if ($vathmoi2[$max-$i]=='1969-12-31'){$vathmoi2[$max-$i]='2030-01-30';}
 $i=$i+1;
 }
 $i=0;
 $vathmoi3=array();

 while($i<$totals){
 $vathmoi2[$max-$i]=$vathmoi2[$max-$i];
 $vathmoi[$max-$i]=$vathmoi[$max-$i];

 if (
    ((strtotime($vathmoi[$max-$i])>($period_start_f) and (strtotime($vathmoi[$max-$i])<($period_end_f) ))
and (((strtotime($vathmoi2[$max-$i])>($period_end_f))) and (strtotime($vathmoi2[$max-$i])>($period_start_f))))
   or
   ((strtotime($vathmoi[$max-$i])<=($period_start_f) and (strtotime($vathmoi[$max-$i])<=($period_end_f) ))
and (((strtotime($vathmoi2[$max-$i])>=($period_end_f))) and (strtotime($vathmoi2[$max-$i])>=($period_start_f))))
   or
   ((strtotime($vathmoi[$max-$i])<($period_start_f) and (strtotime($vathmoi[$max-$i])<($period_end_f) ))
and (((strtotime($vathmoi2[$max-$i])<($period_end_f))) and (strtotime($vathmoi2[$max-$i])>($period_start_f))))
    ) {

      $vathmoi3[$XML_Vathm_descr[$max-$i]]=$vathmoi[$max-$i];
     }
 $i=$i+1;


 }


 $final_vathm=array();
 $final_vathm=(array_keys($vathmoi3));
 return $final_vathm;
}
else{return 1;}

}
}












function Get_misth_part($fpc_salid,$fpc_part) {
  $funcsql = "SELECT SUM(ESAD_CREDIT) AS CREDIT, SUM(ESAD_DEBIT) AS DEBIT FROM SALARY_EMP_DETAIL WHERE SAL_ID=".$fpc_salid." AND ESAD_MODULE = '".$fpc_part."' ";
  $funcres =DB_query($funcsql,$db);
  $funcrow =DB_fetch_array($funcres);
  $Func_ret = $funcrow['CREDIT']-$funcrow['DEBIT'];
  if (in_array($fpc_part,array('DED','EDED','◊DED','TAX','LOAN','REC'))) { $Func_ret = - $Func_ret; }
  return $Func_ret;
}

function Get_takt_mikta($fpc_empid,$fpc_month,$fpc_year,$fpc_vathm_iatr,$fpc_doro='') {
  $Pat_id=$fpc_month;
  if ($fpc_doro!='') { $Pat_id=$fpc_doro; }
  $Func_ret = 0;
  $Date_from  = "01/".str_pad($fpc_month,2,"0",str_pad_left)."/".$fpc_year;
  $Date_to    = getDaysInMonth($Date_from)."/".str_pad($fpc_month,2,"0",str_pad_left)."/".$fpc_year;
  $funcsql  = "SELECT SALARY.SAL_ID FROM SALARY, PAYROLL_TRANSACTIONS WHERE SALARY.EMP_ID = ".$fpc_empid;
  $funcsql .= " AND SALARY.PAY_ID = PAYROLL_TRANSACTIONS.PAY_ID ";
  $funcsql .= " AND PAY_YEAR = ".$fpc_year;
  $funcsql .= " AND SALARY.PAT_ID = ".$Pat_id;
  $funcsql .= " AND SAL_DATE >= ".FormatDateForSQL($Date_from)." AND SAL_DATE < ".FormatDateForSQL(dateadd($Date_to,'d',1));
  if (in_array($fpc_vathm_iatr,array(5,6,10,11))) {
    $tmpsql = "SELECT EMP_WAGE_DEP FROM EMPLOYEES WHERE EMP_ID=".$fpc_empid;
    $tmpres = DB_query($tmpsql,$db);
    $tmprow = DB_fetch_array($tmpres);
    $Func_ret = $tmprow['EMP_WAGE_DEP'];
  }
  else {
    $funcres  = DB_query($funcsql,$db);
    $misthbas = 0;
    $fpc_misthbas = 0;
    while ($funcrow=DB_fetch_array($funcres)) {
      $fpc_salid = $funcrow['SAL_ID'];
      $misthbas=Get_misth_part($fpc_salid,'BAS');
      if ($misthbas>0) { $fpc_misthbas=$misthbas; }
    }
    $funcres  = DB_query($funcsql,$db);
    $misthben = 0;
    $misthxben = 0;
    $fpc_misthben=0;
    $fpc_misthxben=0;
    while ($funcrow=DB_fetch_array($funcres)) {
      $fpc_salid = $funcrow['SAL_ID'];
      $misthben=Get_misth_part($fpc_salid,'BEN');
      if ($misthben<>0) { $fpc_misthben=$misthben; }
      $misthxben=Get_misth_part($fpc_salid,'EBEN');
      if ($misthxben<>0) { $fpc_misthxben=$misthxben; }
    }
    $Func_ret = $fpc_misthbas+$fpc_misthben+$fpc_misthxben;
  }
  return $Func_ret;
}

function Get_One_BDLRE($fpc_empid,$fpc_month,$fpc_year,$fpc_module,$fpc_mod_name) {
  $BDL_type=$fpc_module;
  if ($fpc_module=='BEN_RETRO') { $BDL_type='BEN'; }
  $SQL = "SELECT BDL_ID FROM BDLRE_GROUP WHERE BDL_VAR='".$fpc_mod_name."' AND BDL_TYPE='".$BDL_type."'";
  $RES = DB_query($SQL,$db);
  $ROW = DB_fetch_array($RES);
  $BDL_id = $ROW['BDL_ID'];
  $Date_from  = "01/".str_pad($fpc_month,2,"0",str_pad_left)."/".$fpc_year;
  $Date_to    = getDaysInMonth($Date_from)."/".str_pad($fpc_month,2,"0",str_pad_left)."/".$fpc_year;
  $funcsql    = "SELECT SALARY.SAL_ID FROM SALARY, PAYROLL_TRANSACTIONS WHERE SALARY.EMP_ID = ".$fpc_empid;
  $funcsql   .= " AND SALARY.PAY_ID = PAYROLL_TRANSACTIONS.PAY_ID ";
  $funcsql   .= " AND PAY_YEAR = ".$fpc_year;
  $funcsql   .= " AND SALARY.PAT_ID = ".$fpc_month;
  $funcsql   .= " AND SAL_DATE >= ".FormatDateForSQL($Date_from)." AND SAL_DATE < ".FormatDateForSQL(dateadd($Date_to,'d',1));
  $funcres    = DB_query($funcsql,$db);
  $Amount     = 0;
  $fpc_Amount = 0;
  while ($funcrow=DB_fetch_array($funcres)) {
    $fpc_salid = $funcrow['SAL_ID'];
    if ($fpc_module=='BEN') {
      $bensql  = "SELECT SUM(ESAD_CREDIT) AS CREDIT, SUM(ESAD_DEBIT) AS DEBIT FROM SALARY_EMP_DETAIL WHERE SAL_ID=".$fpc_salid." AND ESAD_MODULE='BEN' AND BDL_ID=".$BDL_id;
      $benrs   = DB_query($bensql,$db);
      $benrow  = DB_fetch_array($benrs);
      $Amount  = $benrow['CREDIT']-$benrow['DEBIT'];
    }
    elseif ($fpc_module=='BEN_RETRO') {
      $tmpsql  = "SELECT SUM(RD.RDET_CREDIT) AS CREDIT, SUM(RD.RDET_DEBIT) AS DEBIT FROM RETRO_DETAIL RD,RETRO_MASTER RM ";
      $tmpsql .= " WHERE RM.SAL_ID_TO=".$fpc_salid." AND RM.RMST_ID=RD.RMST_ID AND RD.RDET_MODULE='BEN' AND BDL_ID=".$BDL_id;
      $tmpres  = DB_query($tmpsql,$db);
      $tmprow  = DB_fetch_array($tmpres);
      $Amount  = $tmprow['CREDIT']-$tmprow['DEBIT'];
    }
    elseif ($fpc_module=='DED') {
    }
    if ($Amount!=0) { $fpc_Amount=$Amount; }
  }
  return $fpc_Amount;
}

function Cmp_Anal_Efim($fpc_empid,$fpc_from,$fpc_to) {
  $Func_ret=array();
  $SQL1  = "SELECT EMP_ID, DTR_DATE, DTS_TYPE, TS_ANALYSIS_PKG.GET_HOLY_FLAG(EMP_ID,DTR_DATE) AS CUR_HOLY, TS_ANALYSIS_PKG.GET_HOLY_FLAG(EMP_ID,(DTR_DATE+1)) AS NEXT_HOLY ";
  $SQL1 .= " FROM TS_DUTY_TRANS T, TS_DUTIES D WHERE T.DTS_ID=D.DTS_ID AND DTS_TYPE=";
  $SQL2  = " AND DTR_DATE >= ".FormatDateForSQL(ConvertSQLDate($fpc_from))." AND DTR_DATE <= ".FormatDateForSQL(ConvertSQLDate($fpc_to))." AND EMP_ID=".$fpc_empid." ORDER BY DTR_DATE";
  $SQL   = $SQL1.'1 '.$SQL2;
  $normal = 0;
  $before_kyr = 0;
  $kath_to_arg = 0;
  $kyr = 0;
  $kyrkyr = 0;
  $RES =DB_query($SQL,$db);
  if ($RES) {
    while ($ROW =DB_fetch_array($RES)) {
      if ($ROW['CUR_HOLY']==0 && $ROW['NEXT_HOLY']==0) { $normal += 1; }
      if ($ROW['CUR_HOLY']==0 && $ROW['NEXT_HOLY']==1) {
        if (get_weekday_number(ConvertSQLDate($ROW['DTR_DATE']))==6) { $before_kyr += 1; }
        else { $kath_to_arg += 1; }
      }
      if ($ROW['CUR_HOLY']==1 && $ROW['NEXT_HOLY']==1) { $kyrkyr += 1; }
      if ($ROW['CUR_HOLY']==1 && $ROW['NEXT_HOLY']==0) { $kyr += 1; }
    }
  }
  $Func_ret['ENERG_ANAL1']=' :'.$normal."-”:".$before_kyr;
  $Func_ret['ENERG_ANAL2']="- /¡:".$kath_to_arg."-¡:".$kyr;
  $Func_ret['ENERG_ANAL3']="¡/¡:".$kyrkyr;
  $Func_ret['ANALEK']=$normal;
  $Func_ret['ANALES']=$before_kyr;
  $Func_ret['ANALEX']=$kath_to_arg;
  $Func_ret['ANALEA']=$kyr;
  $Func_ret['ANALEZ']=$kyrkyr;
  $SQL   = $SQL1.'2 '.$SQL2;
  $normal = 0;
  $before_kyr = 0;
  $kath_to_arg = 0;
  $kyr = 0;
  $kyrkyr = 0;
  $RES =DB_query($SQL,$db);
  if ($RES) {
    while ($ROW =DB_fetch_array($RES)) {
      if ($ROW['CUR_HOLY']==0 && $ROW['NEXT_HOLY']==0) { $normal += 1; }
      if ($ROW['CUR_HOLY']==0 && $ROW['NEXT_HOLY']==1) {
        if (get_weekday_number(ConvertSQLDate($ROW['DTR_DATE']))==6) { $before_kyr += 1; }
        else { $kath_to_arg += 1; }
      }
      if ($ROW['CUR_HOLY']==1 && $ROW['NEXT_HOLY']==1) { $kyrkyr += 1; }
      if ($ROW['CUR_HOLY']==1 && $ROW['NEXT_HOLY']==0) { $kyr += 1; }
    }
  }
  $Func_ret['MIKT_ANAL1']=' :'.$normal."-”:".$before_kyr;
  $Func_ret['MIKT_ANAL2']="- /¡:".$kath_to_arg."-¡:".$kyr;
  $Func_ret['MIKT_ANAL3']="¡/¡:".$kyrkyr;
  $Func_ret['ANALMK']=$normal;
  $Func_ret['ANALMS']=$before_kyr;
  $Func_ret['ANALMX']=$kath_to_arg;
  $Func_ret['ANALMA']=$kyr;
  $Func_ret['ANALMZ']=$kyrkyr;
  $SQL   = $SQL1.'3 '.$SQL2;
  $normal = 0;
  $before_kyr = 0;
  $kath_to_arg = 0;
  $kyr = 0;
  $kyrkyr = 0;
  $RES =DB_query($SQL,$db);
  if ($RES) {
    while ($ROW =DB_fetch_array($RES)) {
      if ($ROW['CUR_HOLY']==0 && $ROW['NEXT_HOLY']==0) { $normal += 1; }
      if ($ROW['CUR_HOLY']==0 && $ROW['NEXT_HOLY']==1) {
        if (get_weekday_number(ConvertSQLDate($ROW['DTR_DATE']))==6) { $before_kyr += 1; }
        else { $kath_to_arg += 1; }
      }
      if ($ROW['CUR_HOLY']==1 && $ROW['NEXT_HOLY']==1) { $kyrkyr += 1; }
      if ($ROW['CUR_HOLY']==1 && $ROW['NEXT_HOLY']==0) { $kyr += 1; }
    }
  }
  $Func_ret['ETOIM_ANAL1']=' :'.$normal."-”:".$before_kyr;
  $Func_ret['ETOIM_ANAL2']="- /¡:".$kath_to_arg."-¡:".$kyr;
  $Func_ret['ETOIM_ANAL3']="¡/¡:".$kyrkyr;
  $Func_ret['ANALTK']=$normal;
  $Func_ret['ANALTS']=$before_kyr;
  $Func_ret['ANALTX']=$kath_to_arg;
  $Func_ret['ANALTA']=$kyr;
  $Func_ret['ANALTZ']=$kyrkyr;
  return $Func_ret;
}

function Cmp_Date2TS($vDate) {
  $date_array=explode('/', $vDate);
  return mktime(12,0,0,$date_array[1],$date_array[0],$date_array[2]);
}

function fillMasterTable_Taktiki() {
  global  $db, $MasterTable, $PatFrom, $PatTo, $PatYearFrom, $PatYearTo, $HeadPrintPage;
  $sql_master  = "SELECT PAYROLL_TRANSACTIONS.PAY_ID, PAYROLL_TRANSACTIONS.PAY_DATE, PAYROLL_TRANSACTIONS.PAY_COMMENTS, ";
  $sql_master .= "       PAYROLL_TRANSACTIONS.PAT_ID, PAYROLL_TYPES.PAT_DESCRIPTION, PAYROLL_TRANSACTIONS.PAY_YEAR ";
  $sql_master .= "  FROM PAYROLL_TRANSACTIONS ";
  $sql_master .= "       LEFT JOIN PAYROLL_TYPES ON PAYROLL_TRANSACTIONS.PAT_ID=PAYROLL_TYPES.PAT_ID ";
  $sql_master .= " WHERE PAYROLL_TRANSACTIONS.LOCK_MISTH>=".$PatYearFrom.$PatFrom;
  $sql_master .= "       AND PAYROLL_TRANSACTIONS.LOCK_MISTH<=".$PatYearTo.$PatTo;
  $sql_master .= " ORDER BY PAYROLL_TRANSACTIONS.PAY_YEAR, PAYROLL_TRANSACTIONS.PAT_ID";
  if ($sql_master!='') {
    $sql = $sql_master;
    $Result =DB_query($sql,$db);
  }
  while ($Row=DB_fetch_array($Result)) {
    $tablemasterrow = array();
    $YearPer = $Row['PAY_YEAR'].substr('0'.$Row['PAT_ID'],-2,2);
    $tablemasterrow['PAY_COMMENTS'] = $HeadPrintPage.' [ '.$Row['PAT_DESCRIPTION']." ".$Row['PAY_YEAR'].' ]';
    $tablemasterrow['PAY_ID'] = $Row['PAY_ID'];
    $tablemasterrow['PER_YEAR'] = $Row['PAY_YEAR'];
    $tablemasterrow['PER_MONTH'] = $Row['PAT_ID'];
    $MasterTable[$YearPer] = $tablemasterrow;
  }
}

function fillMasterTable_Vardies() {
  global  $db, $MasterTable, $PatFrom, $PatTo, $PatYearFrom, $PatYearTo, $HeadPrintPage;
  $sql_master  = "SELECT PAYROLL_TRANSACTIONS.PAY_ID, PAYROLL_TRANSACTIONS.PAY_DATE, PAYROLL_TRANSACTIONS.PAY_COMMENTS, ";
  $sql_master .= "       PAYROLL_TRANSACTIONS.PAT_ID, PAYROLL_TYPES.PAT_DESCRIPTION, PAYROLL_TRANSACTIONS.PAY_YEAR ";
  $sql_master .= "  FROM PAYROLL_TRANSACTIONS ";
  $sql_master .= "       LEFT JOIN PAYROLL_TYPES ON PAYROLL_TRANSACTIONS.PAT_ID=PAYROLL_TYPES.PAT_ID ";
  $sql_master .= " WHERE PAYROLL_TRANSACTIONS.LOCK_VARD>=".$PatYearFrom.$PatFrom;
  $sql_master .= "       AND PAYROLL_TRANSACTIONS.LOCK_VARD<=".$PatYearTo.$PatTo;
  $sql_master .= " ORDER BY PAYROLL_TRANSACTIONS.PAY_YEAR, PAYROLL_TRANSACTIONS.PAT_ID";
  if ($sql_master!='') {
    $sql = $sql_master;
    $Result =DB_query($sql,$db);
  }
  while ($Row=DB_fetch_array($Result)) {
    $tablemasterrow = array();
    $YearPer = $Row['PAY_YEAR'].substr('0'.$Row['PAT_ID'],-2,2);
    $tablemasterrow['PAY_COMMENTS'] = $HeadPrintPage.' [ '.$Row['PAT_DESCRIPTION']." ".$Row['PAY_YEAR'].' ]';
    $tablemasterrow['PAY_ID'] = $Row['PAY_ID'];
    $tablemasterrow['PER_YEAR'] = $Row['PAY_YEAR'];
    $tablemasterrow['PER_MONTH'] = $Row['PAT_ID'];
    $MasterTable[$YearPer] = $tablemasterrow;
  }
}

function fillMasterTable_compare1() {
  global  $db, $MasterTable, $PatFrom, $PatTo, $PatYear,$PatYearFrom, $PatYearTo, $HeadPrintPage;
  $sql_master  = "SELECT PAYROLL_TRANSACTIONS.PAY_ID, PAYROLL_TRANSACTIONS.PAY_DATE, PAYROLL_TRANSACTIONS.PAY_COMMENTS, ";
  $sql_master .= "       PAYROLL_TRANSACTIONS.PAT_ID, PAYROLL_TYPES.PAT_DESCRIPTION, PAYROLL_TRANSACTIONS.PAY_YEAR ";
  $sql_master .= "  FROM PAYROLL_TRANSACTIONS ";
  $sql_master .= "       LEFT JOIN PAYROLL_TYPES ON PAYROLL_TRANSACTIONS.PAT_ID=PAYROLL_TYPES.PAT_ID ";
  $sql_master .= " WHERE PAYROLL_TRANSACTIONS.PAY_YEAR||substr('0'||PAYROLL_TRANSACTIONS.PAT_ID,-2,2) >=".$PatYear.substr('0'.$PatFrom,-2,2);
  $sql_master .= "       AND PAYROLL_TRANSACTIONS.PAY_YEAR||substr('0'||PAYROLL_TRANSACTIONS.PAT_ID,-2,2) <=".$PatYear.substr('0'.$PatFrom,-2,2);
  $sql_master .= " ORDER BY PAYROLL_TRANSACTIONS.PAY_YEAR, PAYROLL_TRANSACTIONS.PAT_ID";
  if ($sql_master!='') {
    $sql = $sql_master;
    $Result =DB_query($sql,$db);
  }
  while ($Row=DB_fetch_array($Result)) {
    $tablemasterrow = array();
    $YearPer = $Row['PAY_YEAR'].substr('0'.$Row['PAT_ID'],-2,2);
    $tablemasterrow['PAY_COMMENTS'] = $HeadPrintPage.' [ '.$Row['PAT_DESCRIPTION']." ".$Row['PAY_YEAR'].' ]';
    $tablemasterrow['PAY_ID'] = $Row['PAY_ID'];
    $tablemasterrow['PER_YEAR'] = $Row['PAY_YEAR'];
    $tablemasterrow['PER_MONTH'] = $Row['PAT_ID'];
    $MasterTable[$YearPer] = $tablemasterrow;
  }
}


function fillMasterTable_compare2() {
  global  $db, $MasterTable, $PatFrom2, $PatTo, $PatYear2,$PatYearFrom, $PatYearTo, $HeadPrintPage;
 $sql_master  = "SELECT PAYROLL_TRANSACTIONS.PAY_ID, PAYROLL_TRANSACTIONS.PAY_DATE, PAYROLL_TRANSACTIONS.PAY_COMMENTS, ";
  $sql_master .= "       PAYROLL_TRANSACTIONS.PAT_ID, PAYROLL_TYPES.PAT_DESCRIPTION, PAYROLL_TRANSACTIONS.PAY_YEAR ";
  $sql_master .= "  FROM PAYROLL_TRANSACTIONS ";
  $sql_master .= "       LEFT JOIN PAYROLL_TYPES ON PAYROLL_TRANSACTIONS.PAT_ID=PAYROLL_TYPES.PAT_ID ";
  $sql_master .= " WHERE PAYROLL_TRANSACTIONS.PAY_YEAR||substr('0'||PAYROLL_TRANSACTIONS.PAT_ID,-2,2) >=".$PatYear2.substr('0'.$PatFrom2,-2,2);
  $sql_master .= "       AND PAYROLL_TRANSACTIONS.PAY_YEAR||substr('0'||PAYROLL_TRANSACTIONS.PAT_ID,-2,2) <=".$PatYear2.substr('0'.$PatFrom2,-2,2);
  $sql_master .= " ORDER BY PAYROLL_TRANSACTIONS.PAY_YEAR, PAYROLL_TRANSACTIONS.PAT_ID";
  if ($sql_master!='') {
    $sql = $sql_master;
    $Result =DB_query($sql,$db);
  }
  while ($Row=DB_fetch_array($Result)) {
    $tablemasterrow = array();
    $YearPer = $Row['PAY_YEAR'].substr('0'.$Row['PAT_ID'],-2,2);
    $tablemasterrow['PAY_COMMENTS'] = $HeadPrintPage.' [ '.$Row['PAT_DESCRIPTION']." ".$Row['PAY_YEAR'].' ]';
    $tablemasterrow['PAY_ID'] = $Row['PAY_ID'];
    $tablemasterrow['PER_YEAR'] = $Row['PAY_YEAR'];
    $tablemasterrow['PER_MONTH'] = $Row['PAT_ID'];
    $MasterTable[$YearPer] = $tablemasterrow;
  }
}


function fillMasterTable_Efimeries() {
  global  $db, $MasterTable, $PatFrom, $PatTo, $PatYearFrom, $PatYearTo, $HeadPrintPage;
  $sql_master  = "SELECT PAYROLL_TRANSACTIONS.PAY_ID, PAYROLL_TRANSACTIONS.PAY_DATE, PAYROLL_TRANSACTIONS.PAY_COMMENTS, ";
  $sql_master .= "       PAYROLL_TRANSACTIONS.PAT_ID, PAYROLL_TYPES.PAT_DESCRIPTION, PAYROLL_TRANSACTIONS.PAY_YEAR ";
  $sql_master .= "  FROM PAYROLL_TRANSACTIONS ";
  $sql_master .= "       LEFT JOIN PAYROLL_TYPES ON PAYROLL_TRANSACTIONS.PAT_ID=PAYROLL_TYPES.PAT_ID ";
  $sql_master .= " WHERE PAYROLL_TRANSACTIONS.LOCK_EFIM>=".$PatYearFrom.$PatFrom;
  $sql_master .= "       AND PAYROLL_TRANSACTIONS.LOCK_EFIM<=".$PatYearTo.$PatTo;
  $sql_master .= " ORDER BY PAYROLL_TRANSACTIONS.PAY_YEAR, PAYROLL_TRANSACTIONS.PAT_ID";
  if ($sql_master!='') {
    $sql = $sql_master;
    $Result =DB_query($sql,$db);
  }
  while ($Row=DB_fetch_array($Result)) {
    $tablemasterrow = array();
    $YearPer = $Row['PAY_YEAR'].substr('0'.$Row['PAT_ID'],-2,2);
    $tablemasterrow['PAY_COMMENTS'] = $HeadPrintPage.' [ '.$Row['PAT_DESCRIPTION']." ".$Row['PAY_YEAR'].' ]';
    $tablemasterrow['PAY_ID'] = $Row['PAY_ID'];
    $tablemasterrow['PER_YEAR'] = $Row['PAY_YEAR'];
    $tablemasterrow['PER_MONTH'] = $Row['PAT_ID'];
    $MasterTable[$YearPer] = $tablemasterrow;
  }
}

function fillMasterTable_Ipervaseis() {
  global  $db, $MasterTable, $PatFrom, $PatTo, $PatYearFrom, $PatYearTo, $HeadPrintPage;
  $sql_master  = "SELECT PAYROLL_TRANSACTIONS.PAY_ID, PAYROLL_TRANSACTIONS.PAY_DATE, PAYROLL_TRANSACTIONS.PAY_COMMENTS, ";
  $sql_master .= "       PAYROLL_TRANSACTIONS.PAT_ID, PAYROLL_TYPES.PAT_DESCRIPTION, PAYROLL_TRANSACTIONS.PAY_YEAR ";
  $sql_master .= "  FROM PAYROLL_TRANSACTIONS ";
  $sql_master .= "       LEFT JOIN PAYROLL_TYPES ON PAYROLL_TRANSACTIONS.PAT_ID=PAYROLL_TYPES.PAT_ID ";
  $sql_master .= " WHERE PAYROLL_TRANSACTIONS.LOCK_IPERV>=".$PatYearFrom.$PatFrom;
  $sql_master .= "       AND PAYROLL_TRANSACTIONS.LOCK_IPERV<=".$PatYearTo.$PatTo;
  $sql_master .= " ORDER BY PAYROLL_TRANSACTIONS.PAY_YEAR, PAYROLL_TRANSACTIONS.PAT_ID";
  if ($sql_master!='') {
    $sql = $sql_master;
    $Result =DB_query($sql,$db);
  }
  while ($Row=DB_fetch_array($Result)) {
    $tablemasterrow = array();
    $YearPer = $Row['PAY_YEAR'].substr('0'.$Row['PAT_ID'],-2,2);
    $tablemasterrow['PAY_COMMENTS'] = $HeadPrintPage.' [ '.$Row['PAT_DESCRIPTION']." ".$Row['PAY_YEAR'].' ]';
    $tablemasterrow['PAY_ID'] = $Row['PAY_ID'];
    $tablemasterrow['PER_YEAR'] = $Row['PAY_YEAR'];
    $tablemasterrow['PER_MONTH'] = $Row['PAT_ID'];
    $MasterTable[$YearPer] = $tablemasterrow;
  }
}


function fillMasterTable() {
  global  $db, $MasterTable, $PatFrom, $PatTo, $PatYearFrom, $PatYearTo, $HeadPrintPage;
  $sql_master  = "SELECT PAYROLL_TRANSACTIONS.PAY_ID, PAYROLL_TRANSACTIONS.PAY_DATE, PAYROLL_TRANSACTIONS.PAY_COMMENTS, ";
  $sql_master .= "       PAYROLL_TRANSACTIONS.PAT_ID, PAYROLL_TYPES.PAT_DESCRIPTION, PAYROLL_TRANSACTIONS.PAY_YEAR ";
  $sql_master .= "  FROM PAYROLL_TRANSACTIONS ";
  $sql_master .= "       LEFT JOIN PAYROLL_TYPES ON PAYROLL_TRANSACTIONS.PAT_ID=PAYROLL_TYPES.PAT_ID ";
  $sql_master .= " WHERE PAYROLL_TRANSACTIONS.PAY_YEAR||substr('0'||PAYROLL_TRANSACTIONS.PAT_ID,-2,2) >=".$PatYearFrom.substr('0'.$PatFrom,-2,2);
  $sql_master .= "       AND PAYROLL_TRANSACTIONS.PAY_YEAR||substr('0'||PAYROLL_TRANSACTIONS.PAT_ID,-2,2) <=".$PatYearTo.substr('0'.$PatTo,-2,2);
  $sql_master .= " ORDER BY PAYROLL_TRANSACTIONS.PAY_YEAR, PAYROLL_TRANSACTIONS.PAT_ID";
//ECHO $sql_master;DIE();
  if ($sql_master!='') {
    $sql = $sql_master;
    $Result =DB_query($sql,$db);
  }
  while ($Row=DB_fetch_array($Result)) {
    $tablemasterrow = array();
    $YearPer = $Row['PAY_YEAR'].substr('0'.$Row['PAT_ID'],-2,2);
    $tablemasterrow['PAY_COMMENTS'] = $HeadPrintPage.' [ '.$Row['PAT_DESCRIPTION']." ".$Row['PAY_YEAR'].' ]';
    $tablemasterrow['PAY_ID'] = $Row['PAY_ID'];
    $tablemasterrow['PER_YEAR'] = $Row['PAY_YEAR'];
    $tablemasterrow['PER_MONTH'] = $Row['PAT_ID'];
    $MasterTable[$YearPer] = $tablemasterrow;
  }
}

function fillDetailTable($masterrow) {

  global $db, $DetailTable, $Compute_Payroll, $empwhere, $emporder, $ListBox3, $Analysi_Efim, $Taktiki_Mikta,$payroll_code,$afm_code;
  $Payid    = $masterrow['PAY_ID'];
  $PerYear  = $masterrow['PER_YEAR'];
  $PerMonth = $masterrow['PER_MONTH'];

  $sql  = "SELECT EMPLOYEES.EMP_ID, EMPLOYEES.EMP_PAYROLL_CODE, EMPLOYEES.EMP_LAST_NAME, EMPLOYEES.EMP_FIRST_NAME, EMPLOYEES.EMP_FATHER_NAME,
                  EMPLOYEES.EMP_PAYROLL_CODE, EMPLOYEES.EMP_PAYTIME, EMPLOYEES.EMP_FIREDATE, EMPLOYEES.EMP_HIREDATE,
                  EMPLOYEES.EMP_AMKA, EMPLOYEES.EMP_IDENTITY_NUMBER, EMPLOYEES.EMP_TAX_NUMBER, EMPLOYEES.EMP_IKA_AM,
                  EMPLOYEES.EMP_HIREDATE, EMPLOYEES.EMP_FIREDATE,EMPLOYEES.EMP_PHONE1,EMPLOYEES.EMP_EMAIL, EMP_START_OBLIG, EMP_TSAY_AM, EMP_TSAY_WR,EMPLOYEES.EMP_ISDOCTOR,EMPLOYEES.EMP_PAYTIME,
                  EMP_TSAY_CATEG, EMP_TSAY_RESP, EMP_TSAY_NEW, EMP_TSAY_TIME, EMP_TSAY_FOR,EMPLOYEES.EAPD_KRIT_ID,
                  ERG_CATEGORY.ECAT_XML_CODE, ERG_CATEGORY.ECAT_DESCR, ERG_CRAFT.ECRAFT_DESCR,
                  ERG_WORK_REL.EWREL_YPRG_CODE, FOREIS.FOR_DESCR, YPHRESIES.YPHR_DESCR,COSTCENTERS.COSTC_DESCR,EMPLOYEES.FOR_ID
             FROM EMPLOYEES
                  LEFT JOIN FOREIS ON EMPLOYEES.FOR_ID=FOREIS.FOR_ID
                  LEFT JOIN ERG_CATEGORY ON EMPLOYEES.ECAT_ID1=ERG_CATEGORY.ECAT_ID
                  LEFT JOIN ERG_WORK_REL ON EMPLOYEES.EWREL_ID=ERG_WORK_REL.EWREL_ID
                  LEFT JOIN ERG_CRAFT ON EMPLOYEES.ECRAFT_ID1=ERG_CRAFT.ECRAFT_ID
                  LEFT JOIN YPHRESIES ON EMPLOYEES.YPHR_ID = YPHRESIES.YPHR_ID
              LEFT JOIN COSTCENTERS ON EMPLOYEES.COSTC_ID = COSTCENTERS.COSTC_ID
            WHERE 1=1  and EMPLOYEES.EMP_PAYROLL_CODE='".$payroll_code."' and EMPLOYEES.EMP_TAX_NUMBER='".$afm_code."'";
  $DetailsResult =DB_query($sql,$db);
  while ($DetailRow=DB_fetch_array($DetailsResult)) {
    set_time_limit(0);
    $Emp_id = $DetailRow['EMP_ID'];
    $Sal_id = Get_Salid($Emp_id,$Payid);








    if ($Sal_id=='') { continue; }
    $SQL_sal = "SELECT * FROM SALARY WHERE SALARY.PAY_ID = ".$Payid." AND SALARY.EMP_ID = ".$Emp_id;

    $RES_sal = DB_query($SQL_sal,$db);
    while ($ROW_sal=DB_fetch_array($RES_sal)) {
      $Sum_Credit     = 0;
      $Sum_Debit      = 0;
      $Sum_plus       = 0;
      $Sum_plus_anadr = 0;
      $Sum_plus_efyp  = 0;
      $Sum_minus      = 0;
      $Sum_minus_anadr= 0;
      $Sum_minus_efyp = 0;
      $Sal_id = $ROW_sal['SAL_ID'];
      $tablemasterrow = array();
      $tablemasterrow['TWA_EMP_ID']         = $Emp_id;
      $tablemasterrow['TWA_SAL_ID']         = $Sal_id;
      $tablemasterrow['TWA_ASTHEN_APO']     = $ROW_sal['ASTHEN_APO'];
      $tablemasterrow['TWA_EMP_CODE']       = $DetailRow['EMP_PAYROLL_CODE'];
      $tablemasterrow['TWA_LAST_NAME']      = $DetailRow['EMP_LAST_NAME'];
      $tablemasterrow['TWA_FIRST_NAME']     = $DetailRow['EMP_FIRST_NAME'];
      $tablemasterrow['TWA_FATHER_NAME']    = $DetailRow['EMP_FATHER_NAME'];
      $tablemasterrow['TWA_WORK_REL_ORIG']  = $DetailRow['EWREL_YPRG_CODE'];
      $tablemasterrow['TWA_WORK_REL']       = $DetailRow['EWREL_YPRG_CODE'];
      $tablemasterrow['TWA_WORK_REL_REAL']  = $DetailRow['EWREL_YPRG_CODE'];
      $tablemasterrow['TWA_PAYTIME']        = $DetailRow['EMP_PAYTIME'];
      $tablemasterrow['TWA_HIREDATE']       = ConvertSQLDate($DetailRow['EMP_HIREDATE']);
      $tablemasterrow['TWA_FIREDATE']       = ConvertSQLDate($DetailRow['EMP_FIREDATE']);
      $tablemasterrow['TWA_AMKA']           = $DetailRow['EMP_AMKA'];
      $tablemasterrow['TWA_IDENTITY_NUMBER']= $DetailRow['EMP_IDENTITY_NUMBER'];
      $tablemasterrow['TWA_TAX_NUMBER']     = $DetailRow['EMP_TAX_NUMBER'];
      $tablemasterrow['TWA_IKA_AM']         = $DetailRow['EMP_IKA_AM'];
      $tablemasterrow['TWA_CATEGORY']       = $DetailRow['ECAT_XML_CODE'];
      $tablemasterrow['TWA_ERG_CATEG']      = $DetailRow['ECAT_DESCR'];
      $tablemasterrow['TWA_EIDIKOTITA']     = $DetailRow['ECRAFT_DESCR'];
      $tablemasterrow['TWA_FOREAS']         = $DetailRow['FOR_DESCR'];
      $tablemasterrow['TWA_YPHRESIA']       = $DetailRow['YPHR_DESCR'];
      $tablemasterrow['TWA_TSAY_AM']        = $DetailRow['EMP_TSAY_AM'];
      $tablemasterrow['TWA_START_OBLIG']    = ConvertSQLDate($DetailRow['EMP_START_OBLIG']);
      $tablemasterrow['TWA_TSAY_WR']        = $DetailRow['EMP_TSAY_WR'];
      $tablemasterrow['TWA_TSAY_CATEG']     = $DetailRow['EMP_TSAY_CATEG'];
      $tablemasterrow['TWA_TSAY_RESP']      = $DetailRow['EMP_TSAY_RESP'];
      $tablemasterrow['TWA_TSAY_NEW']       = $DetailRow['EMP_TSAY_NEW'];
      $tablemasterrow['TWA_TSAY_TIME']      = $DetailRow['EMP_TSAY_TIME'];
      $tablemasterrow['TWA_TSAY_FOR']       = $DetailRow['EMP_TSAY_FOR'];
      $tablemasterrow['TWA_PHONE']          = $DetailRow['EMP_PHONE1'];
      $tablemasterrow['TWA_EMAIL']          = $DetailRow['EMP_EMAIL'];
      $tablemasterrow['TWA_EMP_IS_DOCTOR']  = $DetailRow['EMP_ISDOCTOR'];
      $tablemasterrow['TWA_EMP_PAYTIME']    = $DetailRow['EMP_PAYTIME'];
      $tablemasterrow['TWA_DAYS']           = $ROW_sal['SAL_RUN_DAYS'];
      $tablemasterrow['TWA_COSTC']          = $DetailRow['COSTC_DESCR'];
      $Eapd_krit_id                         = $DetailRow['EAPD_KRIT_ID'];
      $for_id                               = $DetailRow['FOR_ID'];
      $Work_relation = $DetailRow['EWREL_YPRG_CODE'];
	  $tablemasterrow['TWA_SALARY_ID']      = $DetailRow['TWA_SALARY_ID'];


      $Pliromi='';
      $Month_misth=intval(getMonthFromDate(str_replace("-","/",$ROW_sal['SAL_DATE'])));
      $tablemasterrow['TWA_SAL_MONTH']    = $Month_misth;
      if ($Month_misth!=$PerMonth) { $Pliromi='A';}
//_____B_____: VATMOS KLIMAKIO - VATHMOS IATROY
      $VathmKlim = Get_VathmosDescr($Emp_id);
      $Vathmos_iatr=$VathmKlim['vathm'];


      $tablemasterrow['TWA_VATHMOS'] = $VathmKlim['out'];
      $tablemasterrow['TWA_VATHMOS_ONLY']=substr($tablemasterrow['TWA_VATHMOS'],0,2);
      $tablemasterrow['TWA_KLIMAKIO_ONLY']=substr($tablemasterrow['TWA_VATHMOS'],2,4);

      $tablemasterrow['TWA_VATHM_XML_CODE']=$VathmKlim['xml'];

      if($tablemasterrow['TWA_VATHM_XML_CODE']==null){$tablemasterrow['TWA_VATHM_XML_CODE']=998;}

      if ($Vathmos_iatr==0 || $Vathmos_iatr==7 || $Vathmos_iatr==8 || $Vathmos_iatr==9 ){

      $tablemasterrow['TWA_VATHMOS_AFT'] = $VathmKlim['out'];
       $tablemasterrow['TWA_VATHMOS_ONLY']=substr($tablemasterrow['TWA_VATHMOS_AFT'],0,2);
       $tablemasterrow['TWA_KLIMAKIO_ONLY']=substr($tablemasterrow['TWA_VATHMOS_AFT'],2,4);

    }
      //if ( $VathmKlim['vathm']==15 && $_SESSION['GLInstall'] == 'ELPIS' && $Emp_id==545 ){$tablemasterrow['TWA_WORK_REL']  = 9;}
      if ( $VathmKlim['vathm']==7 || $VathmKlim['vathm']==8 || $VathmKlim['vathm']==9){$tablemasterrow['TWA_WORK_REL']  = 1;}
      if ( $VathmKlim['vathm']!=0 &&  (($VathmKlim['vathm']!=15) && ($VathmKlim['vathm']!=7) && ($VathmKlim['vathm']!=8)&& ($VathmKlim['vathm']!=9))){$tablemasterrow['TWA_WORK_REL']  = 9;}
      if ( $VathmKlim['vathm']==5 || $VathmKlim['vathm']==6 || $VathmKlim['vathm']==10 || $VathmKlim['vathm']==11){$tablemasterrow['TWA_WORK_REL']  = 8;}
      if ( $VathmKlim['vathm']==14){$tablemasterrow['TWA_WORK_REL']  = 4;}


     if ($Vathmos_iatr>0 AND ($Vathmos_iatr!=15 AND $Vathmos_iatr!=7 AND $Vathmos_iatr!=8 AND $Vathmos_iatr!=9)){


      $tablemasterrow['TWA_VATHMOS_AFT'] = $VathmKlim['out'];
      $tablemasterrow['TWA_VATHMOS_ONLY']=substr($tablemasterrow['TWA_VATHMOS_AFT'],0,2);
      $tablemasterrow['TWA_KLIMAKIO_ONLY']=substr($tablemasterrow['TWA_VATHMOS_AFT'],2,4);





     $tablemasterrow['TWA_VATHMOS_IATR']=$Vathmos_iatr;
     $desc_vathm=$tablemasterrow['TWA_VATHMOS'];
     $plafon_efimerion=plafon_efimerion($desc_vathm);
     $tablemasterrow['PLAFON_EFIM']=$plafon_efimerion;
     $tablemasterrow['TWA_VATHMOS_ONLY']=$tablemasterrow['TWA_VATHMOS'];


     $tablemasterrow['TWA_VATHMOS_ONLY']=substr($tablemasterrow['TWA_VATHMOS_AFT'],0,10);
     $tablemasterrow['TWA_KLIMAKIO_ONLY']='';

       if (in_array($Vathmos_iatr,array(1,2,3,4,5,6,7,8,9,10,11,12,13))) {      // an einai iatros
        $tablemasterrow['TWA_EMP_IS_DOCTOR']=1;
      }
       else{
        $tablemasterrow['TWA_EMP_IS_DOCTOR']=0;
       }

    }
      elseif ($Vathmos_iatr==15){


       $tablemasterrow['TWA_VATHMOS_AFT'] = $VathmKlim['out'];
       $tablemasterrow['TWA_VATHMOS_ONLY']=substr($tablemasterrow['TWA_VATHMOS'],0,2);
       $tablemasterrow['TWA_KLIMAKIO_ONLY']=substr($tablemasterrow['TWA_VATHMOS'],2,4);

    }

     else{
      $tablemasterrow['TWA_EMP_IS_DOCTOR']=0;
      }


//_____E_____: VATMOS KLIMAKIO - VATHMOS IATROY
//_____B_____: DATEAPO-DATETO
      $Date_hire   = ConvertSQLDate($DetailRow['EMP_HIREDATE']);
      $Date_fire   = ConvertSQLDate($DetailRow['EMP_FIREDATE']);
      $tablemasterrow['TWA_ASFALHMER'] = $ROW_sal['SAL_RUN_DAYS'];
      if($tablemasterrow['TWA_ASFALHMER']==null){$tablemasterrow['TWA_ASFALHMER']=$ROW_sal['SAL_WORK_DAYS'];}
      $tablemasterrow['TWA_ASFALHMER_KLIN']=Get_Days_kliniko($Emp_id); //ÏÔÌÔ „È· ·ÎÂÓ·Ì‰ÒÔıÔÎÁ „È· ÙÔ ÍÎÈÌÈÍÔ Âﬂ‰ÔÏ·
	  
	  
	  //$tablemasterrow['TWA_ASFALHMER'] = $ROW_sal['SAL_WORK_DAYS'];
      $Date_to_per = ConvertSQLDate($ROW_sal['SAL_DATE']);
      $Date_from_per = '01/'.substr($Date_to_per,3,2).'/'.substr($Date_to_per,6,4);
      $tablemasterrow['TWA_FROM_PER'] = $Date_from_per;
      $tablemasterrow['TWA_TO_PER'] = $Date_to_per;
      if ($Date_hire!='' && (Cmp_Date2TS($Date_hire) > Cmp_Date2TS($Date_from_per) && Cmp_Date2TS($Date_hire) < Cmp_Date2TS($Date_to_per))) { $tablemasterrow['TWA_FROM_PER'] = $Date_hire; }
      if ($Date_fire!='' && (Cmp_Date2TS($Date_fire) > Cmp_Date2TS($Date_from_per) && Cmp_Date2TS($Date_fire) < Cmp_Date2TS($Date_to_per))) { $tablemasterrow['TWA_TO_PER'] = $Date_fire; }
//_____E_____: DATEAPO-DATETO
//_____B_____: IBAN
      $SQL = "SELECT * FROM BANKACCOUNTS WHERE EMP_ID = ".$Emp_id." and BAC_TYPE=1";
      $RES = DB_query($SQL,$db);
      $TMPROW=DB_fetch_array($RES);
      $tablemasterrow['TWA_IBAN'] = $TMPROW['BAC_ISBN'];
//_____E_____: IBAN

      if (in_array($Compute_Payroll,array('All','1','3'))) {
        $SQL = "SELECT * FROM SALARY_EMP_DETAIL WHERE SAL_ID = ".$Sal_id;
        $RES = DB_query($SQL,$db);
        while ($ROW=DB_fetch_array($RES)) {
          $Module=$ROW['ESAD_MODULE'];
          $Amount=$ROW['ESAD_CREDIT']-$ROW['ESAD_DEBIT'];
          $MisthVar=Get_Mod_VarName($Module,$ROW['BDL_ID']);
        if($MisthVar=='SOMATEIO1'){
           if($_SESSION['GLInstall'] == 'DRAMANOSOK') {$MisthVar='SOMATEIO1';}
          else{$MisthVar='SOMATEIO';}
        }

         if($MisthVar=='SOMATEIO2'){
           if($_SESSION['GLInstall'] == 'DRAMANOSOK') {$MisthVar='SOMATEIO2';}
          else{$MisthVar='SOMATEIO';}
        }
          if ($MisthVar=='AGNOSTO') {  }
          else {
            if ($Module=='BAS') { $tablemasterrow['T_BASIC'] += $Amount; }
            elseif ($Module=='TAX') { $tablemasterrow['T_FMY'] -= $Amount; }
            elseif ($Module=='BEN') {
              $tablemasterrow['T_BENEFITS'] += $Amount;
              $tablemasterrow['TB_'.$MisthVar] += $Amount;
            }
            elseif ($Module=='EBEN' || $Module=='XBEN') {
              $tablemasterrow['T_XBENEFITS'] += $Amount;
              $tablemasterrow['TF_'.$MisthVar] += $Amount;
            }
            elseif ($Module=='DED') {
              $tablemasterrow['T_DEDUCTIONS'] -= $Amount;
              $tablemasterrow['TD_'.$MisthVar] -= $Amount;
           }



         elseif ($Module=='EDED') {
              $tablemasterrow['T_XDEDUCTIONS'] -= $Amount;
              $tablemasterrow['TK_'.$MisthVar] -= $Amount;
            }
            elseif ($Module=='LOAN') {
              $tablemasterrow['T_LOANS'] -= $Amount;
              $tablemasterrow['TL_'.$MisthVar] -= $Amount;
           $id=$ROW['ESAD_MODULEID'];
           $SQL_LOAN = "SELECT * FROM LOAN_DETAILS WHERE LOD_ID = ".$id;
              $RES_LOAN = DB_query($SQL_LOAN,$db);
           $ROW=DB_fetch_array($RES_LOAN);
           $LOA_ID=$ROW['LOA_ID'];
           if ($LOA_ID==null){$tablemasterrow['LL_'.$MisthVar.'DATE']='deleted';}
           else{
           $SQL_LOAN_DATE = "SELECT * FROM LOANS WHERE LOA_ID = ".$LOA_ID;
              $RES_LOAN_DATE = DB_query($SQL_LOAN_DATE,$db);
           $ROW_DATE=DB_fetch_array($RES_LOAN_DATE);
           $LOA_DATE=ConvertSQLDate($ROW_DATE['LOA_DATEEND']);
           $tablemasterrow['LL_'.$MisthVar.'DATE']=$LOA_DATE;
           }
            }
            elseif ($Module=='REC') {
              $tablemasterrow['T_RECOGNITIONS'] -= $Amount;
              $tablemasterrow['TR_'.$MisthVar] -= $Amount;
            }
            elseif (substr($Module,0,3)=='RED' || substr($Module,0,3)=='RRD') {
              $tablemasterrow['T_REDUCTIONS'] -= $Amount;
              $tablemasterrow['TM_'.$MisthVar] -= $Amount;
            }
            elseif ($Module=='RETR') { $tablemasterrow['T_RETRO_TAKT'] += $Amount; }
            else {  }
          }
        }
        $SQL = "SELECT * FROM SALARY_ERG_DETAIL WHERE SAL_ID = ".$Sal_id." ORDER BY OSAD_MODULE,OSAD_DESCRIPTION";
        $RES = DB_query($SQL,$db);
        while ($ROW=DB_fetch_array($RES)) {
          $Amount=$ROW['OSAD_CREDIT']-$ROW['OSAD_DEBIT'];
          $MisthVar=Get_Mod_VarName($ROW['OSAD_MODULE'],$ROW['BDL_ID']);
          if ($MisthVar=='AGNOSTO') {  }
          else {
            if ($ROW['OSAD_MODULE']=='DED') {
              $tablemasterrow['T_ERGDED'] -= $Amount;
              $tablemasterrow['TE_'.$MisthVar] -= $Amount;
            }
            elseif ($ROW['OSAD_MODULE']=='RETR') { $tablemasterrow['T_RETRO_T_ERGD'] += $Amount; }
            else {  }
          }
        }
        $Sum_plus  = $tablemasterrow['T_BASIC']+$tablemasterrow['T_BENEFITS']+$tablemasterrow['T_XBENEFITS'];
        $Sum_ded   = $tablemasterrow['T_DEDUCTIONS']+$tablemasterrow['T_XDEDUCTIONS'];
        $Sum_minus = $Sum_ded+$tablemasterrow['T_LOANS']+$tablemasterrow['T_RECOGNITIONS']+$tablemasterrow['T_REDUCTIONS']+$tablemasterrow['T_FMY'];
        $tablemasterrow['T_INCOME']     = $Sum_plus;
        $tablemasterrow['T_DED_ERGAZ']  = $Sum_ded;
		$tablemasterrow['T_ENTELOM']    = $Sum_plus+$tablemasterrow['T_ERGDED'];
        $tablemasterrow['T_XML_INCOME'] = $Sum_plus-$tablemasterrow['TF_KATALOGI'];
        $tablemasterrow['T_DED_TAX']    = $Sum_minus;
        $tablemasterrow['T_XML_DED']    = $Sum_minus-$tablemasterrow['TF_KATALOGI'];
        $tablemasterrow['TOT_DED_ERG']  = $Sum_ded+$tablemasterrow['T_FMY']+$tablemasterrow['T_ERGDED'];
        $tablemasterrow['T_PAID']       = $Sum_plus-$Sum_minus;
        $tablemasterrow['T_A_DEK']      = round(0.5*$tablemasterrow['T_PAID'],2);
        if ($Pliromi=='A') { $tablemasterrow['T_A_DEK'] = $tablemasterrow['T_PAID']; }
        $tablemasterrow['T_B_DEK']      = $tablemasterrow['T_PAID'] - $tablemasterrow['T_A_DEK'];
        $tablemasterrow['T_EKKATHARISMENO'] = $Sum_plus+$tablemasterrow['T_ERGDED']-$tablemasterrow['TF_KATALOGI'];

 

        if($tablemasterrow['TWA_PAYTIME']==1){
      $tablemasterrow['T_A_DEK']      = $tablemasterrow['T_PAID'];
      $tablemasterrow['T_B_DEK']      = round(0,2);
      $tablemasterrow['T_EKKATHARISMENO'] = $Sum_plus+$tablemasterrow['T_ERGDED']-$tablemasterrow['TF_KATALOGI'];
      }
	  
	  
	  if(($_SESSION['GLInstall'] == 'DRAMANOSOK') && ($for_id==61))
        {$tablemasterrow['T_EKKATHARISMENO'] = $Sum_plus+$Sum_ded+$tablemasterrow['T_ERGDED']-$tablemasterrow['TF_KATALOGI'];}
     }

      if (in_array($Compute_Payroll,array('All','2','3')))  {
        $SQL = "SELECT * FROM RETRO_DETAIL RD,RETRO_MASTER RM WHERE RM.SAL_ID_TO=".$Sal_id." AND RM.RMST_ID=RD.RMST_ID ORDER BY RDET_MODULE,RDET_DESCRIPTION";
        $RES = DB_query($SQL,$db);
        while ($ROW=DB_fetch_array($RES)) {
          $Amount=$ROW['RDET_CREDIT']-$ROW['RDET_DEBIT'];
          $MisthVar=Get_Mod_VarName($ROW['RDET_MODULE'],$ROW['BDL_ID']);
          if ($ROW['RDET_MODULE']=='BAS') { $tablemasterrow['A_BASIC'] += $Amount; }
          elseif ($ROW['RDET_MODULE']=='TAXR' || $ROW['RDET_MODULE']=='TAX') { $tablemasterrow['A_TAX'] -= $Amount; }
          elseif ($ROW['RDET_MODULE']=='BEN') {
            $tablemasterrow['A_BENEFITS'] += $Amount;
            $tablemasterrow['AB_'.$MisthVar] += $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='EBEN' || $ROW['RDET_MODULE']=='XBEN') {
            $tablemasterrow['A_XBENEFITS'] += $Amount;
            $tablemasterrow['AF_'.$MisthVar] += $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='DED' && $ROW['RDET_TYPE']==1) {
            $tablemasterrow['A_DEDUCTIONS'] -= $Amount;
            $tablemasterrow['AD_'.$MisthVar] -= $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='DED' && $ROW['RDET_TYPE']==2) {
            $tablemasterrow['A_ERGDED'] -= $Amount;
            $tablemasterrow['AE_'.$MisthVar] -= $Amount;
          }
          elseif (($ROW['RDET_MODULE']=='EDED' || $ROW['RDET_MODULE']=='XDED') && $ROW['RDET_TYPE']==1) {
            $tablemasterrow['A_XDEDUCTIONS'] -= $Amount;
            $tablemasterrow['AK_'.$MisthVar] -= $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='LOAN') {
            $tablemasterrow['A_LOANS'] -= $Amount;
            $tablemasterrow['AL_'.$MisthVar] -= $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='REC') {
            $tablemasterrow['A_RECOGNITIONS'] -= $Amount;
            $tablemasterrow['AR_'.$MisthVar] -= $Amount;
          }
          elseif (substr($ROW['RDET_MODULE'],0,3)=='RED' || substr($ROW['RDET_MODULE'],0,3)=='RRD') {
            $tablemasterrow['A_REDUCTIONS'] -= $Amount;
            $tablemasterrow['AM_'.$MisthVar] -= $Amount;
          }
          else { $tablemasterrow[$MisthVar] = $ROW['RDET_MODULE']; }
        }
		//if($tablemasterrow['AD_IKA']<>0 or $tablemasterrow['AD_IKA_ETAM']
		//   or $tablemasterrow['AE_IKA']<>0 or $tablemasterrow['AE_IKA_ETAM']<>0){
		//$tablemasterrow['AD_IKA']=$tablemasterrow['AD_IKA']+$tablemasterrow['AD_IKA_ETAM'];
		//$tablemasterrow['AE_IKA']=$tablemasterrow['AE_IKA']+$tablemasterrow['AE_IKA_ETAM'];
		//}
		
        $Sum_plus_anadr  = $tablemasterrow['A_BASIC']+$tablemasterrow['A_BENEFITS']+$tablemasterrow['A_XBENEFITS'];
        $Sum_ded_anadr   = $tablemasterrow['A_DEDUCTIONS']+$tablemasterrow['A_XDEDUCTIONS'];
        $Sum_minus_anadr = $Sum_ded_anadr+$tablemasterrow['A_LOANS']+$tablemasterrow['A_RECOGNITIONS']+$tablemasterrow['A_REDUCTIONS']+$tablemasterrow['A_TAX'];
        $tablemasterrow['A_INCOME']     = $Sum_plus_anadr;
        $tablemasterrow['A_ENTELOM']    = $Sum_plus_anadr+$tablemasterrow['A_ERGDED'];
        $tablemasterrow['A_DED_TAX']    = $Sum_minus_anadr;
        $tablemasterrow['A_PAID']       = $Sum_plus_anadr-$Sum_minus_anadr;
        $tablemasterrow['A_A_DEK']      = round($tablemasterrow['A_PAID'],2);
        $tablemasterrow['A_B_DEK']      = round(0,2);
      }

//-------------------------------------DIKASTIKA ANADROMIKA---------------------------------------------------------
     if ($Compute_Payroll==13)  {
      $RMST_ID = array();
      $SQL13 = "SELECT * FROM RETRO_MASTER RM WHERE RM.SAL_ID_TO=".$Sal_id." AND RMST_TAXED80=1 ORDER BY RMST_ID ASC";
        $RES13 = DB_query($SQL13,$db);
        while ($ROW13=DB_fetch_array($RES13)) {
        $RMST_ID[]=$ROW13['RMST_ID'];
        }

        $SQL = "SELECT * FROM RETRO_DETAIL RD,RETRO_MASTER RM WHERE RM.SAL_ID_TO=".$Sal_id." AND RM.RMST_ID=RD.RMST_ID AND RMST_TAXED80=1 AND RM.RMST_ID=".$RMST_ID[0]." ORDER BY RDET_MODULE,RDET_DESCRIPTION";
        $RES = DB_query($SQL,$db);

        while ($ROW=DB_fetch_array($RES)) {
      $rmst_id=$ROW['RMST_ID'];
          $Amount=$ROW['RDET_CREDIT']-$ROW['RDET_DEBIT'];
          $MisthVar=Get_Mod_VarName($ROW['RDET_MODULE'],$ROW['BDL_ID']);
          if ($ROW['RDET_MODULE']=='BAS') { $tablemasterrow['A_BASIC'] += $Amount;}

          elseif ($ROW['RDET_MODULE']=='TAXR' || $ROW['RDET_MODULE']=='TAX') { $tablemasterrow['A_TAX'] -= $Amount; }
          elseif ($ROW['RDET_MODULE']=='BEN') {
            $tablemasterrow['A_BENEFITS'] += $Amount;
            $tablemasterrow['AB_'.$MisthVar] += $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='EBEN' || $ROW['RDET_MODULE']=='XBEN') {
            $tablemasterrow['A_XBENEFITS'] += $Amount;
            $tablemasterrow['AF_'.$MisthVar] += $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='DED' && $ROW['RDET_TYPE']==1) {
            $tablemasterrow['A_DEDUCTIONS'] -= $Amount;
            $tablemasterrow['AD_'.$MisthVar] -= $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='DED' && $ROW['RDET_TYPE']==2) {
            $tablemasterrow['A_ERGDED'] -= $Amount;
            $tablemasterrow['AE_'.$MisthVar] -= $Amount;
          }
          elseif (($ROW['RDET_MODULE']=='EDED' || $ROW['RDET_MODULE']=='XDED') && $ROW['RDET_TYPE']==1) {
            $tablemasterrow['A_XDEDUCTIONS'] -= $Amount;
            $tablemasterrow['AK_'.$MisthVar] -= $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='LOAN') {
            $tablemasterrow['A_LOANS'] -= $Amount;
            $tablemasterrow['AL_'.$MisthVar] -= $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='REC') {
            $tablemasterrow['A_RECOGNITIONS'] -= $Amount;
            $tablemasterrow['AR_'.$MisthVar] -= $Amount;
          }
          elseif (substr($ROW['RDET_MODULE'],0,3)=='RED' || substr($ROW['RDET_MODULE'],0,3)=='RRD') {
            $tablemasterrow['A_REDUCTIONS'] -= $Amount;
            $tablemasterrow['AM_'.$MisthVar] -= $Amount;
          }
          else { $tablemasterrow[$MisthVar] = $ROW['RDET_MODULE']; }
        }
      $SQL1 = "SELECT * FROM RETRO_DETAIL RD,RETRO_MASTER RM WHERE RM.SAL_ID_TO=".$Sal_id." AND RM.RMST_ID=RD.RMST_ID AND RMST_TAXED80=1 AND RM.RMST_ID=".$RMST_ID[1]." ORDER BY RDET_MODULE,RDET_DESCRIPTION";
        $RES1= DB_query($SQL1,$db);
      //ECHO $SQL1;DIE();
       while ($ROW=DB_fetch_array($RES1)) {
          $Amount=$ROW['RDET_CREDIT']-$ROW['RDET_DEBIT'];
          $MisthVar=Get_Mod_VarName($ROW['RDET_MODULE'],$ROW['BDL_ID']);
          if ($ROW['RDET_MODULE']=='BAS') { $tablemasterrow['X_BASIC'] += $Amount; }
          elseif ($ROW['RDET_MODULE']=='TAXR' || $ROW['RDET_MODULE']=='TAX') { $tablemasterrow['X_TAX'] -= $Amount; }
          elseif ($ROW['RDET_MODULE']=='BEN') {
            $tablemasterrow['X_BENEFITS'] += $Amount;
            $tablemasterrow['XB_'.$MisthVar] += $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='EBEN' || $ROW['RDET_MODULE']=='XBEN') {
            $tablemasterrow['X_XBENEFITS'] += $Amount;
            $tablemasterrow['XF_'.$MisthVar] += $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='DED' && $ROW['RDET_TYPE']==1) {
            $tablemasterrow['X_DEDUCTIONS'] -= $Amount;
            $tablemasterrow['XD_'.$MisthVar] -= $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='DED' && $ROW['RDET_TYPE']==2) {
            $tablemasterrow['X_ERGDED'] -= $Amount;
            $tablemasterrow['XE_'.$MisthVar] -= $Amount;
          }
          elseif (($ROW['RDET_MODULE']=='EDED' || $ROW['RDET_MODULE']=='XDED') && $ROW['RDET_TYPE']==1) {
            $tablemasterrow['X_XDEDUCTIONS'] -= $Amount;
            $tablemasterrow['XK_'.$MisthVar] -= $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='LOAN') {
            $tablemasterrow['TA_LOANS'] -= $Amount;
            $tablemasterrow['TAL_'.$MisthVar] -= $Amount;
          }
          elseif ($ROW['RDET_MODULE']=='REC') {
            $tablemasterrow['X_RECOGNITIONS'] -= $Amount;
            $tablemasterrow['XR_'.$MisthVar] -= $Amount;
          }
          elseif (substr($ROW['RDET_MODULE'],0,3)=='RED' || substr($ROW['RDET_MODULE'],0,3)=='RRD') {
            $tablemasterrow['X_REDUCTIONS'] -= $Amount;
            $tablemasterrow['XM_'.$MisthVar] -= $Amount;
          }
          else { $tablemasterrow[$MisthVar] = $ROW['RDET_MODULE']; }
        }





        $Sum_plus_anadr  = $tablemasterrow['A_BASIC']+$tablemasterrow['A_BENEFITS']+$tablemasterrow['A_XBENEFITS']+$tablemasterrow['X_BASIC']+$tablemasterrow['X_BENEFITS']+$tablemasterrow['X_XBENEFITS'];
        $Sum_ded_anadr   = $tablemasterrow['A_DEDUCTIONS']+$tablemasterrow['A_XDEDUCTIONS']+$tablemasterrow['X_DEDUCTIONS']+$tablemasterrow['X_XDEDUCTIONS'];
        $Sum_minus_anadr = $Sum_ded_anadr+$tablemasterrow['A_LOANS']+$tablemasterrow['A_RECOGNITIONS']+$tablemasterrow['A_REDUCTIONS']+$tablemasterrow['A_TAX']+$Sum_ded_anadr+$tablemasterrow['X_LOANS']+$tablemasterrow['X_RECOGNITIONS']+$tablemasterrow['X_REDUCTIONS']+$tablemasterrow['X_TAX'];;


      }

//-----------------------------------------------------------------------------------------------------------------------------------------------------
      if (in_array($Compute_Payroll,array('All','4','5','6','7','8','9','14','17'))) {
        $SQL_ot = "SELECT SALARY.SAL_ID, EXTRA_SALARY.EXSAL_ID, EXTRA_SALARY.EXSAL_DATEFROM, EXTRA_SALARY.EXSAL_DATETO FROM EXTRA_SALARY, SALARY WHERE EXTRA_SALARY.SAL_ID = SALARY.SAL_ID AND  EXTRA_SALARY.EXSALARY_DS IS NULL AND EXTRA_SALARY.EMP_ID =".$Emp_id." AND SALARY.PAY_ID=".$Payid." AND SALARY.SAL_ID=".$Sal_id;

      $RES_ot = DB_query($SQL_ot,$db);
        $ROW_ot = DB_fetch_array($RES_ot);
        $Exsal_id = $ROW_ot['EXSAL_ID'];
        $Exsal_from = $ROW_ot['EXSAL_DATEFROM'];
        $Exsal_to = $ROW_ot['EXSAL_DATETO'];
        if ($Exsal_id>0) {
          $tablemasterrow['TWA_EXSAL_ID'] = $Exsal_id;
          if (in_array($Compute_Payroll,array('All','4','6','7','9','14','17'))) {
            $SQL = "SELECT * FROM EXTRA_SALARY_DETAIL WHERE EXSAL_ID = ".$Exsal_id." ORDER BY EXSAD_MODULE,EXSAD_DESCRIPTION";
            $RES = DB_query($SQL,$db);
            while ($ROW=DB_fetch_array($RES)) {
              $Amount   = $ROW['EXSAD_CREDIT']-$ROW['EXSAD_DEBIT'];
              $hours    = $ROW['EXSAD_HOURS'];
              $MisthVar = G_VarPA($ROW['EXSAD_MODULE'],$ROW['BDL_ID'],$ROW['EXSAD_MODULEID']);

              if ($MisthVar=='AGNOSTO') {  }
              else {
                if ($ROW['EXSAD_MODULE']=='TAXH') { $tablemasterrow['P_TAX'] -= $Amount; }
                elseif ($ROW['EXSAD_MODULE']=='HOUR') {
                  $tablemasterrow['P_HOURS'] += $Amount;
                  $tablemasterrow['PH_'.$MisthVar] += $Amount;
                  $tablemasterrow['H_HOURS'] += $hours;
                  $tablemasterrow['HH_'.$MisthVar] += $hours;
                  $tablemasterrow['PM_'.$MisthVar] = round($tablemasterrow['PH_'.$MisthVar]/$tablemasterrow['HH_'.$MisthVar],2);
                  if (in_array($ROW['EXSAD_MODULEID'],array(27,28,31,32,33,34,35,36,37,38,39,40))) { $tablemasterrow['EFHM_OVERTIME'] = '≈÷«Ã≈—…≈”'; }
                  elseif (in_array($ROW['EXSAD_MODULEID'],array(21,23,24,25,26,30,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76))) { $tablemasterrow['EFHM_OVERTIME'] = '’–≈—Ÿ—…≈”'; }
                  else { $tablemasterrow['EFHM_OVERTIME'] = ''; }
                }
                elseif ($ROW['EXSAD_MODULE']=='EBEN') {
                  $tablemasterrow['P_XBENEFITS'] += $Amount;
                  $tablemasterrow['PF_'.$MisthVar] += $Amount;
                }
                elseif (in_array($ROW['EXSAD_MODULE'],array('EXTH','PLAE','PLAF','PLAP','SEVE'))) {
                  $tablemasterrow['P_BENEFITS'] += $Amount;
                  $tablemasterrow['PB_'.$MisthVar] += $Amount;
                }
                elseif ($ROW['EXSAD_MODULE']=='DED' && $ROW['EXSAD_TYPE']==0) {
                  $tablemasterrow['P_DEDUCTIONS'] -= $Amount;
                  $tablemasterrow['PD_'.$MisthVar] -= $Amount;
                }
                elseif ($ROW['EXSAD_MODULE']=='DED' && $ROW['EXSAD_TYPE']==1) {
                  $tablemasterrow['P_ERGDED'] -= $Amount;
                  $tablemasterrow['PE_'.$MisthVar] -= $Amount;
                }
            elseif ($ROW['EXSAD_MODULE']=='EDED' && $ROW['EXSAD_TYPE']==0) {
                  $tablemasterrow['P_XDEDUCTIONS'] -= $Amount;
                  $tablemasterrow['PK_'.$MisthVar] -= $Amount;
                }
                else { $tablemasterrow[$MisthVar] = $ROW['EXSAD_MODULE']; }
              }
            }
			
		    if($tablemasterrow['PD_TSMEDE']<>0 or $tablemasterrow['PD_TSMEDE_PR']<>0 or $tablemasterrow['PD_TSMEDE_EP'] or $tablemasterrow['PD_TSMEDE_KP']<>0 or $tablemasterrow['PD_TSMEDE_SY']<>0 or
			   $tablemasterrow['PE_TSMEDE']<>0 or $tablemasterrow['PE_TSMEDE_PR']<>0 or $tablemasterrow['PE_TSMEDE_EP'] or $tablemasterrow['PE_TSMEDE_KP']<>0 or $tablemasterrow['PE_TSMEDE_SY']<>0){
		   $tablemasterrow['PD_TSMEDE']=$tablemasterrow['PD_TSMEDE']+$tablemasterrow['PD_TSMEDE_PR']+$tablemasterrow['PD_TSMEDE_EP']+$tablemasterrow['PD_TSMEDE_KP']+$tablemasterrow['PD_TSMEDE_SY'];
           $tablemasterrow['PE_TSMEDE']=$tablemasterrow['PE_TSMEDE']+$tablemasterrow['PE_TSMEDE_PR']+$tablemasterrow['PE_TSMEDE_EP']+$tablemasterrow['PE_TSMEDE_KP']+$tablemasterrow['PE_TSMEDE_SY'];
		  }
 		   $sint=sinton($Emp_id);
           $agrot=agrotikos($Emp_id);
           $Gross_Efim=GetMTEfim($Vathmos_iatr,$PerMonth,$PerYear);
           $Analisi=Cmp_Anal_Efim($Emp_id,$Exsal_from,$Exsal_to);
              foreach ($Analisi as $key => $value) { $tablemasterrow[$key] = $value; }


           if ($sint==1 and $_SESSION['GLInstall'] =='DRAMANOSOK'){

           $Gross_Efim[0]=157.23;
           $Gross_Efim[1]=215.96;
           $Gross_Efim[2]=167.03;
           $Gross_Efim[3]=232.76;
           $Gross_Efim[4]=242.56;

           $tablemasterrow['V_ENER_KAN']    = $Gross_Efim[0];
           $tablemasterrow['V_ENER_SAB']    = $Gross_Efim[1];
           $tablemasterrow['V_ENER_KA_AR']  = $Gross_Efim[2];
           $tablemasterrow['V_ENER_ARGIA']  = $Gross_Efim[3];
           $tablemasterrow['V_ENER_AR_AR']  = $Gross_Efim[4];
           $tablemasterrow['TOT_ENER_KAN']  = $tablemasterrow['V_ENER_KAN']*$tablemasterrow['ANALEK'];
           $tablemasterrow['TOT_ENER_SAB']  = $tablemasterrow['V_ENER_SAB']*$tablemasterrow['ANALES'];
           $tablemasterrow['TOT_ENER_KA_AR']= $tablemasterrow['V_ENER_KA_AR']*$tablemasterrow['ANALEX'];
           $tablemasterrow['TOT_ENER_ARGIA']  = $tablemasterrow['V_ENER_ARGIA']*$tablemasterrow['ANALEA'];
           $tablemasterrow['TOT_ENER_AR_AR']  = $tablemasterrow['V_ENER_AR_AR']*$tablemasterrow['ANALEZ'];

           }

           else{
           $tablemasterrow['V_ENER_KAN']    = $Gross_Efim[0];
           $tablemasterrow['V_ENER_SAB']    = $Gross_Efim[1];
           $tablemasterrow['V_ENER_KA_AR']  = $Gross_Efim[2];
           $tablemasterrow['V_ENER_ARGIA']  = $Gross_Efim[3];
           $tablemasterrow['V_ENER_AR_AR']  = $Gross_Efim[4];
           $tablemasterrow['TOT_ENER_KAN']  = $tablemasterrow['V_ENER_KAN']*$tablemasterrow['ANALEK'];
           $tablemasterrow['TOT_ENER_SAB']  = $tablemasterrow['V_ENER_SAB']*$tablemasterrow['ANALES'];
           $tablemasterrow['TOT_ENER_KA_AR']= $tablemasterrow['V_ENER_KA_AR']*$tablemasterrow['ANALEX'];
           $tablemasterrow['TOT_ENER_ARGIA']  = $tablemasterrow['V_ENER_ARGIA']*$tablemasterrow['ANALEA'];
           $tablemasterrow['TOT_ENER_AR_AR']  = $tablemasterrow['V_ENER_AR_AR']*$tablemasterrow['ANALEZ'];

           }

           $tablemasterrow['V_MIKT_KAN']      = round(0.7*$Gross_Efim[0],2);
           $tablemasterrow['V_MIKT_SAB']      = round(0.7*$Gross_Efim[1],2);
           $tablemasterrow['V_MIKT_KA_AR']    = round(0.7*$Gross_Efim[2],2);
           $tablemasterrow['V_MIKT_ARGIA']    = round(0.7*$Gross_Efim[3],2);
           $tablemasterrow['V_MIKT_AR_AR']    = round(0.7*$Gross_Efim[4],2);
           $tablemasterrow['TOT_MIKT_KAN']    = $tablemasterrow['V_MIKT_KAN']*$tablemasterrow['ANALMK'];
           $tablemasterrow['TOT_MIKT_SAB']    = $tablemasterrow['V_MIKT_SAB']*$tablemasterrow['ANALMS'];
           $tablemasterrow['TOT_MIKT_KA_AR']  = $tablemasterrow['V_MIKT_KA_AR']*$tablemasterrow['ANALMX'];
           $tablemasterrow['TOT_MIKT_ARGIA']  = $tablemasterrow['V_MIKT_ARGIA']*$tablemasterrow['ANALMA'];
           $tablemasterrow['TOT_MIKT_AR_AR']  = $tablemasterrow['V_MIKT_AR_AR']*$tablemasterrow['ANALMZ'];


           $tablemasterrow['V_ETOIM_KAN']      = round(0.4*$Gross_Efim[0],2);
           $tablemasterrow['V_ETOIM_SAB']      = round(0.4*$Gross_Efim[1],2);
           $tablemasterrow['V_ETOIM_KA_AR']    = round(0.4*$Gross_Efim[2],2);
           $tablemasterrow['V_ETOIM_ARGIA']    = round(0.4*$Gross_Efim[3],2);
           $tablemasterrow['V_ETOIM_AR_AR']    = round(0.4*$Gross_Efim[4],2);
           $tablemasterrow['TOT_ETOIM_KAN']    = $tablemasterrow['V_ETOIM_KAN']*$tablemasterrow['ANALTK'];
           $tablemasterrow['TOT_ETOIM_SAB']    = $tablemasterrow['V_ETOIM_SAB']*$tablemasterrow['ANALTS'];
           $tablemasterrow['TOT_ETOIM_KA_AR']  = $tablemasterrow['V_ETOIM_KA_AR']*$tablemasterrow['ANALTX'];
           $tablemasterrow['TOT_ETOIM_ARGIA']  = $tablemasterrow['V_ETOIM_ARGIA']*$tablemasterrow['ANALTA'];
           $tablemasterrow['TOT_ETOIM_AR_AR']  = $tablemasterrow['V_ETOIM_AR_AR']*$tablemasterrow['ANALTZ'];

		if ($Vathmos_iatr==15 ){
			 
		   $tablemasterrow['V_ENER_KAN']    = $Gross_Efim[0];
           $tablemasterrow['V_ENER_SAB']    = $Gross_Efim[1];
           $tablemasterrow['V_ENER_KA_AR']  = $Gross_Efim[2];
           $tablemasterrow['V_ENER_ARGIA']  = $Gross_Efim[3];
           $tablemasterrow['V_ENER_AR_AR']  = $Gross_Efim[4];
			 
		    if($tablemasterrow['HH_ENERG1']>0){
				$tablemasterrow['P_OROMISTH1']    = round($tablemasterrow['PH_ENERG1']/$tablemasterrow['HH_ENERG1'],2);
				$tablemasterrow['P_OROMISTH2']    = round($tablemasterrow['P_OROMISTH1']+$tablemasterrow['P_OROMISTH1']*(15/100),2);
				$tablemasterrow['P_OROMISTH3']    = round($tablemasterrow['P_OROMISTH1']+$tablemasterrow['P_OROMISTH1']*(25/100),2);
				$tablemasterrow['P_OROMISTH4']    = round($tablemasterrow['P_OROMISTH1']+$tablemasterrow['P_OROMISTH1']*(30/100),2);
			}
			if($tablemasterrow['HH_ENERG2']>0){
			    $tablemasterrow['P_OROMISTH2']    = round($tablemasterrow['PH_ENERG2']/$tablemasterrow['HH_ENERG2'],2);
				$tablemasterrow['P_OROMISTH1']    = round($tablemasterrow['P_OROMISTH2']/1.15,2);
				$tablemasterrow['P_OROMISTH3']    = round($tablemasterrow['P_OROMISTH1']+$tablemasterrow['P_OROMISTH1']*(25/100),2);
				$tablemasterrow['P_OROMISTH4']    = round($tablemasterrow['P_OROMISTH1']+$tablemasterrow['P_OROMISTH1']*(30/100),2);
					
			}
			if($tablemasterrow['HH_ENERG3']>0){
			    $tablemasterrow['P_OROMISTH3']    = round($tablemasterrow['PH_ENERG3']/$tablemasterrow['HH_ENERG3'],2);
				$tablemasterrow['P_OROMISTH1']    = round($tablemasterrow['P_OROMISTH3']/1.25,2);
				$tablemasterrow['P_OROMISTH2']    = round($tablemasterrow['P_OROMISTH1']+$tablemasterrow['P_OROMISTH1']*(15/100),2);
				$tablemasterrow['P_OROMISTH4']    = round($tablemasterrow['P_OROMISTH1']+$tablemasterrow['P_OROMISTH1']*(30/100),2);
			}
			if($tablemasterrow['HH_ENERG4']>0){
			    $tablemasterrow['P_OROMISTH4']    = round($tablemasterrow['PH_ENERG4']/$tablemasterrow['HH_ENERG4'],2);
				$tablemasterrow['P_OROMISTH1']    = round($tablemasterrow['P_OROMISTH4']/1.30,2);
				$tablemasterrow['P_OROMISTH2']    = round($tablemasterrow['P_OROMISTH1']+$tablemasterrow['P_OROMISTH1']*(15/100),2);
				$tablemasterrow['P_OROMISTH3']    = round($tablemasterrow['P_OROMISTH1']+$tablemasterrow['P_OROMISTH1']*(25/100),2);
				
			}
			
			   if ($_SESSION['GLInstall'] =='AGLAIA' || $_SESSION['GLInstall'] =='KOMOTINI'){
			    $tablemasterrow['V_ENER_KAN']    = ($tablemasterrow['P_OROMISTH1']*9)+($tablemasterrow['P_OROMISTH2']*8);
				$tablemasterrow['V_ENER_SAB']    = ($tablemasterrow['P_OROMISTH1']*14)+($tablemasterrow['P_OROMISTH2']*2)+($tablemasterrow['P_OROMISTH4']*6)+($tablemasterrow['P_OROMISTH3']*2);
				$tablemasterrow['V_ENER_KA_AR']  = ($tablemasterrow['P_OROMISTH1']*7)+($tablemasterrow['P_OROMISTH2']*2)+($tablemasterrow['P_OROMISTH4']*6)+($tablemasterrow['P_OROMISTH3']*2);
				$tablemasterrow['V_ENER_ARGIA']  = ($tablemasterrow['P_OROMISTH3']*14)+($tablemasterrow['P_OROMISTH4']*2)+($tablemasterrow['P_OROMISTH2']*6)+($tablemasterrow['P_OROMISTH1']*2);
				$tablemasterrow['V_ENER_AR_AR']  = ($tablemasterrow['P_OROMISTH3']*14)+($tablemasterrow['P_OROMISTH4']*6)+($tablemasterrow['P_OROMISTH3']*2);
			 }
			 
			else{
			
			    $tablemasterrow['V_ENER_KAN']    = ($tablemasterrow['P_OROMISTH1']*8)+($tablemasterrow['P_OROMISTH2']*8);
				$tablemasterrow['V_ENER_SAB']    = ($tablemasterrow['P_OROMISTH1']*15)+($tablemasterrow['P_OROMISTH2']*2)+($tablemasterrow['P_OROMISTH4']*6)+($tablemasterrow['P_OROMISTH3']*1);
				$tablemasterrow['V_ENER_KA_AR']  = ($tablemasterrow['P_OROMISTH1']*7)+($tablemasterrow['P_OROMISTH2']*2)+($tablemasterrow['P_OROMISTH4']*6)+($tablemasterrow['P_OROMISTH3']*1);
				$tablemasterrow['V_ENER_ARGIA']  = ($tablemasterrow['P_OROMISTH3']*15)+($tablemasterrow['P_OROMISTH4']*2)+($tablemasterrow['P_OROMISTH2']*6)+($tablemasterrow['P_OROMISTH1']*1);
				$tablemasterrow['V_ENER_AR_AR']  = ($tablemasterrow['P_OROMISTH3']*15)+($tablemasterrow['P_OROMISTH4']*6)+($tablemasterrow['P_OROMISTH3']*1);
			
			}
			 
			 
		}
            if ($Taktiki_Mikta == 'YES') {
              $Mikta_Taktikis = Get_takt_mikta($Emp_id,$PerMonth,$PerYear,$Vathmos_iatr);
              if ($PerYear==2012 && in_array($PerMonth,array(8,9,10,11,12))) { $Mikta_Taktikis = Get_takt_mikta($Emp_id,1,2013,$Vathmos_iatr); }
              $Oikogeneiako = Get_One_BDLRE($Emp_id,$PerMonth,$PerYear,'BEN','OIKOGEN');
              $Agoni        = Get_One_BDLRE($Emp_id,$PerMonth,$PerYear,'BEN_RETRO','AGON_PER');
              $tablemasterrow['TAKT_MIKTA'] = $Mikta_Taktikis-$Oikogeneiako+($Agoni/12);
            }
		$SQL = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$Emp_id." AND ECOP_VARIABLE='¬¡»Ãœ”_…¡‘—ŸÕ' ";
        $RES = DB_query($SQL,$db);
        $ROW = DB_fetch_array($RES);
        $Vathmos_iatr=$ROW['ECOP_VALUE'];
	    
	        if($Vathmos_iatr==21) {$Vathmos_iatr=1;
			$tablemasterrow['TWA_VATHM_XML_CODE']=258;}
            if($Vathmos_iatr==22) {$Vathmos_iatr=2;
			$tablemasterrow['TWA_VATHM_XML_CODE']=259;}
            if($Vathmos_iatr==23) {$Vathmos_iatr=3;
			$tablemasterrow['TWA_VATHM_XML_CODE']=260;}
            if($Vathmos_iatr==24) {$Vathmos_iatr=4;
			$tablemasterrow['TWA_VATHM_XML_CODE']=262;}
            if($Vathmos_iatr==25) {$Vathmos_iatr=5;
			$tablemasterrow['TWA_VATHM_XML_CODE']=445;}
            if($Vathmos_iatr==26) {$Vathmos_iatr=6;
			$tablemasterrow['TWA_VATHM_XML_CODE']=444;}
            if($Vathmos_iatr==27) {$Vathmos_iatr=7;
			$tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==28) {$Vathmos_iatr=8;
			$tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==29) {$Vathmos_iatr=9;
			$tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==30) {$Vathmos_iatr=10;
			$tablemasterrow['TWA_VATHM_XML_CODE']=447;}
            if($Vathmos_iatr==31) {$Vathmos_iatr=11;
			$tablemasterrow['TWA_VATHM_XML_CODE']=446;}
            if($Vathmos_iatr==32) {$Vathmos_iatr=12;
			$tablemasterrow['TWA_VATHM_XML_CODE']=258;}
            if($Vathmos_iatr==33) {$Vathmos_iatr=13;
			$tablemasterrow['TWA_VATHM_XML_CODE']=259;}
            if($Vathmos_iatr==34) {$Vathmos_iatr=14;
			$tablemasterrow['TWA_VATHM_XML_CODE']=10;}	
			
			
        if ($Vathmos_iatr>0 AND ($Vathmos_iatr!=15 AND $Vathmos_iatr!=7 AND $Vathmos_iatr!=8 AND $Vathmos_iatr!=9)){
        
		$Vathm_array=array(1=>'ƒ…≈’».' ,2=>'≈–…Ã ¡', 3=>'≈–…Ã ¬', 4=>'≈…ƒ… ', 5=>'¡Õ¡–  ¡»',6=>' ¡»«√',7=>'¡√—œ‘ 14',8=>'¡√—œ‘ 15',9=>'¡√—œ‘ 16',10=>'À≈ ‘œ—',11=>'≈–… œ’—');
        $Vathm_desc=$Vathm_array[$Vathmos_iatr];	
		$tablemasterrow['TWA_VATHMOS_AFT'] = $Vathm_desc;	
		$tablemasterrow['TWA_VATHMOS_ONLY'] = $Vathm_desc;		
		}	
			
         $Pericopes=Find_Pericopes($Emp_id,$Sal_id,$Payid,$PerMonth,$PerYear);
         $Plafon_AP=$Pericopes[plaap]>0?$Pericopes[plaap]:0;
         $tablemasterrow['AREOPAGITIS'] = $Plafon_AP;
         $tablemasterrow['PLAFON_EFIM']=$Plafon_AP-$tablemasterrow['TAKT_MIKTA'];
         $tablemasterrow['PLAFON_EFIM_TOT']=$tablemasterrow['PB_PER_EFHMAP']+$tablemasterrow['PB_PLAFON']+$tablemasterrow['PB_PER_AP']+$tablemasterrow['PB_SEVEN'];

            $Sum_plus_efyp  = $tablemasterrow['P_HOURS']+$tablemasterrow['P_BENEFITS']+$tablemasterrow['P_XBENEFITS'];
			$Sum_ded_efyp   = $tablemasterrow['P_DEDUCTIONS']+$tablemasterrow['P_XDEDUCTIONS'];
            $tablemasterrow['P_TOTDEDASFAL']=$tablemasterrow['P_DEDUCTIONS']+$tablemasterrow['P_XDEDUCTIONS']+$tablemasterrow['P_TAX'];
            $Sum_minus_efyp = $Sum_ded_efyp+$tablemasterrow['P_TAX'];
            $tablemasterrow['P_DED_ERGAZ']  = $Sum_ded_efyp;
			$tablemasterrow['P_PLUSNOEBEN'] = $tablemasterrow['P_HOURS']+$tablemasterrow['P_BENEFITS'];
            $tablemasterrow['P_INCOME']     = $Sum_plus_efyp;
            $tablemasterrow['P_ERG_DED']    = $tablemasterrow['P_ERGDED'];
            $tablemasterrow['P_ENTELOM']    = $Sum_plus_efyp+$tablemasterrow['P_ERGDED'];
            $tablemasterrow['P_DED_TAX']    = $Sum_minus_efyp;
            $tablemasterrow['P_TOTAL_DED']  = $Sum_minus_efyp+$tablemasterrow['P_ERGDED'];
            $tablemasterrow['P_PAID']       = $Sum_plus_efyp-$Sum_minus_efyp;
            $tablemasterrow['P_A_DEK']      = round($tablemasterrow['P_PAID'],2);
            $tablemasterrow['P_B_DEK']      = round(0,2);

          if ($Vathmos_iatr==15 and $_SESSION['GLInstall'] =='DRAMANOSOK'){
          //$tablemasterrow['V_ENER_KAN']    = round($tablemasterrow['P_PLUSNOEBEN']/$tablemasterrow['ANALEK'],2);
         // $tablemasterrow['TOT_ENER_KAN']  = round($tablemasterrow['V_ENER_KAN']*$tablemasterrow['ANALEK'],2);
         // $tablemasterrow['P_PLUSNOEBEN']  =$tablemasterrow['TOT_ENER_KAN'];
         // $tablemasterrow['P_INCOME']     = $tablemasterrow['P_PLUSNOEBEN']+$tablemasterrow['P_XBENEFITS'];
         // $tablemasterrow['P_ENTELOM']    = $tablemasterrow['P_INCOME']+$tablemasterrow['P_ERGDED'];
          if($tablemasterrow['HH_ENERG1']>0){
		  $tablemasterrow['P_OROMISTH1']    = round($tablemasterrow['PH_ENERG1']/$tablemasterrow['HH_ENERG1'],2);
		  }
		  if($tablemasterrow['HH_ENERG2']>0){
		  $tablemasterrow['P_OROMISTH2']    = round($tablemasterrow['PH_ENERG2']/$tablemasterrow['HH_ENERG2'],2);
		  }
		  if($tablemasterrow['HH_ENERG3']>0){
		  $tablemasterrow['P_OROMISTH3']    = round($tablemasterrow['PH_ENERG3']/$tablemasterrow['HH_ENERG3'],2);
		  }
		  if($tablemasterrow['HH_ENERG4']>0){
		  $tablemasterrow['P_OROMISTH4']    = round($tablemasterrow['PH_ENERG4']/$tablemasterrow['HH_ENERG4'],2);
		  }
		  
		  }


            if (in_array($Compute_Payroll,array('7','9')) && $tablemasterrow['EFHM_OVERTIME'] != '≈÷«Ã≈—…≈”') {
              $Sum_plus_efyp=0;
              $Sum_minus_efyp=0;
            }
            if (in_array($Compute_Payroll,array('4','6')) && $tablemasterrow['EFHM_OVERTIME'] != '’–≈—Ÿ—…≈”') {
              $Sum_plus_efyp=0;
              $Sum_minus_efyp=0;
            }
          }
          if (in_array($Compute_Payroll,array('All','5','6','8','9','14','17'))) {

          $tmpsqldt = "select exsal_id_from from retro_master_extra ";
            $tmpsqldt .= " where retro_master_extra.exsal_id_to=".$Exsal_id;
            $tmpresdt =DB_query($tmpsqldt,$db);
            $tmprowdt =DB_fetch_array($tmpresdt);
            $Exsal_id_from=$tmprowdt['EXSAL_ID_FROM'];

         if ($Exsal_id_from>0){
            $tmpsqldt  = "select exsal_datefrom, exsal_dateto from extra_salary ";
            $tmpsqldt .= " where exsal_id=".$Exsal_id_from;
            $tmpresdt =DB_query($tmpsqldt,$db);
            $tmprowdt =DB_fetch_array($tmpresdt);
            $tablemasterrow['ANADR_DT_FROM']=ConvertSQLDate($tmprowdt['EXSAL_DATEFROM']);
            $tablemasterrow['ANADR_DT_TO']=ConvertSQLDate($tmprowdt['EXSAL_DATETO']);
       }

            $SQL  = "SELECT RMST_REASON, RDET_CREDIT, RDET_DEBIT, RDET_MODULE, RDET_MODULEID, RDET_DESCRIPTION, RDET_TYPE,RDET_HOURS,BDL_ID";
            $SQL .= "  FROM RETRO_MASTER_EXTRA, RETRO_DETAIL_EXTRA ";
            $SQL .= " WHERE RETRO_MASTER_EXTRA.RMST_ID = RETRO_DETAIL_EXTRA.RMST_ID AND RETRO_MASTER_EXTRA.EXSAL_ID_TO = ".$Exsal_id." ORDER BY RDET_MODULE,RDET_DESCRIPTION";
            $RES = DB_query($SQL,$db);
            while ($ROW=DB_fetch_array($RES)) {
              $Amount=$ROW['RDET_CREDIT']-$ROW['RDET_DEBIT'];
           $hours = $ROW['RDET_HOURS'];
              $MisthVar=G_VarPA($ROW['RDET_MODULE'],$ROW['BDL_ID'],$ROW['RDET_MODULEID']);
              if ($ROW['RDET_MODULE']=='TAXR') { $tablemasterrow['N_TAX'] -= $Amount; }
              elseif ($ROW['RDET_MODULE']=='HOUR') {


                $tablemasterrow['K_HOURS'] += $hours;
                $tablemasterrow['KH_'.$MisthVar] += $hours;
                $tablemasterrow['N_HOURS'] += $Amount;
                $tablemasterrow['NH_'.$MisthVar] += $Amount;
              }
              elseif (in_array($ROW['RDET_MODULE'],array('EXTH','PLAE','PLAF','PLAP','SEVE'))) {
                $tablemasterrow['N_BENEFITS'] += $Amount;
                $tablemasterrow['NB_'.$MisthVar] += $Amount;
              }
              elseif ($ROW['RDET_MODULE']=='DED' && $ROW['RDET_TYPE']==1) {
                $tablemasterrow['N_DEDUCTIONS'] -= $Amount;
                $tablemasterrow['ND_'.$MisthVar] -= $Amount;
              }
              elseif ($ROW['RDET_MODULE']=='DED' && $ROW['RDET_TYPE']==2) {
                $tablemasterrow['N_ERGDED'] -= $Amount;
                $tablemasterrow['NE_'.$MisthVar] -= $Amount;
              }
              else { $tablemasterrow[$MisthVar] = $ROW['RDET_MODULE']; }
            }
			
			$SQL = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$Emp_id." AND ECOP_VARIABLE='¬¡»Ãœ”_…¡‘—ŸÕ' ";
            $RES = DB_query($SQL,$db);
            $ROW = DB_fetch_array($RES);
            $Vathmos_iatr=$ROW['ECOP_VALUE'];
	        
	         if($Vathmos_iatr==21) {$Vathmos_iatr=1;
			$tablemasterrow['TWA_VATHM_XML_CODE']=258;}
            if($Vathmos_iatr==22) {$Vathmos_iatr=2;
			$tablemasterrow['TWA_VATHM_XML_CODE']=259;}
            if($Vathmos_iatr==23) {$Vathmos_iatr=3;
			$tablemasterrow['TWA_VATHM_XML_CODE']=260;}
            if($Vathmos_iatr==24) {$Vathmos_iatr=4;
			$tablemasterrow['TWA_VATHM_XML_CODE']=262;}
            if($Vathmos_iatr==25) {$Vathmos_iatr=5;
			$tablemasterrow['TWA_VATHM_XML_CODE']=445;}
            if($Vathmos_iatr==26) {$Vathmos_iatr=6;
			$tablemasterrow['TWA_VATHM_XML_CODE']=444;}
            if($Vathmos_iatr==27) {$Vathmos_iatr=7;
			$tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==28) {$Vathmos_iatr=8;
			$tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==29) {$Vathmos_iatr=9;
			$tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==30) {$Vathmos_iatr=10;
			$tablemasterrow['TWA_VATHM_XML_CODE']=447;}
            if($Vathmos_iatr==31) {$Vathmos_iatr=11;
			$tablemasterrow['TWA_VATHM_XML_CODE']=446;}
            if($Vathmos_iatr==32) {$Vathmos_iatr=12;
			$tablemasterrow['TWA_VATHM_XML_CODE']=258;}
            if($Vathmos_iatr==33) {$Vathmos_iatr=13;
			$tablemasterrow['TWA_VATHM_XML_CODE']=259;}
            if($Vathmos_iatr==34) {$Vathmos_iatr=14;
			$tablemasterrow['TWA_VATHM_XML_CODE']=10;}	
			
			
			
			
			
			
           if ($Vathmos_iatr>0 AND ($Vathmos_iatr!=15 AND $Vathmos_iatr!=7 AND $Vathmos_iatr!=8 AND $Vathmos_iatr!=9)){
        
		   $Vathm_array=array(1=>'ƒ…≈’».' ,2=>'≈–…Ã ¡', 3=>'≈–…Ã ¬', 4=>'≈…ƒ… ', 5=>'¡Õ¡–  ¡»',6=>' ¡»«√',7=>'¡√—œ‘ 14',8=>'¡√—œ‘ 15',9=>'¡√—œ‘ 16',10=>'À≈ ‘œ—',11=>'≈–… œ’—');
           $Vathm_desc=$Vathm_array[$Vathmos_iatr];	
		   $tablemasterrow['TWA_VATHMOS_AFT'] = $Vathm_desc;
           $tablemasterrow['TWA_VATHMOS_ONLY'] = $Vathm_desc;			   
		   }	
			

            $Sum_plus_anadr  = $tablemasterrow['N_HOURS']+$tablemasterrow['N_BENEFITS']+$tablemasterrow['N_XBENEFITS'];
            $Sum_ded_anadr   = $tablemasterrow['N_DEDUCTIONS'];
            $Sum_minus_anadr = $Sum_ded_anadr+$tablemasterrow['N_TAX'];
            $tablemasterrow['N_PLUSNOEBEN'] = $tablemasterrow['N_HOURS']+$tablemasterrow['N_BENEFITS'];
            $tablemasterrow['N_INCOME']     = $Sum_plus_anadr;
            $tablemasterrow['N_ENTELOM']    = $Sum_plus_anadr+$tablemasterrow['N_ERGDED'];
            $tablemasterrow['N_DED_TAX']    = $Sum_minus_anadr;
            $tablemasterrow['N_TOTAL_DED']  = $Sum_minus_anadr+$tablemasterrow['N_ERGDED'];
            $tablemasterrow['N_PAID']       = $Sum_plus_anadr-$Sum_minus_anadr;
            $tablemasterrow['N_A_DEK']      = round($tablemasterrow['N_PAID'],2);
            $tablemasterrow['N_B_DEK']      = round(0,2);

          }
        }
      }
	  
	  
//-----------------------¡Ãœ…¬≈” Ã≈ÀŸÕ ƒ”------------------------

if (in_array($Compute_Payroll,array('All','21'))) {
        $SQL_ot = "SELECT SALARY.SAL_ID, EXTRA_SALARY.EXSAL_ID, EXTRA_SALARY.EXSAL_DATEFROM, EXTRA_SALARY.EXSAL_DATETO FROM EXTRA_SALARY, SALARY WHERE EXTRA_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA_SALARY.EXSALARY_DS=1 AND EXTRA_SALARY.EMP_ID =".$Emp_id." AND SALARY.PAY_ID=".$Payid." AND SALARY.SAL_ID=".$Sal_id;
		$RES_ot = DB_query($SQL_ot,$db);
        $ROW_ot = DB_fetch_array($RES_ot);
        $Exsal_id = $ROW_ot['EXSAL_ID'];
        $Exsal_from = $ROW_ot['EXSAL_DATEFROM'];
        $Exsal_to = $ROW_ot['EXSAL_DATETO'];
        if ($Exsal_id>0) {
          $tablemasterrow['TWA_EXSAL_ID'] = $Exsal_id;
          if (in_array($Compute_Payroll,array('All','21'))) {
            $SQL = "SELECT * FROM EXTRA_SALARY_DETAIL WHERE EXSAL_ID = ".$Exsal_id." ORDER BY EXSAD_MODULE,EXSAD_DESCRIPTION";
			$RES = DB_query($SQL,$db);
            while ($ROW=DB_fetch_array($RES)) {
              $Amount   = $ROW['EXSAD_CREDIT']-$ROW['EXSAD_DEBIT'];
              $hours    = $ROW['EXSAD_HOURS'];
              $MisthVar = G_VarPA($ROW['EXSAD_MODULE'],$ROW['BDL_ID'],$ROW['EXSAD_MODULEID']);
              if ($MisthVar=='AGNOSTO') {  }
              else {
                if ($ROW['EXSAD_MODULE']=='TAXH') { $tablemasterrow['P_TAX'] -= $Amount; }
                elseif ($ROW['EXSAD_MODULE']=='HOUR') {
                  $tablemasterrow['P_HOURS'] += $Amount;
                  $tablemasterrow['PH_'.$MisthVar] += $Amount;
                  $tablemasterrow['H_HOURS'] += $hours;
                  $tablemasterrow['HH_'.$MisthVar] += $hours;
                  $tablemasterrow['PM_'.$MisthVar] = round($tablemasterrow['PH_'.$MisthVar]/$tablemasterrow['HH_'.$MisthVar],2);
                  if (in_array($ROW['EXSAD_MODULEID'],array(27,28,31,32,33,34,35,36,37,38,39,40))) { $tablemasterrow['EFHM_OVERTIME'] = '≈÷«Ã≈—…≈”'; }
                  elseif (in_array($ROW['EXSAD_MODULEID'],array(21,23,24,25,26,30,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77))) { $tablemasterrow['EFHM_OVERTIME'] = '’–≈—Ÿ—…≈”'; }
                  else { $tablemasterrow['EFHM_OVERTIME'] = ''; }
                }
                elseif ($ROW['EXSAD_MODULE']=='EBEN') {
                  $tablemasterrow['P_XBENEFITS'] += $Amount;
                  $tablemasterrow['PF_'.$MisthVar] += $Amount;
                }
                elseif (in_array($ROW['EXSAD_MODULE'],array('EXTH','PLAE','PLAF','PLAP','SEVE'))) {
                  $tablemasterrow['P_BENEFITS'] += $Amount;
                  $tablemasterrow['PB_'.$MisthVar] += $Amount;
                }
                elseif ($ROW['EXSAD_MODULE']=='DED' && $ROW['EXSAD_TYPE']==0) {
                  $tablemasterrow['P_DEDUCTIONS'] -= $Amount;
                  $tablemasterrow['PD_'.$MisthVar] -= $Amount;
                }
                elseif ($ROW['EXSAD_MODULE']=='DED' && $ROW['EXSAD_TYPE']==1) {
                  $tablemasterrow['P_ERGDED'] -= $Amount;
                  $tablemasterrow['PE_'.$MisthVar] -= $Amount;
                }
            elseif ($ROW['EXSAD_MODULE']=='EDED' && $ROW['EXSAD_TYPE']==0) {
                  $tablemasterrow['P_XDEDUCTIONS'] -= $Amount;
                  $tablemasterrow['PK_'.$MisthVar] -= $Amount;
                }
                else { $tablemasterrow[$MisthVar] = $ROW['EXSAD_MODULE']; }
              }
            }
			
		    if($tablemasterrow['PD_TSMEDE']<>0 or $tablemasterrow['PD_TSMEDE_PR']<>0 or $tablemasterrow['PD_TSMEDE_EP'] or $tablemasterrow['PD_TSMEDE_KP']<>0 or $tablemasterrow['PD_TSMEDE_SY']<>0 or
			   $tablemasterrow['PE_TSMEDE']<>0 or $tablemasterrow['PE_TSMEDE_PR']<>0 or $tablemasterrow['PE_TSMEDE_EP'] or $tablemasterrow['PE_TSMEDE_KP']<>0 or $tablemasterrow['PE_TSMEDE_SY']<>0){
		   $tablemasterrow['PD_TSMEDE']=$tablemasterrow['PD_TSMEDE']+$tablemasterrow['PD_TSMEDE_PR']+$tablemasterrow['PD_TSMEDE_EP']+$tablemasterrow['PD_TSMEDE_KP']+$tablemasterrow['PD_TSMEDE_SY'];
           $tablemasterrow['PE_TSMEDE']=$tablemasterrow['PE_TSMEDE']+$tablemasterrow['PE_TSMEDE_PR']+$tablemasterrow['PE_TSMEDE_EP']+$tablemasterrow['PE_TSMEDE_KP']+$tablemasterrow['PE_TSMEDE_SY'];
		  }
 		   $sint=sinton($Emp_id);
           $agrot=agrotikos($Emp_id);
           $Gross_Efim=GetMTEfim($Vathmos_iatr,$PerMonth,$PerYear);
           $Analisi=Cmp_Anal_Efim($Emp_id,$Exsal_from,$Exsal_to);
              foreach ($Analisi as $key => $value) { $tablemasterrow[$key] = $value; }

            if ($Taktiki_Mikta == 'YES') {
              $Mikta_Taktikis = Get_takt_mikta($Emp_id,$PerMonth,$PerYear,$Vathmos_iatr);
              if ($PerYear==2012 && in_array($PerMonth,array(8,9,10,11,12))) { $Mikta_Taktikis = Get_takt_mikta($Emp_id,1,2013,$Vathmos_iatr); }
              $Oikogeneiako = Get_One_BDLRE($Emp_id,$PerMonth,$PerYear,'BEN','OIKOGEN');
              $Agoni        = Get_One_BDLRE($Emp_id,$PerMonth,$PerYear,'BEN_RETRO','AGON_PER');
              $tablemasterrow['TAKT_MIKTA'] = $Mikta_Taktikis-$Oikogeneiako+($Agoni/12);
            }
		$SQL = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$Emp_id." AND ECOP_VARIABLE='¬¡»Ãœ”_…¡‘—ŸÕ' ";
        $RES = DB_query($SQL,$db);
        $ROW = DB_fetch_array($RES);
        $Vathmos_iatr=$ROW['ECOP_VALUE'];
	    
	        if($Vathmos_iatr==21) {$Vathmos_iatr=1;
			$tablemasterrow['TWA_VATHM_XML_CODE']=258;}
            if($Vathmos_iatr==22) {$Vathmos_iatr=2;
			$tablemasterrow['TWA_VATHM_XML_CODE']=259;}
            if($Vathmos_iatr==23) {$Vathmos_iatr=3;
			$tablemasterrow['TWA_VATHM_XML_CODE']=260;}
            if($Vathmos_iatr==24) {$Vathmos_iatr=4;
			$tablemasterrow['TWA_VATHM_XML_CODE']=262;}
            if($Vathmos_iatr==25) {$Vathmos_iatr=5;
			$tablemasterrow['TWA_VATHM_XML_CODE']=445;}
            if($Vathmos_iatr==26) {$Vathmos_iatr=6;
			$tablemasterrow['TWA_VATHM_XML_CODE']=444;}
            if($Vathmos_iatr==27) {$Vathmos_iatr=7;
			$tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==28) {$Vathmos_iatr=8;
			$tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==29) {$Vathmos_iatr=9;
			$tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==30) {$Vathmos_iatr=10;
			$tablemasterrow['TWA_VATHM_XML_CODE']=447;}
            if($Vathmos_iatr==31) {$Vathmos_iatr=11;
			$tablemasterrow['TWA_VATHM_XML_CODE']=446;}
            if($Vathmos_iatr==32) {$Vathmos_iatr=12;
			$tablemasterrow['TWA_VATHM_XML_CODE']=258;}
            if($Vathmos_iatr==33) {$Vathmos_iatr=13;
			$tablemasterrow['TWA_VATHM_XML_CODE']=259;}
            if($Vathmos_iatr==34) {$Vathmos_iatr=14;
			$tablemasterrow['TWA_VATHM_XML_CODE']=10;}	
			
			
        if ($Vathmos_iatr>0 AND ($Vathmos_iatr!=15 AND $Vathmos_iatr!=7 AND $Vathmos_iatr!=8 AND $Vathmos_iatr!=9)){
        
		$Vathm_array=array(1=>'ƒ…≈’».' ,2=>'≈–…Ã ¡', 3=>'≈–…Ã ¬', 4=>'≈…ƒ… ', 5=>'¡Õ¡–  ¡»',6=>' ¡»«√',7=>'¡√—œ‘ 14',8=>'¡√—œ‘ 15',9=>'¡√—œ‘ 16',10=>'À≈ ‘œ—',11=>'≈–… œ’—');
        $Vathm_desc=$Vathm_array[$Vathmos_iatr];	
		$tablemasterrow['TWA_VATHMOS_AFT'] = $Vathm_desc;	
		$tablemasterrow['TWA_VATHMOS_ONLY'] = $Vathm_desc;		
		}	
			
         $Pericopes=Find_Pericopes($Emp_id,$Sal_id,$Payid,$PerMonth,$PerYear);
         $Plafon_AP=$Pericopes[plaap]>0?$Pericopes[plaap]:0;
         $tablemasterrow['AREOPAGITIS'] = $Plafon_AP;
         $tablemasterrow['PLAFON_EFIM']=$Plafon_AP-$tablemasterrow['TAKT_MIKTA'];
         $tablemasterrow['PLAFON_EFIM_TOT']=$tablemasterrow['PB_PER_EFHMAP']+$tablemasterrow['PB_PLAFON']+$tablemasterrow['PB_PER_AP']+$tablemasterrow['PB_SEVEN'];

            $Sum_plus_efyp  = $tablemasterrow['P_HOURS']+$tablemasterrow['P_BENEFITS']+$tablemasterrow['P_XBENEFITS'];
			$Sum_ded_efyp   = $tablemasterrow['P_DEDUCTIONS']+$tablemasterrow['P_XDEDUCTIONS'];
            $tablemasterrow['P_TOTDEDASFAL']=$tablemasterrow['P_DEDUCTIONS']+$tablemasterrow['P_XDEDUCTIONS']+$tablemasterrow['P_TAX'];
            $Sum_minus_efyp = $Sum_ded_efyp+$tablemasterrow['P_TAX'];
            $tablemasterrow['P_DED_ERGAZ']  = $Sum_ded_efyp;
			$tablemasterrow['P_PLUSNOEBEN'] = $tablemasterrow['P_HOURS']+$tablemasterrow['P_BENEFITS'];
            $tablemasterrow['P_INCOME']     = $Sum_plus_efyp;
            $tablemasterrow['P_ERG_DED']    = $tablemasterrow['P_ERGDED'];
            $tablemasterrow['P_ENTELOM']    = $Sum_plus_efyp+$tablemasterrow['P_ERGDED'];
            $tablemasterrow['P_DED_TAX']    = $Sum_minus_efyp;
            $tablemasterrow['P_TOTAL_DED']  = $Sum_minus_efyp+$tablemasterrow['P_ERGDED'];
            $tablemasterrow['P_PAID']       = $Sum_plus_efyp-$Sum_minus_efyp;
            $tablemasterrow['P_A_DEK']      = round($tablemasterrow['P_PAID'],2);
            $tablemasterrow['P_B_DEK']      = round(0,2);
			$tablemasterrow['P_FIX_AMOUNT']      = round(50,2);


            if (in_array($Compute_Payroll,array('7','9')) && $tablemasterrow['EFHM_OVERTIME'] != '≈÷«Ã≈—…≈”') {
              $Sum_plus_efyp=0;
              $Sum_minus_efyp=0;
            }
            if (in_array($Compute_Payroll,array('4','6')) && $tablemasterrow['EFHM_OVERTIME'] != '’–≈—Ÿ—…≈”') {
              $Sum_plus_efyp=0;
              $Sum_minus_efyp=0;
            }
          }

        }
      }


	  
	  
//------------------------XML EFIMERION--------------


 if (in_array($Compute_Payroll,array('16','20'))) {
        $SQL_ot = "SELECT SALARY.SAL_ID, EXTRA_SALARY.EXSAL_ID, EXTRA_SALARY.EXSAL_DATEFROM, EXTRA_SALARY.EXSAL_DATETO FROM EXTRA_SALARY, SALARY WHERE EXTRA_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA_SALARY.EMP_ID =".$Emp_id." AND SALARY.PAY_ID=".$Payid." AND SALARY.SAL_ID=".$Sal_id;
      $RES_ot = DB_query($SQL_ot,$db);
        $ROW_ot = DB_fetch_array($RES_ot);
        $Exsal_id = $ROW_ot['EXSAL_ID'];
        $Exsal_from = $ROW_ot['EXSAL_DATEFROM'];
        $Exsal_to = $ROW_ot['EXSAL_DATETO'];
        if ($Exsal_id>0) {
          $tablemasterrow['TWA_EXSAL_ID'] = $Exsal_id;
          if (in_array($Compute_Payroll,array('16','20'))) {
            $SQL = "SELECT * FROM EXTRA_SALARY_DETAIL WHERE EXSAL_ID = ".$Exsal_id." ORDER BY EXSAD_MODULE,EXSAD_DESCRIPTION";
            $RES = DB_query($SQL,$db);
            while ($ROW=DB_fetch_array($RES)) {
              $Amount   = $ROW['EXSAD_CREDIT']-$ROW['EXSAD_DEBIT'];
              $hours    = $ROW['EXSAD_HOURS'];
              $MisthVar = G_VarPA($ROW['EXSAD_MODULE'],$ROW['BDL_ID'],$ROW['EXSAD_MODULEID']);

              if ($MisthVar=='AGNOSTO') {  }
              else {
                if ($ROW['EXSAD_MODULE']=='TAXH') { $tablemasterrow['P_TAX'] -= $Amount; }
                elseif ($ROW['EXSAD_MODULE']=='HOUR') {
                  $tablemasterrow['P_HOURS'] += $Amount;
                  $tablemasterrow['PH_'.$MisthVar] += $Amount;
                  $tablemasterrow['H_HOURS'] += $hours;
                  $tablemasterrow['HH_'.$MisthVar] += $hours;
              $tablemasterrow['PM_'.$MisthVar] = round($tablemasterrow['PH_'.$MisthVar]/$tablemasterrow['HH_'.$MisthVar],2);
                  if (in_array($ROW['EXSAD_MODULEID'],array(27,28,31,32,33,34,35,36,37,38,39,40))) { $tablemasterrow['EFHM_OVERTIME'] = '≈÷«Ã≈—…≈”'; }
                  elseif (in_array($ROW['EXSAD_MODULEID'],array(21,23,24,25,26,30))) { $tablemasterrow['EFHM_OVERTIME'] = '’–≈—Ÿ—…≈”'; }
                  else { $tablemasterrow['EFHM_OVERTIME'] = ''; }
                }
                elseif ($ROW['EXSAD_MODULE']=='EBEN') {
                  $tablemasterrow['P_XBENEFITS'] += $Amount;
                  $tablemasterrow['PF_'.$MisthVar] += $Amount;
                }
                elseif (in_array($ROW['EXSAD_MODULE'],array('EXTH','PLAE','PLAF','PLAP','SEVE'))) {
                  $tablemasterrow['P_BENEFITS'] += $Amount;
                  $tablemasterrow['PB_'.$MisthVar] += $Amount;
                }
                elseif ($ROW['EXSAD_MODULE']=='DED' && $ROW['EXSAD_TYPE']==0) {
                  $tablemasterrow['P_DEDUCTIONS'] -= $Amount;
                  $tablemasterrow['PD_'.$MisthVar] -= $Amount;
                }
                elseif ($ROW['EXSAD_MODULE']=='DED' && $ROW['EXSAD_TYPE']==1) {
                  $tablemasterrow['P_ERGDED'] -= $Amount;
                  $tablemasterrow['PE_'.$MisthVar] -= $Amount;
                }
            elseif ($ROW['EXSAD_MODULE']=='EDED' && $ROW['EXSAD_TYPE']==0) {
                  $tablemasterrow['P_XDEDUCTIONS'] -= $Amount;
                  $tablemasterrow['PK_'.$MisthVar] -= $Amount;
                }
                else { $tablemasterrow[$MisthVar] = $ROW['EXSAD_MODULE']; }

             $tablemasterrow['EFHM_OVERTIME'] = '≈÷«Ã≈—…≈”';
              }
            }
			
			$SQL = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$Emp_id." AND ECOP_VARIABLE='¬¡»Ãœ”_…¡‘—ŸÕ' ";
            $RES = DB_query($SQL,$db);
            $ROW = DB_fetch_array($RES);
            $Vathmos_iatr=$ROW['ECOP_VALUE'];
	        
	        if($Vathmos_iatr==21) {$Vathmos_iatr=1;
			$tablemasterrow['TWA_VATHM_XML_CODE']=258;}
            if($Vathmos_iatr==22) {$Vathmos_iatr=2;
			$tablemasterrow['TWA_VATHM_XML_CODE']=259;}
            if($Vathmos_iatr==23) {$Vathmos_iatr=3;
			$tablemasterrow['TWA_VATHM_XML_CODE']=260;}
            if($Vathmos_iatr==24) {$Vathmos_iatr=4;
			$tablemasterrow['TWA_VATHM_XML_CODE']=262;}
            if($Vathmos_iatr==25) {$Vathmos_iatr=5;
			$tablemasterrow['TWA_VATHM_XML_CODE']=445;}
            if($Vathmos_iatr==26) {$Vathmos_iatr=6;
			$tablemasterrow['TWA_VATHM_XML_CODE']=444;}
            if($Vathmos_iatr==27) {$Vathmos_iatr=7;
			$tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==28) {$Vathmos_iatr=8;
			$tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==29) {$Vathmos_iatr=9;
			$tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==30) {$Vathmos_iatr=10;
			$tablemasterrow['TWA_VATHM_XML_CODE']=447;}
            if($Vathmos_iatr==31) {$Vathmos_iatr=11;
			$tablemasterrow['TWA_VATHM_XML_CODE']=446;}
            if($Vathmos_iatr==32) {$Vathmos_iatr=12;
			$tablemasterrow['TWA_VATHM_XML_CODE']=258;}
            if($Vathmos_iatr==33) {$Vathmos_iatr=13;
			$tablemasterrow['TWA_VATHM_XML_CODE']=259;}
            if($Vathmos_iatr==34) {$Vathmos_iatr=14;
			$tablemasterrow['TWA_VATHM_XML_CODE']=10;}	
			
			
        if ($Vathmos_iatr>0 AND ($Vathmos_iatr!=15 AND $Vathmos_iatr!=7 AND $Vathmos_iatr!=8 AND $Vathmos_iatr!=9)){
        
		$Vathm_array=array(1=>'ƒ…≈’».' ,2=>'≈–…Ã ¡', 3=>'≈–…Ã ¬', 4=>'≈…ƒ… ', 5=>'¡Õ¡–  ¡»',6=>' ¡»«√',7=>'¡√—œ‘ 14',8=>'¡√—œ‘ 15',9=>'¡√—œ‘ 16',10=>'À≈ ‘œ—',11=>'≈–… œ’—');
        $Vathm_desc=$Vathm_array[$Vathmos_iatr];	
		$tablemasterrow['TWA_VATHMOS_AFT'] = $Vathm_desc;	
		$tablemasterrow['TWA_VATHMOS_ONLY'] = $Vathm_desc;		
		
		}	
			
			
			
			
			
			
           $sint=sinton($Emp_id);
           $agrot=agrotikos($Emp_id);
           $Gross_Efim=GetMTEfim($Vathmos_iatr,$PerMonth,$PerYear);
           $Analisi=Cmp_Anal_Efim($Emp_id,$Exsal_from,$Exsal_to);
              foreach ($Analisi as $key => $value) { $tablemasterrow[$key] = $value; }
            if ($Taktiki_Mikta == 'YES') {
              $Mikta_Taktikis = Get_takt_mikta($Emp_id,$PerMonth,$PerYear,$Vathmos_iatr);
              if ($PerYear==2012 && in_array($PerMonth,array(8,9,10,11,12))) { $Mikta_Taktikis = Get_takt_mikta($Emp_id,1,2013,$Vathmos_iatr); }
              $Oikogeneiako = Get_One_BDLRE($Emp_id,$PerMonth,$PerYear,'BEN','OIKOGEN');
              $Agoni        = Get_One_BDLRE($Emp_id,$PerMonth,$PerYear,'BEN_RETRO','AGON_PER');
              $tablemasterrow['TAKT_MIKTA'] = $Mikta_Taktikis-$Oikogeneiako+($Agoni/12);
            }
         $Pericopes=Find_Pericopes($Emp_id,$Sal_id,$Payid,$PerMonth,$PerYear);
         $Plafon_AP=$Pericopes[plaap]>0?$Pericopes[plaap]:0;
         $tablemasterrow['AREOPAGITIS'] = $Plafon_AP;
         $tablemasterrow['PLAFON_EFIM']=$Plafon_AP-$tablemasterrow['TAKT_MIKTA'];
         $tablemasterrow['PLAFON_EFIM_TOT']=$tablemasterrow['PB_PER_EFHMAP']+$tablemasterrow['PB_PLAFON']+$tablemasterrow['PB_PER_AP']+$tablemasterrow['PB_SEVEN'];

            $Sum_plus_efyp  = $tablemasterrow['P_HOURS']+$tablemasterrow['P_BENEFITS']+$tablemasterrow['P_XBENEFITS'];
            $Sum_ded_efyp   = $tablemasterrow['P_DEDUCTIONS']+$tablemasterrow['P_XDEDUCTIONS'];
            $tablemasterrow['P_TOTDEDASFAL']=$tablemasterrow['P_DEDUCTIONS']+$tablemasterrow['P_XDEDUCTIONS']+$tablemasterrow['P_TAX'];
            $Sum_minus_efyp = $Sum_ded_efyp+$tablemasterrow['P_TAX'];
            $tablemasterrow['P_PLUSNOEBEN'] = $tablemasterrow['P_HOURS']+$tablemasterrow['P_BENEFITS'];
            $tablemasterrow['P_INCOME']     = $Sum_plus_efyp;
            $tablemasterrow['P_ERG_DED']     = $tablemasterrow['P_ERGDED'];
            $tablemasterrow['P_ENTELOM']    = $Sum_plus_efyp+$tablemasterrow['P_ERGDED'];
            $tablemasterrow['P_DED_TAX']    = $Sum_minus_efyp;
            $tablemasterrow['P_TOTAL_DED']  = $Sum_minus_efyp+$tablemasterrow['P_ERGDED'];
            $tablemasterrow['P_PAID']       = $Sum_plus_efyp-$Sum_minus_efyp;
            $tablemasterrow['P_A_DEK']      = round($tablemasterrow['P_PAID'],2);
            $tablemasterrow['P_B_DEK']      = round(0,2);


           if (($Vathmos_iatr>0 AND $Vathmos_iatr==15) ||($Vathmos_iatr==0 || $Vathmos_iatr==NULL || ($Vathmos_iatr>0 and $Eapd_krit_id==3)) )

            {

              $Sum_plus_efyp  =0;
              $Sum_minus_efyp =0;
              $Sum_ded_efyp   =0;

           }
		   
		   if(($_SESSION['GLInstall']=='ALEX' AND ($Emp_id==2409 || $Emp_id==1530 || $Emp_id==2635) )){
		   
		    $Sum_plus_efyp  = $tablemasterrow['P_HOURS']+$tablemasterrow['P_BENEFITS']+$tablemasterrow['P_XBENEFITS'];
            $Sum_ded_efyp   = $tablemasterrow['P_DEDUCTIONS']+$tablemasterrow['P_XDEDUCTIONS'];
		    $Sum_minus_efyp = $Sum_ded_efyp+$tablemasterrow['P_TAX'];
		   
		   }

          }
          if (in_array($Compute_Payroll,array('16','18'))) {

          $tmpsqldt = "select exsal_id_from from retro_master_extra ";
            $tmpsqldt .= " where retro_master_extra.exsal_id_to=".$Exsal_id;
            $tmpresdt =DB_query($tmpsqldt,$db);
            $tmprowdt =DB_fetch_array($tmpresdt);
            $Exsal_id_from=$tmprowdt['EXSAL_ID_FROM'];

         if ($Exsal_id_from>0){
            $tmpsqldt  = "select exsal_datefrom, exsal_dateto from extra_salary ";
            $tmpsqldt .= " where exsal_id=".$Exsal_id_from;
            $tmpresdt =DB_query($tmpsqldt,$db);
            $tmprowdt =DB_fetch_array($tmpresdt);
            $tablemasterrow['ANADR_DT_FROM']=$tmprowdt['EXSAL_DATEFROM'];
            $tablemasterrow['ANADR_DT_TO']=$tmprowdt['EXSAL_DATETO'];
       }

            $SQL  = "SELECT RMST_REASON, RDET_CREDIT, RDET_DEBIT, RDET_MODULE, RDET_MODULEID, RDET_DESCRIPTION, RDET_TYPE,RDET_HOURS,BDL_ID";
            $SQL .= "  FROM RETRO_MASTER_EXTRA, RETRO_DETAIL_EXTRA ";
            $SQL .= " WHERE RETRO_MASTER_EXTRA.RMST_ID = RETRO_DETAIL_EXTRA.RMST_ID AND RETRO_MASTER_EXTRA.EXSAL_ID_TO = ".$Exsal_id." ORDER BY RDET_MODULE,RDET_DESCRIPTION";
            $RES = DB_query($SQL,$db);
            while ($ROW=DB_fetch_array($RES)) {
              $Amount=$ROW['RDET_CREDIT']-$ROW['RDET_DEBIT'];
           $hours = $ROW['RDET_HOURS'];
              $MisthVar=G_VarPA($ROW['RDET_MODULE'],$ROW['BDL_ID'],$ROW['RDET_MODULEID']);
              if ($ROW['RDET_MODULE']=='TAXR') { $tablemasterrow['N_TAX'] -= $Amount; }
              elseif ($ROW['RDET_MODULE']=='HOUR') {


                $tablemasterrow['K_HOURS'] += $hours;
                $tablemasterrow['KH_'.$MisthVar] += $hours;
                $tablemasterrow['N_HOURS'] += $Amount;
                $tablemasterrow['NH_'.$MisthVar] += $Amount;
              }
              elseif (in_array($ROW['RDET_MODULE'],array('EXTH','PLAE','PLAF','PLAP','SEVE'))) {
                $tablemasterrow['N_BENEFITS'] += $Amount;
                $tablemasterrow['NB_'.$MisthVar] += $Amount;
              }
              elseif ($ROW['RDET_MODULE']=='DED' && $ROW['RDET_TYPE']==1) {
                $tablemasterrow['N_DEDUCTIONS'] -= $Amount;
                $tablemasterrow['ND_'.$MisthVar] -= $Amount;
              }
              elseif ($ROW['RDET_MODULE']=='DED' && $ROW['RDET_TYPE']==2) {
                $tablemasterrow['N_ERGDED'] -= $Amount;
                $tablemasterrow['NE_'.$MisthVar] -= $Amount;
              }
              else { $tablemasterrow[$MisthVar] = $ROW['RDET_MODULE']; }
            }

            $Sum_plus_anadr  = $tablemasterrow['N_HOURS']+$tablemasterrow['N_BENEFITS']+$tablemasterrow['N_XBENEFITS'];
            $Sum_ded_anadr   = $tablemasterrow['N_DEDUCTIONS'];
            $Sum_minus_anadr = $Sum_ded_anadr+$tablemasterrow['N_TAX'];
            $tablemasterrow['N_PLUSNOEBEN'] = $tablemasterrow['N_HOURS']+$tablemasterrow['N_BENEFITS'];
            $tablemasterrow['N_INCOME']     = $Sum_plus_anadr;
            $tablemasterrow['N_ENTELOM']    = $Sum_plus_anadr+$tablemasterrow['N_ERGDED'];
            $tablemasterrow['N_DED_TAX']    = $Sum_minus_anadr;
            $tablemasterrow['N_TOTAL_DED']  = $Sum_minus_anadr+$tablemasterrow['N_ERGDED'];
            $tablemasterrow['N_PAID']       = $Sum_plus_anadr-$Sum_minus_anadr;
            $tablemasterrow['N_A_DEK']      = round($tablemasterrow['N_PAID'],2);
            $tablemasterrow['N_B_DEK']      = round(0,2);


          if (($Vathmos_iatr>0 AND $Vathmos_iatr==15) ||($Vathmos_iatr==0 || $Vathmos_iatr==NULL || ($Vathmos_iatr>0 and $Eapd_krit_id==3)))

            {
           $Sum_plus_anadr  =0;
           $Sum_minus_anadr =0;
           $Sum_ded_anadr   =0;
           $tablemasterrow['N_HOURS']=0;
           $tablemasterrow['N_DEDUCTIONS']=0;
           $tablemasterrow['N_BENEFITS']=0;
           $tablemasterrow['N_TAX']=0;
           $tablemasterrow['N_PAID']=0;

          }

		  if(($_SESSION['GLInstall']=='ALEX' AND ($Emp_id==2409 || $Emp_id==1530 || $Emp_id==2635) )){
		   
		    $Sum_plus_anadr  = $tablemasterrow['N_HOURS']+$tablemasterrow['N_BENEFITS']+$tablemasterrow['N_XBENEFITS'];
            $Sum_ded_anadr   = $tablemasterrow['N_DEDUCTIONS'];
            $Sum_minus_anadr = $Sum_ded_anadr+$tablemasterrow['N_TAX'];
		   
		   }
		  
          }
        }
      }
//-------------------EPISTIMONIKO PROSPIKO - XML VARDION

   if (in_array($Compute_Payroll,array('15','19'))) {
        $SQL_ot = "SELECT SALARY.SAL_ID, EXTRA_SALARY.EXSAL_ID, EXTRA_SALARY.EXSAL_DATEFROM, EXTRA_SALARY.EXSAL_DATETO FROM EXTRA_SALARY, SALARY WHERE EXTRA_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA_SALARY.EMP_ID =".$Emp_id." AND SALARY.PAY_ID=".$Payid." AND SALARY.SAL_ID=".$Sal_id;

      $RES_ot = DB_query($SQL_ot,$db);
        $ROW_ot = DB_fetch_array($RES_ot);
        $Exsal_id = $ROW_ot['EXSAL_ID'];
        $Exsal_from = $ROW_ot['EXSAL_DATEFROM'];
        $Exsal_to = $ROW_ot['EXSAL_DATETO'];
        if ($Exsal_id>0) {
          $tablemasterrow['TWA_EXSAL_ID'] = $Exsal_id;
          if (in_array($Compute_Payroll,array('15','19'))) {
            $SQL = "SELECT * FROM EXTRA_SALARY_DETAIL WHERE EXSAL_ID = ".$Exsal_id." ORDER BY EXSAD_MODULE,EXSAD_DESCRIPTION";
            $RES = DB_query($SQL,$db);
            while ($ROW=DB_fetch_array($RES)) {
              $Amount   = $ROW['EXSAD_CREDIT']-$ROW['EXSAD_DEBIT'];
              $hours    = $ROW['EXSAD_HOURS'];
              $MisthVar = G_VarPA($ROW['EXSAD_MODULE'],$ROW['BDL_ID'],$ROW['EXSAD_MODULEID']);

              if ($MisthVar=='AGNOSTO') {  }
              else {
                if ($ROW['EXSAD_MODULE']=='TAXH') { $tablemasterrow['P_TAX'] -= $Amount; }
                elseif ($ROW['EXSAD_MODULE']=='HOUR') {
                  $tablemasterrow['P_HOURS'] += $Amount;
                  $tablemasterrow['PH_'.$MisthVar] += $Amount;
                  $tablemasterrow['H_HOURS'] += $hours;
                  $tablemasterrow['HH_'.$MisthVar] += $hours;
              $tablemasterrow['PM_'.$MisthVar] = round($tablemasterrow['PH_'.$MisthVar]/$tablemasterrow['HH_'.$MisthVar],2);

              if (($Vathmos_iatr>0 AND $Vathmos_iatr==15) || ($Vathmos_iatr>0 and $Eapd_krit_id==3)){
               $tablemasterrow['PH_KANONIKH']=$tablemasterrow['PH_ENERG1'];
               $tablemasterrow['PH_KANONYXT']=$tablemasterrow['PH_ENERG2'];
               $tablemasterrow['PH_ARGIA']=$tablemasterrow['PH_ENERG3'];
               $tablemasterrow['PH_ARGNYXT']=$tablemasterrow['PH_ENERG4'];

               $tablemasterrow['HH_KANONIKH']=$tablemasterrow['HH_ENERG1'];
               $tablemasterrow['HH_KANONYXT']=$tablemasterrow['HH_ENERG2'];
               $tablemasterrow['HH_ARGIA']=$tablemasterrow['HH_ENERG3'];
               $tablemasterrow['HH_ARGNYXT']=$tablemasterrow['HH_ENERG4'];
              }
              elseif (($Vathmos_iatr>0 AND $Vathmos_iatr!=15) AND ($Vathmos_iatr>0 and $Eapd_krit_id!=3)){
               $tablemasterrow['PH_KANONIKH']=0;
               $tablemasterrow['PH_KANONYXT']=0;
               $tablemasterrow['PH_ARGIA']=0;
               $tablemasterrow['PH_ARGNYXT']=0;

               $tablemasterrow['HH_KANONIKH']=0;
               $tablemasterrow['HH_KANONYXT']=0;
               $tablemasterrow['HH_ARGIA']=0;
               $tablemasterrow['HH_ARGNYXT']=0;


              }
			  
			 if(($_SESSION['GLInstall']=='ALEX' AND ($Emp_id==2409 || $Emp_id==1530 || $Emp_id==2635) )){
		   
		       $tablemasterrow['PH_KANONIKH']=0;
               $tablemasterrow['PH_KANONYXT']=0;
               $tablemasterrow['PH_ARGIA']=0;
               $tablemasterrow['PH_ARGNYXT']=0;

               $tablemasterrow['HH_KANONIKH']=0;
               $tablemasterrow['HH_KANONYXT']=0;
               $tablemasterrow['HH_ARGIA']=0;
               $tablemasterrow['HH_ARGNYXT']=0;
		   
		   }


                 $tablemasterrow['EFHM_OVERTIME'] = '’–≈—Ÿ—…≈”';

                }
                elseif ($ROW['EXSAD_MODULE']=='EBEN') {
                  $tablemasterrow['P_XBENEFITS'] += $Amount;
                  $tablemasterrow['PF_'.$MisthVar] += $Amount;
                }
                elseif (in_array($ROW['EXSAD_MODULE'],array('EXTH','PLAE','PLAF','PLAP','SEVE'))) {
                  $tablemasterrow['P_BENEFITS'] += $Amount;
                  $tablemasterrow['PB_'.$MisthVar] += $Amount;
                }
                elseif ($ROW['EXSAD_MODULE']=='DED' && $ROW['EXSAD_TYPE']==0) {
                  $tablemasterrow['P_DEDUCTIONS'] -= $Amount;
                  $tablemasterrow['PD_'.$MisthVar] -= $Amount;
                }
                elseif ($ROW['EXSAD_MODULE']=='DED' && $ROW['EXSAD_TYPE']==1) {
                  $tablemasterrow['P_ERGDED'] -= $Amount;
                  $tablemasterrow['PE_'.$MisthVar] -= $Amount;
                }
                else { $tablemasterrow[$MisthVar] = $ROW['EXSAD_MODULE']; }
              }
            }
           $sint=sinton($Emp_id);
           $agrot=agrotikos($Emp_id);
           $Gross_Efim=GetMTEfim($Vathmos_iatr,$PerMonth,$PerYear);
           $Analisi=Cmp_Anal_Efim($Emp_id,$Exsal_from,$Exsal_to);
              foreach ($Analisi as $key => $value) { $tablemasterrow[$key] = $value; }




           if ($sint==1 and $_SESSION['GLInstall'] =='DRAMANOSOK'){

           $Gross_Efim[0]=157.23;
           $Gross_Efim[1]=215.96;
           $Gross_Efim[2]=167.03;
           $Gross_Efim[3]=232.76;
           $Gross_Efim[4]=242.56;

           $tablemasterrow['V_ENER_KAN']    = $Gross_Efim[0];
           $tablemasterrow['V_ENER_SAB']    = $Gross_Efim[1];
           $tablemasterrow['V_ENER_KA_AR']  = $Gross_Efim[2];
           $tablemasterrow['V_ENER_ARGIA']  = $Gross_Efim[3];
           $tablemasterrow['V_ENER_AR_AR']  = $Gross_Efim[4];
           $tablemasterrow['TOT_ENER_KAN']  = $tablemasterrow['V_ENER_KAN']*$tablemasterrow['ANALEK'];
           $tablemasterrow['TOT_ENER_SAB']  = $tablemasterrow['V_ENER_SAB']*$tablemasterrow['ANALES'];
           $tablemasterrow['TOT_ENER_KA_AR']= $tablemasterrow['V_ENER_KA_AR']*$tablemasterrow['ANALEX'];
           $tablemasterrow['TOT_ENER_ARGIA']  = $tablemasterrow['V_ENER_ARGIA']*$tablemasterrow['ANALEA'];
           $tablemasterrow['TOT_ENER_AR_AR']  = $tablemasterrow['V_ENER_AR_AR']*$tablemasterrow['ANALEZ'];

           }

           else{
           $tablemasterrow['V_ENER_KAN']    = $Gross_Efim[0];
           $tablemasterrow['V_ENER_SAB']    = $Gross_Efim[1];
           $tablemasterrow['V_ENER_KA_AR']  = $Gross_Efim[2];
           $tablemasterrow['V_ENER_ARGIA']  = $Gross_Efim[3];
           $tablemasterrow['V_ENER_AR_AR']  = $Gross_Efim[4];
           $tablemasterrow['TOT_ENER_KAN']  = $tablemasterrow['V_ENER_KAN']*$tablemasterrow['ANALEK'];
           $tablemasterrow['TOT_ENER_SAB']  = $tablemasterrow['V_ENER_SAB']*$tablemasterrow['ANALES'];
           $tablemasterrow['TOT_ENER_KA_AR']= $tablemasterrow['V_ENER_KA_AR']*$tablemasterrow['ANALEX'];
           $tablemasterrow['TOT_ENER_ARGIA']  = $tablemasterrow['V_ENER_ARGIA']*$tablemasterrow['ANALEA'];
           $tablemasterrow['TOT_ENER_AR_AR']  = $tablemasterrow['V_ENER_AR_AR']*$tablemasterrow['ANALEZ'];

           }

           $tablemasterrow['V_MIKT_KAN']      = round(0.7*$Gross_Efim[0],2);
           $tablemasterrow['V_MIKT_SAB']      = round(0.7*$Gross_Efim[1],2);
           $tablemasterrow['V_MIKT_KA_AR']    = round(0.7*$Gross_Efim[2],2);
           $tablemasterrow['V_MIKT_ARGIA']    = round(0.7*$Gross_Efim[3],2);
           $tablemasterrow['V_MIKT_AR_AR']    = round(0.7*$Gross_Efim[4],2);
           $tablemasterrow['TOT_MIKT_KAN']    = $tablemasterrow['V_MIKT_KAN']*$tablemasterrow['ANALMK'];
           $tablemasterrow['TOT_MIKT_SAB']    = $tablemasterrow['V_MIKT_SAB']*$tablemasterrow['ANALMS'];
           $tablemasterrow['TOT_MIKT_KA_AR']  = $tablemasterrow['V_MIKT_KA_AR']*$tablemasterrow['ANALMX'];
           $tablemasterrow['TOT_MIKT_ARGIA']  = $tablemasterrow['V_MIKT_ARGIA']*$tablemasterrow['ANALMA'];
           $tablemasterrow['TOT_MIKT_AR_AR']  = $tablemasterrow['V_MIKT_AR_AR']*$tablemasterrow['ANALMZ'];


           $tablemasterrow['V_ETOIM_KAN']      = round(0.4*$Gross_Efim[0],2);
           $tablemasterrow['V_ETOIM_SAB']      = round(0.4*$Gross_Efim[1],2);
           $tablemasterrow['V_ETOIM_KA_AR']    = round(0.4*$Gross_Efim[2],2);
           $tablemasterrow['V_ETOIM_ARGIA']    = round(0.4*$Gross_Efim[3],2);
           $tablemasterrow['V_ETOIM_AR_AR']    = round(0.4*$Gross_Efim[4],2);
           $tablemasterrow['TOT_ETOIM_KAN']    = $tablemasterrow['V_ETOIM_KAN']*$tablemasterrow['ANALTK'];
           $tablemasterrow['TOT_ETOIM_SAB']    = $tablemasterrow['V_ETOIM_SAB']*$tablemasterrow['ANALTS'];
           $tablemasterrow['TOT_ETOIM_KA_AR']  = $tablemasterrow['V_ETOIM_KA_AR']*$tablemasterrow['ANALTX'];
           $tablemasterrow['TOT_ETOIM_ARGIA']  = $tablemasterrow['V_ETOIM_ARGIA']*$tablemasterrow['ANALTA'];
           $tablemasterrow['TOT_ETOIM_AR_AR']  = $tablemasterrow['V_ETOIM_AR_AR']*$tablemasterrow['ANALTZ'];



            if ($Taktiki_Mikta == 'YES') {
              $Mikta_Taktikis = Get_takt_mikta($Emp_id,$PerMonth,$PerYear,$Vathmos_iatr);
              if ($PerYear==2012 && in_array($PerMonth,array(8,9,10,11,12))) { $Mikta_Taktikis = Get_takt_mikta($Emp_id,1,2013,$Vathmos_iatr); }
              $Oikogeneiako = Get_One_BDLRE($Emp_id,$PerMonth,$PerYear,'BEN','OIKOGEN');
              $Agoni        = Get_One_BDLRE($Emp_id,$PerMonth,$PerYear,'BEN_RETRO','AGON_PER');
              $tablemasterrow['TAKT_MIKTA'] = $Mikta_Taktikis-$Oikogeneiako+($Agoni/12);
            }
         $Pericopes=Find_Pericopes($Emp_id,$Sal_id,$Payid,$PerMonth,$PerYear);
         $Plafon_AP=$Pericopes[plaap]>0?$Pericopes[plaap]:0;
         $tablemasterrow['AREOPAGITIS'] = $Plafon_AP;
         $tablemasterrow['PLAFON_EFIM']=$Plafon_AP-$tablemasterrow['TAKT_MIKTA'];
         $tablemasterrow['PLAFON_EFIM_TOT']=$tablemasterrow['PER_EFHMAP']+$tablemasterrow['PLAFON']+$tablemasterrow['PER_AP']+$tablemasterrow['SEVEN'];

            $Sum_plus_efyp  = $tablemasterrow['P_HOURS']+$tablemasterrow['P_BENEFITS']+$tablemasterrow['P_XBENEFITS'];
            $Sum_ded_efyp   = $tablemasterrow['P_DEDUCTIONS'];
            $tablemasterrow['P_TOTDEDASFAL']=$tablemasterrow['P_DEDUCTIONS']+$tablemasterrow['P_TAX'];
            $Sum_minus_efyp = $Sum_ded_efyp+$tablemasterrow['P_TAX'];
            $tablemasterrow['P_PLUSNOEBEN'] = $tablemasterrow['P_HOURS']+$tablemasterrow['P_BENEFITS'];
            $tablemasterrow['P_INCOME']     = $Sum_plus_efyp;
            $tablemasterrow['P_ERG_DED']     = $tablemasterrow['P_ERGDED'];
            $tablemasterrow['P_ENTELOM']    = $Sum_plus_efyp+$tablemasterrow['P_ERGDED'];
            $tablemasterrow['P_DED_TAX']    = $Sum_minus_efyp;
            $tablemasterrow['P_TOTAL_DED']  = $Sum_minus_efyp+$tablemasterrow['P_ERGDED'];
            $tablemasterrow['P_PAID']       = $Sum_plus_efyp-$Sum_minus_efyp;
            $tablemasterrow['P_A_DEK']      = round($tablemasterrow['P_PAID'],2);
            $tablemasterrow['P_B_DEK']      = round(0,2);


         if (($Vathmos_iatr>0 AND $Vathmos_iatr!=15) AND ($Vathmos_iatr>0 and $Eapd_krit_id!=3))

            {
              $Sum_plus_efyp  =0;
              $Sum_minus_efyp =0;
              $Sum_ded_efyp   =0;

           }

         if(($_SESSION['GLInstall']=='ALEX' AND ($Emp_id==2409 || $Emp_id==1530 || $Emp_id==2635) )){
		   
		      $Sum_plus_efyp  =0;
              $Sum_minus_efyp =0;
              $Sum_ded_efyp   =0;
		   
		   }
		   
		   
          }
          if (in_array($Compute_Payroll,array('15','17'))) {

          $tmpsqldt = "select exsal_id_from from retro_master_extra ";
            $tmpsqldt .= " where retro_master_extra.exsal_id_to=".$Exsal_id;
            $tmpresdt =DB_query($tmpsqldt,$db);
            $tmprowdt =DB_fetch_array($tmpresdt);
            $Exsal_id_from=$tmprowdt['EXSAL_ID_FROM'];



         if ($Exsal_id_from>0){
            $tmpsqldt  = "select exsal_datefrom, exsal_dateto from extra_salary ";
            $tmpsqldt .= " where exsal_id=".$Exsal_id_from;
            $tmpresdt =DB_query($tmpsqldt,$db);
            $tmprowdt =DB_fetch_array($tmpresdt);
            $tablemasterrow['ANADR_DT_FROM']=$tmprowdt['EXSAL_DATEFROM'];
            $tablemasterrow['ANADR_DT_TO']=$tmprowdt['EXSAL_DATETO'];
       }

            $SQL  = "SELECT RMST_REASON, RDET_CREDIT, RDET_DEBIT, RDET_MODULE, RDET_MODULEID, RDET_DESCRIPTION, RDET_TYPE,RDET_HOURS,BDL_ID";
            $SQL .= "  FROM RETRO_MASTER_EXTRA, RETRO_DETAIL_EXTRA ";
            $SQL .= " WHERE RETRO_MASTER_EXTRA.RMST_ID = RETRO_DETAIL_EXTRA.RMST_ID AND RETRO_MASTER_EXTRA.EXSAL_ID_TO = ".$Exsal_id." ORDER BY RDET_MODULE,RDET_DESCRIPTION";
            $RES = DB_query($SQL,$db);
            while ($ROW=DB_fetch_array($RES)) {
              $Amount=$ROW['RDET_CREDIT']-$ROW['RDET_DEBIT'];
           $hours = $ROW['RDET_HOURS'];
              $MisthVar=G_VarPA($ROW['RDET_MODULE'],$ROW['BDL_ID'],$ROW['RDET_MODULEID']);
              if ($ROW['RDET_MODULE']=='TAXR') { $tablemasterrow['N_TAX'] -= $Amount; }
              elseif ($ROW['RDET_MODULE']=='HOUR') {


                $tablemasterrow['K_HOURS'] += $hours;
                $tablemasterrow['KH_'.$MisthVar] += $hours;
                $tablemasterrow['N_HOURS'] += $Amount;
                $tablemasterrow['NH_'.$MisthVar] += $Amount;

             if (($Vathmos_iatr>0 AND $Vathmos_iatr==15) || (($Vathmos_iatr>0 and $Eapd_krit_id==3))){
               $tablemasterrow['KH_KANONIKH']=$tablemasterrow['KH_ENERG1'];
               $tablemasterrow['KH_KANONYXT']=$tablemasterrow['KH_ENERG2'];
               $tablemasterrow['KH_ARGIA']=$tablemasterrow['KH_ENERG3'];
               $tablemasterrow['KH_ARGNYXT']=$tablemasterrow['KH_ENERG4'];

               $tablemasterrow['NH_KANONIKH']=$tablemasterrow['NH_ENERG1'];
               $tablemasterrow['NH_KANONYXT']=$tablemasterrow['NH_ENERG2'];
               $tablemasterrow['NH_ARGIA']=$tablemasterrow['NH_ENERG3'];
               $tablemasterrow['NH_ARGNYXT']=$tablemasterrow['NH_ENERG4'];

              }
              elseif (($Vathmos_iatr>0 AND $Vathmos_iatr!=15) AND ($Vathmos_iatr>0 and $Eapd_krit_id!=3)){

               $tablemasterrow['KH_KANONIKH']=0;
               $tablemasterrow['KH_KANONYXT']=0;
               $tablemasterrow['KH_ARGIA']=0;
               $tablemasterrow['KH_ARGNYXT']=0;

               $tablemasterrow['NH_KANONIKH']=0;
               $tablemasterrow['NH_KANONYXT']=0;
               $tablemasterrow['NH_ARGIA']=0;
               $tablemasterrow['NH_ARGNYXT']=0;


              }
			  
			   if(($_SESSION['GLInstall']=='ALEX' AND ($Emp_id==2409 || $Emp_id==1530 || $Emp_id==2635) )){
		   
		      $tablemasterrow['KH_KANONIKH']=0;
               $tablemasterrow['KH_KANONYXT']=0;
               $tablemasterrow['KH_ARGIA']=0;
               $tablemasterrow['KH_ARGNYXT']=0;

               $tablemasterrow['NH_KANONIKH']=0;
               $tablemasterrow['NH_KANONYXT']=0;
               $tablemasterrow['NH_ARGIA']=0;
               $tablemasterrow['NH_ARGNYXT']=0;
		   
		   }

              }
              elseif (in_array($ROW['RDET_MODULE'],array('EXTH','PLAE','PLAF','PLAP','SEVE'))) {
                $tablemasterrow['N_BENEFITS'] += $Amount;
                $tablemasterrow['NB_'.$MisthVar] += $Amount;
              }
              elseif ($ROW['RDET_MODULE']=='DED' && $ROW['RDET_TYPE']==1) {
                $tablemasterrow['N_DEDUCTIONS'] -= $Amount;
                $tablemasterrow['ND_'.$MisthVar] -= $Amount;
              }
              elseif ($ROW['RDET_MODULE']=='DED' && $ROW['RDET_TYPE']==2) {
                $tablemasterrow['N_ERGDED'] -= $Amount;
                $tablemasterrow['NE_'.$MisthVar] -= $Amount;
              }
              else { $tablemasterrow[$MisthVar] = $ROW['RDET_MODULE']; }
            }

            $Sum_plus_anadr  = $tablemasterrow['N_HOURS']+$tablemasterrow['N_BENEFITS']+$tablemasterrow['N_XBENEFITS'];
            $Sum_ded_anadr   = $tablemasterrow['N_DEDUCTIONS'];
            $Sum_minus_anadr = $Sum_ded_anadr+$tablemasterrow['N_TAX'];
            $tablemasterrow['N_PLUSNOEBEN'] = $tablemasterrow['N_HOURS']+$tablemasterrow['N_BENEFITS'];
            $tablemasterrow['N_INCOME']     = $Sum_plus_anadr;
            $tablemasterrow['N_ENTELOM']    = $Sum_plus_anadr+$tablemasterrow['N_ERGDED'];
            $tablemasterrow['N_DED_TAX']    = $Sum_minus_anadr;
            $tablemasterrow['N_TOTAL_DED']  = $Sum_minus_anadr+$tablemasterrow['N_ERGDED'];
            $tablemasterrow['N_PAID']       = $Sum_plus_anadr-$Sum_minus_anadr;
            $tablemasterrow['N_A_DEK']      = round($tablemasterrow['N_PAID'],2);
            $tablemasterrow['N_B_DEK']      = round(0,2);


         if (($Vathmos_iatr>0 AND $Vathmos_iatr!=15) AND ($Vathmos_iatr>0 and $Eapd_krit_id!=3)){

           $Sum_plus_anadr  =0;
           $Sum_minus_anadr =0;
           $Sum_ded_anadr   =0;
           $tablemasterrow['N_HOURS']=0;
           $tablemasterrow['N_DEDUCTIONS']=0;
           $tablemasterrow['N_BENEFITS']=0;
           $tablemasterrow['N_TAX']=0;
           $tablemasterrow['N_PAID']=0;

           }
		   
		  if(($_SESSION['GLInstall']=='ALEX' AND ($Emp_id==2409 || $Emp_id==1530 || $Emp_id==2635) )){
		   
		   $Sum_plus_anadr  =0;
           $Sum_minus_anadr =0;
           $Sum_ded_anadr   =0;
           $tablemasterrow['N_HOURS']=0;
           $tablemasterrow['N_DEDUCTIONS']=0;
           $tablemasterrow['N_BENEFITS']=0;
           $tablemasterrow['N_TAX']=0;
           $tablemasterrow['N_PAID']=0;
		   
		   }  

           }
        }

    }



//-------------------------------------------------------



      if (in_array($Compute_Payroll,array('All','10','11','12','14','17'))) {

     $SQL_takt = "SELECT SALARY.SAL_ID, EXTRA_SALARY.EXSAL_ID, EXTRA_SALARY.EXSAL_DATEFROM, EXTRA_SALARY.EXSAL_DATETO FROM EXTRA_SALARY, SALARY WHERE EXTRA_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA_SALARY.EMP_ID =".$Emp_id." AND SALARY.PAY_ID=".$Payid." AND SALARY.SAL_ID=".$Sal_id;

      $RES_takt = DB_query($SQL_takt,$db);
      $ROW_takt = DB_fetch_array($RES_takt);
      $Exsal_id_takt = $ROW_takt['EXSAL_ID'];


      if ($Exsal_id_takt>0) {
    $tmpsql = "SELECT SUM(EXSAD_CREDIT) AS CREDIT, SUM(EXSAD_DEBIT) AS DEBIT FROM EXTRA_SALARY_DETAIL WHERE EXSAL_ID =".$Exsal_id_takt." AND (EXSAD_MODULE='SEVE' OR EXSAD_MODULE='PLAE' OR EXSAD_MODULE='PLAP')";
    $tmpres =DB_query($tmpsql,$db);
    $tmprow =DB_fetch_array($tmpres);
    $Perikop_plafon = $tmprow['CREDIT']-$tmprow['DEBIT'];
  }
  
    $SQL = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$Emp_id." AND ECOP_VARIABLE='¬¡»Ãœ”_…¡‘—ŸÕ' ";
    $RES = DB_query($SQL,$db);
    $ROW = DB_fetch_array($RES);
    $Vathmos_iatr=$ROW['ECOP_VALUE'];
	
	
	      if($Vathmos_iatr==21) {$Vathmos_iatr=1;
	  $tablemasterrow['TWA_VATHM_XML_CODE']=258;}
            if($Vathmos_iatr==22) {$Vathmos_iatr=2;
	  $tablemasterrow['TWA_VATHM_XML_CODE']=259;}
            if($Vathmos_iatr==23) {$Vathmos_iatr=3;
	  $tablemasterrow['TWA_VATHM_XML_CODE']=260;}
            if($Vathmos_iatr==24) {$Vathmos_iatr=4;
	  $tablemasterrow['TWA_VATHM_XML_CODE']=262;}
            if($Vathmos_iatr==25) {$Vathmos_iatr=5;
	  $tablemasterrow['TWA_VATHM_XML_CODE']=445;}
            if($Vathmos_iatr==26) {$Vathmos_iatr=6;
	  $tablemasterrow['TWA_VATHM_XML_CODE']=444;}
            if($Vathmos_iatr==27) {$Vathmos_iatr=7;
	  $tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==28) {$Vathmos_iatr=8;
	  $tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==29) {$Vathmos_iatr=9;
	  $tablemasterrow['TWA_VATHM_XML_CODE']=998;}
            if($Vathmos_iatr==30) {$Vathmos_iatr=10;
	  $tablemasterrow['TWA_VATHM_XML_CODE']=447;}
            if($Vathmos_iatr==31) {$Vathmos_iatr=11;
	  $tablemasterrow['TWA_VATHM_XML_CODE']=446;}
            if($Vathmos_iatr==32) {$Vathmos_iatr=12;
	  $tablemasterrow['TWA_VATHM_XML_CODE']=258;}
            if($Vathmos_iatr==33) {$Vathmos_iatr=13;
	  $tablemasterrow['TWA_VATHM_XML_CODE']=259;}
            if($Vathmos_iatr==34) {$Vathmos_iatr=14;
	  $tablemasterrow['TWA_VATHM_XML_CODE']=10;}	
			
	
      if ($Vathmos_iatr>0) {
      $Vathm_array=array(1=>'ƒ…≈’».' ,2=>'≈–…Ã ¡', 3=>'≈–…Ã ¬', 4=>'≈…ƒ… ', 5=>'¡Õ¡–  ¡»',6=>' ¡»«√',7=>'¡√—œ‘ 14',8=>'¡√—œ‘ 15',9=>'¡√—œ‘ 16',10=>'À≈ ‘œ—',11=>'≈–… œ’—');
      $Vathm_desc=$Vathm_array[$Vathmos_iatr];
	  $tablemasterrow['TWA_VATHMOS']=$Vathm_desc;
	  $tablemasterrow['TWA_VATHMOS_ONLY'] = $Vathm_desc;		
	  $sint=sinton($Emp_id);
      $tablemasterrow['KLIMAKIO'] = $Vathm_desc;
      $MT_Efim=GetMTEfim($Vathmos_iatr,$PerMonth,$PerYear);
      $tablemasterrow['TM_ENER_KAN']    = $MT_Efim[0];
      $tablemasterrow['TM_ENER_SAB']    = $MT_Efim[1];
      $tablemasterrow['TM_ENER_KA_AR']  = $MT_Efim[2];
      $tablemasterrow['TM_ENER_ARGIA']  = $MT_Efim[3];
      $tablemasterrow['TM_ENER_AR_AR']  = $MT_Efim[4];

      if ($_SESSION['GLInstall']=='ALEX' && $Emp_id==832) {
        $tablemasterrow['TM_ENER_KAN']    = 203.28;
        $tablemasterrow['TM_ENER_SAB']    = 283.26;
        $tablemasterrow['TM_ENER_KA_AR']  = 216.62;
        $tablemasterrow['TM_ENER_ARGIA']  = 306.10;
        $tablemasterrow['TM_ENER_AR_AR']  = 319.44;
        $tablemasterrow['TM_MIKT_KAN']    = 0.7*$tablemasterrow['TM_ENER_KAN'];
        $tablemasterrow['TM_MIKT_SAB']    = 0.7*$tablemasterrow['TM_ENER_SAB'];
        $tablemasterrow['TM_MIKT_KA_AR']  = 0.7*$tablemasterrow['TM_ENER_KA_AR'];
        $tablemasterrow['TM_MIKT_ARGIA']  = 0.7*$tablemasterrow['TM_ENER_ARGIA'];
        $tablemasterrow['TM_MIKT_AR_AR']  = 0.7*$tablemasterrow['TM_ENER_AR_AR'];
        $tablemasterrow['TM_ETOIM_KAN']   = 0.4*$tablemasterrow['TM_ENER_KAN'];
        $tablemasterrow['TM_ETOIM_SAB']   = 0.4*$tablemasterrow['TM_ENER_SAB'];
        $tablemasterrow['TM_ETOIM_KA_AR'] = 0.4*$tablemasterrow['TM_ENER_KA_AR'];
        $tablemasterrow['TM_ETOIM_ARGIA'] = 0.4*$tablemasterrow['TM_ENER_ARGIA'];
        $tablemasterrow['TM_ETOIM_AR_AR'] = 0.4*$tablemasterrow['TM_ENER_AR_AR'];
      }
      elseif ($_SESSION['GLInstall']=='ALEX' && $Emp_id==1391) {
        $tablemasterrow['TM_ENER_KAN']    = 102.56;
        $tablemasterrow['TM_ENER_SAB']    = 157.32;
        $tablemasterrow['TM_ENER_KA_AR']  = 113.16;
        $tablemasterrow['TM_ENER_ARGIA']  = 182.52;
        $tablemasterrow['TM_ENER_AR_AR']  = 193.12;
        $tablemasterrow['TM_MIKT_KAN']    = 0;
        $tablemasterrow['TM_MIKT_SAB']    = 0;
        $tablemasterrow['TM_MIKT_KA_AR']  = 0;
        $tablemasterrow['TM_MIKT_ARGIA']  = 0;
        $tablemasterrow['TM_MIKT_AR_AR']  = 0;
        $tablemasterrow['TM_ETOIM_KAN']   = 0;
        $tablemasterrow['TM_ETOIM_SAB']   = 0;
        $tablemasterrow['TM_ETOIM_KA_AR'] = 0;
        $tablemasterrow['TM_ETOIM_ARGIA'] = 0;
        $tablemasterrow['TM_ETOIM_AR_AR'] = 0;
      }
      elseif (in_array($Vathmos,array(4,7,8,9))) {
        $tablemasterrow['TM_MIKT_KAN']    = 0;
        $tablemasterrow['TM_MIKT_SAB']    = 0;
        $tablemasterrow['TM_MIKT_KA_AR']  = 0;
        $tablemasterrow['TM_MIKT_ARGIA']  = 0;
        $tablemasterrow['TM_MIKT_AR_AR']  = 0;
        $tablemasterrow['TM_ETOIM_KAN']   = 0;
        $tablemasterrow['TM_ETOIM_SAB']   = 0;
        $tablemasterrow['TM_ETOIM_KA_AR'] = 0;
        $tablemasterrow['TM_ETOIM_ARGIA'] = 0;
        $tablemasterrow['TM_ETOIM_AR_AR'] = 0;
      }
      else {
        $tablemasterrow['TM_MIKT_KAN']    = 0.7*$MT_Efim[0];
        $tablemasterrow['TM_MIKT_SAB']    = 0.7*$MT_Efim[1];
        $tablemasterrow['TM_MIKT_KA_AR']  = 0.7*$MT_Efim[2];
        $tablemasterrow['TM_MIKT_ARGIA']  = 0.7*$MT_Efim[3];
        $tablemasterrow['TM_MIKT_AR_AR']  = 0.7*$MT_Efim[4];
        $tablemasterrow['TM_ETOIM_KAN']   = round(0.4*$MT_Efim[0],2);
        $tablemasterrow['TM_ETOIM_SAB']   = round(0.4*$MT_Efim[1],2);
        $tablemasterrow['TM_ETOIM_KA_AR'] = round(0.4*$MT_Efim[2],2);
        $tablemasterrow['TM_ETOIM_ARGIA'] = round(0.4*$MT_Efim[3],2);
        $tablemasterrow['TM_ETOIM_AR_AR'] = round(0.4*$MT_Efim[4],2);
      }
	  
	   if ($_SESSION['GLInstall']=='DRAMANOSOK' AND $sint==1) {
        
		$Gross_Efim[0]=157.23;
        $Gross_Efim[1]=215.96;
        $Gross_Efim[2]=167.03;
        $Gross_Efim[3]=232.76;
        $Gross_Efim[4]=242.56;

        $tablemasterrow['TM_ENER_KAN']    = $Gross_Efim[0];
        $tablemasterrow['TM_ENER_SAB']    = $Gross_Efim[1];
        $tablemasterrow['TM_ENER_KA_AR']  = $Gross_Efim[2];
        $tablemasterrow['TM_ENER_ARGIA']  = $Gross_Efim[3];
        $tablemasterrow['TM_ENER_AR_AR']  = $Gross_Efim[4];
        $tablemasterrow['TM_MIKT_KAN']    = 0.7*$tablemasterrow['TM_ENER_KAN'];
        $tablemasterrow['TM_MIKT_SAB']    = 0.7*$tablemasterrow['TM_ENER_SAB'];
        $tablemasterrow['TM_MIKT_KA_AR']  = 0.7*$tablemasterrow['TM_ENER_KA_AR'];
        $tablemasterrow['TM_MIKT_ARGIA']  = 0.7*$tablemasterrow['TM_ENER_ARGIA'];
        $tablemasterrow['TM_MIKT_AR_AR']  = 0.7*$tablemasterrow['TM_ENER_AR_AR'];
        $tablemasterrow['TM_ETOIM_KAN']   = 0.4*$tablemasterrow['TM_ENER_KAN'];
        $tablemasterrow['TM_ETOIM_SAB']   = 0.4*$tablemasterrow['TM_ENER_SAB'];
        $tablemasterrow['TM_ETOIM_KA_AR'] = 0.4*$tablemasterrow['TM_ENER_KA_AR'];
        $tablemasterrow['TM_ETOIM_ARGIA'] = 0.4*$tablemasterrow['TM_ENER_ARGIA'];
        $tablemasterrow['TM_ETOIM_AR_AR'] = 0.4*$tablemasterrow['TM_ENER_AR_AR'];
      }
	  
    }
   $Pericopes=Find_Pericopes($Emp_id,$Sal_id,$Payid,$PerMonth,$PerYear);

    $Vathmos=$Pericopes[vath];
    $Vathm_descr=$Pericopes[vadescr];
    $Exsal_id=$Pericopes[exsalid];
    $All_takt_apod=$Pericopes[allgr]>0?$Pericopes[allgr]:0;
    $Oikogen_ben=$Pericopes[oikog]>0?$Pericopes[oikog]:0;
    $Takt_gross=$Pericopes[grtakt]>0?$Pericopes[grtakt]:0;
    $Agoni_ben=$Pericopes[agonper]>0?$Pericopes[agonper]:0;
    $Final_gross=$Pericopes[telgr]>0?$Pericopes[telgr]:0;
    $Efim_gross=$Pericopes[grefim]>0?$Pericopes[grefim]:0;
    $Plafon_1=$Pericopes[plaf1]>0?$Pericopes[plaf1]:0;
    $All_gross=$Pericopes[sumgr]>0?$Pericopes[sumgr]:0;
    $Plafon_AP=$Pericopes[plaap]>0?$Pericopes[plaap]:0;
    $Plafon_2=$Pericopes[plaf2]>0?$Pericopes[plaf2]:0;
    $Plafon_aepa=$Plafon_2;

    $tablemasterrow['AREOPAGITIS'] = $Plafon_AP;

        $SQL_ex = "SELECT SALARY.SAL_ID, EXTRA2_SALARY.EXSAL_ID,EXTRA2_SALARY.EXSAL_DATEFROM,EXTRA2_SALARY.EXSAL_DATETO FROM EXTRA2_SALARY, SALARY WHERE EXTRA2_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA2_SALARY.EMP_ID =".$Emp_id." AND SALARY.PAY_ID=".$Payid." AND SALARY.SAL_ID=".$Sal_id;
      $RES_ex = DB_query($SQL_ex,$db);
        $ROW_ex = DB_fetch_array($RES_ex);
        $Ex2sal_id = $ROW_ex['EXSAL_ID'];
        if ($Ex2sal_id>0) {
          $tablemasterrow['TWA_EX2SAL_ID'] = $Ex2sal_id;
          if (in_array($Compute_Payroll,array('All','10','12','14','17'))) {
            $SQL = "SELECT * FROM EXTRA2_SALARY_DETAIL WHERE EXSAL_ID = ".$Ex2sal_id." ORDER BY EXSAD_MODULE,EXSAD_DESCRIPTION";
            $RES = DB_query($SQL,$db);
            while ($ROW=DB_fetch_array($RES)) {
              $Amount=$ROW['EXSAD_CREDIT']-$ROW['EXSAD_DEBIT'];
              $MisthVar=G_VarPA($ROW['EXSAD_MODULE'],$ROW['BDL_ID'],$ROW['EXSAD_MODULEID']);
              if ($ROW['EXSAD_MODULE']=='TAXH') { $tablemasterrow['C_TAX'] -= $Amount; }
              elseif ($ROW['EXSAD_MODULE']=='PLAF') { $tablemasterrow['CB_D2_BASIC'] += $Amount; }
			  elseif ($ROW['EXSAD_MODULE']=='PER') { $tablemasterrow['CB_D2_PERIK'] += $Amount; }
              elseif ($ROW['EXSAD_MODULE']=='DED' && $ROW['EXSAD_TYPE']==0) {
                $tablemasterrow['C_DEDUCTIONS'] -= $Amount;
                $tablemasterrow['CD_'.$MisthVar] -= $Amount;
              }
              elseif ($ROW['EXSAD_MODULE']=='DED' && $ROW['EXSAD_TYPE']==1) {
                $tablemasterrow['C_ERGDED'] -= $Amount;
                $tablemasterrow['CE_'.$MisthVar] -= $Amount;
              }
              else { $tablemasterrow[$MisthVar] = $ROW['EXSAD_MODULE']; }


            }


            if ($Taktiki_Mikta == 'YES') {
              $Mikta_Taktikis = Get_takt_mikta($Emp_id,$PerMonth,$PerYear,$Vathmos_iatr);
              if ($PerYear==2012 && in_array($PerMonth,array(8,9,10,11,12))) { $Mikta_Taktikis = Get_takt_mikta($Emp_id,1,2013,$Vathmos_iatr); }
              $Oikogeneiako = Get_One_BDLRE($Emp_id,$PerMonth,$PerYear,'BEN','OIKOGEN');
              $Agoni        = Get_One_BDLRE($Emp_id,$PerMonth,$PerYear,'BEN_RETRO','AGON_PER');
              $tablemasterrow['TAKT_MIKTA'] = $Mikta_Taktikis;
              $tablemasterrow['SINOLO_APODOX_MIK'] = $Mikta_Taktikis-$Oikogeneiako+($Agoni/12);
            }


            $tablemasterrow['PLAFON_EFIM']=$Plafon_AP-$tablemasterrow['TAKT_MIKTA'];


    // ¡Ì·ÎıÛÁ ≈ÌÂÒ„˛Ì
    $tmpsql3 = "SELECT emp_id,dtr_date,dts_type,";
    $tmpsql3 .= " ts_analysis_pkg.get_holy_flag(emp_id,dtr_date) AS cur_holy ,";
    $tmpsql3 .= " ts_analysis_pkg.get_holy_flag(emp_id,(dtr_date+1)) AS next_holy ";
    $tmpsql3 .= " FROM ts_duty_trans t, ts_duties d";
    $tmpsql3 .= " WHERE t.dts_id=d.dts_id";
    $tmpsql3 .= " AND dts_type=1";
    $tmpsql3 .= " AND dtr_date >= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATEFROM']));
    $tmpsql3 .= " AND dtr_date <= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATETO']));
    $tmpsql3 .= " AND emp_id='".$Emp_id."'";
    $tmpsql3 .= " ORDER by dtr_date";

    $normal = 0;
    $before_kyr = 0;
    $kath_to_arg = 0;
    $kyr = 0;
    $kyrkyr = 0;
    $tmpres3 =DB_query($tmpsql3,$db);
    if ($tmpres3) {
        while ($tmprow3 =DB_fetch_array($tmpres3)) {
            if ($tmprow3['CUR_HOLY']==0 && $tmprow3['NEXT_HOLY']==0) {
                $normal += 1;
            }
            if ($tmprow3['CUR_HOLY']==0 && $tmprow3['NEXT_HOLY']==1) {
                if (get_weekday_number(ConvertSQLDate($tmprow3['DTR_DATE']))==6) {
                    $before_kyr += 1;
                } else {
                    $kath_to_arg += 1;
                }
            }
            if ($tmprow3['CUR_HOLY']==1 && $tmprow3['NEXT_HOLY']==1) {
                $kyrkyr += 1;
            }
            if ($tmprow3['CUR_HOLY']==1 && $tmprow3['NEXT_HOLY']==0) {
                $kyr += 1;
            }
        }
    }

    $tablemasterrow['ENERG_ANAL1']=' :'.$normal."-”:".$before_kyr;
    $tablemasterrow['ENERG_ANAL2']="- /¡:".$kath_to_arg."-¡:".$kyr."-¡/¡:".$kyrkyr;

    $tablemasterrow['ENER_KAN']   = $normal;
    $tablemasterrow['ENER_SAB']   = $before_kyr;
    $tablemasterrow['ENER_KA_AR'] = $kath_to_arg;
    $tablemasterrow['ENER_ARGIA'] = $kyr;
    $tablemasterrow['ENER_AR_AR'] = $kyrkyr;

    $tablemasterrow['ANALEK']=$normal;
    $tablemasterrow['ANALES']=$before_kyr;
    $tablemasterrow['ANALEX']=$kath_to_arg;
    $tablemasterrow['ANALEA']=$kyr;
    $tablemasterrow['ANALEZ']=$kyrkyr;

    // ¡Ì·ÎıÛÁ ÃÈÍÙ˛Ì
    $tmpsql3 = "SELECT emp_id,dtr_date,dts_type,";
    $tmpsql3 .= " ts_analysis_pkg.get_holy_flag(emp_id,dtr_date) AS cur_holy ,";
    $tmpsql3 .= " ts_analysis_pkg.get_holy_flag(emp_id,(dtr_date+1)) AS next_holy ";
    $tmpsql3 .= " FROM ts_duty_trans t, ts_duties d";
    $tmpsql3 .= " WHERE t.dts_id=d.dts_id";
    $tmpsql3 .= " AND dts_type=2";
    $tmpsql3 .= " AND dtr_date >= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATEFROM']));
    $tmpsql3 .= " AND dtr_date <= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATETO']));
    $tmpsql3 .= " AND emp_id='".$Emp_id."'";
    $tmpsql3 .= " ORDER by dtr_date";

    $normal = 0;
    $before_kyr = 0;
    $kath_to_arg = 0;
    $kyr = 0;
    $kyrkyr = 0;
    $tmpres3 =DB_query($tmpsql3,$db);
    if ($tmpres3) {
        while ($tmprow3 =DB_fetch_array($tmpres3)) {
            if ($tmprow3['CUR_HOLY']==0 && $tmprow3['NEXT_HOLY']==0) {
                $normal += 1;
            }
            if ($tmprow3['CUR_HOLY']==0 && $tmprow3['NEXT_HOLY']==1) {
                if (get_weekday_number(ConvertSQLDate($tmprow3['DTR_DATE']))==6) {
                    $before_kyr += 1;
                } else {
                    $kath_to_arg += 1;
                }
            }
            if ($tmprow3['CUR_HOLY']==1 && $tmprow3['NEXT_HOLY']==1) {
                $kyrkyr += 1;
            }
            if ($tmprow3['CUR_HOLY']==1 && $tmprow3['NEXT_HOLY']==0) {
                $kyr += 1;
            }
        }
    }

    $tablemasterrow['MIKT_ANAL1']=' :'.$normal."-”:".$before_kyr;
    $tablemasterrow['MIKT_ANAL2']="- /¡:".$kath_to_arg."-¡:".$kyr."-¡/¡:".$kyrkyr;

    $tablemasterrow['MIKT_KAN']   = $normal;
    $tablemasterrow['MIKT_SAB']   = $before_kyr;
    $tablemasterrow['MIKT_KA_AR'] = $kath_to_arg;
    $tablemasterrow['MIKT_ARGIA'] = $kyr;
    $tablemasterrow['MIKT_AR_AR'] = $kyrkyr;

    $tablemasterrow['ANALMK']=$normal;
    $tablemasterrow['ANALMS']=$before_kyr;
    $tablemasterrow['ANALMX']=$kath_to_arg;
    $tablemasterrow['ANALMA']=$kyr;
    $tablemasterrow['ANALMZ']=$kyrkyr;

    // ¡Ì·ÎıÛÁ ≈ÙÔÈÏ¸ÙÁÙ·Ú
    $tmpsql3 = "SELECT emp_id,dtr_date,dts_type,";
    $tmpsql3 .= " ts_analysis_pkg.get_holy_flag(emp_id,dtr_date) AS cur_holy ,";
    $tmpsql3 .= " ts_analysis_pkg.get_holy_flag(emp_id,(dtr_date+1)) AS next_holy ";
    $tmpsql3 .= " FROM ts_duty_trans t, ts_duties d";
    $tmpsql3 .= " WHERE t.dts_id=d.dts_id";
    $tmpsql3 .= " AND dts_type=3";
    $tmpsql3 .= " AND dtr_date >= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATEFROM']));
    $tmpsql3 .= " AND dtr_date <= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATETO']));
    $tmpsql3 .= " AND emp_id='".$Emp_id."'";
    $tmpsql3 .= " ORDER by dtr_date";

    $normal = 0;
    $before_kyr = 0;
    $kath_to_arg = 0;
    $kyr = 0;
    $kyrkyr = 0;
    $tmpres3 =DB_query($tmpsql3,$db);
    if ($tmpres3) {
        while ($tmprow3 =DB_fetch_array($tmpres3)) {
            if ($tmprow3['CUR_HOLY']==0 && $tmprow3['NEXT_HOLY']==0) {
                $normal += 1;
            }
            if ($tmprow3['CUR_HOLY']==0 && $tmprow3['NEXT_HOLY']==1) {
                if (get_weekday_number(ConvertSQLDate($tmprow3['DTR_DATE']))==6) {
                    $before_kyr += 1;
                } else {
                    $kath_to_arg += 1;
                }
            }
            if ($tmprow3['CUR_HOLY']==1 && $tmprow3['NEXT_HOLY']==1) {
                $kyrkyr += 1;
            }
            if ($tmprow3['CUR_HOLY']==1 && $tmprow3['NEXT_HOLY']==0) {
                $kyr += 1;
            }
        }
    }

    $tablemasterrow['ETOIM_ANAL1']=' :'.$normal."-”:".$before_kyr;
    $tablemasterrow['ETOIM_ANAL2']="- /¡:".$kath_to_arg."-¡:".$kyr."-¡/¡:".$kyrkyr;

    $tablemasterrow['ETOIM_KAN']   = $normal;
    $tablemasterrow['ETOIM_SAB']   = $before_kyr;
    $tablemasterrow['ETOIM_KA_AR'] = $kath_to_arg;
    $tablemasterrow['ETOIM_ARGIA'] = $kyr;
    $tablemasterrow['ETOIM_AR_AR'] = $kyrkyr;

    $tablemasterrow['ANALTK']=$normal;
    $tablemasterrow['ANALTS']=$before_kyr;
    $tablemasterrow['ANALTX']=$kath_to_arg;
    $tablemasterrow['ANALTA']=$kyr;
    $tablemasterrow['ANALTZ']=$kyrkyr;



    if($_SESSION['GLInstall']=='DRAMANOSOK'){
	
	
	$sqlchk = "select count(*) AS ENERGES from ts_duty_plans_iperv  where dts_id=11 and
               emp_id='".$Emp_id."' and dpl_date >= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATEFROM']))."
               and dpl_date <= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATETO']))."";   
	$Reschk =DB_query($sqlchk,$db);	   
	$Rowchk=DB_fetch_array($Reschk);
	$ENERGES=$Rowchk['ENERGES'];
			
	$sqlchk = "select count(*) AS ENERGESS_K from ts_duty_plans_iperv  where dts_id=16 and
               emp_id='".$Emp_id."' and dpl_date >= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATEFROM']))."
               and dpl_date <= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATETO']))."";   
    $Reschk =DB_query($sqlchk,$db);	   
	$Rowchk=DB_fetch_array($Reschk);
	$ENERGESS_K=$Rowchk['ENERGESS_K'];
			 
	$sqlchk = "select count(*) AS ENERGES_A from ts_duty_plans_iperv  where dts_id=14 and
               emp_id='".$Emp_id."' and dpl_date >= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATEFROM']))."
               and dpl_date <= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATETO']))."";   
	$Reschk =DB_query($sqlchk,$db);	   
	$Rowchk=DB_fetch_array($Reschk);
    $ENERGES_A=$Rowchk['ENERGES_A'];
			 
	$sqlchk = "select count(*) AS ENERGESK_A from ts_duty_plans_iperv  where dts_id=17 and
               emp_id='".$Emp_id."' and dpl_date >= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATEFROM']))."
               and dpl_date <= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATETO']))."";   
	$Reschk =DB_query($sqlchk,$db);	   
	$Rowchk=DB_fetch_array($Reschk);
	$ENERGESK_A=$Rowchk['ENERGESK_A'];
			 
			 
	$sqlchk = "select count(*) AS ENERGESA_A from ts_duty_plans_iperv  where dts_id=18 and
               emp_id='".$Emp_id."' and dpl_date >= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATEFROM']))."
               and dpl_date <= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATETO']))."";   
	$Reschk =DB_query($sqlchk,$db);	   
	$Rowchk=DB_fetch_array($Reschk);
	$ENERGESA_A=$Rowchk['ENERGESA_A'];
			 
			 
			
			 
	$sqlchk = "select count(*) AS ETOIMOTITAS from ts_duty_plans_iperv  where dts_id=13 and
               emp_id='".$Emp_id."' and dpl_date >= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATEFROM']))."
               and dpl_date <= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATETO']))."";   
	$Reschk =DB_query($sqlchk,$db);	   
	$Rowchk=DB_fetch_array($Reschk);
	$ETOIMOTITAS=$Rowchk['ETOIMOTITAS'];
			 
	$sqlchk = "select count(*) AS ETOIMOTITASS_K from ts_duty_plans_iperv  where dts_id=19 and
               emp_id='".$Emp_id."' and dpl_date >= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATEFROM']))."
               and dpl_date <= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATETO']))."";   
	$Reschk =DB_query($sqlchk,$db);	   
	$Rowchk=DB_fetch_array($Reschk);
	$ETOIMOTITASS_K=$Rowchk['ETOIMOTITASS_K'];
			 
	$sqlchk = "select count(*) AS ETOIMOTITAS_A from ts_duty_plans_iperv  where dts_id=15 and
               emp_id='".$Emp_id."' and dpl_date >= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATEFROM']))."
               and dpl_date <= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATETO']))."";   
	$Reschk =DB_query($sqlchk,$db);	   
	$Rowchk=DB_fetch_array($Reschk);
	$ETOIMOTITAS_A=$Rowchk['ETOIMOTITAS_A'];
			 
	$sqlchk = "select count(*) AS ETOIMOTITASK_A from ts_duty_plans_iperv  where dts_id=20 and
               emp_id='".$Emp_id."' and dpl_date >= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATEFROM']))."
               and dpl_date <= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATETO']))."";   
	$Reschk =DB_query($sqlchk,$db);	   
	$Rowchk=DB_fetch_array($Reschk);
	$ETOIMOTITASK_A=$Rowchk['ETOIMOTITASK_A'];
			 
			 
	$sqlchk = "select count(*) AS ETOIMOTITASA_A from ts_duty_plans_iperv  where dts_id=21 and
               emp_id='".$Emp_id."' and dpl_date >= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATEFROM']))."
               and dpl_date <= ".FormatDateForSQL(ConvertSQLDate($ROW_ex['EXSAL_DATETO']))."";   
	$Reschk =DB_query($sqlchk,$db);	   
	$Rowchk=DB_fetch_array($Reschk);
	$ETOIMOTITASA_A=$Rowchk['ETOIMOTITASA_A'];
	
	$tablemasterrow['ENER_KAN']   = $ENERGES;
    $tablemasterrow['ENER_SAB']   = $ENERGESS_K;
    $tablemasterrow['ENER_KA_AR'] = $ENERGESK_A;
    $tablemasterrow['ENER_ARGIA'] = $ENERGES_A;
    $tablemasterrow['ENER_AR_AR'] = $ENERGESA_A;
	
	$tablemasterrow['MIKT_KAN']   = 0;
    $tablemasterrow['MIKT_SAB']   = 0;
    $tablemasterrow['MIKT_KA_AR'] = 0;
    $tablemasterrow['MIKT_ARGIA'] = 0;
    $tablemasterrow['MIKT_AR_AR'] = 0;
	
	$tablemasterrow['ETOIM_KAN']   = $ETOIMOTITAS;
    $tablemasterrow['ETOIM_SAB']   = $ETOIMOTITASS_K;
    $tablemasterrow['ETOIM_KA_AR'] = $ETOIMOTITASK_A;
    $tablemasterrow['ETOIM_ARGIA'] = $ETOIMOTITAS_A;
    $tablemasterrow['ETOIM_AR_AR'] = $ETOIMOTITASA_A;
	
	
	$tablemasterrow['SUM_ENER_KAN']   = $ENERGES   *$tablemasterrow['TM_ENER_KAN'];
    $tablemasterrow['SUM_ENER_SAB']   = $ENERGESS_K*$tablemasterrow['TM_ENER_SAB'];
    $tablemasterrow['SUM_ENER_KA_AR'] = $ENERGESK_A*$tablemasterrow['TM_ENER_KA_AR'];
    $tablemasterrow['SUM_ENER_ARGIA'] = $ENERGES_A *$tablemasterrow['TM_ENER_ARGIA'];
    $tablemasterrow['SUM_ENER_AR_AR'] = $ENERGESA_A*$tablemasterrow['TM_ENER_AR_AR'];
	
	$tablemasterrow['SUM_ETOIM_KAN']   = $ETOIMOTITAS*$tablemasterrow['TM_ETOIM_KAN'];
    $tablemasterrow['SUM_ETOIM_SAB']   = $ETOIMOTITASS_K*$tablemasterrow['TM_ETOIM_SAB'];
    $tablemasterrow['SUM_ETOIM_KA_AR'] = $ETOIMOTITASK_A*$tablemasterrow['TM_ETOIM_KA_AR'];
    $tablemasterrow['SUM_ETOIM_ARGIA'] = $ETOIMOTITAS_A*$tablemasterrow['TM_ETOIM_ARGIA'];
    $tablemasterrow['SUM_ETOIM_AR_AR'] = $ETOIMOTITASA_A*$tablemasterrow['TM_ETOIM_AR_AR'];
	
	}

// [---------------------------------------------------------------- EXTRA_SALARY_DETAIL


         $tablemasterrow['TAKT_EFHM']=$Efim_gross;

         $tablemasterrow['PERIKOP_PLAFON']=($Perikop_plafon);
         $tablemasterrow['AKATH_EFHM'] = $tablemasterrow['TAKT_EFHM'] + $tablemasterrow['PERIKOP_PLAFON'];
         $tablemasterrow['KATAVLITH']= efim_paid ($Emp_id,$Payid);

            $Sum_plus_yperv  = $tablemasterrow['CB_D2_BASIC'];
            $Sum_ded_yperv   = $tablemasterrow['C_DEDUCTIONS'];
            $Sum_minus_yperv = $Sum_ded_yperv+$tablemasterrow['C_TAX'];

            $tablemasterrow['C_INCOME']     = $Sum_plus_yperv;
			$tablemasterrow['C_DED_ERGAZ']  = $Sum_ded_yperv;
            $tablemasterrow['C_ENTELOM']    = $Sum_plus_yperv+$tablemasterrow['C_ERGDED']+$tablemasterrow['CB_D2_PERIK'];
            $tablemasterrow['C_DED_TAX']    = $Sum_minus_yperv;
            $tablemasterrow['C_TOTAL_DED']  = $Sum_minus_yperv+$tablemasterrow['C_ERGDED'];
            $tablemasterrow['C_PAID']       = $Sum_plus_yperv-$Sum_minus_yperv+$tablemasterrow['CB_D2_PERIK'];
            $tablemasterrow['C_A_DEK']      = round($tablemasterrow['C_PAID'],2);
            $tablemasterrow['C_B_DEK']      = round(0,2);

			if(($tablemasterrow['TAKT_EFHM']+$tablemasterrow['C_INCOME'])>$tablemasterrow['PLAFON_EFIM']){
			$tablemasterrow['PLAFON_EFIM']=$tablemasterrow['PLAFON_EFIM']-($tablemasterrow['TAKT_EFHM']+$tablemasterrow['C_INCOME']-$tablemasterrow['PLAFON_EFIM']);
			$tablemasterrow['CB_PLAFON']=$tablemasterrow['CB_PLAFON']+($tablemasterrow['TAKT_EFHM']+$tablemasterrow['C_INCOME']-$tablemasterrow['PLAFON_EFIM']);
			
			}

          }
          if (in_array($Compute_Payroll,array('All','11','12','14'))) {
            $SQL  = "SELECT RMST_REASON, RDET_CREDIT, RDET_DEBIT, RDET_MODULE, RDET_MODULEID, RDET_DESCRIPTION, RDET_TYPE ";
            $SQL .= "  FROM RETRO_MASTER_EXTRA2, RETRO_DETAIL_EXTRA2 ";
            $SQL .= " WHERE RETRO_MASTER_EXTRA2.RMST_ID = RETRO_DETAIL_EXTRA2.RMST_ID AND RETRO_MASTER_EXTRA2.EXSAL_ID_TO = ".$Ex2sal_id." ORDER BY RDET_MODULE,RDET_DESCRIPTION";
            $RES = DB_query($SQL,$db);
            while ($ROW=DB_fetch_array($RES)) {
              $Amount=$ROW['RDET_CREDIT']-$ROW['RDET_DEBIT'];
              $MisthVar=G_VarPA($ROW['RDET_MODULE'],$ROW['RDET_DESCRIPTION'],$ROW['RDET_MODULEID']);
              if ($ROW['RDET_MODULE']=='TAXR') { $tablemasterrow['M_TAX'] -= $Amount; }
              elseif ($ROW['RDET_MODULE']=='PLAF') { $tablemasterrow['MB_D2_BASIC'] += $Amount; }
              elseif ($ROW['RDET_MODULE']=='DED' && $ROW['RDET_TYPE']==1) {
                $tablemasterrow['M_DEDUCTIONS'] -= $Amount;
                $tablemasterrow['MD_'.$MisthVar] -= $Amount;
              }
              elseif ($ROW['RDET_MODULE']=='DED' && $ROW['RDET_TYPE']==2) {
                $tablemasterrow['M_ERGDED'] -= $Amount;
                $tablemasterrow['ME_'.$MisthVar] -= $Amount;
              }
              else { $tablemasterrow[$MisthVar] = $ROW['RDET_MODULE']; }
            }
          }
        }
      }
      $tablemasterrow['N_PAID'] = $tablemasterrow['N_HOURS']+$tablemasterrow['N_BENEFITS']
                               -$tablemasterrow['N_DEDUCTIONS']-$tablemasterrow['N_TAX'];
      $tablemasterrow['C_PAID'] = $tablemasterrow['CB_D2_BASIC']-$tablemasterrow['C_DEDUCTIONS']-$tablemasterrow['C_TAX'];
      $tablemasterrow['M_PAID'] = $tablemasterrow['MB_D2_BASIC']-$tablemasterrow['M_DEDUCTIONS']-$tablemasterrow['M_TAX'];

      $Sum_Credit = $Sum_plus+$Sum_plus_anadr+$Sum_plus_yperv+$Sum_plus_efyp
                   +$tablemasterrow['N_HOURS']+$tablemasterrow['N_BENEFITS']+$tablemasterrow['CB_D2_BASIC']
                   +$tablemasterrow['MB_D2_BASIC'];
      $Sum_Debit  = $Sum_minus+$Sum_minus_anadr+$Sum_minus_yperv+$Sum_minus_efyp
                   +$tablemasterrow['N_DEDUCTIONS']
                   +$tablemasterrow['N_TAX']+$tablemasterrow['C_DEDUCTIONS']+$tablemasterrow['C_TAX']
                   +$tablemasterrow['M_DEDUCTIONS']+$tablemasterrow['M_TAX'];
      $Sum_paid=$tablemasterrow['T_PAID']+$tablemasterrow['A_PAID']+$tablemasterrow['P_PAID']+$tablemasterrow['N_PAID']+$tablemasterrow['C_PAID']+$tablemasterrow['M_PAID'];
 
	if ($ListBox3=='All') {
      if($Sum_Credit==0 and $Sum_Debit<>0){
      $errors[]= "–—œ”œ◊«: œ/H ≈Ò„·Ê¸ÏÂÌÔÚ/Á ".$tablemasterrow['TWA_LAST_NAME']." ".$tablemasterrow['TWA_FIRST_NAME']. " (".$tablemasterrow['TWA_EMP_CODE'].") ›˜ÂÈ Í‹ÔÈÔ Ò¸‚ÎÁÏ· ÏÂ ÙÁ ÏÈÛËÔ‰ÔÛﬂ· ÙÔı";
         }
	  }
      if ($Sum_Credit<>0 || $Sum_Debit<>0) {
        if ($ListBox3=='1') {
      if ($Sum_paid<0) {
      $tablemasterrow['T_PAID']       = 0;
      $tablemasterrow['T_A_DEK']      = 0;
      $tablemasterrow['T_B_DEK']      = 0;



      $DetailTable[] = $tablemasterrow; } }
      elseif ($Sum_paid>=0 and ($Compute_Payroll==1 || $Compute_Payroll==2 || $Compute_Payroll==3 || $Compute_Payroll==13)) { $DetailTable[] = $tablemasterrow; }
      elseif ($Sum_paid>0 and ($Compute_Payroll==4 || $Compute_Payroll==5 || $Compute_Payroll==6 ||$Compute_Payroll==7 || $Compute_Payroll==8 || $Compute_Payroll=='All' || $Compute_Payroll==9 || $Compute_Payroll==10 || $Compute_Payroll==12 || $Compute_Payroll==14 || $Compute_Payroll==15 || $Compute_Payroll==16 || $Compute_Payroll==17 || $Compute_Payroll==21)) { $DetailTable[] = $tablemasterrow; }

      }
      
    }




  }


  

  
  $a=sizeof($errors);
  if($a>0){
	for($i = 0; $i < $a;$i++){
		echo $errors[$i];
    }



	die();
  }


}
?>