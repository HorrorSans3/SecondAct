<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$gender = $_POST['gender'];
	$birthdate = $_POST['birthdate'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
		
	// checking empty fields
	if(empty($fname) || empty($lname) || empty($gender) || empty($birthdate) || empty($address) || empty($contact)) {
				
		if(empty($fname)) {
			echo "<font color='red'>first name field is empty.</font><br/>";
		}
		
		if(empty($lname)) {
			echo "<font color='red'>last name field is empty.</font><br/>";
		}
		
		if(empty($gender)) {
			echo "<font color='red'>gender field is empty.</font><br/>";
		}

		if(empty($birthdate)) {
			echo "<font color='red'>birthdate field is empty.</font><br/>";
		}

		if(empty($address)) {
			echo "<font color='red'>address field is empty.</font><br/>";
		}

		if(empty($contact)) {
			echo "<font color='red'>contact field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database		
		$sql = "INSERT INTO tbl_students(fname, lname, gender, birthdate, address, contact) VALUES(:fname, :lname, :gender,:birthdate ,:address ,:contact )";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':fname', $fname);
		$query->bindparam(':lname', $lname);
		$query->bindparam(':gender', $gender);
		$query->bindparam(':birthdate', $birthdate);
		$query->bindparam(':address', $address);
		$query->bindparam(':contact', $contact);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='students.php'>View Result</a>";
	}
}
?>
</body>
</html>
