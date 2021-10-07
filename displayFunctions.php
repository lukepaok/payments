<?php

function startBox($width="100%",$margintop="0px",$marginleft="0px",$marginbottom="0px",$marginright="0px") {
  echo '<table class="myborder" style="width: '.$width.'; margin-top: '.$margintop.'; margin-left: '.$marginleft.'; margin-bottom: '.$marginbottom.'; margin-right: '.$marginright.'; " ';
  echo 'cellspacing="0" cellpadding="0" border="0">';
  echo '  <tr>';
  echo '    <td>';
}

function endBox() {
  echo '    </td>';
  echo '  </tr>';
  echo '</table>';
}

function toggle(&$tog, $ret_value=NULL) {
  if (!$tog) {
    if ($ret_value!==NULL) { $tog=$ret_value; }
    else { $tog=1; }
  }
  else { $tog=NULL; }
}

function ezTable($data_array, $cellpadding=0, $cellspacing=0, $border=0, $width=0, $th=FALSE, $toggle=FALSE, $valign=NULL, $class=NULL, $width_array=NULL){
  $high_column = 0;
  $bg = $cell_width = $background = $table_width = NULL;
  if (!is_array($data_array)) return FALSE;
  foreach ($data_array as $row_count){
    if ($high_column < count($row_count))
      $high_column = count($row_count);
  }
  reset ($data_array);
  if (is_array($width_array)) {
    foreach ($width_array as $col_width){
			$col_style[] = " style=\" align:left; width:".$col_width."px; overflow:hidden; \" ";
    }
	};
  if ($class) $background = " class=\"$class\"";
  if ($width){
    $width_per_cell = (int)floor(100/$high_column);
    $cell_width = " width=\"".$width_per_cell."%\"";
    $table_width = " width=\"".$width."%\"";
  }
  if ($valign) $vert = " valign=\"".$valign."\" ";
  else $vert = " valign=\"top\" ";
  if ($high_column){
    $table = "<table style=\"table-layout: fixed;\" cellpadding=\"$cellpadding\" cellspacing=\"$cellspacing\" border=\"$border\"". $table_width . $background.">";
  foreach ($data_array as $row_array){
    if ($toggle)
      toggle($bg, " class=\"".$class."_light"."\"");
      $table .= "<tr>";
      // Για να βρούμε πόσα στοιχεία έχει η γραμμή
  		$thisrowcount=count($row_array);
      for ($j=0; $j < $high_column; $j++){
        if ($th && !$loop)
	  	//$table .= "<th" . $cell_width . ">$row_array[$j]</th>";
		  	$table .= "<th" . $col_style[$j] . " " . ">$row_array[$j]</th>";
          else
		  	//$table .= "<td " . $bg . $cell_width . $vert .">$row_array[$j]</td>";
		  	//$table .= "<td " . $bg . $col_style[$j].$vert ."><div style=\"overflow:auto;\" > $row_array[$j]</div></td>";
		  	//$colspan="";
		  	//echo $j."-".$thisrowcount."<br>";
		  	
		  	// Αν οι τιμές είναι μικρότερες από το header τότε στην τελευταία βάλε colspan για τις υπόλοιπες
		  	if ($j==($thisrowcount-1) and ($thisrowcount<$high_column)) {
		  		
		  		$table .= "<td width=\"100%\" rowspan=\"1\" colspan=\"".($high_column-$thisrowcount+1)."\" ". $bg . $vert .">$row_array[$j]</td>";
		  		
		  	} else if ($j>($thisrowcount-1)) {
		  		//$colspan = " colspan=".($high_column-$thisrowcount-1)." ";
		  		//echo $j." ".$colspan."<BR>";
		  		//$table .= "<td></td>";
		  	} else {
		  	
		  		// Το κανονικό
		  		$table .= "<td " . $bg . $col_style[$j].$vert .">$row_array[$j]</td>";	
		  	}
		  	
			
        }
        $loop = 1;
        $table .= "</tr>";
      }
      $table .= "</table>";

      return $table;
    } else return NULL;
  }// END FUNC ezTable()



?>