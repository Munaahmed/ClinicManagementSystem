
<?php
 session_start();
 //check if there is a session
 if (isset($_SESSION['username'])) {
  //pull it out
   $username = $_SESSION['username'];
   echo "Welcome, $username";
   echo"<br> ";
   echo "<a href='logout.php'>Logout</a>";
 }
elseif (!isset($_SESSION['username'])) {
  header("location: login.php");
  exit();
}

else {
  header("location: login.php");
  exit();
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Search ID</title>
	 <link rel="stylesheet"
     href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<a href="addpatient.php">Back Home</a>
<h3>Search by ID</h3>


<form action="" method="POST">
	<input type="text" name="patient_id" placeholder="Enter Patient_ID">
	<br></br>

	<input type="submit" value="Search">
	<br></br>



</form>
</body>
</html>


<?php

if (empty($_POST)) {
	exit(); //quit if button is not clicked
}

$object = new IdSearch($_POST['patient_id']);
$object->search();


class IdSearch{
  function __construct($patient_id){
     $this->patient_id = $patient_id;
      }
 
function search(){
      	 $conn = mysqli_connect("localhost","root","","clinic_db");
	   $response = mysqli_query($conn, "SELECT * FROM table_patient
	     		WHERE patient_id = '$this->patient_id'");

	     if (mysqli_num_rows($response) == 0) {
	     	echo "No Patient found. Try again";
	     	exit();
	     }
            
           else {
         	//get all columns for the first row found
         	echo "<table border = 1 width = 100% class='table table-hover'>";
         	while($colm = mysqli_fetch_array($response))
         	{
         	echo "<tr>";
            echo "<td> $colm[0] </td>";
            echo "<td> $colm[1] </td>";
            echo "<td> $colm[2] </td>";        
            echo "</tr>";
         	}//end while
         	echo "</table";

            }

}
}
 
?>








































