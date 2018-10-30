
<?php
 session_start();
 //check if there is a session
 if (isset($_SESSION['username'])) {
  //pull it out
    if ($_SESSION['role']=="Doctor") {
      $username = $_SESSION['username'];
     $username = $_SESSION['username'];
   echo "Welcome, $username";
   echo"<br> ";    
   echo "<a href='logout.php'>Logout</a>";
}
   else {
  echo "Access Denied";
  exit();
}
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
	<title>Add Patient</title>
<link rel="stylesheet" 
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
     <center>
       <h1>Clinic Managment</h1>
       	<p>Better Health Care</p>
       	<a href="addpatient.php">Add Patient</a> /
       	<a href="adddoctor.php">Add Doctor</a> /
       	<a href="psearch.php" "idsearch.php">Search Patient</a> /
       	<a href="">Search Doctor</a> /
       	<a href="checkup.php">Patient Info</a> /
         <a href="idsearch.php">Seach Patient by ID</a>

     </center>

          <h3>Add Patient</h3>
            
    <fieldset>
    <legend>Patient Details</legend>

    <form action="" method="POST">
    	<input type="text" name="surname" 
    	placeholder="Enter Surname">
    	<br></br>

    	<input type="text" name="fname" 
    	placeholder="Enter First Name">
    	<br></br>

    	<input type="text" name="lname" 
    	placeholder="Enter Last Name">
    	<br></br>

    	<input type="tel" name="phone" 
    	placeholder="Enter Phone Number">
    	<br></br>

    	<input type="text" name="residence" 
    	placeholder="Enter Residence">
    	<br></br>

        <input type="text" name="patient_id" 
    	placeholder="Enter Patient Identity Number">
    	<br></br>

    	<label>Select Gender</label>
    	<input type="radio" name="gender" value="Male">Male
    	<input type="radio" name="gender" value="Female">Female
    	<br></br>

    	<input type="email" name="email" 
    	placeholder="Enter Email">
    	<br></br>

    	<input type="submit" value="Save Patient">


    </form>
    
</fieldset>
</body>
</html>

<?php

  //This is the logic: provide the constructor with form  values
if (empty($_POST)) {
   exit();//quit executing PHP code until form button is clicked 
}

     $object = new Patient($_POST['surname'],
		                   $_POST['fname'],
		                   $_POST['lname'],
		                   $_POST['phone'],
		                   $_POST['residence'],
		                   $_POST['patient_id'],
		                   $_POST['gender'],  
		                   $_POST['email']);
           $object->save(); #trigger save function

class Patient{
     function __construct($surname, $fname, $lname, $phone,
     	$residence, $patient_id, $gender, $email){

     	$this->surname = $surname;
     	$this->fname = $fname;
     	$this->lname = $lname;
     	$this->phone = $phone;
     	$this->residence = $residence;
     	$this->patient_id = $patient_id;
     	$this->gender = $gender;
     	$this->email = $email;

     }//end

     function save(){
	     	//connect to data base
	       $conn = mysqli_connect("localhost","root","","clinic_db");
	     	//save to table
	       $response = mysqli_query($conn,"INSERT INTO `table_patient`
			   (`surname`, `fname`, `lname`, `phone`, `residence`, `patient_id`, `gender`,
			   `email`) VALUES ('$this->surname','$this->fname','$this->lname',
			    '$this->phone','$this->residence','$this->patient_id',
			    '$this->gender','$this->email')");

        //testing the response

     if ($response==true) {
     echo "Successfully Saved Record";
     }
      else {
      	echo "Record failed. Check your records and try again";
      }

  }//end

}

?>

 