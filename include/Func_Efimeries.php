<?php
session_start();

function G_DBfield($sqlGetfld,$DBField) {
  $funcres  = DB_query($sqlGetfld,$db);
  $funcrow  = DB_fetch_array($funcres);
  $Func_ret = $funcrow["$DBField"];
  return $Func_ret;
}

function G_Salid($fpc_empid,$fpc_month,$fpc_year,$fpc_payid=0) {
  if ($fpc_payid==0) {
    $funcsql = "SELECT PAYROLL_TRANSACTIONS.PAY_ID FROM PAYROLL_TRANSACTIONS WHERE PAYROLL_TRANSACTIONS.PAT_ID = ".$fpc_month." AND PAYROLL_TRANSACTIONS.PAY_YEAR = ".$fpc_year;
    $fpc_payid = G_DBfield($funcsql,'PAY_ID');
  }
  $funcsql = "SELECT SALARY.SAL_ID FROM SALARY WHERE SALARY.PAY_ID = ".$fpc_payid." AND SALARY.EMP_ID = ".$fpc_empid;
  $Func_ret = G_DBfield($funcsql,'SAL_ID');
  return $Func_ret;
}

function G_takt_mikta($fpc_empid,$fpc_month,$fpc_year,$fpc_doro='') {
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
//echo $funcsql;die();
  $Vathmos = G_Vathmos($fpc_empid);
  if (in_array($Vathmos,array(5,6,10,11))) {
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
      $misthbas=G_misth_part($fpc_salid,'BAS');
      if ($misthbas>0) { $fpc_misthbas=$misthbas; }
    }
    $funcres  = DB_query($funcsql,$db);
    $misthben = 0;
    $misthxben = 0;
    $fpc_misthben=0;
    $fpc_misthxben=0;
    while ($funcrow=DB_fetch_array($funcres)) {
      $fpc_salid = $funcrow['SAL_ID'];
      $misthben=G_misth_part($fpc_salid,'BEN');
      if ($misthben>0) { $fpc_misthben=$misthben; }
      $misthxben=G_misth_part($fpc_salid,'EBEN');
      if ($misthxben!=0) { $fpc_misthxben=$misthxben; }
    }
    $Func_ret = $fpc_misthbas+$fpc_misthben+$fpc_misthxben;
  }
  return $Func_ret;
}

function G_misth_part($fpc_salid,$fpc_part) {
  $funcsql = "SELECT SUM(ESAD_CREDIT) AS CREDIT, SUM(ESAD_DEBIT) AS DEBIT FROM SALARY_EMP_DETAIL WHERE SAL_ID=".$fpc_salid." AND ESAD_MODULE = '".$fpc_part."' ";
  $funcres =DB_query($funcsql,$db);
  $funcrow =DB_fetch_array($funcres);
  $Func_ret = $funcrow['CREDIT']-$funcrow['DEBIT'];
  if (in_array($fpc_part,array('DED','EDED','ΧDED','TAX','LOAN','REC'))) { $Func_ret = - $Func_ret; }
  return $Func_ret;
}

function G_One_BDLRE($fpc_empid,$fpc_month,$fpc_year,$fpc_module,$fpc_mod_name) {
  include ('include/v_BDLRE.php');
  $stub = '';
  if ($fpc_module=='BEN') {
    foreach($custom_benefits[$fpc_mod_name] as $kv=>$vv) {
      if ($stub!='') $stub .= ' OR ';
      if (empty($vv)) { $stub .= ' ESAD_DESCRIPTION=\''.$kv.'\' '; }
      else { $stub .= ' SUBSTR(ESAD_DESCRIPTION,'.$vv[0].','.$vv[1].')=\''.$kv.'\' '; }
    }
  }
  elseif ($fpc_module=='BEN_RETRO') {
    foreach($custom_ben_retro[$fpc_mod_name] as $kv=>$vv) {
      if ($stub!='') $stub .= ' OR ';
      if (empty($vv)) { $stub .= ' RDET_DESCRIPTION=\''.$kv.'\' '; }
      else { $stub .= ' SUBSTR(RDET_DESCRIPTION,'.$vv[0].','.$vv[1].')=\''.$kv.'\' '; }
    }
  }
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
      $bensql  = "SELECT SUM(ESAD_CREDIT) AS CREDIT, SUM(ESAD_DEBIT) AS DEBIT FROM SALARY_EMP_DETAIL WHERE SAL_ID=".$fpc_salid." AND ESAD_MODULE='BEN' AND ( ";
      $bensql .= $stub;
      $bensql .= ' ) ';
      $benrs   = DB_query($bensql,$db);
      $benrow  = DB_fetch_array($benrs);
      $Amount  = $benrow['CREDIT']-$benrow['DEBIT'];
    }
    elseif ($fpc_module=='BEN_RETRO') {
      $tmpsql  = "SELECT SUM(RD.RDET_CREDIT) AS CREDIT, SUM(RD.RDET_DEBIT) AS DEBIT FROM RETRO_DETAIL RD,RETRO_MASTER RM ";
      $tmpsql .= " WHERE RM.SAL_ID_TO=".$fpc_salid." AND RM.RMST_ID=RD.RMST_ID AND RD.RDET_MODULE='BEN' AND ( ";
      $tmpsql .= $stub;
      $tmpsql .= " ) ";
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

function G_ExSalid($fpc_empid,$fpc_month,$fpc_year) {
  $funcsql = "SELECT PAY_ID FROM PAYROLL_TRANSACTIONS WHERE PAT_ID = ".$fpc_month." AND PAY_YEAR = ".$fpc_year;
  $fpc_payid = G_DBfield($funcsql,'PAY_ID');
  $funcsql = "SELECT SALARY.SAL_ID, EXTRA_SALARY.EXSAL_ID FROM EXTRA_SALARY, SALARY WHERE EXTRA_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA_SALARY.EMP_ID =".$fpc_empid." AND SALARY.PAY_ID=".$fpc_payid;
  $Func_ret = G_DBfield($funcsql,'EXSAL_ID');
  return $Func_ret;
}

function G_Vathmos($fpc_empid) {
  $sqlva = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$fpc_empid." AND ECOP_VARIABLE='ΒΑΘΜΟΣ_ΙΑΤΡΩΝ' ";
  $Func_ret = G_DBfield($sqlva,'ECOP_VALUE');
  
  
  if($Func_ret==21) {$Func_ret=1;}
  if($Func_ret==22) {$Func_ret=2;}
  if($Func_ret==23) {$Func_ret=3;}
  if($Func_ret==24) {$Func_ret=4;}
  if($Func_ret==25) {$Func_ret=5;}
  if($Func_ret==26) {$Func_ret=6;}
  if($Func_ret==27) {$Func_ret=7;}
  if($Func_ret==28) {$Func_ret=8;}
  if($Func_ret==29) {$Func_ret=9;}
  if($Func_ret==30) {$Func_ret=10;}
  if($Func_ret==31) {$Func_ret=11;}
  if($Func_ret==32) {$Func_ret=12;}
  if($Func_ret==33) {$Func_ret=13;}
  if($Func_ret==34) {$Func_ret=14;}
  
  
  return $Func_ret;
}

function C_Vathmos($fpc_empid,$fpc_month,$fpc_year) {
  $Date_change=0;
  $Vathmos = G_Vathmos($fpc_empid);
  $sqlva  = "SELECT to_char(S.SYSREG_VALIDFROM,'yyyymmdd') as datefrom, S.SYSREG_VALUEOLD FROM SYSTEM_SCD_REGISTER S, EMP_CONTRACT_PARAMS E ";
  $sqlva .= " WHERE S.SYSREG_TABLE = 'emp_contract_params' AND E.ECOP_ID = S.SYSREG_TABLE_ID";
  $sqlva .= "   AND E.ECOP_VARIABLE = 'ΒΑΘΜΟΣ_ΙΑΤΡΩΝ' AND S.SYSREG_VALUE = '".$Vathmos."' AND E.EMP_ID = ".$fpc_empid;
  $resva  = DB_query($sqlva,$db);
  $rowva  = DB_fetch_array($resva);
  $Date_va = $rowva['DATEFROM'];
  $Vathmos1 = $rowva['SYSREG_VALUEOLD'];
  $Date_per = $fpc_year.str_pad($fpc_month,2,"0",str_pad_left).'01';
  if ($Date_per<$Date_va) {
    $Date_per_end = $fpc_year.str_pad($fpc_month,2,"0",str_pad_left).'31';
    if ($Date_va<$Date_per_end) { $Date_change=$Date_va;}
  }
  else { $Vathmos1=$Vathmos; }
  $Func_ret['vathmos']=$Vathmos1;
  $Func_ret['datechange']=$Date_change;
  return $Func_ret;
}

function G_efim_mikta($fpc_empid,$fpc_month,$fpc_year) {
  $tmpsql = "SELECT PAY_ID FROM PAYROLL_TRANSACTIONS WHERE PAT_ID=".$fpc_month." AND PAY_YEAR=".$fpc_year;
  $tmpres = DB_query($tmpsql,$db);
  $In_var = '';
  while ($funcrow=DB_fetch_array($tmpres)) {
    if ($In_var=='') { $In_var = $funcrow['PAY_ID']; }
    else {$In_var = $In_var.', '.$funcrow['PAY_ID']; }
  }
  $tmpsql = "SELECT SALARY.SAL_ID, EXTRA_SALARY.EXSAL_ID, EXTRA_SALARY.EXSAL_DATEFROM, EXTRA_SALARY.EXSAL_DATETO FROM EXTRA_SALARY, SALARY WHERE EXTRA_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA_SALARY.EMP_ID =".$fpc_empid." AND SALARY.PAY_ID in (".$In_var.")";
  $tmpres =DB_query($tmpsql,$db);
  $tmprow =DB_fetch_array($tmpres);
  $Salid=$tmprow['SAL_ID'];
  $Exsalid=$tmprow['EXSAL_ID'];
  if ($Exsalid>0) {
    $tmpsql = "SELECT SUM(EXSAD_CREDIT) AS CREDIT, SUM(EXSAD_DEBIT) AS DEBIT FROM EXTRA_SALARY_DETAIL WHERE EXSAL_ID =".$Exsalid." AND (EXSAD_MODULE='HOUR' OR EXSAD_MODULE='EXTH' OR EXSAD_MODULE='SEVE' OR EXSAD_MODULE='PLAF' OR EXSAD_MODULE='PLAE' OR EXSAD_MODULE='PLAP')";
    $tmpres =DB_query($tmpsql,$db);
    $tmprow =DB_fetch_array($tmpres);
    $Gross_efim = $tmprow['CREDIT']-$tmprow['DEBIT'];
  }
  return $Gross_efim;
}




function G_efim_mikta_plir($fpc_empid,$fpc_month,$fpc_year) {
  $tmpsql = "SELECT PAY_ID FROM PAYROLL_TRANSACTIONS WHERE PAT_ID=".$fpc_month." AND PAY_YEAR=".$fpc_year;
  $tmpres = DB_query($tmpsql,$db);
  $In_var = '';
  while ($funcrow=DB_fetch_array($tmpres)) {
    if ($In_var=='') { $In_var = $funcrow['PAY_ID']; }
    else {$In_var = $In_var.', '.$funcrow['PAY_ID']; }
  }
  $tmpsql = "SELECT SALARY.SAL_ID, EXTRA_SALARY.EXSAL_ID, EXTRA_SALARY.EXSAL_DATEFROM, EXTRA_SALARY.EXSAL_DATETO FROM EXTRA_SALARY, SALARY WHERE EXTRA_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA_SALARY.EMP_ID =".$fpc_empid." AND SALARY.PAY_ID in (".$In_var.")";
  $tmpres =DB_query($tmpsql,$db);
  $tmprow =DB_fetch_array($tmpres);
  $Salid=$tmprow['SAL_ID'];
  $Exsalid=$tmprow['EXSAL_ID'];
  if ($Exsalid>0) {
    $tmpsql = "SELECT SUM(EXSAD_CREDIT) AS CREDIT, SUM(EXSAD_DEBIT) AS DEBIT FROM EXTRA_SALARY_DETAIL WHERE EXSAL_ID =".$Exsalid." AND (EXSAD_MODULE='HOUR' OR EXSAD_MODULE='EXTH' OR EXSAD_MODULE='SEVE' OR EXSAD_MODULE='PLAF' OR EXSAD_MODULE='PLAE' OR EXSAD_MODULE='PLAP' OR EXSAD_MODULE='EBEN')";
    $tmpres =DB_query($tmpsql,$db);
    $tmprow =DB_fetch_array($tmpres);
    $Gross_efim = $tmprow['CREDIT']-$tmprow['DEBIT'];
  }
  return $Gross_efim;
}

function G_all_efim($fpc_empid,$fpc_month,$fpc_year) {
  $tmpsql = "SELECT PAY_ID FROM PAYROLL_TRANSACTIONS WHERE PAT_ID=".$fpc_month." AND PAY_YEAR=".$fpc_year;
  $tmpres = DB_query($tmpsql,$db);
  //echo $tmpsql;die();
  $In_var = '';
  while ($funcrow=DB_fetch_array($tmpres)) {
    if ($In_var=='') { $In_var = $funcrow['PAY_ID']; }
    else {$In_var = $In_var.', '.$funcrow['PAY_ID']; }
  }
  $tmpsql = "SELECT SALARY.SAL_ID, EXTRA_SALARY.EXSAL_ID, EXTRA_SALARY.EXSAL_DATEFROM, EXTRA_SALARY.EXSAL_DATETO FROM EXTRA_SALARY, SALARY WHERE EXTRA_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA_SALARY.EMP_ID =".$fpc_empid." AND SALARY.PAY_ID in (".$In_var.")";
//  echo $tmpsql;die();
  $tmpres =DB_query($tmpsql,$db);
  $tmprow =DB_fetch_array($tmpres);
  $Salid=$tmprow['SAL_ID'];
  $Exsalid=$tmprow['EXSAL_ID'];
  if ($Exsalid>0) {
    $tmpsql = "SELECT SUM(EXSAD_CREDIT) AS CREDIT, SUM(EXSAD_DEBIT) AS DEBIT FROM EXTRA_SALARY_DETAIL WHERE EXSAL_ID =".$Exsalid." AND (EXSAD_MODULE='HOUR' OR EXSAD_MODULE='EXTH' OR EXSAD_MODULE='SEVE')";
    $tmpres =DB_query($tmpsql,$db);
    $tmprow =DB_fetch_array($tmpres);
    $Gross_efim = $tmprow['CREDIT']-$tmprow['DEBIT'];
  }
  return $Gross_efim;
}

function G_E_Monada($fpc_empid,$fpc_sysmast,$fpc_vathmos) {
  $funcsql  = "SELECT STD.SYSTBD_VALUE1, STD.SYSTBD_VALUE2 FROM SYSTEM_TABLES_DETAIL STD, SYSTEM_TABLE_MASTER STM, PARAMETERS P";
  $funcsql .= " WHERE P.PRM_TBL_CVALUE50 = STM.SYSTBM_VARIABLE";
  $funcsql .= "   AND STM.SYSTBM_ID = STD.SYSTBM_ID";
  $funcsql .= "   AND STM.SYSMST_ID = ".$fpc_sysmast;
  $funcsql .= "   AND P.PRM_TABLE = 'SVVIAT'";
  $funcsql .= "   AND P.PRM_TBL_ID = ".$fpc_vathmos;
  $funcres  = DB_query($funcsql,$db);

  while ($funcrow=DB_fetch_array($funcres)) { $Efim_Orom[$funcrow['SYSTBD_VALUE1']] = str_replace(',','.',$funcrow['SYSTBD_VALUE2']); }
  $Func_ret[27] = $Efim_Orom['ΚΑΘΗΜΕΡΙΝΗ'];
  $Func_ret[28] = $Efim_Orom['ΝΥΧΤΑ'];
  $Func_ret[31] = $Efim_Orom['ΑΡΓΙΑ'];
  $Func_ret[32] = $Efim_Orom['ΑΡΓΙΑ-ΝΥΧΤΑ'];
  $Func_ret[33] = 0.70*$Func_ret[27];
  $Func_ret[34] = 0.70*$Func_ret[28];
  $Func_ret[35] = 0.70*$Func_ret[31];
  $Func_ret[36] = 0.70*$Func_ret[32];
  $Func_ret[37] = 0.40*$Func_ret[27];
  $Func_ret[38] = 0.40*$Func_ret[28];
  $Func_ret[39] = 0.40*$Func_ret[31];
  $Func_ret[40] = 0.40*$Func_ret[32];
  return $Func_ret;
}

function G_E_Kind($fpc_empid,$fpc_date) {
  $Func_ret=0;
  $funcsql = "SELECT ATT_ID FROM ATTENDANCE WHERE EMP_ID = ".$fpc_empid." AND ATT_DATE = ".FormatDateForSQL($fpc_date);
  $att_id  = G_DBfield($funcsql,'ATT_ID');
  if ($att_id>0) {
    $funcsql = 'SELECT SYSAPA_ID,ATTDET_VALUE FROM ATTENDANCE_DETAIL WHERE ATT_ID='.$att_id;
    $funcres=DB_query($funcsql,$db,'','',true,true);
    $Kind_efim=0;
    $Func_ret=0;
    while ($funcrow=DB_fetch_array($funcres)) {
      $Hours=str_replace(":",".",ConvertSQLTime($funcrow['ATTDET_VALUE']));
      if ($Hours>0) { $Kind_efim=$funcrow['SYSAPA_ID']; }
    }
    if ($Kind_efim>26 && $Kind_efim<33) { $Func_ret=1; }
    if ($Kind_efim>32 && $Kind_efim<37) { $Func_ret=2; }
    if ($Kind_efim>36 && $Kind_efim<41) { $Func_ret=3; }
  }
  return $Func_ret;
}

function G_E_Type($fpc_empid,$fpc_date) {
  $tmpsql3  = "SELECT DTS_TYPE, TS_ANALYSIS_PKG.GET_HOLY_FLAG(EMP_ID,DTR_DATE) AS CUR_HOLY,";
  $tmpsql3 .= " TS_ANALYSIS_PKG.GET_HOLY_FLAG(EMP_ID,(DTR_DATE+1)) AS NEXT_HOLY ";
  $tmpsql3 .= " FROM TS_DUTY_TRANS T, TS_DUTIES D";
  $tmpsql3 .= " WHERE EMP_ID=".$fpc_empid;
  $tmpsql3 .= " AND T.DTS_ID=D.DTS_ID";
  $tmpsql3 .= " AND DTR_DATE = ".FormatDateForSQL($fpc_date);
  $tmpres3  = DB_query($tmpsql3,$db);
  $tmprow3  = DB_fetch_array($tmpres3);
  $Efim_type = $tmprow3['DTS_TYPE'];
  $Efim_current = $tmprow3['CUR_HOLY'];
  $Efim_next = $tmprow3['NEXT_HOLY'];
  $Func_ret=0;
  if ($Efim_current==0 && $Efim_next==0) { $Func_ret = 1; }
  if ($Efim_current==0 && $Efim_next==1) {
    if (get_weekday_number(ConvertSQLDate($fpc_date))==6) { $Func_ret = 2; }
    else { $Func_ret = 3; }
  }
  if ($Efim_current==1 && $Efim_next==1) { $Func_ret = 4; }
  if ($Efim_current==1 && $Efim_next==0) { $Func_ret = 5; }
  if ($Efim_type==2) { $Func_ret = $Func_ret + 5; }
  if ($Efim_type==3) { $Func_ret = $Func_ret + 10; }
  return $Func_ret;
}

function G_E_D_Hours($fpc_empid,$fpc_date) {
  $Func_ret[0]=1;
  $funcsql = "SELECT ATT_ID FROM ATTENDANCE WHERE EMP_ID = ".$fpc_empid." AND ATT_DATE = ".FormatDateForSQL($fpc_date);
  $att_id  = G_DBfield($funcsql,'ATT_ID');
  if ($att_id>0) {
    $funcsql = 'SELECT SYSAPA_ID,ATTDET_VALUE FROM ATTENDANCE_DETAIL WHERE ATT_ID='.$att_id;
    $funcres=DB_query($funcsql,$db,'','',true,true);
    while ($funcrow=DB_fetch_array($funcres)) { $Func_ret[$funcrow['SYSAPA_ID']] = str_replace(":",".",ConvertSQLTime($funcrow['ATTDET_VALUE'])); }
  }
  else {$Func_ret[0]=0;}
  return $Func_ret;
}

function G_E_D_Money($fpc_empid,$fpc_date,$fpc_Monada,$fpc_Hours) {
  foreach ($fpc_Hours as $key => $value ) { $Func_ret[$key] = $fpc_Monada[$key]*$value; }
  return $Func_ret;
}

function G_E_Month($fpc_empid,$fpc_month,$fpc_year,$fpc_holy=0) {
  $Get_vathmos = C_Vathmos($fpc_empid,$fpc_month,$fpc_year);
  $Vathmos = $Get_vathmos['vathmos'];
  $Over_Limit=7;
  if (in_array($Vathmos,array(5,6,10,11))) { $Over_Limit=6; }
  else { $Over_Limit=7; }

  $V_Date_change = $Get_vathmos['datechange'];
  $Get_Monada = G_E_Monada($fpc_empid,$_SESSION['PayrollSystemMasterID'],$Vathmos);
  $Foreasid = G_DBfield("SELECT FOR_ID FROM EMPLOYEES WHERE EMP_ID=".$fpc_empid,'FOR_ID');
  $plafsql = "SELECT PRM_TBL_NVALUED FROM PARAMETERS WHERE PRM_TABLE='PLADU' AND PRM_TBL_FOR=".$Foreasid." AND PRM_TBL_ID=".$Vathmos;
  $plafsql1 = "SELECT PRM_TBL_NVALUED FROM PARAMETERS WHERE PRM_TABLE='PLADU' AND PRM_TBL_FOR=20 AND PRM_TBL_ID=1";
  $Plafon_Duty = G_DBfield($plafsql,'PRM_TBL_NVALUED');
  $tmpsql = "SELECT ECOP_VALUE FROM EMP_CONTRACT_PARAMS WHERE EMP_ID=".$fpc_empid." AND ECOP_VARIABLE='ΣΥΝΤΟΝΙΣΤΗΣ' ";
  $tmpres =DB_query($tmpsql,$db);
  $tmprow =DB_fetch_array($tmpres);
  if ($tmprow['ECOP_VALUE']==1) { $Plafon_Duty=G_DBfield($plafsql1,'PRM_TBL_NVALUED'); }
  else { $Plafon_Duty = G_DBfield($plafsql,'PRM_TBL_NVALUED'); }

  if (in_array($Vathmos,array(1,5,6))) { $Energ_Bonus=30; }
  elseif (in_array($Vathmos,array(7,8,9))) { $Energ_Bonus=0; }
  else {$Energ_Bonus=30;}
  $D_Bonus=array( 1 => $Energ_Bonus, 2 => 0.7*$Energ_Bonus, 3 => 0.4*$Energ_Bonus );
  $current_date = '01/'.$fpc_month.'/'.$fpc_year;
  $days = getDaysInMonth($current_date);
  $i=1;
  $Efim_aa=0;
  $Efim_kind_sum=array();
  $Sum_All_Efim=array();
  $Sum_AllEfims=0;
  $Sum_AlEf_dias=0;
  $Sum_Part_Efims=0;
  $Sum_normal_Efim=0;
  $Sum_Bonus=0;
  $Apokopi=0;
  $Done=false;
  for($i=1;$i<=$days;$i++) {
    $imerominia = $i.'/'.$fpc_month.'/'.$fpc_year;
    $Date_current = $fpc_year.str_pad($fpc_month,2,"0",str_pad_left).str_pad($i,2,"0",str_pad_left);
    $fpc_daily_hours=G_E_D_Hours($fpc_empid,$imerominia);
    if ($fpc_daily_hours[0]!=0) {
      if ($V_Date_change!=0 && $Date_current>=$V_Date_change) {
        $Vathmos = G_Vathmos($fpc_empid);
        $Get_Monada = G_E_Monada($fpc_empid,$_SESSION['PayrollSystemMasterID'],$Vathmos);
      }
      $fpc_daily_Money=G_E_D_Money($fpc_empid,$imerominia,$Get_Monada,$fpc_daily_hours);
      $Sum_day=round(array_sum($fpc_daily_Money),2);
    }
    else { $Sum_day=0; }
    if ($Sum_day>0) {
      $Efim_aa++;
      $Efim_Daily_kind=G_E_Kind($fpc_empid,$imerominia);
      $Efim_kind_sum[$Efim_Daily_kind] ++;
      if (isset($Efim_kind_o7sum))  {
        $Efim_kind_o7sum[$Efim_Daily_kind] ++;
        $Efim_Daily_type=G_E_Type($fpc_empid,$imerominia);
        $Efim_type_o7sum[$Efim_Daily_type] ++;
      }
      foreach ($fpc_daily_Money as $key => $value ) { $Sum_All_Efim[$key] += $value; }
      $efimsql = "SELECT DTS_TYPE FROM TS_DUTY_TRANS T, TS_DUTIES D WHERE T.DTS_ID = D.DTS_ID AND DTR_DATE = ".FormatDateForSQL($imerominia)." AND EMP_ID = ".$fpc_empid;
      $Efim_Kind = G_DBfield($efimsql,'DTS_TYPE');
      if (in_array($Vathmos,array(1,2,3,4,5,6,10,11,12,13,14))) {
        $Bonus = $D_Bonus[$Efim_Kind];
        $Sum_Bonus += $Bonus;
      }
      $Sum_AllEfims = round(array_sum($Sum_All_Efim),2);
      $Sum_AlEf_dias = array_sum($Sum_All_Efim);
      $Sum_AlEfim_p_Bonus = $Sum_AllEfims + $Sum_Bonus;
      $Sum_Part_Efims += $Sum_day + $Bonus;
      if (isset($Sum_All_o7Efim))  { $Sum_All_o7Efim[$Efim_Daily_kind] += $Sum_day + $Bonus; }
      if ($Efim_aa==$Over_Limit) {
        $Sum_7efim=$Sum_AllEfims+$Sum_Bonus;
        $Sum_normal_Efim=$Sum_AlEf_dias+$Sum_Bonus;
        if ($Sum_7efim>=$Plafon_Duty) {
          $Done=true;
          $Sum_normal_Efim=$Plafon_Duty;
          $Sum_Part_Efims = 0;
          $Diff_small=$Sum_7efim-$Plafon_Duty; //Παρεμβολη για να μην χανουν μια ολοκληρη εφημερια για ποσο λιγοτερο των 11 γιουρος
          if ($Diff_small<11) {
            $Apokopi = 0;
            $Sum_Part_Efims=$Sum_7efim - $Plafon_Duty;
          }
          else { $Apokopi = $Sum_7efim - $Plafon_Duty; }
          $Efim_kind_o7sum=array();
          $Efim_type_o7sum=array();
          $Sum_All_o7Efim=array();
        }
      }
      if ($Efim_aa>$Over_Limit && $Apokopi==0 && $Done==false) {
        $Sum_normal_Efim=$Sum_AlEf_dias+$Sum_Bonus;
        if ($Sum_AlEfim_p_Bonus>=$Plafon_Duty) {
          $Done=true;
          $Sum_normal_Efim=$Plafon_Duty;
          $Sum_Part_Efims = 0;
          $Diff_small=$Plafon_Duty-($Sum_AlEfim_p_Bonus-$Sum_day-$Bonus); //Παρεμβολη για να μην χανουν μια ολοκληρη εφημερια για ποσο λιγοτερο των 11 γιουρος
          
          $Apokopi = $Sum_AlEfim_p_Bonus - $Plafon_Duty; 
          $Efim_kind_o7sum=array();
          $Efim_type_o7sum=array();
          $Sum_All_o7Efim=array();
        }
      }
    }
  }
  if ($Efim_aa<=$Over_Limit) {
    $Sum_7efim=$Sum_AllEfims+$Sum_Bonus;
    $Sum_normal_Efim=$Sum_AlEf_dias+$Sum_Bonus;
    if ($Sum_7efim>=$Plafon_Duty) {
      $Sum_normal_Efim=$Plafon_Duty;
      $Sum_Part_Efims = 0;
      $Diff_small=$Sum_7efim-$Plafon_Duty; //Παρεμβολη για να μην χανουν μια ολοκληρη εφημερια για ποσο λιγοτερο των 11 γιουρος
	   if ($Diff_small<11) {
        $Apokopi = 0;
        $Sum_Part_Efims=$Sum_7efim - $Plafon_Duty;
      }
      else { $Apokopi = $Sum_7efim - $Plafon_Duty; }
	
     $Apokopi = $Sum_7efim - $Plafon_Duty; 
    }
  }
  $Func_ret['count']=$Efim_aa;
  $Func_ret['seven']=$Sum_7efim;
  $Func_ret['allmoney']=$Sum_AllEfims;
  $Func_ret['bonus']=$Sum_Bonus;
  $Func_ret['vathmos']=$Vathmos;
  $Func_ret['plafon']=$Plafon_Duty;
  $Func_ret['allbonus']=$Sum_AllEfims+$Sum_Bonus;
  $Func_ret['dias']=$Sum_normal_Efim;
  $Func_ret['apokopi']=$Apokopi;
  $Func_ret['epipleon']=$Sum_Part_Efims;
  $Func_ret['efimdaykind']=$Efim_Daily_kind;
  $Func_ret['efimkind']=$Efim_kind_sum;
  $Func_ret['efimo7kind']=$Efim_kind_o7sum;
  $Func_ret['allo7bonus']=$Sum_All_o7Efim;
  $Func_ret['efimo7type']=$Efim_type_o7sum;
  $Func_ret['overlimit']=$Over_Limit;
  return $Func_ret;
}

function Find_APPericopi($FPEmpid, $FPPeriod, $FPPayyear, $Vathmos='') {
  include ('include/v_BDLRE.php');
  $Ret_func=array();
  if ($Vathmos=='') { $Vathmos = G_Vathmos($FPEmpid); }
  $Plafon1=0;
  $Plafon2=0;
  if ($Vathmos>0) {
    $tmpsql = "SELECT PRM_TBL_NVALUED,PRM_TBL_CVALUE15 FROM PARAMETERS WHERE PRM_TABLE='PLAAP' AND PRM_TBL_ID=".$Vathmos;
    $tmpres =DB_query($tmpsql,$db);
    $tmprow =DB_fetch_array($tmpres);
    $Vathm_descr=$tmprow['PRM_TBL_CVALUE15'];
    $Plafon_AP=$tmprow['PRM_TBL_NVALUED'];
    if ($Plafon_AP>0) {
      $tmpsql = "SELECT FOR_ID FROM EMPLOYEES WHERE EMP_ID=".$FPEmpid;
      $tmpres =DB_query($tmpsql,$db);
      $tmprow =DB_fetch_array($tmpres);
      $Foreasid=$tmprow['FOR_ID'];
      $tmpsql = "SELECT PAY_ID FROM PAYROLL_TRANSACTIONS WHERE PAT_ID=".$FPPeriod." AND PAY_YEAR=".$FPPayyear;
      $tmpres =DB_query($tmpsql,$db);
      $tmprow =DB_fetch_array($tmpres);
      $Payid=$tmprow['PAY_ID'];
      $tmpsql = "SELECT SALARY.SAL_ID, EXTRA_SALARY.EXSAL_ID, EXTRA_SALARY.EXSAL_DATEFROM, EXTRA_SALARY.EXSAL_DATETO FROM EXTRA_SALARY, SALARY WHERE EXTRA_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA_SALARY.EMP_ID =".$FPEmpid." AND SALARY.PAY_ID=".$Payid;
      $tmpres =DB_query($tmpsql,$db);
      $tmprow =DB_fetch_array($tmpres);
      $Salid=$tmprow['SAL_ID'];
      $Exsalid=$tmprow['EXSAL_ID'];
      $Gross_efim = G_all_efim($FPEmpid,$FPPeriod,$FPPayyear);
      $All_Gross_Takt = G_takt_mikta($FPEmpid,$FPPeriod,$FPPayyear);
      if ($FPPayyear==2012 && in_array($FPPeriod,array(8,9,10,11,12))) { $All_Gross_Takt = G_takt_mikta($FPEmpid,1,2013); }
      $Gross_Takt = $All_Gross_Takt;
      $Oikogeneiako = G_One_BDLRE($FPEmpid,$FPPeriod,$FPPayyear,'BEN','TB_OIKOGEN');
      $tmpsql  = "SELECT EMP_BEN_AGONI FROM EMPLOYEES WHERE EMP_ID=".$FPEmpid;
      $tmpres =DB_query($tmpsql,$db);
      $tmprow =DB_fetch_array($tmpres);
      $Agoni_Perioxi = $tmprow['EMP_BEN_AGONI'];
      $Gross_Takt=$All_Gross_Takt-$Oikogeneiako;

      if (($FPPeriod==7 || $FPPeriod==8 || $FPPeriod==9) && $FPPayyear==2011) {
        if (in_array($Vathmos,array(5,6,10,11))) { }
        else {
          $Cut_Nosokom = G_One_BDLRE($FPEmpid,10,2011,'BEN','TB_PERNOS');
          $Gross_Takt =  $Gross_Takt + ($Cut_Nosokom/3);
        }
      }
      if (($FPPeriod==10) && $FPPayyear==2011) {
        if (in_array($Vathmos,array(5,6,10,11))) { }
        else {
          $Cut_Nosokom = G_One_BDLRE($FPEmpid,10,2011,'BEN','TB_PERNOS');
          $Gross_Takt =  $Gross_Takt - $Cut_Nosokom;
        }
      }

      $Gross_Plaf1=$Gross_Takt+($Agoni_Perioxi/12);
      if ($Gross_efim>$Gross_Plaf1 && $All_Gross_Takt>0) { $Plafon1=$Gross_efim-$Gross_Plaf1; }
      $Sum_gross=$Gross_efim+$Gross_Plaf1-$Plafon1;
      if ($Sum_gross>$Plafon_AP) { $Plafon2=$Sum_gross-$Plafon_AP; }
      $plafsql = "SELECT PRM_TBL_NVALUED FROM PARAMETERS WHERE PRM_TABLE='PLADU' AND PRM_TBL_FOR=".$Foreasid." AND PRM_TBL_ID=".$Vathmos;
      $Plafon_Duty = G_DBfield($plafsql,'PRM_TBL_NVALUED');
      $Plafon_Duty_Plir=G_efim_mikta_plir($FPEmpid,$FPPeriod,$FPPayyear);
	  $Efim_Rest=$Gross_efim-$Plafon_Duty;


    }
  }
  $Ret_func=array('vath'=>$Vathmos, 'vadescr'=>$Vathm_descr, 'plaap'=>$Plafon_AP, 'exsalid'=>$Exsalid,
                  'grefim'=>$Gross_efim, 'grtakt'=>$Gross_Takt, 'agonper'=>$Agoni_Perioxi, 'plaf1'=>$Plafon1,
                  'plaf2'=>$Plafon2, 'allgr'=>$All_Gross_Takt, 'oikog'=>$Oikogeneiako, 'telgr'=>$Gross_Plaf1,
                  'sumgr'=>$Sum_gross, 'efimrest'=>$Efim_Rest);
  return $Ret_func;
}

function G_vardies_mikta($fpc_empid,$fpc_month,$fpc_year) {
  $tmpsql = "SELECT PAY_ID FROM PAYROLL_TRANSACTIONS WHERE PAT_ID=".$fpc_month." AND PAY_YEAR=".$fpc_year;
  $tmpres = DB_query($tmpsql,$db);
  $In_var = '';
  while ($funcrow=DB_fetch_array($tmpres)) {
    if ($In_var=='') { $In_var = $funcrow['PAY_ID']; }
    else {$In_var = $In_var.', '.$funcrow['PAY_ID']; }
  }
  $tmpsql = "SELECT SALARY.SAL_ID, EXTRA_SALARY.EXSAL_ID, EXTRA_SALARY.EXSAL_DATEFROM, EXTRA_SALARY.EXSAL_DATETO FROM EXTRA_SALARY, SALARY WHERE EXTRA_SALARY.SAL_ID = SALARY.SAL_ID AND EXTRA_SALARY.EMP_ID =".$fpc_empid." AND SALARY.PAY_ID in (".$In_var.")";
  $tmpres =DB_query($tmpsql,$db);
  $tmprow =DB_fetch_array($tmpres);
  $Salid=$tmprow['SAL_ID'];
  $Exsalid=$tmprow['EXSAL_ID'];
  if ($Exsalid>0) {
    $tmpsql = "SELECT SUM(EXSAD_CREDIT) AS CREDIT, SUM(EXSAD_DEBIT) AS DEBIT FROM EXTRA_SALARY_DETAIL WHERE EXSAL_ID =".$Exsalid." AND EXSAD_MODULE='HOUR' ";
    $tmpres =DB_query($tmpsql,$db);
    $tmprow =DB_fetch_array($tmpres);
    $Gross_efim = $tmprow['CREDIT']-$tmprow['DEBIT'];
  }
  return $Gross_efim;
}

function G_ben25($fpc_year,$fpc_month,$fpc_empid) {
  $Func_ret=0;
  if ($fpc_year==2012 && $fpc_month<11) {
    $funcsql = "SELECT BEN_25.B25_AYEAR FROM BEN_25 WHERE BEN_25.EMP_ID = ".$fpc_empid;

    $poso = G_DBfield($funcsql,'B25_AYEAR');
    if ($poso<>0) {$Func_ret=$poso;}
  }
  elseif (($fpc_year==2012 && $fpc_month<13) || ($fpc_year==2013 && $fpc_month<11)) {
    $funcsql = "SELECT BEN_25.B25_BYEAR FROM BEN_25 WHERE BEN_25.EMP_ID = ".$fpc_empid;
    $poso = G_DBfield($funcsql,'B25_BYEAR');
    if ($poso<>0) {$Func_ret=$poso;}
  }
  elseif (($fpc_year==2013 && $fpc_month<13) || ($fpc_year==2014 && $fpc_month<11)) {
    $funcsql = "SELECT BEN_25.B25_CYEAR FROM BEN_25 WHERE BEN_25.EMP_ID = ".$fpc_empid;
    $poso = G_DBfield($funcsql,'B25_CYEAR');
    if ($poso<>0) {$Func_ret=$poso;}
  }
  elseif (($fpc_year==2014 && $fpc_month<13) || ($fpc_year==2015 && $fpc_month<11)) {
    $funcsql = "SELECT BEN_25.B25_DYEAR FROM BEN_25 WHERE BEN_25.EMP_ID = ".$fpc_empid;
    $poso = G_DBfield($funcsql,'B25_DYEAR');
    if ($poso<>0) {$Func_ret=$poso;}
  }
  elseif (($fpc_year==2015 && $fpc_month<13)||($fpc_year==2015 && $fpc_month>11)) {
    $funcsql = "SELECT BEN_25.B25_EYEAR FROM BEN_25 WHERE BEN_25.EMP_ID = ".$fpc_empid;
    $poso = G_DBfield($funcsql,'B25_EYEAR');
    if ($poso<>0) {$Func_ret=$poso;}
  }
  elseif (($fpc_year==2015 && $fpc_month>13)||($fpc_year==2016 && $fpc_month<13)) {
    $funcsql = "SELECT BEN_25.B25_FYEAR FROM BEN_25 WHERE BEN_25.EMP_ID = ".$fpc_empid;
    $poso = G_DBfield($funcsql,'B25_FYEAR');
    if ($poso<>0) {$Func_ret=$poso;}
  }

  elseif (($fpc_year==2017 && $fpc_month<13)) {
    $funcsql = "SELECT BEN_25.B25_GYEAR FROM BEN_25 WHERE BEN_25.EMP_ID = ".$fpc_empid;
    $poso = G_DBfield($funcsql,'B25_GYEAR');
    if ($poso<>0) {$Func_ret=$poso;}
  }
  elseif (($fpc_year==2018 && $fpc_month<13)) {
    $funcsql = "SELECT BEN_25.B25_HYEAR FROM BEN_25 WHERE BEN_25.EMP_ID = ".$fpc_empid;
    $poso = G_DBfield($funcsql,'B25_HYEAR');
    if ($poso<>0) {$Func_ret=$poso;}
  }
  elseif (($fpc_year==2019 && $fpc_month<13)) {
    $funcsql = "SELECT BEN_25.B25_IYEAR FROM BEN_25 WHERE BEN_25.EMP_ID = ".$fpc_empid;
    $poso = G_DBfield($funcsql,'B25_IYEAR');
    if ($poso<>0) {$Func_ret=$poso;}
  }


//echo  $Func_ret;
  return $Func_ret;
}





















function Find_Efimeries($FPEmpid, $FPDtFrom, $FPDtTo) {
  $Ret_func=array();

  // Αναλυση Ενεργών
  $tmpsql3 = "SELECT emp_id,dtr_date,dts_type,";
  $tmpsql3 .= " ts_analysis_pkg.get_holy_flag(emp_id,dtr_date) AS cur_holy ,";
  $tmpsql3 .= " ts_analysis_pkg.get_holy_flag(emp_id,(dtr_date+1)) AS next_holy ";
  $tmpsql3 .= " FROM ts_duty_trans t, ts_duties d";
  $tmpsql3 .= " WHERE t.dts_id=d.dts_id";
  $tmpsql3 .= " AND dts_type=1";
  $tmpsql3 .= " AND dtr_date >= ".FormatDateForSQL(ConvertSQLDate($FPDtFrom));
  $tmpsql3 .= " AND dtr_date <= ".FormatDateForSQL(ConvertSQLDate($FPDtTo));
  $tmpsql3 .= " AND emp_id='".$FPEmpid."'";
  $tmpsql3 .= " ORDER by dtr_date";

  $normal = 0;
  $before_kyr = 0;
  $kath_to_arg = 0;
  $kyr = 0;
  $kyrkyr = 0;
  $tmpres3 =DB_query($tmpsql3,$db);
  if ($tmpres3) {
    while ($tmprow3 =DB_fetch_array($tmpres3)) {
      if ($tmprow3['CUR_HOLY']==0 && $tmprow3['NEXT_HOLY']==0) { $normal += 1; }
      if ($tmprow3['CUR_HOLY']==0 && $tmprow3['NEXT_HOLY']==1) {
        if (get_weekday_number(ConvertSQLDate($tmprow3['DTR_DATE']))==6) { $before_kyr += 1; }
        else { $kath_to_arg += 1; }
      }
      if ($tmprow3['CUR_HOLY']==1 && $tmprow3['NEXT_HOLY']==1) { $kyrkyr += 1; }
      if ($tmprow3['CUR_HOLY']==1 && $tmprow3['NEXT_HOLY']==0) { $kyr += 1; }
    }
  }
//  $EnerKath=$normal;
//  $EnerSabb=$before_kyr;
//  $EnerKaAr=$kath_to_arg;
//  $EnerArgi=$kyr;
//  $EnerArAr=$kyrkyr;
  $Ret_func[EnerKath]=$normal;
  $Ret_func[EnerSabb]=$before_kyr;
  $Ret_func[EnerKaAr]=$kath_to_arg;
  $Ret_func[EnerArgi]=$kyr;
  $Ret_func[EnerArAr]=$kyrkyr;
  $Ret_func[EnerSum] =$normal+$before_kyr+$kath_to_arg+$kyr+$kyrkyr;

  // Αναλυση Μικτών
  $tmpsql3 = "SELECT emp_id,dtr_date,dts_type,";
  $tmpsql3 .= " ts_analysis_pkg.get_holy_flag(emp_id,dtr_date) AS cur_holy ,";
  $tmpsql3 .= " ts_analysis_pkg.get_holy_flag(emp_id,(dtr_date+1)) AS next_holy ";
  $tmpsql3 .= " FROM ts_duty_trans t, ts_duties d";
  $tmpsql3 .= " WHERE t.dts_id=d.dts_id";
  $tmpsql3 .= " AND dts_type=2";
  $tmpsql3 .= " AND dtr_date >= ".FormatDateForSQL(ConvertSQLDate($FPDtFrom));
  $tmpsql3 .= " AND dtr_date <= ".FormatDateForSQL(ConvertSQLDate($FPDtTo));
  $tmpsql3 .= " AND emp_id='".$FPEmpid."'";
  $tmpsql3 .= " ORDER by dtr_date";

  $normal = 0;
  $before_kyr = 0;
  $kath_to_arg = 0;
  $kyr = 0;
  $kyrkyr = 0;
  $tmpres3 =DB_query($tmpsql3,$db);
  if ($tmpres3) {
    while ($tmprow3 =DB_fetch_array($tmpres3)) {
      if ($tmprow3['CUR_HOLY']==0 && $tmprow3['NEXT_HOLY']==0) { $normal += 1; }
      if ($tmprow3['CUR_HOLY']==0 && $tmprow3['NEXT_HOLY']==1) {
        if (get_weekday_number(ConvertSQLDate($tmprow3['DTR_DATE']))==6) { $before_kyr += 1; }
        else { $kath_to_arg += 1; }
      }
      if ($tmprow3['CUR_HOLY']==1 && $tmprow3['NEXT_HOLY']==1) { $kyrkyr += 1; }
      if ($tmprow3['CUR_HOLY']==1 && $tmprow3['NEXT_HOLY']==0) { $kyr += 1; }
    }
  }
  $Ret_func[MiktKath]=$normal;
  $Ret_func[MiktSabb]=$before_kyr;
  $Ret_func[MiktKaAr]=$kath_to_arg;
  $Ret_func[MiktArgi]=$kyr;
  $Ret_func[MiktArAr]=$kyrkyr;
  $Ret_func[MiktSum] =$normal+$before_kyr+$kath_to_arg+$kyr+$kyrkyr;

  // Αναλυση Ετοιμότητας
  $tmpsql3 = "SELECT emp_id,dtr_date,dts_type,";
  $tmpsql3 .= " ts_analysis_pkg.get_holy_flag(emp_id,dtr_date) AS cur_holy ,";
  $tmpsql3 .= " ts_analysis_pkg.get_holy_flag(emp_id,(dtr_date+1)) AS next_holy ";
  $tmpsql3 .= " FROM ts_duty_trans t, ts_duties d";
  $tmpsql3 .= " WHERE t.dts_id=d.dts_id";
  $tmpsql3 .= " AND dts_type=3";
  $tmpsql3 .= " AND dtr_date >= ".FormatDateForSQL(ConvertSQLDate($FPDtFrom));
  $tmpsql3 .= " AND dtr_date <= ".FormatDateForSQL(ConvertSQLDate($FPDtTo));
  $tmpsql3 .= " AND emp_id='".$FPEmpid."'";
  $tmpsql3 .= " ORDER by dtr_date";

  $normal = 0;
  $before_kyr = 0;
  $kath_to_arg = 0;
  $kyr = 0;
  $kyrkyr = 0;
  $tmpres3 =DB_query($tmpsql3,$db);
  if ($tmpres3) {
    while ($tmprow3 =DB_fetch_array($tmpres3)) {
      if ($tmprow3['CUR_HOLY']==0 && $tmprow3['NEXT_HOLY']==0) { $normal += 1; }
      if ($tmprow3['CUR_HOLY']==0 && $tmprow3['NEXT_HOLY']==1) {
        if (get_weekday_number(ConvertSQLDate($tmprow3['DTR_DATE']))==6) { $before_kyr += 1; }
        else { $kath_to_arg += 1; }
      }
      if ($tmprow3['CUR_HOLY']==1 && $tmprow3['NEXT_HOLY']==1) { $kyrkyr += 1; }
      if ($tmprow3['CUR_HOLY']==1 && $tmprow3['NEXT_HOLY']==0) { $kyr += 1; }
    }
  }
  $Ret_func[EtimKath]=$normal;
  $Ret_func[EtimSabb]=$before_kyr;
  $Ret_func[EtimKaAr]=$kath_to_arg;
  $Ret_func[EtimArgi]=$kyr;
  $Ret_func[EtimArAr]=$kyrkyr;
  $Ret_func[EtimSum] =$normal+$before_kyr+$kath_to_arg+$kyr+$kyrkyr;

  $Ret_func[EfimSum] =$Ret_func[EnerSum]+$Ret_func[MiktSum]+$Ret_func[EtimSum];
  return $Ret_func;
}













?>