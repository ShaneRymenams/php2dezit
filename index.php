<?php  
	include_once("classes/Projects.class.php");
	include_once("classes/Admin.class.php");
	include_once("classes/Users.class.php");
	include_once('ajax/config.php');
	
	$p = new Project();
	$b = new Project();
	$allProjects = $p->ShowProjects();

	if(!empty($_POST['AddProject'])) {
		try {	
			$p->Title = $_POST['title'];
			$p->Description = $_POST['description'];
			$p->SaveProject();
			header("Location: index.php");
			$succes = "Project is toegevoegd!";
		} catch(Exception $e) {
			$error = $e->getMessage();
		}
	}

	if(!empty($_POST["DeleteProject"])) {
		try {	
			$b->Id = $_POST['id'];
			$b->DeleteProject();
			header("Location: adminboard.php");
			$succes = "Project is verwijderd!";
		} catch(Exception $e) {
			$error = $e->getMessage();
		}
	}


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
	
?><!doctype html>

<html lang="en">
<head>
  	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	
  	<title>PHP1 2de Zit</title>  
	
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
	$(function() {

		$(".vote").click(function() {
		var id = $(this).attr("id");
		var name = $(this).attr("name");
		var dataString = 'id='+ id ;
		var parent = $(this);

		if(name=='up') {
			$(this).fadeIn(200).html('<img src="images/ajax-loader.gif" align="absmiddle">');
			$.ajax({
				type: "POST",
				url: "up_vote.php",
				data: dataString,
				cache: false,

				success: function(html) {
					parent.html(html);
			  	}  
			});
		} else {
			$(this).fadeIn(200).html('<img src="images/ajax-loader.gif" align="absmiddle">');
			$.ajax({
				type: "POST",
				url: "down_vote.php",
				data: dataString,
				cache: false,

				success: function(html) {
				   parent.html(html);
				}
			});
		}

		return false;
		});
	});
</script>

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
				<a class="navbar-nav" style="margin-top:15px;" href="index.php">FeatureList</a>
			</div> <!-- END NAVBAR-HEADER -->
			<ul class="nav navbar-nav pull-right">
				<li><a href="#">Home</a></li>
				<li><a href="#">Test</a></li>
				<li><a href="#">Test2</a></li>
			</ul>
		</div> <!-- END CONTAINER -->
	</div> <!-- END NAVBAR -->
	
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<legend>All Projects</legend>
				<br />
			</div> <!-- END COL -->
			<div class="col col-md-4">
				<div class="row intro2">
			   		<div class="col-md-12">
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
							</div> <!-- END COL -->
						</div> <!-- END ROW -->
			       	</div> <!-- END COL -->
				</div> <!-- END ROW -->
			</div> <!-- END COL -->
		</div> <!-- END ROW -->
		<div class="row">
			<div class="col-md-8">
				<ul id="responds">
				    <?php  
				    	while($row = $allProjects->fetch(PDO::FETCH_ASSOC)) {
				    		$id= $row['id'];
							$up= $row['up'];
							$down= $row['down'];
				    		echo '<div class="row"><div class="col col-md-9">';
				    		echo '<li id="item_'.$row['id'].'">';
							echo '<div><p><strong>Title:</strong> ' .$row['title'].'</p></div>';
							echo '<div><p><strong>Description:</strong> ' .$row['description'].'</p></div></li>';
							echo '</div>'; // END COL
							echo '<div class="col col-md-3 pull-right">';
							echo '<div class="up btn btn-default"><span class="glyphicon glyphicon-thumbs-up"></span> <a href="" class="vote" id="'. $id . '" name="up">' . $up . '</a></div>';
							echo '<div class="down btn btn-default"><span class="glyphicon glyphicon-thumbs-down"></span> <a href="" class="vote" id="'. $id .'" name="down">' . $down .'</a></div>';
							echo '</div>'; // END COL
							echo '</div>'; // END ROW
							echo '<hr>';
						}
				    ?>
				</ul>
			</div> <!-- END COL -->
			<div class="col col-md-4">
				<div class="row intro2">
			   		<div class="col-md-12">
			   			<form method="post" class="formulier">
							<div class="row">
								<div class="col-md-3">
									<label for="email">Email:</label>	
								</div> <!-- END COL -->
								<div class="col-md-9">
									<input type="text" id="email" name="email" placeholder="email" />
								</div> <!-- END COL -->
							</div> <!-- END ROW -->

							<div class="row">
								<div class="col-md-3">
									<label for="password">Password:</label>
								</div> <!-- END COL -->
								<div class="col-md-9">
									<input type="password" id="password" name="password" placeholder="password" />
								</div> <!-- END COL -->
							</div> <!-- END ROW -->

							<div class="row">
								<div class="col-md-3">	
								</div> <!-- END COL -->
								<div class="col-md-9">
									<input class="submit btn btn-default" type="submit" value="Login" name="UserLogin" />
								</div> <!-- END COL -->
							</div> <!-- END ROW -->

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
									</div> <!-- END COL -->
								</div> <!-- END ROW -->

								<div class="row">
									<div class="col-md-3">
										<label for="email">Email:</label>
									</div> <!-- END COL -->
									<div class="col-md-9">
										<input type="text" id="email" name="email" placeholder="email" />
									</div> <!-- END COL -->
								</div> <!-- END ROW -->

								<div class="row">
									<div class="col-md-3">
										<label for="password">Password:</label>
									</div> <!-- END COL -->
									<div class="col-md-9">
										<input type="password" id="password" name="password" placeholder="password" />
									</div> <!-- END COL -->
								</div> <!-- END ROW -->

								<div class="row">
									<div class="col-md-3">	
									</div> <!-- END COL -->
									<div class="col-md-9">
										<input class="submit btn btn-default" type="submit" value="Login" name="AdminLogin" />
									</div> <!-- END COL -->
								</div> <!-- END ROW -->
							</form> 

						</div> <!-- END MYDIV -->
			       	</div> <!-- END COL -->
				</div> <!-- END ROW -->
			</div> <!-- END COL -->
		</div> <!-- END ROW -->
	</div> <!-- END CONTAINER -->

</body>
</html>
		