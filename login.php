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

        	if (password_verify($_POST['userpassword'], $row['password'])) {
				session_start();
				$_SESSION['email'] = $_POST['email'];
				header("Location: userboard.php");
			} elseif (!isset($row['userpassword'])) {
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
	
	<div class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">FeatureList</a>
			</div> <!-- END NAVBAR-HEADER -->
			<ul class="nav navbar-nav pull-right">
				<li><a href="index.php">Home</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="registreer.php">Registreer</a></li>
			</ul>
		</div> <!-- END CONTAINER -->
	</div> <!-- END NAVBAR -->

<div class="container">

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
				<div class="form-group">
					<label class="control-label col-md-3 text-right" for="email">Email</label>
					<div class="col-md-9">
						<input class="form-control"type="text" id="useremail" name="email" placeholder="Email" />
					</div> <!-- END COL -->
				</div> <!-- END COL -->
			</div> <!-- END ROW -->
			<br>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-3 text-right" for="password">Password</label>
					<div class="col-md-9">
						<input class="form-control" type="password" id="userpassword" name="userpassword" placeholder="Password" />
					</div> <!-- END COL -->
				</div> <!-- END COL -->
			</div> <!-- END ROW -->
			<br>
			<div class="row">
				<div class="col-md-3">
				</div> <!-- END COL -->
				<div class="col-md-9">
					<input class="submit btn btn-default col col-md-12" type="submit" value="Login" name="UserLogin" />
				</div> <!-- END COL -->
				
			</div> <!-- END ROW -->
			<br>
			<div class="row">
				<div class="col-md-12">
					<br/><a href="registreer.php" >Heb je nog geen account? Maak er dan snel een aan!</a>
				</div> <!-- END COL -->
			</div> <!-- END ROW -->
			
			<div class="row">
				<div class="col-md-12">
					<br/><a href="#" name="answer" onclick="ShowDiv()">Als je een admin bent, kan je hier inloggen</a>
				</div> <!-- END COL -->
			</div> <!-- END ROW -->

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
				<div class="form-group">
					<label class="control-label col-md-3 text-right" for="email">Email</label>
					<div class="col-md-9">
						<input class="form-control" type="text" id="email" name="email" placeholder="email" />
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-3 text-right" for="password">Password</label>
				
					<div class="col-md-9">
						<input class="form-control" type="password" id="password" name="password" placeholder="password" />
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-3">	
				</div>
				<div class="col-md-9">
					<input class="submit btn btn-default col col-md-12" type="submit" value="Login" name="AdminLogin" />
				</div>
			</div>

			</form> 

			</div>

       	</div>
	</div>
</div>
</body>
</html>
