 <?php
 
 
 global $db;

  $sql2  = "SELECT * from employess ";
  $RES2 = DB_query($sql2,$db);
  

   
  
  
  while ($DetailRow2=DB_fetch_array($RES2)) {
        	   
	   $sql3 = " insert into \"ACCESS\" (ACC_ID,EMP_ID,BRA_ID,FOR_ID,ACC_USERNAME, ACC_PASSWORD,ACC_REALNAME) VALUES( ";
       $sql3 .= "'',";
	   $sql3 .= "'".$DetailRow2['EMP_ID']."',";
	   $sql3 .= "'0',";
	   $sql3 .= "'0',";
	   $sql3 .= "'".$DetailRow2['EMP_TAX_NUMBER']."',";
	   $sql3 .= "'".$DetailRow2['EMP_PAYROLL_CODE']."',";
	   $sql3 .= "'".$DetailRow2['EMP_LAST_NAME']." ".$DetailRow2['EMP_FIRST_NAME']."')";
	   $RES3 = DB_query($sql3,$db); //dont trap errors here
	  
		
	}
	
	echo'текос диадийасиас';die();
	
	?>