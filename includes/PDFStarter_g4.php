<?php
/* ----------------------------------------------------------------------------------------------------------------------------
    PAYROLL
    PDFStarter_g4.php
    2.0.0.2
    include:  GetConfig.php, class.pdf.php
    notes:    this class is an extension to the fpdf class using a syntax that the original reports were written in
              (the R &OS pdf.php class) - due to limitation of this class for foreign character support this wrapper class
              was written to allow the same code base to use the more functional fpdf.class by Olivier Plathey
   ---------------------------------------------------------------------------------------------------------------------------- */

if (isset($SessionSavePath)) { session_save_path($SessionSavePath); }
session_start();
include('includes/GetConfig.php');
include ('includes/class.pdf.php');
If (isset($_POST['Theme'])) {
  $_SESSION['Theme'] = $_POST['Theme'];
  $theme = $_POST['Theme'];
}
elseif (!isset($_SESSION['Theme'])) {
  $theme = $_SESSION['DefaultTheme'];
  $_SESSION['Theme'] = $_SESSION['DefaultTheme'];
}
else { $theme = $_SESSION['Theme']; }

if ($_SESSION['HTTPS_Only']==1) {
  if ($_SERVER['HTTPS']!='on') {
    prnMsg('webERP is configured to allow only secure socket connections. Pages must be called with https:// ....','error');
    exit;
  }
}
//include('includes/LanguageSetup.php');
if (!function_exists('_')) {
  function _($text){
    return $text;
  }
}

// Standard PDF file creation header stuff
// check security - $PageSecurity set in files where this script is included from
if (! in_array($PageSecurity,$_SESSION['AllowedPageSecurityTokens']) OR !isset($PageSecurity)){
  $title = _('Permission Denied Report');
//  include('includes/header.inc');
  echo '<BR><BR><BR><BR><BR><BR><BR><CENTER><FONT COLOR=RED SIZE=4><B>' . _('The security settings on your account do not permit you to access this function') . '</B></FONT>';
  include('includes/footer.inc');
  exit;
}

if (!isset($PaperSize)) { $PaperSize = $_SESSION['DefaultPageSize']; }

switch ($PaperSize) {
  case 'A4':
    $Page_Width=595;
    $Page_Height=842;
    $Top_Margin=30;
    $Bottom_Margin=30;
    $Left_Margin=40;
    $Right_Margin=30;
    break;
  case 'A4_Landscape':
    $Page_Width=842;
    $Page_Height=595;
    $Top_Margin=30;
    $Bottom_Margin=30;
    $Left_Margin=40;
    $Right_Margin=30;
    break;
  case 'A3':
    $Page_Width=842;
    $Page_Height=1190;
    $Top_Margin=50;
    $Bottom_Margin=50;
    $Left_Margin=50;
    $Right_Margin=40;
    break;
  case 'A3_landscape':
    $Page_Width=1190;
    $Page_Height=842;
    $Top_Margin=50;
    $Bottom_Margin=40;
    $Left_Margin=10;
    $Right_Margin=10;
    break;
  case 'letter':
    $Page_Width=612;
    $Page_Height=792;
    $Top_Margin=30;
    $Bottom_Margin=30;
    $Left_Margin=30;
    $Right_Margin=25;
    break;
  case 'letter_landscape':
    $Page_Width=792;
    $Page_Height=612;
    $Top_Margin=30;
    $Bottom_Margin=30;
    $Left_Margin=30;
    $Right_Margin=25;
    break;
  case 'legal':
    $Page_Width=612;
    $Page_Height=1008;
    $Top_Margin=50;
    $Bottom_Margin=40;
    $Left_Margin=30;
    $Right_Margin=25;
    break;
  case 'legal_landscape':
    $Page_Width=1008;
    $Page_Height=612;
    $Top_Margin=50;
    $Bottom_Margin=40;
    $Left_Margin=30;
    $Right_Margin=25;
    break;
}

$PageSize = array(0,0,$Page_Width,$Page_Height);
$pdf = & new Cpdf($PageSize);

$pdf->AddFont('arial','','arial.php');
$pdf->AddFont('timesbold','','timesbold.php');
$pdf->AddFont('arialbold','','arialbold.php');
$pdf->addinfo('Author','Reports ' . $Appl_Version);
$pdf->addinfo('Creator','Reports');

/*depending on the language this font is modified see includes/class.pdf.php
   selectFont method interprets the text helvetica to be:
   for Chinese - BIg5
   for Japanese - SJIS
   for Korean - UHC
*/
$pdf->selectFont('arial');

//$pdf->AddFont('tahomabold','','tahomabold.php');
//$pdf->AddFont('arialbold','','arialbold.php');
//$pdf->AddFont('arialnbold','','arialnbold.php');
//$pdf->AddFont('courierbold','','courierbold.php');
//$pdf->AddFont('courier','','courier.php');
//$pdf->AddFont('garamond','','garamond.php');
//$pdf->AddFont('garamondbold','','garamondbold.php');
//$pdf->AddFont('georgia','','georgia.php');
//$pdf->AddFont('tahoma','','tahoma.php');
//$pdf->AddFont('times','','times.php');
//$pdf->AddFont('verdana','','verdana.php');
//$pdf->AddFont('verdanabold','','verdanabold.php');
?>