<?php 

function db_connect()
{	//static assigned to avoid more than one conection
	static $connection;

	// Try and connect to the database,
	if(!isset($connection))
	{
		$connection = mysqli_connect('localhost','root','root','web_tech');
	}
	//if connection was not successful alert.
	if($connection===false)
	{
		return mysqli_connect_error();
	}
	else{
		echo "you have connected to db";  // comment out this else for production.
	}
	return $connection;

 }
 
 function db_query($query)
 {
 	//conect to the database
 	$connection = db_connect();
 	// query the database
 	$result = mysqli_query($connection,$query);

 	return $result;
 }
 function db_error()
 {
 	$connection = db_connect();
 	return mysqli_error($connection);
 }
 function db_select($query)
 {
 	$rows= array();
 	$result = db_query($query);
 	// if query failed return false
 	if($result===false)
 	{    
 		return false;
 	}
 	// if query wasa successful, retrieve all the rows into an array
 	while ($row = mysqli_fetch_assoc($result))
 	{
 		$rows[] =$row;
 	}
 	return $rows;
 }
 function db_quote($value)
 {
 	$connection = db_connect();
 	return "'" . mysqli_real_escape_string($connection,$value) . "'";
 }

db_connect(); 
db_select("select * from players");
$num_results = mysqli_num_rows($rows);
for($i=0; $i < $num_results; $i++)
{
	echo "$rows[0] . $rows[1] $rows[2] $rows[3] $rows[4]";
}

?>