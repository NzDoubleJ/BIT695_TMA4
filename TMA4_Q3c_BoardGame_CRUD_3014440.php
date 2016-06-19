<!DOCTYPE html>
<html>
<head>
	<title> Form input submited and validator</title>

</head>
<body>
<h1>Field input and validate</h1>

<?php
/*
THIS FILE UPLOADS TO THE DATABASE--- TROUBLE WITH GETTING THE INCLUDES OR REQUIRES FILE TO PULL ACROSS FUNCTIONS,  outputs all code into the browser including comments. works ok with functions put into this file.

*/
//require 'test_q1d.php';



    $BGame_name =test_input($_POST['board_game_name']);

	$maximum_players= test_input($_POST['Max_players']);

	$Owner_Game= test_input($_POST['Owner_of_game']);


	
	//comment out the below print for production use for testing
		//print "this is your information $first_name $last_name $email_input and $phone_input<\br>"; //<----- comment out for production used for testing

	
  //    connect to the database.
  //    dbConnect(); // was not pulling across from the function library file. procedural connection instead
	 
   //function dbConnect() was not injecting function into during test
  //{
    $servername ="localhost";
    $username="root";
    $password="root";
    $dbname="web_tech";// this is the name of the db on the server
    //create connection
    $conn= new mysqli($servername, $username,$password,$dbname);
    // check connection
      if ($conn->connect_error)
      {
        die("Connection failed: " .$conn->connect_error);
      }

    //echo"Connected successfully";//<--******COMMENT THIS OUT FOR THE PRODUCTION, USE FOR TESTING******
  //}
  //^^ to close a db use the "$conn->close();" ^^


// validate the inputs to make sure that they have no numbers and blank space with the trim. USE THE TEST_INPUT() BELOW. May be able to pu this within the validate function.

	validateForm();


// send the information to the database that are stored in the variables
$sql = "INSERT INTO boardgames value (null,\"$BGame_name\",\"$maximum_players\",\"$Owner_Game\")";

if ($conn->query($sql)===TRUE)
{
	echo "New record created successfully, ";
  echo "this is your Stored information $BGame_name $maximum_players $Owner_Game and $phone_input";
}
	else
	{
		echo "Error: ". $sql. "<br>". $conn->error;
	}

  // close the connection 
  $conn->close();

  
  /*
      function dbConnect()
        {
          $servername ="localhost";
          $username="root";
          $password="root";
          $dbname="web_tech";// this is the name of the db on the server
          //create connection
          $conn= new mysqli($servername, $username,$password,$dbname);
          // check connection
            if ($conn->connect_error)
            {
              die("Connection failed: " .$conn->connect_error);
            }

          echo"Connected successfully";//<--******COMMENT THIS OUT FOR THE PRODUCTION, USE FOR TESTING******
        }
        */
  
      	function validateForm()
        {
          // define variables and set to empty values
          $GnameErr = $MxPLErr= $ownerErr = $phoneErr= $submitString = "";
          $Gname = $MxPlyer = $owner = "";

          //if ($_SERVER["REQUEST_METHOD"] == "POST") 
          //{
            if (empty($_POST["board_game_name"])) 
            {
              $GnameErr = "game Name is required";
            } else
              {
              $Gname = test_input($_POST["board_game_name"]);
              }
            
            if (empty($_POST["Max_players"])) 
            {
              $MxPLErr = "Name is required";
            } 
              else 
              {
              $MxPlyer = test_input($_POST["last_name"]);
              }
              
            if (empty($_POST["Owner_of_game"])) 
            {
              $ownerErr = "E mail is required";
            } 
              else 
              {
              $owner = test_input($_POST["email_input"]);
              }

            if (empty($_POST["phone_input"])) 
            {
              $phoneErr = "Phone number is required";
            }
             else 
              {
              $phone = test_input($_POST["phone_input"]);
              } 
              // use the globals from the validate function to set the variables to the trimed version
      	 
         // }
          //echo "$Fname $Lname $email $phone";// ******THIS IS USED FOR TESTING COMMENT OUT AFTER*******
        }

        function test_input($data)
        {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
     	
  
?>

</body>
</html>
