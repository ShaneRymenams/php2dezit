<?php
	
	include_once("classes/Users.class.php");
	
	$u = new User();

	if(isset($_POST['UserRegister'])) {
		try {	

			$u->Firstname = $_POST['firstname'];
			$u->Lastname = $_POST['lastname'];
			$u->Email = $_POST['email'];

			$u->checkPassword($_POST['password'],$_POST['cpassword']);

			$u->Password = $_POST['password'];
			$u->CPassword = $_POST['cpassword'];

			$u->Save();

			$success = "Uw profiel is aangemaakt.";
			header("Location: index.php");
		}
			catch(Exception $e)
			{
				$error = $e->getMessage();
			}
	}

?><!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rent a student - Login</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<script src="js/additional-methods.js"></script>
	<script src="js/jquery.js"></script>
    <script src="js/validate.js"></script>
    <script src="js/jq_errors.js"></script>

	<script>
		$(document).ready(function() {
    
		    $('#registreerform').validate({

		        errorElement: 'div',
		        rules: {
		            firstname: {
		                required: true
		            },
		            lastname: {
		                required: true
		            },
		            email: {
		                required: true,
		                email: true
		            },
		            password: {
		                required: true,
		                minlength: 6

		            },
		            cpassword: {
		                required: true
		            },
		            // fileToUpload: {
		            //     required: true
		            // }
		        },

			    submitHandler: function(form) {
		            form.submit();
		        }
		    });
		});
	</script>

	<style>
		input{
			width: 300px;
		}
	</style>

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
   			<form method="post" action="" enctype="multipart/form-data" class="formulier" id="registreerform">
			
			<div class="row">
				
				<div class="col-md-12">
					<legend>User registratie</legend>
					Alle velden met een * zijn verplicht<br/>
					<?php if(isset($error)): ?>
						<div class="error">
					<?php echo $error;?>
						</div>
					<?php endif; ?>

					<?php if(isset($success)): ?>
						<div class="feedback">
					<?php echo $success;?>
						</div>
					<?php endif; ?>
					<br/>
				</div>
			</div>

			<div class="row">
				
				<div class="form-group">
					<label class="control-label col-md-4 text-right" for="firstname">Voornaam*</label> 
					<div class="col-md-8">
						<input class="form-control" type="text" id="firstname" name="firstname" placeholder="Voornaam"/>
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-4 text-right" for="lastname">Achternaam*</label>
				
					<div class="col-md-8">
						<input class="form-control" type="text" id="lastname" name="lastname" placeholder="Achternaam" />
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-4 text-right" for="email">Email*</label>
					<div class="col-md-8">
						<input class="form-control" type="text" id="email" name="email" placeholder="email" />
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-4 text-right" for="password">Wachtwoord*</label>
					<div class="col-md-8">	
						<input class="form-control" type="password" id="password" name="password" placeholder="Wachtwoord" />
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-4 text-right" for="cpassword">Verifieer Wachtwoord*</label>
					<div class="col-md-8">	
						<input class="form-control" type="password" id="cpassword" name="cpassword" placeholder="Verifieer Wachtwoord" />
					</div>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="form-group">
					<label class="control-label col-md-4 text-right" for="cpassword"></label>
					<div class="col-md-8">	
						<input class="submit btn btn-default col-md-12" type="submit" value="Registreer" name="UserRegister"/>
					</div>
				</div>
				
				
			</div>	
			</form>

		</div>
   	</div>

</div>
</body>
</html>
