<?php  
	session_start();
	if(!isset($_SESSION["email"])) {
	    header("location:index.php");
	    exit();
	}

	include_once("classes/Users.class.php");

	$a = new User();
	$b = new User();
	$showAcc = $b->ShowAccount();

	if(!empty($_POST["FormUpdate"])) {
		try {	
			$a->Lastname = $_POST['naam'];
			$a->Firstname = $_POST['voornaam'];			
			$a->Email = $_POST['email'];
			$a->Password = $_POST['password'];
			$a->Id = $_POST['id'];
			$a->UpdateAccount();

			$succes = "Account is gewijzigd!";

		} catch(Exception $e) {
			$error = $e->getMessage();
		}
	}

	if(!empty($_POST["FormDelete"])) {
		try {	
			$b->Id = $_POST['id'];
			$b->DeleteAccount();

			$succes = "Account is verwijderd!";

		} catch(Exception $e) {
			$error = $e->getMessage();
		}
	}

	if(!empty($_POST["ImageUpload"])) {
		try {	
			$b->Id = $_POST['id'];
			$b->Email = $_POST['email'];

			$map = $_POST['email'];
        	if(!file_exists("images/profpics/$map")) {
            	mkdir("images/profpics/$map", 0777, true);
        	}

        	include_once("upload.php");

        	$b->Picture = "images/profpics/".$_POST['email']."/".basename( $_FILES["fileToUpload"]["name"]);
			
			$b->UpdateImage();
		} catch(Exception $e) {
			$error = $e->getMessage();
		}
	}

	if(!empty($_POST["ImageDelete"])) {
		try {	
			
			$b->Id = $_POST['studentID'];
			$b->Foto = $_POST['foto'];
			
			$b->DeleteImage();
		} catch(Exception $e) {
			$error = $e->getMessage();
		}
	}
?><!doctype html>

<html lang="en">
<head>
  	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	
  	<title>PHP1 2de Zit - Adminboard</title>  
	
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

  	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
  	<script src="js/validate.js"></script>
  	<script>
		$(document).ready(function() {
		    $('#FormUpdate').validate({
		        errorElement: 'div',
		        rules: {
		            naam: {
		                required: true
		            },
		            voornaam: {
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
		        },

			    submitHandler: function(form) {
		            form.submit();
		        }
		    });
		});
	</script>
</head>

<body>
	<div class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-nav" style="margin-top:15px;" href="index.php">FeatureList</a>
			</div> <!-- END NAVBAR-HEADER -->
			<ul class="nav navbar-nav pull-right">
				<li><a href="userboard.php">Dashboard</a></li>
				<li><a href="useraccount.php">Profile</a></li>
			</ul>
		</div> <!-- END CONTAINER -->
	</div> <!-- END NAVBAR -->

	<div class="container">

		<div class="row">
			<div class="col col-md-6">
				<?php if(isset($error)): ?>
					<div class="error alert alert-danger">
				<?php echo $error;?>
					</div>
				<?php endif; ?>

				<?php if(isset($success)): ?>
					<div class="feedback alert alert-success">
				<?php echo $success;?>
					</div>
				<?php endif; ?>

        		<form method="post" action="" class="form-horizontal">

            		<?php
						while($acc = $showAcc->fetch(PDO::FETCH_ASSOC)) {
							echo '<div class="form-group">';
				    			echo '<label for="naam" class="col-md-3 control-label">Naam</label>';
				    	
				    			echo '<div class="col-md-9">';
				      				echo '<input type="text" id="naam" name="naam" placeholder="Naam" class="form-control" value="'.$acc['lastname'].'" />';
				    			echo '</div>';
				  			echo '</div>';

				  			echo '<div class="form-group">';
				    			echo '<label for="voornaam" class="col-md-3 control-label">Voornaam</label>';
				    	
				    			echo '<div class="col-md-9">';
				      				echo '<input type="text" id="voornaam" name="voornaam" placeholder="Voornaam" class="form-control" value="'.$acc['firstname'].'" />';
				    			echo '</div>';
				  			echo '</div>';

							echo '<div class="form-group">';
				    			echo '<label for="email" class="col-md-3 control-label">Email</label>';
				    	
				    			echo '<div class="col-md-9">';
				      				echo '<input type="text" id="email" name="email" placeholder="email" class="form-control" value="'.$acc['email'].'" />';
				    			echo '</div>';
				  			echo '</div>';

				  			echo '<div class="form-group">';
				    			echo '<label for="password" class="col-md-3 control-label">Wachtwoord</label>';
				    	
				    			echo '<div class="col-md-9">';
				      				echo '<input type="password" id="password" name="password" placeholder="Nieuw wachtwoord" class="form-control" />';
				    			echo '</div>';
				  			echo '</div>';


				  			echo '<div class="form-group">';
				    			echo '<label for="fileToUpload" class="col-md-3 control-label">Profielafbeelding</label>';
				    			
				    			echo '<div class="col-md-9">';
				    				echo '<img src="'.$acc['foto'].'" alt="Foto '.$acc['firstname']. '" />';
				      				echo '<input type="file" name="fileToUpload" id="fileToUpload" class="fileupload btn btn-default" /><br/>
						      				<input type="submit" class="submit btn btn-default" name="ImageUpload" value="Afbeelding uploaden">
						      				<input type="submit" class="submit btn btn-default" name="ImageDelete" value="Afbeelding verwijderen">
						      				';
				    			echo '</div>';
				  			echo '</div>';


				  			echo '<div class="form-group">';
				    			echo '<label for="" class="col-md-3 control-label"></label>';
				    	
				    			echo '<div class="col-md-9">';
				      				echo '	<input type="hidden" name="id" value="'.$acc['id'].'"/>
				      						<input type="submit" id="FormUpdate" class="submit btn btn-default col-md-12" name="FormUpdate" value="Wijzig uw account"><br/><br/><br/><br/>
				      						';
				    			echo '</div>';
				  			echo '</div>';
				  			echo '<div class="col-md-3"></div>';
				  			echo '<div class="col-md-9">';
				    			echo '<input type="submit" class="submit btn btn-default col-md-12" name="FormDelete" value="Verwijder uw account">';
				  			echo '</div>';


						}
					?>
				</form>
			</div> <!-- END COL -->
			
		</div> <!-- END ROW -->
	</div> <!-- END CONTAINER-FLUID -->

	<!-- jQuery -->
	<script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>