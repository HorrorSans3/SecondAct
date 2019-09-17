<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$classcode = $_POST['classcode'];
	$studentid = $_POST['studentid'];
	$subjectcode = $_POST['subjectcode'];	
	$timed = $_POST['time'];	
	$teacher = $_POST['teacher'];	
	// checking empty fieldstime
	if(empty($classcode) || empty($studentid) || empty($subjectcode) || empty($time) || empty($teacher)) {	
			
		if(empty($classcode)) {
			echo "<font color='red'>classcode field is empty.</font><br/>";
		}
		
		if(empty($studentid)) {
			echo "<font color='red'>student id field is empty.</font><br/>";
		}
		
		if(empty($subjectcode)) {
			echo "<font color='red'>subject code field is empty.</font><br/>";
		}	
		if(empty($time)) {
			echo "<font color='red'>time field is empty.</font><br/>";
		}		
		if(empty($teacher)) {
			echo "<font color='red'>teacher field is empty.</font><br/>";			
	} else {	
		//updating the table
		$sql = "UPDATE tbl_class SET classcode=:classcode, studentid=:studentid, subjectcode=:subjectcode, time=:time, teacher=:teacher WHERE studentid=:studentid";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':studentid', $studentid);
		$query->bindparam(':classcode', $classcode);
		$query->bindparam(':studentid', $studentid);
		$query->bindparam(':subjectcode', $subjectcode);
		$query->bindparam(':time', $time);
		$query->bindparam(':teacher', $teacher);
		$query->execute();
		
		// Alternative to above bindparam and execute
		// $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));
				
		//redirectig to the display page. In our case, it is index.php
		header("Location: class.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM tbl_class WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$classcode = $row['classcode'];
	$studentid = $row['studentid'];
	$subjectcode = $row['subjectcode'];
	$time = $row['time'];
	$teacher = $row['teacher'];
}
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
	<a href="class.php">Home</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Class Code</td>
				<td><input type="text" name="classcode" value="<?php echo $classcode;?>"></td>
			</tr>
			<tr> 
				<td>Student ID</td>
				<td><input type="text" name="studentid" value="<?php echo $studentid;?>"></td>
			</tr>
			<tr> 
				<td>Subject Code</td>
				<td><input type="text" name="subjectcode" value="<?php echo $subjectcode;?>"></td>
			</tr>
			<tr> 
				<td>Time</td>
				<td><input type="text" name="time" value="<?php echo $time;?>"></td>
			</tr>
			<tr> 
				<td>Teacher</td>
				<td><input type="text" name="teacher" value="<?php echo $teacher;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
