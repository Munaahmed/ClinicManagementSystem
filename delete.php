
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

<?php
  $patient_id = $_GET['patient_id'];
   $conn = mysqli_connect("localhost","root","","clinic_db");
   $response = mysqli_query($conn, "DELETE FROM table_patient
   	WHERE patient_id ='$patient_id'");

   echo "$patient_id has been removed";

?>