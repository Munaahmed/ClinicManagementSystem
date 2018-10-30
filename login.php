<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" 
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<center>
   <h2>Login</h2>

 <fieldset>
 <legend>Login details</legend>
    <form action="" method="POST">
      <input type="text" name="username"  placeholder="Enter username">
      <br></br>

      <input type="password" name="password"  placeholder="Enter password">
      <br></br>

      <input type="submit" value="Login" class="btn btn-success">
       <br></br>

    </form>
    <a href="">Don't have an account</a>
    <br>
    <a href="">Forgot Password</a>
    <br></br>
</fieldset>
</body>
</center>
</html>


<?php
if (empty(($_POST))) {
  exit();
}
 
$object = new UserLogin($_POST['username'],
                        $_POST['password']);
$object->login();
class UserLogin{

     function __construct($username, $password){
      $this->username = $username;
      $this->password = $password;
     }

     function Login(){
       $conn = mysqli_connect("localhost","root","","clinic_db");
       $response = mysqli_query($conn, "SELECT * FROM table_users
          WHERE username = '$this->username' AND password = '$this->password' AND status ='active'");

        //count the response
       if (mysqli_num_rows($response) ==0) {
        echo "<center>";
        echo "Login Failed. Check Credentials </center>";

        exit();
    }//end if
 elseif(mysqli_num_rows($response) ==1){
    
        echo "Login Successful. Welcome, ";
        //create session
        session_start();
        $_SESSION['username'] = $this->username;//store username
        $_SESSION['time'] = date("y/m/d h:m:s");
       //session are stored and available to all other php files
         //we need to know the role of the logged in user
        $colm = mysqli_fetch_array($response);
         $_SESSION['role']=$colm[2]; //store role in session


        header("location: addpatient.php");
       
       }//end elseif
    
    else {
      echo "Something went wrong. Contact Admin";
    }
}//end function
}//end class

 

?>