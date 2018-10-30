
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
	<title></title>
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

  <h3>Patient Checkup</h3>
  
    <fieldset>
     <legend>Patient Info</legend>
    <form action="" method="POST">

       <input type="text" name="patient_id" 
    	placeholder="Enter Patient Identity Number">
    	<br></br>

    	<input type="text" name="weight" 
    	placeholder="Enter Weight">
    	<br></br>

    	<input type="text" name="height" 
    	placeholder="Enter Height">
    	<br></br>

    	<input type="text" name="temperature" 
    	placeholder="Enter Temperature">
    	<br></br>

    	<input type="text" name="description" 
    	placeholder="Enter Patient Description">
    	<br></br>

    	<label>Select Gender</label>
    	<input type="radio" name="gender" value="Male">Male
    	<input type="radio" name="gender" value="Female">Female
    	<br></br>

    	<input type="submit" value="Save Info">


    </form>
    
</fieldset>
</body>
</html>



<?php

if (empty($_POST)) {
   exit();//quit executing PHP code until form button is clicked 
}

     $object = new Patient( $_POST['patient_id'],                        
                           $_POST['weight'],  
                           $_POST['weight'],                                             
                           $_POST['temperature'],  
                           $_POST['description']);
           $object->save(); #trigger save function


class Patient{
     function __construct($patient_id, $weight, $height, $temperature,
        $description){

        $this->patient_id = $patient_id;
        $this->weight = $weight;
        $this->height = $height;
        $this->temperature = $temperature;
        $this->description = $description;
    
     }//end

     function save(){
            //connect to data base
           $conn = mysqli_connect("localhost","root","","clinic_db");
            //save to table
           $response = mysqli_query($conn,"INSERT INTO `table_patient_info`
            (`patient_id`, `weight`, `height`, `temperature`, `description`) VALUES
              ('$this->patient_id','$this->weight','$this->height','$this->temperature','$this->description')");

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
































