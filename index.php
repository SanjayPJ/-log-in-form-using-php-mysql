<?php 

// form function to validate data

function validateData($data) {
	$data = trim(stripcslashes(htmlspecialchars($data)));
	return $data;
}

if(isset($_POST['submit'])){

	// create validated variables

	$validatedUsername = validateData($_POST['username']);
	$validatedPasword = validateData($_POST['password']);

	// connecting to database
	include "includes/connect.php";

	if($connection){

		$select_details_query = "SELECT password, email FROM user_details WHERE user_name='$validatedUsername'";

		$result = mysqli_query($connection , $select_details_query);

		$alertLoginError = "<div class='alert alert-danger'>Incorrect username or password</div>";
		$loginError = "";

		if(mysqli_num_rows($result) > 0){
			while ($row = mysqli_fetch_assoc($result)) {
				$validatedHashedPassword = $row['password'];
				$validatedEmail = $row['email'];
			}
			// echo $validatedPasword . "<br>";
			// echo password_hash($validatedPasword, PASSWORD_DEFAULT);

			if(password_verify($validatedPasword, $validatedHashedPassword)){

				session_start();

				$_SESSION['loggedUser'] = $validatedUsername;
				$_SESSION['loggedEmail'] = $validatedEmail;

				header("Location: includes/loggedIn/profile.php");

			}else{
				// password mismatch found
				$loginError = $alertLoginError;
			}
		}else{
			// there is no results in the database
			$loginError = $alertLoginError;
		}

	}
	mysqli_close($connection);
}

?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
	    crossorigin="anonymous">

	<title>Log In Form</title>
	<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

	<style>
		body {
			font-family: 'Muli', sans-serif;
		}

		.form-container {
			margin-top: 100px;
			width: 40%;
			margin-left: auto;
			margin-right: auto;
			border: 1px solid #EEE;
			padding: 20px;
			border-radius: 5px;
		}
	</style>
</head>

<body>
	<div class="container">
		<form class="pt-3 form-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

			<div class="form-group">
				<label for="exampleInputEmail1">Username</label>
				<input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			</div>
			<?php

			if(!empty($loginError)){
				echo $loginError;
			}

			?>
			<button type="submit" class="btn btn-primary w-100" name="submit">Log In</button>

		</form>
	</div>

</body>

</html>