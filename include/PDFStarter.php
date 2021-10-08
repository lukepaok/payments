<?php
/* $Revision: 1.1 $ */

/*this class is an extension to the fpdf class using a syntax that the original reports were written in
(the R &OS pdf.php class) - due to limitation of this class for foreign character support this wrapper class
was written to allow the same code base to use the more functional fpdf.class by Olivier Plathey */
if (isset($SessionSavePath)){
	session_save_path($SessionSavePath);
}
session_start();
include('includes/GetConfig.php');

include ('includes/class.pdf.php');


If (isset($_POST['Theme'])) {
	$_SESSION['Theme'] = $_POST['Theme'];
	$theme = $_POST['Theme'];
} elseif (!isset($_SESSION['Theme'])) {
	$theme = $_SESSION['DefaultTheme'];
	$_SESSION['Theme'] = $_SESSION['DefaultTheme'];
	
} else {
	$theme = $_SESSION['Theme'];
}

if ($_SESSION['HTTPS_Only']==1){
	if ($_SERVER['HTTPS']!='on'){
		prnMsg('webERP is configured to allow only secure socket connections. Pages must be called with https:// ....','error');
		exit;
	}
}

if (!function_exists('_')) {
	function _($text){
		return $text;
	}
}
//include('includes/LanguageSetup.php');

/* Standard PDF file creation header stuff */

/*check security - $PageSecurity set in files where this script is included from */




switch ($PaperSize) {

  case 'A4_P':

      $Page_Width=595;
      $Page_Height=842;
      $Top_Margin=30;
      $Bottom_Margin=30;
      $Left_Margin=40;
      $Right_Margin=30;
      $FontSize    = 10;
      $Line_Height = 10;
      break;

  case 'A4_L':

      $Page_Width=842;
      $Page_Height=595;
      $Top_Margin=30;
      $Bottom_Margin=30;
      $Left_Margin=40;
      $Right_Margin=30;
      $FontSize    = 10;
      $Line_Height = 10;
      break;

   case 'A3_P':

      $Page_Width=842;
      $Page_Height=1190;
      $Top_Margin=50;
      $Bottom_Margin=50;
      $Left_Margin=50;
      $Right_Margin=40;
      $FontSize    = 11;
      $Line_Height = 12;
      break;

   case 'A3_L':

      $Page_Width=1190;
      $Page_Height=842;
      $Top_Margin=50;
      $Bottom_Margin=50;
      $Left_Margin=50;
      $Right_Margin=40;
      $FontSize    = 9;
      $Line_Height = 9;
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
$PageNumber   =   1;
$PageSize = array(0,0,$Page_Width,$Page_Height);
$pdf = new Cpdf($PageSize);

$pdf->AddFont('arial','','arial.php');
$pdf->AddFont('arialbold','','arialbold.php');
$pdf->AddFont('arialnbold','','arialnbold.php');
$pdf->AddFont('courier','','courier.php');
$pdf->AddFont('courierbold','','courierbold.php');
$pdf->AddFont('garamond','','garamond.php');
$pdf->AddFont('garamondbold','','garamondbold.php');
$pdf->AddFont('georgia','','georgia.php');
$pdf->AddFont('tahoma','','tahoma.php');
$pdf->AddFont('tahomabold','','tahomabold.php');
$pdf->AddFont('times','','times.php');
$pdf->AddFont('timesbold','','timesbold.php');
$pdf->AddFont('verdana','','verdana.php');
$pdf->AddFont('verdanabold','','verdanabold.php');
$pdf->addinfo('Author','Author');
$pdf->addinfo('Creator','Creator');

$pdf->selectFont('arial');

?>