<?php
if (!headers_sent()) { header('Content-type: text/html; charset=' . _('ISO-8859-7')); }
//	include_once('displayFunctions.php');
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">';
	echo '<HTML>';
	echo '<HEAD><TITLE>Μισθοδοσία</TITLE>';
	echo '<link REL="shortcut icon" TYPE="image/ico" HREF="favicon.ico">';
	echo '<link REL="icon" HREF="favicon.ico">';
	echo '<META http-equiv="Content-Type" content="text/html; charset=' . _('ISO-8859-7') . '">';
	echo '<LINK HREF="css/'. $_SESSION['Theme'] .'/default.css" REL="stylesheet" TYPE="text/css">';
	echo '<LINK HREF="css/calendar.css" REL="stylesheet" TYPE="text/css">';
	echo '  <script type="text/javascript">';
	echo '    function deleteRow(url) {';
	echo '      if (confirm("Είστε σίγουρος για την διαγραφή της εγγραφής;/")) { ';
	echo '          top.Status_section.location.href = url;';
	echo '      }';
	echo '    }';
	echo '  </script>';
	echo '<script type="text/javascript">

		function SetAllCheckBoxes(){
			var objCheckBoxes = document.forms["chk"].elements["CHECKS"];
			// var objCheckBoxes = document.getElementById("CHECKS");
			var countCheckBoxes = objCheckBoxes.length;
				// set the check value for all check boxes
			for(var i = 0; i < countCheckBoxes; i++)
			{
					if (objCheckBoxes[i].checked == true)
					{
						objCheckBoxes[i].checked = false;
					}
					else
					{
						objCheckBoxes[i].checked = true;
					}
					
			}	
		}
	</script>';
	echo '  <script type="text/javascript">';
	//echo '    if(window.history.forward(1) != null)
    //             window.history.forward(1); ';
	//echo ' location.replace(this);';
	//echo 'window.history.forward(1);';
	echo '  </script>	';	
	
	
	echo $_SESSION['HeaderFunction'];
	
    if (!isset($_GET['Application'])) {	
	
		echo "<Script language=\"JavaScript\">";
		
		//echo "if (document.layers) { document.captureEvents(Event.KEYPRESS); } ";
		//echo "document.onkeypress = keyPressHandler(); ";
		
		echo "function addEvent(hoo,wot,fun){ ";
		echo "if(document.addEventListener) hoo.addEventListener(wot,fun,null); ";
		echo "else if(document.attachEvent) hoo.attachEvent('on'+wot,fun); ";
		echo "else hoo['on'+wot]=fun; ";
		echo "} ";		
		
		echo "addEvent(document,'keypress',catchEscape); ";
		
		echo "function catchEscape(e) { ";
		echo "e = (window.event) ? window.event : e; ";
		echo "if (e.keyCode==27) {  history.back(-1); } ";
		echo "return true; ";
		echo "}";
		
/*		echo "function getKey(keyStroke) { ";
		echo " alert(event.keyCode); ";
		echo "   var keyCode = (document.layers) ? keyStroke.which : event.keyCode; ";
		echo "   var keyString = String.fromCharCode(keyCode).toLowerCase(); ";
		echo "   var Esc = (document.layers) ? keyStroke.DOM_VK_ESCAPE : 27 ;  ";
		echo " if (keyCode==27) { history.back(); }";
		echo "} ";
		
		echo "function keyPressHandler(e) { ";
		echo " e= (window.event)? window.event: e; ";
		echo " if (e.keyCode==27){ alert('Escape!') }";
		echo "       //var kC  = (window.event) ? event.keyCode : e.keyCode;  ";
		echo "       //var Esc = (window.event) ? 27 : e.DOM_VK_ESCAPE;  ";
		echo "       //if (kC==Esc) { history.back(); } ";
		echo "}";
*/		
		echo "</Script>";	
		
    } // εάν δεν είμαστε στον αρχικό μενού

	echo '<script src="treemenu/xPandMenu.js"></script>';

	$box = new infobox();
	$box->width=200;
	$box->head('includes/');

	echo '</HEAD>';

    // onLoad="if(history.length>0)history.go(1-history.length)"
	echo '<BODY '.$_SESSION['BodyFunction'].' >';
	echo '<div id="divpage">';
	echo '<div id="divcontent">';
	echo '<img width=100% height=8 src="css/csmaintopbar.png" >';
	echo '<TABLE border=0 width=100% CLASS="callout_main" CELLPADDING="0" CELLSPACING="0">';
	echo '<TR>';
	echo '<TD align=left width=10 ><img src="css/top.jpg" ></TD>';
	echo '<TD align=left class="callout_main_right">&nbsp;</TD>';
	echo '</TR>';
	echo '</TABLE>';
	echo '<img width=100% height=8 src="css/csmainbottom.png" >';

	echo '<TABLE width="100%" CLASS="callout_main" CELLPADDING="0" CELLSPACING="0">';
	echo '<TR>';
	//echo '<TD COLSPAN="5" ROWSPAN="2">';
 	echo '<TD>';

	echo '<TABLE CLASS="main_page" ALIGN="right" CELLPADDING="0" CELLSPACING="0">';
	echo '<TR>';
	echo '<TD>';
	echo '<TABLE WIDTH="100%" border=0 CELLPADDING="0" CELLSPACING="0" >';
	echo '<TR>';
	echo '<TD CLASS="quick_menu">';

	//if ($title AND substr($title,0,4) != 'Help') {
		echo '<TABLE CELLPADDING="0" CELLSPACING="0">';
		echo '<TR>';
		echo '<TD ALIGN="left" VALIGN="middle" WIDTH="20px" CLASS="quick_menu_left">';
		echo '<A HREF="' . $rootpath . '/index.php?foreasrefresh=1">';		
		echo '<IMG SRC="' . $rootpath . '/css/' . $theme .'/images/icon-refresh.gif" WIDTH="20" HEIGHT="20" alt="">';
		echo '</A>';
		echo '</TD>';
		echo '<TD ALIGN="left" VALIGN="middle" WIDTH="100%" CLASS="quick_menu_left">';
		echo '<font size="-1">'. _('Φορέας').': <font color="red">' . $_SESSION['ForeasDescr'] . '</font>';
		echo ' &nbsp;&nbsp;&nbsp;' ;
		echo ''. _('Ημερομηνία').': <font color="red">' . $_SESSION['SystemDate'] . '</font>';
		echo '<br />' ;		
		echo '<small>'. _('Περίοδος').': <font color="red">' . $_SESSION['PayrollMonth'] . '</font></small>';
		echo ' &nbsp;&nbsp;' ;	
		echo '<small>'. _('Πληρωμή').': <font color="red">' . $_SESSION['PayrollPayMonth'] . '</font></small>';
		echo ' &nbsp;&nbsp;' ;				
		echo '<small>'. _('Ε').': <font color="red">' . $_SESSION['SystemYear'] . '</font></small>';
		echo ' &nbsp;&nbsp;' ;
		echo '<small>'. _('Σ.').': <font color="red">' . $_SESSION['PayrollSystemMasterName'] . '</font></small>';
		echo '<TD ALIGN="right" CLASS="quick_menu_left" >';
		echo '<IMG SRC="' . $rootpath . '/css/' . $theme .'/images/menucurve.gif" WIDTH="30" HEIGHT="30" alt=""></TD>';
		echo '<TD CLASS="quick_menu_tabs">';
		echo '<TABLE><TR>';
		echo '<TD CLASS="quick_menu_tabs" ALIGN="center"><A ACCESSKEY="Α" ACCESSKEY="A" HREF="' . $rootpath . '/index.php?' . SID . '" target="_top" >' . "<IMG align=\"top\" src=\"images/btnfirstpage.gif\">" . '</A>&nbsp;&nbsp;</TD>';

/*		if (count($_SESSION['AllowedPageSecurityTokens'])>1){

			echo '<TD CLASS="quick_menu_tabs" ALIGN="center"><A ACCESSKEY="2" HREF="' . $rootpath . '/SelectCustomer.php?' . SID . '"><U>2</U>. ' . _('Select Customer') . '</A>&nbsp;&nbsp;</TD>';

			echo '<TD CLASS="quick_menu_tabs" ALIGN="center"><A ACCESSKEY="3" HREF="' . $rootpath . '/SelectProduct.php?' . SID . '"><U>3</U>. ' . _('Select Item') . '</A>&nbsp;&nbsp;</TD>';

			echo '<TD CLASS="quick_menu_tabs" ALIGN="center"><A ACCESSKEY="4" HREF="' . $rootpath . '/SelectSupplier.php?' . SID . '"><U>4</U>. ' . _('Select Supplier') . '</A>&nbsp;&nbsp;</TD>';

			echo '<TD CLASS="quick_menu_tabs" ALIGN="center"><A TARGET="_blank" ACCESSKEY="8" HREF="' . $rootpath . '/doc/Manual/ManualContents.php?' . SID . '"><U>8</U>. ' . _('Manual') . '</A>&nbsp;&nbsp;</TD>';

		}
*/
		echo "<TD CLASS=\"quick_menu_tabs\" ALIGN=\"center\"><A ACCESSKEY=\"Χ\" HREF=\"" . $rootpath . "/Logout.php?" . SID . "\" target=\"_top\" onclick=\"return confirm('" . _('Είστε σίγουροι για την αποσύνδεση;') . "');\"><IMG align=\"top\" src=\"images/btndisconnect.gif\"></A></TD>";



		echo '</TR></TABLE>';
		echo '</TD></TR></TABLE>';

	//}

echo '</TD>';
echo '</TR>';
//echo '<tr><td><img width=100% height=8 src="css/csmainbottom.png" ></td></tr>';
echo '</TABLE>';

/*
echo "
<table border='0' cellspacing='0' cellpadding='0' width='100%'>
	<tr>
	<td class='main_menu'>
		<table class='main_menu' cellspacing='0'>
			<tr>
";


	$i=0;

	while ($i < count($ModuleLink)){

		// This determines if the user has display access to the module see config.php and header.inc
		// for the authorisation and security code
		if ($_SESSION['ModulesEnabled'][$i]==1)	{

		        echo "<td class='main_menu_space'>&nbsp;</td>";

			// If this is the first time the application is loaded then it is possible that
			// SESSION['Module'] is not set if so set it to the first module that is enabled for the user
			if (!isset($_SESSION['Module'])OR $_SESSION['Module']==''){
				$_SESSION['Module']=$ModuleLink[$i];
			}
			if ($ModuleLink[$i] == $_SESSION['Module']){
				echo "<td class='main_menu_selected'><a ACCESSKEY=\"".($i+1)."\" \"target=\"_top\" href='index.php?". SID . '&Application='. $ModuleLink[$i] ."' >". $ModuleList[$i] .'</a></td>';
                                echo "<td class='main_menu_space'>&nbsp;</td>";
			} else {

				$mouse = $box->newtip($ModuleList[$i],$ModuleDescr[$i]);

				echo "<td class='main_menu_unselected'><a$mouse ACCESSKEY=\"".($i+1)."\" target=\"_top\" href='index.php?". SID . '&Application='. $ModuleLink[$i] ."' >". $ModuleList[$i] .'</a></td>';
                                echo "<td class='main_menu_space'>&nbsp;</td>";
			}
		}
		$i++;
	}


echo '
			</tr>
		</table>
	</td>
	</tr>
</table>';

*/
echo '
<TABLE class="main_menu2" BORDER="0" CELLSPACING="0" CELLPADDING="0">
<TR height="7"><TD width="20"></TD></TR>
<TR>';


	$i=0;
	
	$modFirst = 0;
	$modLast = count($ModuleLink)-1;
	
	// find 1st module enabled
	while ($i < count($ModuleLink)){
		if ($_SESSION['ModulesEnabled'][$i]==1)	{
			$modFirst = $i;
			break;
		}
		$i++;
	}
	
	//echo $modFirst;
	
	$i=0;	
	
	// find last module enabled
	while ($i < count($ModuleLink)){
		if ($_SESSION['ModulesEnabled'][$i]==1)	{
			$modLast = $i;
		}
		$i++;
	}	

	//echo $modLast;
	
	//echo '<TD><IMG SRC="images/tabs/spacer30.gif"></TD>';

	$i=0;	
	
	
	while ($i < count($ModuleLink)){

		// This determines if the user has display access to the module see config.php and header.inc
		// for the authorisation and security code
		if ($_SESSION['ModulesEnabled'][$i]==1)	{

		        //echo "<td class='main_menu_space'>&nbsp;</td>";


			// If this is the first time the application is loaded then it is possible that
			// SESSION['Module'] is not set if so set it to the first module that is enabled for the user
			if (!isset($_SESSION['Module'])OR $_SESSION['Module']==''){
				$_SESSION['Module']=$ModuleLink[$i];
			}
			if ($ModuleLink[$i] == $_SESSION['Module']){
			    if ($i==$modFirst) {//($i==0) {
			       echo '<TD><IMG SRC="images/tabs/tabs_white_under_dblue.gif"></TD>';
			    } else {
				   echo '<TD><IMG SRC="images/tabs/tabs_lblue_under_dblue.gif"></TD>';
				}

				// echo "<td class='main_menu_selected2'><a ACCESSKEY=\"".($i+1)."\" \"target=\"_top\" href='index.php?". SID . '&Application='. $ModuleLink[$i] ."' >". $ModuleList[$i] .'</a></td>';
				//echo "<td class='main_menu_selected2'><a ACCESSKEY=\"".($i+1)."\" \"target=\"_top\" href='index.php?".'Application='. $ModuleLink[$i] ."' >". $ModuleList[$i] .'</a></td>';
				echo "<td class='main_menu_selected2'><a \"target=\"_top\" href='index.php?".'Application='. $ModuleLink[$i] ."' >". $ModuleList[$i] .'</a></td>';

				if ($i==$modLast) {//($i==count($ModuleLink)-1) {
			       echo '<TD><IMG SRC="images/tabs/tabs_dblue_over_white.gif"></TD>';
			    } else {
				   echo '<TD><IMG SRC="images/tabs/tabs_dblue_over_lblue.gif"></TD>';
				}

			} else {

				$mouse = $box->newtip($ModuleList[$i],$ModuleDescr[$i]);
				if ($i==$modFirst) {
			       echo '<TD><IMG SRC="images/tabs/tabs_white_under_lblue.gif"></TD>';
			    } else {
				   //echo '<TD><IMG SRC="images/tabs/tabs_lblue_under_dblue.gif"></TD>';
				}
				//echo "<td class='main_menu_unselected2'><a$mouse ACCESSKEY=\"".($i+1)."\" target=\"_top\" href='index.php?". SID . '&Application='. $ModuleLink[$i] ."' >". $ModuleList[$i] .'</a></td>';
				//echo "<td class='main_menu_unselected2'><a$mouse ACCESSKEY=\"".($i+1)."\" target=\"_top\" href='index.php?".'Application='. $ModuleLink[$i] ."' >". $ModuleList[$i] .'</a></td>';
                echo "<td class='main_menu_unselected2'><a$mouse target=\"_top\" href='index.php?".'Application='. $ModuleLink[$i] ."' >". $ModuleList[$i] .'</a></td>';				
                                //echo "<td class='main_menu_space'>&nbsp;</td>";
				if ($i==$modLast) {//($i==count($ModuleLink)-1) {
			       echo '<TD><IMG SRC="images/tabs/tabs_lblue_over_white.gif"></TD>';
			    } else {
			       if ($ModuleLink[$i+1] != $_SESSION['Module']){
				   		echo '<TD><IMG SRC="images/tabs/tabs_lblue_over_lblue.gif"></TD>';
				   }
				}
			}
		}
		$i++;
	}



echo '
</TR>
</TABLE>
<TABLE class="main_menu2" width="100%" height="5" BORDER="0" CELLSPACING="0"  CELLPADDING="0">
<TR>
	<TD>';

echo '<img width=100% height=8 src="css/csmaintopbar.png" >';

echo '</TD>
</TR>
</TABLE>';


if ($title!='') {
	echo "<table class=\"HeaderBox\"><tr><td class=\"HeaderBox\">$title</td></tr></table>";
}


?>