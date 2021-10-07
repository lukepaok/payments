<?php
include ('includes/session.inc');
$afm=$_SESSION['AFM'];
$payrollcode=iconv('ISO-8859-7', 'UTF-8//TRANSLIT', $_SESSION['PayrollCode']);
$last_name = iconv('ISO-8859-7', 'UTF-8//TRANSLIT', $_SESSION['LastName']);
$first_name= iconv('ISO-8859-7', 'UTF-8//TRANSLIT', $_SESSION['FirstName']);
if (!isset($_SESSION['AFM'])) { header('Location: index.html'); }
?>

<html>
<head>
  <meta charset="UTF-8">
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
  <title>Kαλωσήρθατε</title>
</head>
<body>
  <div id="background">
    <header>
      <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header"><a class="navbar-brand" href="http://csl-test.webnode.com/">Computer Solutions</a></div>
        <div><p class="navbar-text">Συνδεδεμένος ως:<strong><?php echo $last_name ?> <?php echo $first_name ?></strong></p></div>
        <div><p class="navbar-text navbar-right"><a class="navbar-link">Αποσύνδεση</a></p></div>
      </nav>
    </header>
  </div>
  <div id="select_all">
    <form  name="input" action="Rep_Apod_control.php" method="post">
      <div id="label"><label for="myDate"><strong>Τύπος Μισθοδοσίας - Μισθολογική Περιόδος</strong></label></div>
      <select id="listbox" name="select" class="form-control">
        <option value="3">Μισθοδοσία Τακτική</option>
        <option value="6">Μισθοδοσία Βαρδιών</option>
        <option value="9">Μισθοδοσία Εφημεριών</option>
        <option value="12">Μισθοδοσία Υπερβαλλουσών Εφημεριών</option>
      </select>
      <input name="myDate" id="datepicker">
      <input type="hidden" id="payroll_code" name="payroll" value="<?php echo $payrollcode;?>">
      <input type="hidden" id="afm_code" name="afm" value="<?php echo $afm;?>">
      <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10"><input type="submit" id="submit_pdf" name="button" class="btn btn-primary" value="Αναφορά"></div>
      </div>
    </form>
  </div>
  <script type= "text/javascript" src="js/jquery-1.11.1.js"></script>
  <script type= "text/javascript" src="js/jquery-ui-1.10.4.custom.js"></script>
  <script type= "text/javascript" src="js/jquery.backstretch.js"></script>
  <script type= "text/javascript" src="js/script2.js"></script>
  <link   rel="stylesheet" type="text/css" href="css/style_b.css">
  <link   href="css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" media="screen">
  <link   href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</body>
</html>
