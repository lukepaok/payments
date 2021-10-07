<?php
/* --------------------------------------------------------------
    PAYROLL
    Rep_Apod_Plirom_new.php
    02-20/10/2015
   -------------------------------------------------------------- */
ini_set('default_charset', 'ISO-8859-7');
include ('includes/session.inc');
include ('include/Rep_Fill_pck.php');
include ('include/Func_Efimeries.php');
include ('params/BDLRE_name.php');
$InputError      = 0;
$form_session    = 'Rep_Apod_Plirom.php';
$title           = 'аПОДЕъНЕИР пКГЯЫЛЧМ тАЙТИЙчР';
$Form_btns       = array( 'PDF'=>true,  'EXCEL'=>false,   'TEXT'=>false,  'HTML'=>false,  'XML'=>false, 'CSV'=>false, 'WORD'=>false,
                          'TPDF'=>'PDF','TEXCEL'=>'EXCEL','TTEXT'=>'TEXT','THTML'=>'HTML','TXML'=>'XML','TCSV'=>'CSV','TWORD'=>'Word');
$Rep_Type        = 3;
$Logo_head_print = 1;
$Gen_Sums        = 'NO';
$SelectPart      = array(
  'Katig_Block'=>1,
     'Katigoria'=>1, 'NMKatig'=>1,   'Klados'=>1,    'Eidikotita'=>1,'Grafeio'=>0,
     'Ypiresia' =>1, 'Dieythinsi'=>1,'Tomeas'=>1,    'Tmima'=>1,
  'Misth_Block'=>1,
      'PayCat'=>1, 'PayTime'=>1, 'SxesiErg'=>0,'XMLKrit'=>1,
      'Krit1'=>1,  'Krit2'=>1, 'Krit3'=>1, 'Krit4'=>0,
  'List_Block'=>1,
      'ListBox1'=>1,'DateFromTo'=>0,
  'Period'=>3,
                 );
$SelectTitle=array(
  'ListBox1'=>'еПИКОЦч',
  'DateFromTo'=>'гЛЕЯОЛГМъЕР',
                 );
$SelectArray=array(
  'ListBox1'=>array('All'=>'аПЭДЕИНГ пКГЯЫЛчР','1'=>'бЕБАъЫСГ аПОДОВЧМ'),
                 );

$Det_Head[1]  = array('йыдийос',    'епымуло',      'омола',              );
$Det_Width[1] = array(50,           100,            60,                   );
$Det_Name[1]  = array('TWA_EMP_CODE','TWA_LAST_NAME','TWA_FIRST_NAME',     );
$Det_Type[1]  = array('',           '',             '',                   );
$Det_Sum[1]   = array(                                                    );
$FWD          = array(50,           100,            65,                   );

$Print_lines=1;
$Compute_Payroll=1;
$ReportTitle     = "еййахаяистийо сглеиыла лисходосиас";
$ReportTitle2    = 'тайтийг';
$ReportTitle3    = '';
$ReportPageTitle = '';
$HeaderFile = 'include/Rep_Page_Header_A4.inc';
$PaperSize = 'A4_P';
$HG_Line=0;
$CreateFile = 'self';
$Head_Page_Date='no';
include ('Rep_Main.php');
$PatTo=$PatFrom;
$PatYearFrom=$PatYear;
$PatYearTo=$PatYear;

if ($SignFile!='') { include ('params/signs/'.$SignFile); }
unset($MasterTable);
$MasterTable = array();
fillMasterTable();
$myrow=$MasterTable;
$table=array();
foreach ($myrow as $myr) { foreach ($myr as $key=>$value) { $table[$key]=$value; } }
$Misth_Per=$table['PER_MONTH'];
$Misth_Year=$table['PER_YEAR'];
$ReportTitle3='лгмас/етос   '.$myrow['PAY_COMMENTS'];
$Lock_Misth=G_DBfield("SELECT LOCK_MISTH FROM PAYROLL_TRANSACTIONS WHERE PAYROLL_TRANSACTIONS.PAY_YEAR || substr('0' || PAYROLL_TRANSACTIONS.PAT_ID, -2, 2) =".$PatYearFrom.substr('0'.$PatFrom,-2,2),"LOCK_MISTH");
if ($_SESSION['GLInstall']!='AGLAIA') { $Lock_Misth=1; }
if ($Lock_Misth>0) {
  foreach ($MasterTable as $myrow) {
    unset($DetailTable);
    $DetailTable = array();
    fillDetailTable($myrow);
    $Errors_msg=array();
    foreach ($DetailTable as $DetailRow) {
      $Errors_found=0;
      if ($Misth_Per<13) {
        $Date_Misth = explode('/',$DetailRow['TWA_FROM_PER']);
        $ReportTitle3='лгмас/етос   '.$_SESSION['GLMonthL'][intval($Date_Misth[1])]." ".$Date_Misth[2];
      }
      include ($HeaderFile);
      if (isset($AL_Lixi)) { unset($AL_Lixi); }
      $Emp_id=$DetailRow['TWA_EMP_ID'];
      $days=$DetailRow['TWA_ASFALHMER'];
      $ADek=$DetailRow['T_A_DEK'];
      $BDek=$DetailRow['T_B_DEK'];
      $Errors_line='------------------------ EMP_ID='.$Emp_id.' SAL_ID='.$DetailRow['TWA_SAL_ID'].'  '.$DetailRow['TWA_LAST_NAME'].' '.$DetailRow['EMP_FIRST_NAME'];
      $Errors_1line='еНЕТАСТЕ ТОМ/ТГМ '.$DetailRow['TWA_LAST_NAME'].' '.$DetailRow['TWA_FIRST_NAME'];
      $Ben_array=array();
      $Ded_array=array();
      $Erg_array=array();
      $Loans_array=array();
      $Meiosi25 = G_ben25($Misth_Year,$Misth_Per,$Emp_id);
      if ($Meiosi25<0) {
        $DetailRow['T_BASIC'] -= $Meiosi25*($days/30);
        $DetailRow['TB_DIAF_APOD'] = $Meiosi25*($days/30);
      }
      foreach ($DetailRow as $key=>$value) {
        $Col_cat=substr($key,0,3);
        $Col_desc=trim(substr($key,1,40));
        if ($key=='T_BASIC') { $Ben_array[$BDLRE_name['B_BASIC']]=$value; }
        if (in_array($Col_cat,array('TB_','TF_'))) { $Ben_array[$BDLRE_name[$Col_desc]]=$value; }
        if ($key=='T_FMY') { $Ded_array[$BDLRE_name['D_TAXFMY']]=$value; }
        if (in_array($Col_cat,array('TD_','TK_','TR_','TM_'))) {
          $Ded_array[$BDLRE_name[$Col_desc]]=$value;
          if ($Col_desc=='K_AXR_LIFTH') {
            $AL_name=$BDLRE_name[$Col_desc].'*';
            $Ded_array[$AL_name]=$value;
            unset($Ded_array[$BDLRE_name[$Col_desc]]);
            $Date_periodou="01/".$Date_Misth[1]."/".$Date_Misth[2];
            $sql_eded  = "SELECT EDED_DATE2 FROM EMP_DEDUCTIONS WHERE EMP_ID=".$Emp_id." AND ".FormatDateForSQL($Date_periodou)." BETWEEN EDED_DATE1 AND EDED_DATE2 ";
            $RES = DB_query($sql_eded,$db);
            $AL_Lixi=array();
            while ($ROW=DB_fetch_array($RES)) { $AL_Lixi[]=ConvertSQLDate($ROW['EDED_DATE2']); }
          }
        }
        if ($Col_cat=='TE_') { $Erg_array[$BDLRE_name[$Col_desc]]=$value; }
        if ($Col_cat=='TL_') { $Loans_array[$BDLRE_name[$Col_desc]]=$value; }
        if ($Col_cat=='LL_') { $Loans_array_date[$BDLRE_name[$Col_desc]]=$value; }
      }
      $pdf->SetDrawColor(120);
      $pdf->rect(35, 80, 530, 35);
      $pdf->line(35, 750, 565, 750);
      $pdf->line(35, 739, 565, 739);
      $pdf->line(270, 761, 270, 728);
      $pdf->line(450, 761, 450, 728);
      $Box_LX=35;     //  X of Left Boxes - X of Right Boxes = $Box_LX+267
      $Box_ALRY=125;  //  Y of A (upper) Boxes
      $Box_W=263;     //  Width all Boxes
      $Box_ALH=300;   //  Height A Left Box
      $Box_BLH=146;   //  Height B Left Box
      $Box_CLH=200;   //  Height C Left Box
      $Box_ARH=450;   //  Height A Right Box
      $pdf->rect($Box_LX, $Box_ALRY, $Box_W, $Box_ALH);
      $pdf->rect($Box_LX, $Box_ALRY, $Box_W, 20);
      $pdf->rect($Box_LX, $Box_ALRY+$Box_ALH+4, $Box_W, $Box_BLH);
      $pdf->rect($Box_LX, $Box_ALRY+$Box_ALH+4, $Box_W, 20);
      $pdf->rect($Box_LX, $Box_ALRY+$Box_ALH+$Box_BLH+8, $Box_W, $Box_CLH);
      $pdf->rect($Box_LX, $Box_ALRY+$Box_ALH+$Box_BLH+8, $Box_W, 20);
      $pdf->rect($Box_LX+267, $Box_ALRY, $Box_W, $Box_ARH);
      $pdf->rect($Box_LX+267, $Box_ALRY, $Box_W, 20);
      $pdf->SetDrawColor(220);
      $pdf->rect($Box_LX+180, $Box_ALRY+$Box_ALH-20, $Box_W-190, 15);
      $pdf->rect($Box_LX+180, $Box_ALRY+$Box_ALH+$Box_BLH-16, $Box_W-190, 15);
      $pdf->rect($Box_LX+180, $Box_ALRY+$Box_ALH+$Box_BLH+$Box_CLH-10, $Box_W-190, 15);
      $pdf->rect($Box_LX+447, $Box_ALRY+$Box_ARH-20, $Box_W-190, 15);
      $pdf->rect($Box_LX+447, 650, 73, 15);
      $pdf->rect($Box_LX+447, 670, 73, 15);

      $pdf->SetDrawColor(0);
      $pdf->setFont('arial');
      $pdf->addText(40, 753, 8, 'еПЧМУЛО:');
      $pdf->addText(40, 742, 8, 'оМОЛА:');
      $pdf->addText(40, 731, 8, 'пАТЯЧМУЛО:');
      $pdf->addText(275, 753, 8, 'а.л.:');
      $pdf->addText(275, 742, 8, 'йАТГЦОЯъА:');
      $pdf->addText(275, 731, 8, 'еИДИЙЭТГТА:');
      $pdf->addText(455, 753, 8, 'а.ж.л.:');
      $pdf->addText(455, 742, 8, 'бАХЛЭР:');
      $pdf->addText(455, 731, 8, 'йКИЛэЙИО:');
      $pdf->setFont('arialbold');
      $pdf->addText(82, 753, 8, $DetailRow['TWA_LAST_NAME']);
      $pdf->addText(82, 742, 8, $DetailRow['TWA_FIRST_NAME']);
      $pdf->addText(86, 731, 8, $DetailRow['TWA_FATHER_NAME']);
      $pdf->addText(317, 753, 8, $DetailRow['TWA_EMP_CODE']);
      $pdf->addText(317, 742, 8, $DetailRow['TWA_CATEGORY']);
      $pdf->addText(317, 731, 8, $DetailRow['TWA_EIDIKOTITA']);
      if ($ListBox1==1) { $pdf->addText(490, 753, 8, $DetailRow['TWA_TAX_NUMBER']); }
      $pdf->addText(490, 742, 8, $DetailRow['TWA_VATHMOS_ONLY']);
      $pdf->addText(490, 731, 8, $DetailRow['TWA_KLIMAKIO_ONLY']);
      $pdf->addTextWrap(37,702,260,9,'амакусг аподовым', 'center');
      $pdf->addText(60, 425, 9, 'сумоко аподовым');
      $pdf->addTextWrap(304,702,260,9,'амакусг йяатгсеым асжакислемоу', 'center');
      $pdf->addText(320, 275, 9, 'сумоко йяатгсеым');
      $pdf->addTextWrap(37,397,260,9,'амакусг дамеиым - коипым ожеикым', 'center');
      $pdf->addText(40, 275, 9, 'сумоко дамеиым - коипым ожеикым');
      $pdf->addTextWrap(37,248,260,9,'еяцодотийес еисжояес', 'center');
      $pdf->addText(50, 69, 9, 'сумоко еяцодотийым еисжояым');
      $pdf->addText(320, 240, 9, 'сумоко аподовым');
      $pdf->addText(320, 225, 9, 'сумоко йяатгсеым');
      $pdf->addText(320, 205, 9, 'йахаяес аподовес');
      $pdf->addText(320, 180, 9, "а' 15/хглеяо");
      $pdf->addText(320, 160, 9, "б' 15/хглеяо");
      $pdf->setFont('verdana');
      $YPos=680;
      $Line_aa=1;
      $Sum_ben=0;
      $Fontsize=10;
      $Line_Height=15;
      foreach ($Ben_array as $key=>$value) {
        $pdf->addText(50, $YPos, $Fontsize, $Line_aa.') '.$key.':');
        $pdf->addTextWrap(200, $YPos, 80, $Fontsize, number_format($value,2,',','.').'  ─', 'right');
        $Sum_ben += $value;
        $Line_aa ++;
        $YPos -= $Line_Height;
      }
      $YPos=680;
      $Line_aa=1;
      $Sum_ded=0;
      foreach ($Ded_array as $key=>$value) {
        $pdf->addText(317, $YPos, $Fontsize, $Line_aa.') '.$key.':');
        $pdf->addTextWrap(467, $YPos, 80, $Fontsize, number_format($value,2,',','.').'  ─', 'right');
        $Sum_ded += $value;
        $Line_aa ++;
        $YPos -= $Line_Height;
      }
      if (isset($AL_Lixi)) {
        $Lixi_Ypos=285+count($AL_Lixi)*8;
        foreach ($AL_Lixi as $value) {
          $pdf->addText(317, $Lixi_Ypos, 8, '(*) кчНГ: '.$value);
          $Lixi_Ypos -= 9;
        }
      }
      $YPos=375;
      $Line_aa=1;
      $Sum_loan=0;
      foreach ($Loans_array as $key=>$value) {
        $pdf->addText(50, $YPos, $Fontsize, $Line_aa.') '.$key.':');
        $pdf->addTextWrap(200, $YPos, 80, $Fontsize, number_format($value,2,',','.').'  ─', 'right');
        $Sum_loan += $value;
        $Line_aa ++;
        $YPos -= $Line_Height;
      }
      $YPos=320;
      if (!empty($Loans_array_date)) {
        foreach ($Loans_array_date as $key=>$value) {
          $pdf->addText(50, $YPos, 7, '(*)'.$key.':');
          $pdf->addTextWrap(200, $YPos, 80, 7, $value, 'right');
          $YPos -= 0.5*$Line_Height;
          unset($Loans_array_date);
        }
      }
      $YPos=226;
      $Line_aa=1;
      $Sum_erg=0;
      foreach ($Erg_array as $key=>$value) {
        $pdf->addText(50, $YPos, $Fontsize, $Line_aa.') '.$key.':');
        $pdf->addTextWrap(200, $YPos, 80, $Fontsize, number_format($value,2,',','.').'  ─', 'right');
        $Sum_erg += $value;
        $Line_aa ++;
        $YPos -= $Line_Height;
      }
      $pdf->setFont('verdanabold');
      $pdf->addTextWrap(200, 425, 80, 8, number_format($Sum_ben,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(467, 275, 80, 8, number_format($Sum_ded,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(200, 275, 80, 8, number_format($Sum_loan,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(200,  69, 80, 8, number_format($Sum_erg,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(467, 240, 80, 8, number_format($Sum_ben,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(467, 225, 80, 8, number_format($Sum_ded+$Sum_loan,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(467, 205, 80, 8, number_format($Sum_ben-$Sum_ded-$Sum_loan,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(467, 180, 80, 8, number_format($ADek,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(467, 160, 80, 8, number_format($BDek,2,',','.').'  ─', 'right');
      if ($ListBox1==1) {
        $pdf->setFont('arial');
        $pdf->addTextWrap(320, 130, 235, 8, $NEW_Notes1, 'center');
        $pdf->addTextWrap(320, 120, 235, 8, $NEW_Notes2, 'center');
        $pdf->addTextWrap(320, 110, 235, 8, $NEW_Notes3, 'center');
        $pdf->addTextWrap(320, 100, 235, 8, $NEW_Notes4, 'center');
        $pdf->addTextWrap(320,  65, 235, 8, $Poli.'  ........................................................', 'left');
        $pdf->addTextWrap(340,  45, 235, 8, $NEW_TS_Head, 'left');
      }
      $F_Paid=trim(number_format($ADek+$BDek,2,',','.'));
      $P_Paid=trim(number_format($Sum_ben-$Sum_ded-$Sum_loan,2,',','.'));
      $F_Income=trim(number_format($DetailRow['T_INCOME'],2,',','.'));
      $P_Income=trim(number_format($Sum_ben,2,',','.'));
      $F_Deds=trim(number_format($Sum_ded,2,',','.'));
      $P_Deds=trim(number_format($Sum_ded,2,',','.'));
      $F_Loans=trim(number_format($DetailRow['T_LOANS'],2,',','.'));
      $P_Loans=trim(number_format($Sum_loan,2,',','.'));
      $F_Ergs=trim(number_format($DetailRow['T_ERGDED'],2,',','.'));
      $P_Ergs=trim(number_format($Sum_erg,2,',','.'));
      if ($F_Paid!=$P_Paid) {
        $Errors_found=1;
        if ($_SESSION['MENUC0UNT']==496451) {
          $Errors_msg[]=$Errors_line;
          $Errors_msg[]='диажояа СТО АХЯОИСЛА дЕЙАПЕМХГЛЕЯЫМ ЛЕ ТИР йАХАЯЕР аПОДОВЕР: '.$F_Paid.'  '.$P_Paid;
        }
        else { $Errors_msg[]=$Errors_1line; }
      }
      if ($F_Income!=$P_Income) {
        if ($_SESSION['MENUC0UNT']==496451) {
          if ($Errors_found==0) {
            $Errors_found=1;
            $Errors_msg[]=$Errors_line;
          }
          $Errors_msg[]='диажояа СТИР аподовес: '.$F_Income.'  '.$P_Income;
        }
        elseif ($Errors_found==0) {
          $Errors_found=1;
          $Errors_msg[]=$Errors_1line;
        }
      }
      if ($F_Deds!=$P_Deds) {
        if ($_SESSION['MENUC0UNT']==496451) {
          if ($Errors_found==0) {
            $Errors_found=1;
            $Errors_msg[]=$Errors_line;
          }
          $Errors_msg[]='диажояа СТИР йяатгсеис: '.$F_Deds.'  '.$P_Deds;
        }
        elseif ($Errors_found==0) {
          $Errors_found=1;
          $Errors_msg[]=$Errors_1line;
        }
      }
      if ($F_Loans!=$P_Loans) {
        if ($_SESSION['MENUC0UNT']==496451) {
          if ($Errors_found==0) {
            $Errors_found=1;
            $Errors_msg[]=$Errors_line;
          }
          $Errors_msg[]='диажояа СТИР дамеиа: '.$F_Loans.'  '.$P_Loans;
        }
        elseif ($Errors_found==0) {
          $Errors_found=1;
          $Errors_msg[]=$Errors_1line;
        }
      }
      if ($F_Ergs!=$P_Ergs) {
        if ($_SESSION['MENUC0UNT']==496451) {
          if ($Errors_found==0) {
            $Errors_found=1;
            $Errors_msg[]=$Errors_line;
          }
          $Errors_msg[]='диажояа СТИР еяцодотийес йяатгсеис: '.$F_Ergs.'  '.$P_Ergs;
        }
        elseif ($Errors_found==0) {
          $Errors_found=1;
          $Errors_msg[]=$Errors_1line;
        }
      }
      $PageNumber++;
    }
    if (count($Errors_msg)!=0)  {
      $YPos = $Page_Height - $Top_Margin-10;
      $pdf->setFont('arial');
      $pdf->newPage();
      foreach ($Errors_msg as $key=>$value) {
        $pdf->addText(30, $YPos, 8, $value);
        $YPos -= 9;
        if ($YPos<30) {
          $YPos = $Page_Height - $Top_Margin;
          $pdf->newPage();
        }
      }
    }
  }

  $Print_lines=1;
  $Compute_Payroll=2;
  $ReportTitle     = "еййахаяистийо сглеиыла лисходосиас";
  $ReportTitle2    = 'амадяолийа тайтийгс';
  $ReportTitle3    = '';
  $ReportPageTitle = '';
  foreach ($MasterTable as $myrow) {
    unset($DetailTable);
    $DetailTable = array();
    fillDetailTable($myrow);
    $Errors_msg=array();
    foreach ($DetailTable as $DetailRow) {
      $Errors_found=0;
      if ($Misth_Per<13) {
        $Date_Misth = explode('/',$DetailRow['TWA_FROM_PER']);
        $ReportTitle3='лгмас/етос   '.$_SESSION['GLMonthL'][intval($Date_Misth[1])]." ".$Date_Misth[2];
      }
      include ($HeaderFile);
      if (isset($AL_Lixi)) { unset($AL_Lixi); }
      $Emp_id=$DetailRow['TWA_EMP_ID'];
      $ADek=$DetailRow['A_A_DEK'];
      $BDek=$DetailRow['A_B_DEK'];
      $Errors_line='------------------------ EMP_ID='.$Emp_id.' SAL_ID='.$DetailRow['TWA_SAL_ID'].'  '.$DetailRow['TWA_LAST_NAME'].' '.$DetailRow['EMP_FIRST_NAME'];
      $Errors_1line='еНЕТАСТЕ ТОМ/ТГМ '.$DetailRow['TWA_LAST_NAME'].' '.$DetailRow['TWA_FIRST_NAME'];
      $Ben_array=array();
      $Ded_array=array();
      $Erg_array=array();
      $Loans_array=array();
      foreach ($DetailRow as $key=>$value) {
        $Col_cat=substr($key,0,3);
        $Col_desc=trim(substr($key,1,40));
        if ($key=='A_BASIC') { $Ben_array[$BDLRE_name['B_BASIC']]=$value; }
        if (in_array($Col_cat,array('AB_','AF_'))) { $Ben_array[$BDLRE_name[$Col_desc]]=$value; }
        if ($key=='A_TAX') { $Ded_array[$BDLRE_name['D_TAXFMY']]=$value; }
        if (in_array($Col_cat,array('AD_','AK_','AR_','AM_'))) {
          $Ded_array[$BDLRE_name[$Col_desc]]=$value;
          if ($Col_desc=='K_AXR_LIFTH') {
            $AL_name=$BDLRE_name[$Col_desc].'*';
            $Ded_array[$AL_name]=$value;
            unset($Ded_array[$BDLRE_name[$Col_desc]]);
            $Date_periodou="01/".$Date_Misth[1]."/".$Date_Misth[2];
            $sql_eded  = "SELECT EDED_DATE2 FROM EMP_DEDUCTIONS WHERE EMP_ID=".$Emp_id." AND ".FormatDateForSQL($Date_periodou)." BETWEEN EDED_DATE1 AND EDED_DATE2 ";
            $RES = DB_query($sql_eded,$db);
            $AL_Lixi=array();
            while ($ROW=DB_fetch_array($RES)) { $AL_Lixi[]=ConvertSQLDate($ROW['EDED_DATE2']); }
          }
        }
        if ($Col_cat=='AE_') { $Erg_array[$BDLRE_name[$Col_desc]]=$value; }
        if ($Col_cat=='AL_') { $Loans_array[$BDLRE_name[$Col_desc]]=$value; }
      }
      $pdf->SetDrawColor(120);
      $pdf->rect(35, 80, 530, 35);
      $pdf->line(35, 750, 565, 750);
      $pdf->line(35, 739, 565, 739);
      $pdf->line(270, 761, 270, 728);
      $pdf->line(450, 761, 450, 728);
      $Box_LX=35;     //  X of Left Boxes - X of Right Boxes = $Box_LX+267
      $Box_ALRY=125;  //  Y of A (upper) Boxes
      $Box_W=263;     //  Width all Boxes
      $Box_ALH=300;   //  Height A Left Box
      $Box_BLH=146;   //  Height B Left Box
      $Box_CLH=200;   //  Height C Left Box
      $Box_ARH=450;   //  Height A Right Box
      $pdf->rect($Box_LX, $Box_ALRY, $Box_W, $Box_ALH);
      $pdf->rect($Box_LX, $Box_ALRY, $Box_W, 20);
      $pdf->rect($Box_LX, $Box_ALRY+$Box_ALH+4, $Box_W, $Box_BLH);
      $pdf->rect($Box_LX, $Box_ALRY+$Box_ALH+4, $Box_W, 20);
      $pdf->rect($Box_LX, $Box_ALRY+$Box_ALH+$Box_BLH+8, $Box_W, $Box_CLH);
      $pdf->rect($Box_LX, $Box_ALRY+$Box_ALH+$Box_BLH+8, $Box_W, 20);
      $pdf->rect($Box_LX+267, $Box_ALRY, $Box_W, $Box_ARH);
      $pdf->rect($Box_LX+267, $Box_ALRY, $Box_W, 20);
      $pdf->SetDrawColor(220);
      $pdf->rect($Box_LX+180, $Box_ALRY+$Box_ALH-20, $Box_W-190, 15);
      $pdf->rect($Box_LX+180, $Box_ALRY+$Box_ALH+$Box_BLH-16, $Box_W-190, 15);
      $pdf->rect($Box_LX+180, $Box_ALRY+$Box_ALH+$Box_BLH+$Box_CLH-10, $Box_W-190, 15);
      $pdf->rect($Box_LX+447, $Box_ALRY+$Box_ARH-20, $Box_W-190, 15);
      $pdf->rect($Box_LX+447, 650, 73, 15);
      $pdf->rect($Box_LX+447, 670, 73, 15);

      $pdf->SetDrawColor(0);
      $pdf->setFont('arial');
      $pdf->addText(40, 753, 8, 'еПЧМУЛО:');
      $pdf->addText(40, 742, 8, 'оМОЛА:');
      $pdf->addText(40, 731, 8, 'пАТЯЧМУЛО:');
      $pdf->addText(275, 753, 8, 'а.л.:');
      $pdf->addText(275, 742, 8, 'йАТГЦОЯъА:');
      $pdf->addText(275, 731, 8, 'еИДИЙЭТГТА:');
      $pdf->addText(455, 753, 8, 'а.ж.л.:');
      $pdf->addText(455, 742, 8, 'бАХЛЭР:');
      $pdf->addText(455, 731, 8, 'йКИЛэЙИО:');
      $pdf->setFont('arialbold');
      $pdf->addText(82, 753, 8, $DetailRow['TWA_LAST_NAME']);
      $pdf->addText(82, 742, 8, $DetailRow['TWA_FIRST_NAME']);
      $pdf->addText(86, 731, 8, $DetailRow['TWA_FATHER_NAME']);
      $pdf->addText(317, 753, 8, $DetailRow['TWA_EMP_CODE']);
      $pdf->addText(317, 742, 8, $DetailRow['TWA_CATEGORY']);
      $pdf->addText(317, 731, 8, $DetailRow['TWA_EIDIKOTITA']);
      if ($ListBox1==1) { $pdf->addText(490, 753, 8, $DetailRow['TWA_TAX_NUMBER']); }
      $pdf->addText(490, 742, 8, $DetailRow['TWA_VATHMOS_ONLY']);
      $pdf->addText(490, 731, 8, $DetailRow['TWA_KLIMAKIO_ONLY']);
      $pdf->addTextWrap(37,702,260,9,'амакусг аподовым', 'center');
      $pdf->addText(60, 425, 9, 'сумоко аподовым');
      $pdf->addTextWrap(304,702,260,9,'амакусг йяатгсеым асжакислемоу', 'center');
      $pdf->addText(320, 275, 9, 'сумоко йяатгсеым');
      $pdf->addTextWrap(37,397,260,9,'амакусг дамеиым - коипым ожеикым', 'center');
      $pdf->addText(40, 275, 9, 'сумоко дамеиым - коипым ожеикым');
      $pdf->addTextWrap(37,248,260,9,'еяцодотийес еисжояес', 'center');
      $pdf->addText(50, 69, 9, 'сумоко еяцодотийым еисжояым');
      $pdf->addText(320, 240, 9, 'сумоко аподовым');
      $pdf->addText(320, 225, 9, 'сумоко йяатгсеым');
      $pdf->addText(320, 205, 9, 'йахаяес аподовес');
      $pdf->addText(320, 180, 9, "а' 15/хглеяо");
      $pdf->addText(320, 160, 9, "б' 15/хглеяо");
      $pdf->setFont('verdana');
      $YPos=680;
      $Line_aa=1;
      $Sum_ben=0;
      $Fontsize=10;
      $Line_Height=15;
      foreach ($Ben_array as $key=>$value) {
        $pdf->addText(50, $YPos, $Fontsize, $Line_aa.') '.$key.':');
        $pdf->addTextWrap(200, $YPos, 80, $Fontsize, number_format($value,2,',','.').'  ─', 'right');
        $Sum_ben += $value;
        $Line_aa ++;
        $YPos -= $Line_Height;
      }
      $YPos=680;
      $Line_aa=1;
      $Sum_ded=0;
      foreach ($Ded_array as $key=>$value) {
        $pdf->addText(317, $YPos, $Fontsize, $Line_aa.') '.$key.':');
        $pdf->addTextWrap(467, $YPos, 80, $Fontsize, number_format($value,2,',','.').'  ─', 'right');
        $Sum_ded += $value;
        $Line_aa ++;
        $YPos -= $Line_Height;
      }
      if (isset($AL_Lixi)) {
        $Lixi_Ypos=285+count($AL_Lixi)*8;
        foreach ($AL_Lixi as $value) {
          $pdf->addText(317, $Lixi_Ypos, 8, '(*) кчНГ: '.$value);
          $Lixi_Ypos -= 9;
        }
      }
      $YPos=375;
      $Line_aa=1;
      $Sum_loan=0;
      foreach ($Loans_array as $key=>$value) {
        $pdf->addText(50, $YPos, $Fontsize, $Line_aa.') '.$key.':');
        $pdf->addTextWrap(200, $YPos, 80, $Fontsize, number_format($value,2,',','.').'  ─', 'right');
        $Sum_loan += $value;
        $Line_aa ++;
        $YPos -= $Line_Height;
      }
      $YPos=226;
      $Line_aa=1;
      $Sum_erg=0;
      foreach ($Erg_array as $key=>$value) {
        $pdf->addText(50, $YPos, $Fontsize, $Line_aa.') '.$key.':');
        $pdf->addTextWrap(200, $YPos, 80, $Fontsize, number_format($value,2,',','.').'  ─', 'right');
        $Sum_erg += $value;
        $Line_aa ++;
        $YPos -= $Line_Height;
      }
      $pdf->setFont('verdanabold');
      $pdf->addTextWrap(200, 425, 80, 8, number_format($Sum_ben,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(467, 275, 80, 8, number_format($Sum_ded,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(200, 275, 80, 8, number_format($Sum_loan,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(200,  69, 80, 8, number_format($Sum_erg,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(467, 240, 80, 8, number_format($Sum_ben,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(467, 225, 80, 8, number_format($Sum_ded+$Sum_loan,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(467, 205, 80, 8, number_format($Sum_ben-$Sum_ded-$Sum_loan,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(467, 180, 80, 8, number_format($ADek,2,',','.').'  ─', 'right');
      $pdf->addTextWrap(467, 160, 80, 8, number_format($BDek,2,',','.').'  ─', 'right');
      if ($ListBox1==1) {
        $pdf->setFont('arial');
        $pdf->addTextWrap(320, 130, 235, 8, $NEW_Notes1, 'center');
        $pdf->addTextWrap(320, 120, 235, 8, $NEW_Notes2, 'center');
        $pdf->addTextWrap(320, 110, 235, 8, $NEW_Notes3, 'center');
        $pdf->addTextWrap(320, 100, 235, 8, $NEW_Notes4, 'center');
        $pdf->addTextWrap(320,  65, 235, 8, $Poli.'  ........................................................', 'left');
        $pdf->addTextWrap(340,  45, 235, 8, $NEW_TS_Head, 'left');
      }
      $F_Paid=trim(number_format($ADek+$BDek,2,',','.'));
      $P_Paid=trim(number_format($Sum_ben-$Sum_ded-$Sum_loan,2,',','.'));
      $F_Income=trim(number_format($DetailRow['A_INCOME'],2,',','.'));
      $P_Income=trim(number_format($Sum_ben,2,',','.'));
      $F_Deds=trim(number_format($Sum_ded,2,',','.'));
      $P_Deds=trim(number_format($Sum_ded,2,',','.'));
      $F_Loans=trim(number_format($DetailRow['а_LOANS'],2,',','.'));
      $P_Loans=trim(number_format($Sum_loan,2,',','.'));
      $F_Ergs=trim(number_format($DetailRow['а_ERGDED'],2,',','.'));
      $P_Ergs=trim(number_format($Sum_erg,2,',','.'));
      $PageNumber++;
    }
  }
  $pdfcode = $pdf->output();
  $len = strlen($pdfcode);
  header('Content-type: application/pdf');
  header('Content-Length: ' . $len);
  header("Content-Disposition: attachment; filename=Employees.pdf");
  header('Expires: 0');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Pragma: public');
  $pdf->stream();
}
else {
  print "<script type='text/javascript'>alert('дЕМ ЕИМАИ ЕТОИЛГ Г АПОДЕИНГ');</script>";
  print "
  <script>
  function goBack() {
    window.history.back();
  }
  </script>
  <script>goBack();</script>";
}
?>