<?php 
	session_start();

	//DB conneection

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD','');
	define('DB_NAME','student_details');

	$dbConn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

	//Check connection
	if($dbConn === false){
		die("Error: Database connection failed" . mysqli_connect_error());
	}

	//Initialize variables

	$firstname = $lastname = $course = $admission = '';

	$update = false;

	if(isset($_POST['add'])) {
		$firstname	=	trim($_POST['firstname']);
		$lastname	=	trim($_POST['lastname']);
		$course		=	trim($_POST['course']);
		$admission	=	trim($_POST['admission']);

		//Insert data into DB
		$sql = "INSERT INTO `info`(`firstname`, `lastname`, `course`, `admission`) VALUES ('$firstname','$lastname','$course','$admission')";
		
		mysqli_query($dbConn,$sql);

		$_SESSION['message'] = "A New Student Added Successfully!";

		header('Location: index.php');

	}

	//Update Data

	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$course = $_POST['course'];
		$admission = $_POST['admission'];

		$sql_update = "UPDATE `info` SET `firstname`='$firstname',`lastname`='$lastname',`course`='$course',`admission`='$admission' WHERE `id`='$id'";
		mysqli_query($dbConn, $sql_update);

		$_SESSION['message'] = 'Student Details Updated Successfully!';

		header('Location: index.php');
	}

	//Delete Data

	if(isset($_GET['del'])){
		$id = $_GET['del'];

		$sql_del = "DELETE FROM `info` WHERE `id`='$id'";

		mysqli_query($dbConn, $sql_del);

		$_SESSION['message'] = 'One Student Deleted Successfully!';

		header('refresh:1;url=index.php');
	}

?>