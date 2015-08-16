<?php 
	
	include_once("classes/Admin.class.php");
	include_once("classes/Users.class.php");
	
	$a = new Admin();
	$u = new User();

	if(!empty($_POST['AdminLogin'])) {
		try {	
			$conn = Db::getInstance();
			$statement = $conn->prepare("SELECT * FROM tbladmin WHERE email=?");
			$statement->execute(array($_POST['email']));
        	$row = $statement->fetch(PDO::FETCH_ASSOC);

        	if (password_verify($_POST['password'], $row['password'])) {
				session_start();
				$_SESSION["email"] = $_POST['email'];
				header("Location: adminboard.php");
			} elseif (!isset($row['password'])) {
	            throw new Exception('Ongeldig emailadres!');
	        } else {
	            throw new Exception("Ongeldig wachtwoord!");
	        }
	        
		} catch(Exception $e) {
			$erroradmin = $e->getMessage();
		}
	}

	if(!empty($_POST['UserLogin'])) {
		try {	
			$conn = Db::getInstance();
			$statement = $conn->prepare("SELECT * FROM tblusers WHERE email=?");
			$statement->execute(array($_POST['email']));
        	$row = $statement->fetch(PDO::FETCH_ASSOC);

        	if (password_verify($_POST['password'], $row['password'])) {
				session_start();
				$_SESSION["useremail"] = $_POST['email'];
				header("Location: registreer.php");
			} elseif (!isset($row['password'])) {
	            throw new Exception('Ongeldig emailadres!');
	        } else {
	            throw new Exception("Ongeldig wachtwoord!");
	        }
		} catch(Exception $e) {
			$erroruser = $e->getMessage();
		}
	}

?><!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<script type="text/javascript">
		function ShowDiv() 
		{
    		document.getElementById("myDiv").style.display = "";
		}
	</script>
</head>
<body>
	
	<!-- <div class="navbar navbar-default">
   		<div class="navbar-header">
    		<a class="navbar-nav" href="index.php"><img class="logo" src="images/logo2.png" alt="The Rent A Student Logo" width="55%"></a>
       	</div>
      	<ul class="nav navbar-nav">
          	<li><a href="index.php">Home</a></li>
       	</ul>
   	</div> -->

<div class="container-fluid">

<br>
   	<div class="row intro2">
   		<div class="col-md-6">
   			
   			<form method="post" class="formulier">
			
			<div class="row">
				<div class="col-md-12">
					<legend>User Login</legend>
					<?php if(isset($erroruser)): ?>
						<div class="error">
					<?php echo $erroruser;?>
						</div>
					<?php endif; ?>
					<?php if(isset($succes)): ?>
						<div class="feedback">
					<?php echo $succes;?>
						</div>
					<?php endif; ?>
					<br />
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label for="email">Email:</label>	
				</div>
				<div class="col-md-9">
					<input type="text" id="email" name="email" placeholder="email" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label for="password">Password:</label>
				</div>
				<div class="col-md-9">
					<input type="password" id="password" name="password" placeholder="password" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">	
				</div>
				<div class="col-md-9">
					<input class="submit" type="submit" value="Login" name="UserLogin" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-9">
					<br/><a href="#" name="answer" onclick="ShowDiv()">Als je een admin bent, kan je hier inloggen</a>
				</div>
			</div>

			</form>
<br>
			<div id="myDiv" style="display:none;" class="answer_list" >
			<form method="post" class="formulier">
			
			<div class="row">
				<div class="col-md-12">
					<legend>Admin login</legend>
					<?php if(isset($erroradmin)): ?>
						<div class="error"><br/>
					<?php echo $erroradmin;?>
						</div>
					<?php endif; ?>
					<?php if(isset($succes)): ?>
						<div class="feedback">
					<?php echo $succes;?>
						</div>
					<?php endif; ?>
					<br/>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label for="email">Email:</label>
				</div>
				<div class="col-md-9">
					<input type="text" id="email" name="email" placeholder="email" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label for="password">Password:</label>
				</div>
				<div class="col-md-9">
					<input type="password" id="password" name="password" placeholder="password" />
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">	
				</div>
				<div class="col-md-9">
					<input class="submit" type="submit" value="Login" name="AdminLogin" />
				</div>
			</div>

			</form> 

			</div>

       	</div>
	</div>
</div>
</body>
</html>
