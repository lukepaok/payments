<?php


//function definitions



//returns the foreignKeyname of a key in a given table

function foreignKeyname($tablename, $rKeyname) {

    global $keyMapping;



    foreach ($keyMapping as $fk => $keyname)

        if (($rKeyname == $keyname) && (GetTablename($fk) == $tablename)) return $fk;



    assert(false);

}

function foreignKeynamenm($tablename, $rKeyname) {

    global $keyMapping;



    foreach ($keyMapping as $fk => $keyname)

        if (($rKeyname == $keyname) ) return $fk;



    assert(false);

}



//returns an array with qualified fieldNames

//example: Qualify ("someTable", array ("name", "sNr")  )

//         returns ("someTable.name", "someTable.snr")

function Qualify($tablename, $colArray) {

    $i =0;

    $result = array ();



    foreach($colArray as $el)

        $result[$i++] = "$tablename.$el";



    return $result;

}



//Qualifies and makes an alias of each element in the array

function QualifyAndAlias($tablename, $colArray) {

    $i =0;

    $result = array ();



    foreach($colArray as $el)

        $result[$i++] = "$tablename.$el AS '$tablename.$el'";



    return $result;

}



//Returns "field" if called with "table.field"

function Dequalify($colName) {

    $result = '';



    $pos = strrpos($colName, ".");

    $result = substr($colName,$pos+1);



    return $result;

}



//Returns the tablename of a qualified fieldname

function GetTablename($colName) {

    $result = '';



    $pos = strrpos($colName, ".");

    $result = substr($colName,0,$pos);



    return $result;

}



//encloses the $fieldValue in '' pairs if necessary (= if the value is a string)

function format($fieldValue,$fieldname, $tablename='default') {

    global $mainTableDataTypes, $nmTables_DataTypes, $mainTablename;



    $result = '';

    if ($tablename == 'default') $tablename = $mainTablename;



    if ( $tablename == $mainTablename ) { //mainTable

        //if ( (substr_count($mainTableDataTypes[$fieldname],'VARCHAR') > 0) || ($mainTableDataTypes[$fieldname] == 'DATE') )

            $result = "'$fieldValue'";

        //else

        //    $result = "$fieldValue";

    }elseif ( isset($nmTables_DataTypes[$tablename]) ) { //nmTable

        //if ( (substr_count($nmTables_DataTypes[$tablename][$fieldname],'VARCHAR') > 0)  || ($mainTableDataTypes[$fieldname] == 'DATE') )

            $result = "'$fieldValue'";

        //else

        //    $result = "$fieldValue";

    }else

        assert(0);



    return $result;

}



//For PHP versions before 4.1.0 (replacement for array_key_exists())

function arrayKeyExists($key, $search) {

   if (in_array($key, array_keys($search))) {

       return true;

   } else {

       return false;

   }

}



//Tests if two arrays are equal;

//Equal means that they have the same key=>value pairs

function arraysEqual($array1, $array2) {



    //they must have the same length

    $c = count($array1);

    $d = count($array2);

    if ($c != $d) return false;



    foreach($array1 as $key=>$val) {

        if (! arrayKeyExists($key, $array2)) return false;

        if ($array2[$key] != $val) return false;

    }



    return true;

}



//For PHP versions before 4.3.0 (replacement for array_intersect_assoc)

//Computes the intersection of arrays with additional index check

function arrayIntersectAssoc($array1, $array2) {

    $returnArray = array();



    foreach($array1 as $key=>$val) {

        if ( (arrayKeyExists($key, $array2)) and ((string) $array2[$key] === (string) $val) ) {

            $returnArray[$key] = $val;

        }

    }



    return $returnArray;

}



function hex2bin($hexdata) {



  $bindata = '';

  for ($i=0;$i<strlen($hexdata);$i+=2) {

    $bindata .= chr(hexdec(substr($hexdata,$i,2)));

  }



  return $bindata;

}

/**
* check to see if a string is in valid email address format
*
* @param [string] email address string
* @return true or false
*/

function is_email($string)
{
	// Remove whitespace
	$string = trim($string);

	$ret = ereg(
				'^([a-zA-Z0-9_&]|\\-|\\.)+'.
				'@'.
				'(([a-zA_Z0-9_&]|\\-)+\\.)+'.
				'[a-zA_Z]{2,4}$',
				$string);

	return($ret);
}

function browser_get_agent () {

	$HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];

	$browser=array();
	if (ereg( 'MSIE ([0-9].[0-9]{1,2})',$HTTP_USER_AGENT,$log_version)) {
		$browser["version"]=$log_version[1];
		$browser["agent"]='IE';
	} elseif (ereg( 'Opera ([0-9].[0-9]{1,2})',$HTTP_USER_AGENT,$log_version)) {
		$browser["version"]=$log_version[1];
		$browser["agent"]='OPERA';
	} elseif (ereg( 'Mozilla/([0-9].[0-9]{1,2})',$HTTP_USER_AGENT,$log_version)) {
		$browser["version"]=$log_version[1];
		$browser["agent"]='MOZILLA';
	} else {
		$browser["version"]=0;
		$browser["agent"]='OTHER';
	}
	if (ereg( 'Gecko\/([0-9]*)',$HTTP_USER_AGENT,$log_version)) {
		$browser["gecko_version"]=$log_version[1];
	}
	if (strstr($HTTP_USER_AGENT,'Win')) {
	$browser["platform"]='Win';
	} else if (strstr($HTTP_USER_AGENT,'Mac')) {
	$browser["platform"]='Mac';
	} else if (strstr($HTTP_USER_AGENT,'Linux')) {
	$browser["platform"]='Linux';
	} else if (strstr($HTTP_USER_AGENT,'Unix')) {
	$browser["platform"]='Unix';
	} else {
	$browser["platform"]='Other';
	}
		return $browser;
}

function make_clickable($text){

	$text = eregi_replace('([[:space:]]|^)(www)', '\\1http://\\2', $text); // no prefix (www.myurl.ext)
	$prefix = '(http|https|ftp|telnet|news|gopher|file|wais)://';
	$pureUrl = '([[:alnum:]/\n+-=%&:_.~?]+[#[:alnum:]+]*)';
	$text = eregi_replace($prefix . $pureUrl, '<a href="\\1://\\2" target="_blank">\\1://\\2</a>', $text);

	// e-mail addresses
	$text = eregi_replace('([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)', '<a href="mailto:\\1">\\1</a>', $text);

	return $text;

}

?>