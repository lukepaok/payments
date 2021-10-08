<?php
ERROR_REPORTING("~E_ALL");

/* $Revision: 1.16 $ */

   echo '<BR><BR>';
   echo '</TD>';
   echo '</TR>';
   echo '</TABLE>';

   echo '</TD>';

   echo '</TABLE>';

   echo '</div>';

   echo '<div id="divbottombuttons" >';

   if (isset($_SESSION['accesskeys']) and count($_SESSION['accesskeys'])>1) {

      echo '<table width="789px" style="padding: 0px; border-bottom: 1px solid #999999; border-top: 1px solid #999999; bottom: 0px; top:0px; position: relative; " >';
      echo "<tr>";

      echo "<td >&nbsp</td>";

      $accessarr = $_SESSION['accesskeys'];

      foreach ($accessarr as $key => $value) {

         if ($key!=0) {

         echo "<td style=\"width:120px\" >ALT+".$key." - ".$value."</td>";

         }

      }

      echo "</tr>";
      echo '</table>';

   }

   echo "</div>";

   echo '<div id="divfooter" >';

   echo '<img  width="100%" height="9" src="css/csmainbottom.png">';

   echo '<p align="center" CLASS="footer" >';
   echo 'Διαχείριση Μισθοδοσίας - ' . _('Copyright') . ' &copy; Computer Solutions S.A. - 2012';
   echo ' - ' . _('Version') . ' - ' . $_SESSION['AppVersion'] . ' &nbsp &nbsp &nbsp &nbsp &nbsp [ '. $_SESSION['GLInstall'] . ' - ' . $host . ' - '.$dbuser . ' - Ver.'.$_SESSION['DBVersion'] .' ] ';
   echo '</p>';

   echo '</div>';

   echo '</div>';

   $box->generate();

   echo '</BODY>';
   echo '</HTML>';

?>
