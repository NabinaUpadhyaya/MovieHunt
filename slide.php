<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="img/glassicon.png" type="glassicon">
	<title>moviehunt/Signup</title>
	<link rel="stylesheet" href="slide.css">

</head>

<body>
<?php
include 'connect.php';
if (isset($_POST['SignUp'])){
  $username1=$_POST['username1'];
  $email1=$_POST['email1'];
  $password1=$_POST['password1'];
  $confirmpassword=$_POST['confirm_password'];
  $passwordHash = password_hash($password1, PASSWORD_DEFAULT);

  if(!empty($username1)&&!empty($email1)&&!empty($password1)){
	
	$sql="SELECT * FROM users WHERE email='$email1'";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0){
		echo'<script>alert("Email Exists!!!")</script>';
	}
	if($password1!=$confirmpassword){
		echo'<script>alert("Passwords dont match!!!")</script>';
	}
	if(strlen($password1)<8){
		echo'<script>alert("Passwords must be atleast 8 characters long")</script>';
	}
	
	else{
		$sql = " INSERT INTO users(username,email,password)
		VALUES ('$username1','$email1','$passwordHash')
		";
	  $result1 = mysqli_query($conn,$sql);
	  if(!$result1){
		echo "data insertion problem";

	}
  }
 
 
  }
}
if (isset($_POST['SignIn'])){

  $email2=$_POST['email2'];
  $password2=$_POST['password2'];

  $sql= "SELECT * FROM users where email='$email2' AND password='$password2'";
  $result2= mysqli_query($conn,$sql);
  $num=mysqli_num_rows($result2);

  if($num==1){
    session_start();
    $_SESSION['login']=true;
    header('location:\NEW MOVIE\index.html');
  
  }
  else{
	echo'<script>alert("Invalid credentials")</script>';
  }
}
?>



	<div class="container" id="container">
		<div class="form-container sign-up-container">
		<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
				<h2>Create an Account</h2>
				<span>Use your email or phone for registration</span>
				<input type="text" placeholder="Enter your username" name="username1"/>
				<input type="email" placeholder="Enter your email" name="email1" />
				<input type="password" placeholder="Enter your password" name="password1"/>
				<input type="password" placeholder="Confirmpassword" name="confirm_password"/>
			
                <input type="submit" class="submit" value="Sign Up" name="SignUp">
            
			</form>
		</div>
		<div class="form-container sign-in-container">
		<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
				<h1>Log In</h1><br>


				<input type="email" placeholder="Enter your email or phone" name="email2" />
				<input type="password" placeholder="Enter your password" name="password2"/>
				
                <input type="submit" class="submit" value="SignIn" name="SignIn">
           
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h2>Already have an account?</h2>
					<p>Enter your login info</p>
				<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h2>Don't have an account?</h2>
					<p>Register your personal info to get started</p>
				<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>

	<footer>
		<p>
			<a>MovieHunt</a>
			- Created by Nabina Upadhyaya and Ahwan Poudyal
			<a target="_blank" href="about.html">Learn more...</a>
		</p>
	</footer>
	<script src="slide.js"></script>
</body>

</html>