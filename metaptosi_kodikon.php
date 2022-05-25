<?php
/* ----------------------------------------------------------------------------------------------------------------------------
    PAYMENTS
    metaptosi_kodikon.php
---------------------------------------------------------------------------------------------------------------------------- */
$PageSecurity = 21;
include ('includes/session.inc');
include ('include/Rep_Fill_pck.php');
include ('includes/emp.class.php');
include ('includes/ui.class.php');
$title='ΕΙΣΑΓΩΓΗ ΔΑΝΕΙΩΝ';
$Form_btns=array('PDF'=>true,      'EXCEL'=>false,   'TEXT'=>false,  'HTML'=>false,  'XML'=>false, 'CSV'=>false, 'WORD'=>false,                'CREATEDB'=>false,
                 'TPDF'=>'ΔΑΝΕΙΩΝ','TEXCEL'=>'EXCEL','TTEXT'=>'TEXT','THTML'=>'HTML','TXML'=>'XML','TCSV'=>'CSV','TWORD'=>'Insert DBLRE_GROUP','TCREATEDB'=>'Δημιουργία Πίνακα');
if ($GoReport!='') { include ('include/metaptosi_pass.php'); }
include ('Rep_Main.php');
?>