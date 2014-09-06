<?php
session_start();
set_time_limit(0);
include ("db/db_connect.php");
date_default_timezone_set('Asia/Calcutta'); 
$ipaddress = $_SERVER["REMOTE_ADDR"];
$updatedatetime = date('Y-m-d H:i:s');
$dateonly = date('Ymd');
$timeonly = date('His');

if (isset($_REQUEST["username"])) { $username = $_REQUEST["username"]; } else { $username = ""; }
//$username = $_SESSION["username"];

//This file applies updates to database. 
//Run this file after updating php files.
//File Created On 31Jan2013

//Please Apply All Updates Prior To 31Jan2013 Manually. Then Run This For Updating Automated.

if (isset($_REQUEST["submit"])) { $submit = $_REQUEST["submit"]; } else { $submit = ""; }

if ($submit == 'Yes. Proceed.')
{

	echo "<br><br>Update Started : ".$updatedatetime;
	
	//Update Process Steps : Hospital Software / Running Folder Name - simaclehospital
	//Customer Clicks Update Software Now Link. 
	//Create File Name Variable With Date_Time Stamp To assign to folder and db.
	
	$originalfoldername = 'simaclehospital';
	$backupfoldername = 'simaclehospital_'.$dateonly.'_'.$timeonly;
	$backupdatabasename = 'simaclehospital'.$dateonly.$timeonly;
	
	//**************************************************************************************************************//
	//Create copy of existing running database as sql file and save under db folder with dbname_date_time.sql name format.
	//Values From db_connect.php file.
	$localhost = $hostname;
	$dbusername = $hostlogin;
	$password = $hostpassword;
	$databasename = $databasename;
	
	/*
	backup_tables($localhost, $dbusername, $password, $databasename);
	
	//backup the db OR just a table
	function backup_tables($host,$user,$pass,$name,$tables = '*')
	{
		$dateonly = date('Ymd');
		$timeonly = date('His');
		$backupfoldername = 'simaclehospital_'.$dateonly.'_'.$timeonly;
		$backupdatabasename = 'simaclehospital'.$dateonly.$timeonly;
	
		$backuptime = date('YMd_His');
		$backupdatabasefiletime = date('Y-m-d H:i:s');
		if (isset($_REQUEST["username"])) { $username = $_REQUEST["username"]; } else { $username = ""; }
		//$username = $_SESSION["username"];
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		
		$backupdatabasefilename = $backupdatabasename.'.sql';
		$backupdatabasefiletime =  $backupdatabasefiletime;
		
		//$query1db = "insert into master_backupdatabase (backupfilename, backupfiledate, username, ipaddress) 
		//values ('$backupdatabasefilename', '$backupdatabasefiletime', '$username', '$ipaddress')";
		//$exec1db = mysql_query($query1db) or die ("Error in Query1db".mysql_error());
	
		$return = '';
		$link = mysql_connect($host,$user,$pass);
		mysql_select_db($name,$link);
		
		//get all of the tables
		if($tables == '*')
		{
			$tables = array();
			$result = mysql_query('SHOW TABLES');
			while($row = mysql_fetch_row($result))
			{
				$tables[] = $row[0];
			}
		}
		else
		{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
		
		//cycle through
		foreach($tables as $table)
		{
			$result = mysql_query('SELECT * FROM '.$table);
			$num_fields = mysql_num_fields($result);
			
			//$return.= 'DROP TABLE '.$table.';';
			$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
			
			for ($i = 0; $i < $num_fields; $i++) 
			{
				while($row = mysql_fetch_row($result))
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);
						
						//Slash after and before double quote is compulsory.
						$patterns = "/\n/";
						$replacements = "/\\n/";
						$string = $row[$j]; 
						
						//$row[$j] = preg_replace("\n","\\n",$row[$j]); 
						$row[$j] = preg_replace($patterns, $replacements, $string);
						
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}
	
		//save file
		//$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
		
		$handle = fopen('zbackupdatabasefiles/'.$backupdatabasename.'.sql','w+'); //z given to list folders at the end.
		fwrite($handle,$return);
		fclose($handle);
		
		
	}
	*/
	//**********************************************************************************************************************//
	
	//Create copy of existing running database inside xampp phpmyadmin with dbname_date_time name format.
	
	//http://stackoverflow.com/questions/4262876/how-to-copy-database-tables-and-each-record-from-one-database-server-to-another
	
	/*
	//($localhost, $dbusername, $password, $databasename)
	//Desitnation Database Connect.
	$destinationdatabase1 = $backupdatabasename; // destination database
	$destinationdbconnect1 = mysql_connect($localhost, $dbusername, $password);
	$query1createdb = "CREATE DATABASE $destinationdatabase1";
	$exec1createdb = mysql_query($query1createdb) or die ("Error in Query1createdb".mysql_error());
	
	mysql_select_db($destinationdatabase1, $destinationdbconnect1);
	
	$originaldatabase1 = $databasename; //original database
	$orginalconnect1 = mysql_connect($localhost, $dbusername, $password);
	
	mysql_select_db($originaldatabase1, $orginalconnect1);
	
	$tables = mysql_query("SHOW TABLES FROM $originaldatabase1");
	
	while ($line = mysql_fetch_row($tables)) 
	{
		$tab = $line[0];
		mysql_query("DROP TABLE IF EXISTS $destinationdatabase1.$tab");
		mysql_query("CREATE TABLE $destinationdatabase1.$tab LIKE $originaldatabase1.$tab") or die(mysql_error());
		mysql_query("INSERT INTO $destinationdatabase1.$tab SELECT * FROM $originaldatabase1.$tab");
		//echo "Table: <b>" . $line[0] . " </b>Done<br>";
	}
	//*/
	
	//*********************************************************************************************************************//
	
	//Create copy of existing running software folder with folder_date_name format.
	
	//$source = '../sourcefolder';
	//$destination = '../destinationfolder';
	
	/*
	$source = '../'.$originalfoldername;
	$destination = '../'.$backupfoldername;
	
	copy_directory ( $source, $destination );
	
	function copy_directory( $source, $destination ) 
	{
		if ( is_dir( $source ) ) 
		{
			@mkdir( $destination );
			$directory = dir( $source );
			while ( FALSE !== ( $readdirectory = $directory->read() ) ) 
			{
				if ( $readdirectory == '.' || $readdirectory == '..' ) 
				{
					continue;
				}
				$PathDir = $source . '/' . $readdirectory; 
				if ( is_dir( $PathDir ) ) 
				{
					copy_directory( $PathDir, $destination . '/' . $readdirectory );
					continue;
				}
				copy( $PathDir, $destination . '/' . $readdirectory );
			}
			
			$directory->close();
		}
		else 
		{
			copy( $source, $destination );
		}
	}
	
	//*/
	
	//**********************************************************************************************//
	
	/*
	//Download Updated zipped folder containg latest files under xampp/simacle_billing_updates folder and 
	//rename as date_time_stamp name.
	
	// folder to save downloaded files to. must end with slash
	$download_url = 'http://www.simpleindia.com/softwareupdates/simacle_billingretail_update.zip';
	
	$destination_folder_name = 'updates_download';
	$destination_folder_path = $destination_folder_name.'/';
	@mkdir( '../'.$destination_folder_name );
	
	$file = fopen ($newfname, "rb");
	$newfname = '../'.$destination_folder_path . basename($download_url);
	
	$file = fopen ($download_url, "rb");
	if ($file) 
	{
		$newf = fopen ($newfname, "wb");
		
		if ($newf)
		while(!feof($file)) 
		{
			fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
		}
	}
	
	if ($file) 
	{
		fclose($file);
	}
	
	if ($newf) 
	{
		fclose($newf);
	}
	*/
	
	//******************************************************************************************************//
	
	
	
	//Unzipp downloaded file to specific location. To get db and other files.
	//Code working on xampp 1.7 and above.
	/*
	$zip = new ZipArchive;
	//$zip->open('../downloads/hospital-live-09Apr2013-0658PM.zip');
	$zip->open('updates_download/hospital-live-09Apr2013-0658PM.zip');
	//$zip->extractTo('../downloads/');
	$zip->extractTo('updates_download/');
	$zip->close();
	*/
	
	
	
	//*********************************************************************************************************//
	
	//To compare running and revised database to update the missing tables and columns and update data types.
	
	$comparisonsourcedatabasename = 'simaclehospitalcomparesource';
	$comparisondestinationdatabasename = 'simaclehospitaldestination';

	//To find compare source database already exists. If not create it.
	///*
	$query1compare = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$comparisonsourcedatabasename' ";
	$exec1compare = mysql_query($query1compare) or die ("Error in Query1compare".mysql_error());
	$rowcount1compare = mysql_num_rows($exec1compare);
	if ($rowcount1compare != 0)
	{
		//To drop the existing comparison source database.
		$query2compare = "DROP database $comparisonsourcedatabasename";
		//$exec2compare = mysql_query($query2compare) or die ("Error in Query1compare".mysql_error());

		//To create new comparison source database.
		$query3compare = "CREATE DATABASE $comparisonsourcedatabasename";
		//$exec3compare = mysql_query($query3compare) or die ("Error in Query3compare".mysql_error());
	}
	else
	{
		//To create new comparison source database.
		$query3compare = "CREATE DATABASE $comparisonsourcedatabasename";
		//$exec3compare = mysql_query($query3compare) or die ("Error in Query3compare".mysql_error());
	}
	//*/
	
	
	
	
	//To dump the comparison source database into created database.
	//Here is a memory-friendly function that should be able to split a big file in individual queries without needing to open the whole file at once
	//http://stackoverflow.com/questions/1883079/best-practice-import-mysql-file-in-php-split-queries/2011454#2011454
	
	$hostname = 'localhost';
	$username = 'root';
	$password = '';
	$comparisonsourcedatabasename = 'simaclehospitalcomparesource';
	
	//Desitnation Database Connect.
	//$comparisondestinationdatabasename = 'simaclehospitaldestination';
	$destinationdbconnect1 = mysql_connect($localhost, $dbusername, $password);
	$query1compare = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$comparisondestinationdatabasename' ";
	$exec1compare = mysql_query($query1compare) or die ("Error in Query1compare".mysql_error());
	$rowcount1compare = mysql_num_rows($exec1compare);
	if ($rowcount1compare != 0)
	{
		//Do Nothing
	}
	else
	{
		//To create new comparison source database.
		$query3compare = "CREATE DATABASE $comparisondestinationdatabasename";
		$exec3compare = mysql_query($query3compare) or die ("Error in Query3compare".mysql_error());
	}

	mysql_select_db($comparisondestinationdatabasename, $destinationdbconnect1);


	/*
	
	$comparisonsourcedatabaseconnect = mysql_connect($hostname, $username, $password, true); 
	mysql_select_db($comparisonsourcedatabasename, $comparisonsourcedatabaseconnect);
	
	$comparisonsourcedatabasefilename = 'updates_download/simaclehospitalcomparesource.sql';
	$comparisonsourcedatabasecontents = file_get_contents('updates_download/simaclehospitalcomparesource.sql');
	//$comparisonsourcedatabasecontents = addslashes($comparisonsourcedatabasecontents);
	//$query4compare = $comparisonsourcedatabasecontents;
	//$exec4compare = mysql_query($query4compare) or die ("Error in Query4compare".mysql_error());
	
	$file = $comparisonsourcedatabasefilename;
	//$fileimport1 = SplitSQL();
	
	//function SplitSQL($file, $delimiter = ';')
	//{
		set_time_limit(0);
		$delimiter = ';';
	
		if (is_file($file) === true)
		{
			$file = fopen($file, 'r');
	
			if (is_resource($file) === true)
			{
				$query = array();
	
				while (feof($file) === false)
				{
					$query[] = fgets($file);
	
					if (preg_match('~' . preg_quote($delimiter, '~') . '\s*$~iS', end($query)) === 1)
					{
						$query = trim(implode('', $query));
	
						if (mysql_query($query, $comparisonsourcedatabaseconnect) === false)
						{
							//echo '<h3>ERROR: ' . $query . '</h3>' . "\n";
							//echo '<br><br>';
							echo mysql_error();
						}
	
						else
						{
							//echo '<h3>SUCCESS: ' . $query . '</h3>' . "\n";
						}
						while (ob_get_level() > 0)
						{
							ob_end_flush();
						}
	
						flush();
					}
	
					if (is_string($query) === true)
					{
						$query = array();
					}
				}
	
				//return fclose($file);
				fclose($file);
			}
		}
	
		//return false;
	//}	
	*/
	
	
	//To compare all the tables from source database are available with desitination database.
	///*
	$query5 = mysql_query("SHOW TABLES FROM $comparisonsourcedatabasename");
	while ($line = mysql_fetch_row($query5)) 
	{
		echo '<br>'.$tablename = $line[0];
		//mysql_query("DROP TABLE IF EXISTS $destinationdatabase1.$tab");
		//mysql_query("CREATE TABLE $destinationdatabase1.$tab LIKE $originaldatabase1.$tab") or die(mysql_error());
		//mysql_query("INSERT INTO $destinationdatabase1.$tab SELECT * FROM $originaldatabase1.$tab");
		//echo "Table: <b>" . $line[0] . " </b>Done<br>";

		$query6 = "SHOW TABLES LIKE '$tablename'";
		$exec6 = mysql_query($query6, $destinationdbconnect1) or die ("Error in Query6".mysql_error());
		$rowcount6 = mysql_num_rows($exec6);
		if ($rowcount6 == 0)
		{
			$query7 = "CREATE TABLE $tablename (auto_number INT(255) NOT NULL AUTO_INCREMENT, PRIMARY KEY (auto_number))";
			$exec7 = mysql_query($query7, $destinationdbconnect1) or die ("Error in Query7".mysql_error());
		}
		
	}
	//*/






	echo "<br><br>Update Completed : ".$updatedatetime;


}
else
{
	if (isset($_REQUEST["submit"])) { $submit = $_REQUEST["submit"]; } else { $submit = ""; }
	
	if ($submit == 'No. Cancel Updates.')
	{
		echo "Updates Apply Cancelled. Not Applied.";
		exit;
	}
}


?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><strong>Please Take Database Manual Backup Before  Proceeding. Please Follow Backup Procedure Always.</strong>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Yes I have Taken Backup. Please Proceed To Apply Updates.</p>
<p></p>
<form id="updatesapply1" name="updatesapply1" method="post" action="">
<input type="hidden" name="updatesapply1" id="updatesapply1" value="updatesapply1" />
<input type="submit" name="submit" value="Yes. Proceed." style="border: 1px solid #001E6A"/>
<input type="submit" name="submit" value="No. Cancel Updates." style="border: 1px solid #001E6A"/>
</form>
<p></p>