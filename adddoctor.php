
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
	<title>Add Doctor</title>
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

       <h1>Add Doctor</h1>
     
    <fieldset>
    <legend>Doctor Details</legend>
    <form action="" method="POST">
      <input type="text" name="doctor_id" 
    	placeholder="Enter Doctor's Identity Number">
    	<br></br>

    	<input type="text" name="surname" 
    	placeholder="Enter Surname">
    	<br></br>

    	<input type="text" name="fname" 
    	placeholder="Enter First Name">
    	<br></br>

    	<input type="text" name="proffesion" 
    	placeholder="Enter Doctor's Proffession">
    	<br></br>

    	<input type="text" name="dept" 
    	placeholder="Enter Doctor's Department">
    	<br></br>

       <input type="text" name="experience" 
    	placeholder="Enter Doctor's experience">
    	<br></br>

	  

    	<label>Select Gender</label>
    	<input type="radio" name="gender" value="Male">Male
    	<input type="radio" name="gender" value="Female">Female
    	<br></br>

    

    	<input type="submit" value="Save Doctor">


    </form>
    
</fieldset>
</body>
</html>

<?php


  //This is the logic: provide the constructor with form  values
if (empty($_POST)) {
   exit();//quit executing PHP code until form button is clicked 
}


     $object = new Doctor(  $_POST['doctor_id'],
     	                    $_POST['surname'],
			                $_POST['fname'],
			                $_POST['dept'],
			                $_POST['proffession'],
			                $_POST['gender'],  			                
			                $_POST['experience']);
			                
	 $object->save(); #trigger save function





 class Doctor{
     function __construct($doctor_id, $surname, $fname, $dept, $proffession, $gender,
     	$experience){

        $this->doctor_id = $doctor_id;
     	$this->surname = $surname;
     	$this->fname = $fname;
     	$this->dept = $dept;
     	$this->proffession = $proffession;
     	$this->gender = $gender;
     	$this->experience = $experience;
     	
     }//end

     function save(){
	     	//connect to data base
	       $conn = mysqli_connect("localhost","root", "","clinic_db");
	     	//save to table
	       $response = mysqli_query($conn,"INSERT INTO `table_doctors`
	       	(`doctor_id`, `surname`, `fname`, `dept`, `proffession`, `gender`, `exp`) 
	       VALUES ('$this->doctor_id','$this->surname','$this->fname','$this->dept',
	       	'$this->proffession','$this->gender','$this->experience')");

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