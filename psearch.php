
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
	<title>Search</title>
	<link rel="stylesheet" 
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

 <center>
       <h1>Clinic Managment</h1>
       	<p>Better Health Care</p>
       	<a href="addpatient.php">Add Patient</a> /
       	<a href="adddoctor.php">Add Doctor</a> /
       	<a href="psearch.php">Search Patient</a> /
       	<a href="">Search Doctor</a> /
       	<a href="checkup.php">Patient Info</a> /
        <a href="idsearch.php">Seach Patient by ID</a>
     </center>


   <h2>Search Patient</h2>

 <fieldset>

 <legend>Search Patient</legend>
    <form action="" method="POST">
      <input type="text" name="surname"  placeholder="Enter Surname">
      <br></br>

      <input type="submit" value="Search">
       <br></br>

    </form>
    
</fieldset>
</body>
</html>

<?php
if (empty($_POST)) {
	exit(); //quit if button is not clicked
}

$object = new PatientSearch($_POST['surname']);
$object->search();


 class PatientSearch{
	 function __construct($surname){
        $this->surname = $surname;
	  }//end 
      
      function search(){
      	 $conn = mysqli_connect("localhost","root","","clinic_db");
	     $response = mysqli_query($conn, "SELECT * FROM table_patient
	     		WHERE surname = '$this->surname'");

        //count the response
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
            echo "<td> $colm[7] </td>";
            echo "<td> $colm[8] </td>";
            
            echo "<td> <a href = 'delete.php?patient_id=$colm[5]'
            class = 'btn btn-primary'>DELETE</a> </td>";

            echo "<td> <a href = ''>ALLOCATE</a> </td>";
            echo "</tr>";
         	}//end while
         	echo "</table";

     }//end else
   }//end function
 }//end class



?>































