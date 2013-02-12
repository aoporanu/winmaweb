<?php
// Bobi
// 5.09.2012
    echo 1:die ;
    
    
if (isset($_GET["email"]) {
				$email = $_GET["email"];
			
				$result = login( $email);
				echo $result;
				}

function makeSqlConnection()
{
$DB_HostName = "localhost";
$DB_Name = "city";
$DB_User = "bobi";
$DB_Pass = "bresti";

	$con = mysql_connect($DB_HostName,$DB_User,$DB_Pass) or die(mysql_error()); 

		mysql_select_db($DB_Name,$con) or die(mysql_error()); 

	return $con;
}

function disconnectSqlConnection($con)
{
	mysql_close($con);
}
 
function login($email, $password)
{
	//require (FILE);
	$con = makeSqlConnection();

	
	$sql = "select * from user  where email = '$email' ";
	$res = mysql_query($sql,$con) or die(mysql_error());
	
	$res1 = mysql_num_rows($res);

	disconnectSqlConnection($con);
	
	 if ($res1 != 0) {
		return 1;
	}else{
		return 0;
	}// end else
	
	
}// end of Function 

?>