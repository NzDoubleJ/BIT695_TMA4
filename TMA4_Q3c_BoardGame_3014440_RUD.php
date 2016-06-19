<?php // 



		//initialise the variables
		$search_id = "";
		$search_GameName ="";
		$search_maxPlayers ="";
		$search_Owner = "";
		$search_phone ="";
		$searchString ="";
		$searchQuery ="";

		// get information from the contact form and store in variables
		$search_id = test_input($_POST['gameId']);
		$search_GameName = test_input($_POST['qFirstNmae']);
		$serach_last_name = test_input($_POST['qLastName']);
		$search_email = test_input($_POST['qemail']);
		$search_phone = test_input($_POST['qPhone']);

		//dbConnect
		dbConnect();


		switch ($searchQuery) {
			//perform a retrival of a given
			case 'Retreave':
				 $sql ="SELECT * FROM boardgames WHERE ($searchString)";
				 insert_query($sql);
				 	// this requires additional storeing into variable and then extracting to the display
				# code...
				break;
				//updates a given row with new data
			case 'Update' :
				if(empty($search_id){
					echo "Can not update without an ID number. Please update with a valid id";
				}else{
					$sql = "INSERT * Into boardgames Where ($searchString)";
					insert_query($sql);
				#code
				}
				break;
				// delete row from a member id
			case 'Delete':
			if(empty($search_id){
					echo "Can not Deleta without an ID number. Please update with a valid id";
				}else{
					$sql = "DELETE * FROM boardgames WHERE member_id = $search_id";
					insert_query($sql);

				}

				break;

			default:
				echo "Can not determine what type of Query you wanted";
				break;
		}

		
		function insert_query($sql){		
			if ($conn->query($sql)===TRUE)
			{
				echo "Query was successfull ";
			  
			}
				else
				{
					echo "Error: ". $sql. "<br>". $conn->error;
				}

			 // close the connection 
			 $conn->close();
		}

		//check the form input to build up a query string.
		 function stringbuild()
			{	 if(!empty($search_id))
				 {
				 	$searchString = "member_id = $search_id,";
				 }

				if(!empty($search_first_name))
				 {
				 	$searchString .= " first_name = $search_first_name,";
				 }
				if(!empty($search_id))
				 {
				 	$searchString .= " last_name = $serach_last_name,";
				 }
				 if(!empty($search_id))
				 {
				 	$searchString .= " email = $search_email,";
				 }
				 if(!empty($search_id))
				 {
				 	$searchString .= " phone = $search_phone";
				 }
				 echo " $searchString"; // comment ouot after testing
			}



		function test_input($data)
		  {
		    $data = trim($data);
		    $data = stripslashes($data);
		    $data = htmlspecialchars($data);
		    $data = mysqli_escape_string($data);
		    return $data;
		  }


/**
 *
 */
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

		    //echo"Connected successfully";//<--******COMMENT THIS OUT FOR THE PRODUCTION, USE FOR TESTING******
		  }
?>