
<?php
	include 'header.php';
	include "functions.php";

		$conn = connectToDb();

//matching entered data with that in the data base, 

if(isset($_POST['username']) && $_POST['password']){
	

 
  

  $user = clean($conn,$_POST['username']);
  $pass = clean($conn,$_POST['password']);
	
$hashpass = hash('sha256',$pass);

  $query = "SELECT `username`, `password` FROM `users` WHERE `username` = '" . $user . "' AND `password` = '" . $hashpass . "' ";
  $response = mysqli_query($conn, $query) or trigger_error(mysqli_error().$query);

   if($response){

    while($row = mysqli_fetch_array($response)){
      echo "Welcome " .$row['username']. " to the BUWFC admin page";
	  $_SESSION['buwfclogin'] = $row['username'];		//Create session 
	  header('Location: admin.php');
    }

   }else {

    echo "Either your username or password is wrong";

   }

  mysqli_close($conn);

}else{

  echo "";

}


?>	
<div align=center>
 <form action="" method="POST">
  <center><br /><h1>Login</h1><br /></center>
  <center>Username: <input type="text" name="username"></input> <br /><br /></center>
  <center>Password: <input type="password" name="password"></input> <br /><br /></center>
  <center><input type='submit'></input>  <br /></center>
  </form>
</div>

<?php
	include 'footer.php';
?>
