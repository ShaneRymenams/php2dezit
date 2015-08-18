<?php  
	session_start();
	if(!isset($_SESSION["email"])) {
	    header("location:index.php");
	    exit();
	}

	include_once("classes/Projects.class.php");
	include_once("classes/Admin.class.php");

	$p = new Project();
	$b = new Project();
	$allProjects = $p->ShowRecentProjects();

	if(!empty($_POST['AddProject'])) {
		try {	
			$p->Title = $_POST['title'];
			$p->Description = $_POST['description'];
			$p->SaveProject();

			$succes = "Project is toegevoegd!";
		} catch(Exception $e) {
			$error = $e->getMessage();
		}
	}

	if(!empty($_POST["DeleteProject"])) {
		try {	
			$b->Id = $_POST['id'];
			$b->DeleteProject();

			$succes = "Project is verwijderd!";
		} catch(Exception $e) {
			$error = $e->getMessage();
		}
	}


	$a = new Admin();
	$b = new Admin();
	$allAcc = $b->ShowAccounts();

	if(!empty($_POST['AddAdmin'])) {
		try {	
			$a->Email = $_POST['email'];
			$a->Password = $_POST['password'];
			$a->CreateAccount();

			$succes = "Admin is toegevoegd!";
		} catch(Exception $e) {
			$error = $e->getMessage();
		}
	}

	if(!empty($_POST["DeleteAdmin"])){
		try {	
			$b->Id = $_POST['id'];
			$b->DeleteAccount();

			$succes = "Account is verwijderd!";
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

	<script type="text/javascript">
	$(document).ready(function() {

	$("body").on("click", "#responds .del_button", function(e) {
		 e.preventDefault();
		 var clickedID = this.id.split('-'); //Split ID string (Split works as PHP explode)
		 var DbNumberID = clickedID[1]; //and get number from array
		 var myData = 'recordToDelete='+ DbNumberID; //build a post data structure
		 
		$('.item_'+DbNumberID).addClass( "sel" ); //change background of this element by adding class
		$(this).hide(); //hide currently clicked delete button
		 
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "ajax/DeleteProject.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:myData, //Form variables
			success:function(response){
				//on success, hide  element user wants to delete.
				$('.item_'+DbNumberID).fadeOut();
				$('.edit_'+DbNumberID).fadeOut();
				$('.hr_'+DbNumberID).fadeOut();
			},
			error:function (xhr, ajaxOptions, thrownError){
				//On error, we alert user
				alert(thrownError);
			}
			});
		});
	
	$("body").on("click", "#responds .del_button", function(e) {
		 e.preventDefault();
		 var clickedID = this.id.split('-'); //Split ID string (Split works as PHP explode)
		 var DbNumberID = clickedID[1]; //and get number from array
		 var myData = 'recordToDelete='+ DbNumberID; //build a post data structure
		 
		$('.item_'+DbNumberID).addClass( "sel" ); //change background of this element by adding class
		$(this).hide(); //hide currently clicked delete button
		 
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "ajax/DeleteAdmin.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:myData, //Form variables
			success:function(response){
				//on success, hide  element user wants to delete.
				$('.item_'+DbNumberID).fadeOut();
				$('.edit_'+DbNumberID).fadeOut();
				$('.hr_'+DbNumberID).fadeOut();
			},
			error:function (xhr, ajaxOptions, thrownError){
				//On error, we alert user
				alert(thrownError);
			}
			});
		});
	});
	</script>
</head>

<body>
	<div class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">FeatureList</a>
			</div> <!-- END NAVBAR-HEADER -->
			<ul class="nav navbar-nav pull-right">
				<li style="border-right:1px solid #e5e5e5;"><p style="margin-top:15px; margin-right:15px;">Howdy, <?php echo $_SESSION["email"];?></p></li>
				<li><a href="adminboard.php">Dashboard</a></li>
				<li><a href="adminaccount.php">Profile</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div> <!-- END CONTAINER -->
	</div> <!-- END NAVBAR -->

	<div class="container">

		<div class="row">
			<div class="col col-md-5">
				<form method="post" class="formulier">
					<div class="row">
						<div class="col-md-12">
							<legend>Add Project</legend>
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

					<div class="row">
						<div class="form-group">
							<label class="control-label col-sm-4 text-right" for="email">Title</label>
							<div class="col-md-8">
								<input class="form-control" type="text" id="title" name="title" placeholder="Title" />
							</div> <!-- END COL -->
						</div> <!-- END FORM-GROUP -->
					</div> <!-- END ROW -->
					<br>
					<div class="row">
						<div class="form-group">
							<label class="control-label col-sm-4 text-right" for="email">Description</label>
							<div class="col-md-8">
								<textarea rows="3" class="form-control"  id="description" name="description" placeholder="Description"></textarea>
							</div> <!-- END COL -->
						</div> <!-- END FORM-GROUP -->
					</div> <!-- END ROW -->
					<br>
					<div class="row">
						<div class="col-md-4">	
						</div> <!-- END COL -->
						<div class="col-md-8">
							<input class="submit btn btn-default col-md-12" type="submit" value="Add Project" name="AddProject" />
						</div> <!-- END COL -->
					</div> <!-- END ROW -->
				</form>
			</div> <!-- END COL -->

			<div class="col col-md-1">
			</div> <!-- END COL -->

			<div class="col col-md-6">
				<div class="row">
					<div class="col-md-12">
						<legend>Latest Projects</legend>
						<br />
					</div> <!-- END COL -->
				</div> <!-- END ROW -->

				<div class="row">
					<div class="col-md-12">
						<ul id="responds">
						    <?php  
						    	while($row = $allProjects->fetch(PDO::FETCH_ASSOC)) {
						    		$id= $row['id'];
									$up= $row['up'];
									$down= $row['down'];
						    		echo '<div class="row"><div class="col col-md-9">';
						    		echo '<li class="item_'.$row['id'].'">';
									echo '<div><p><strong>Title:</strong> ' .$row['title'].'</p></div>';
									echo '<div><p><strong>Description:</strong> ' .$row['description'].'</p></div>';
									echo '<div class="up btn btn-default"><p class="vote" id="'. $id . '" name="up"><span class="glyphicon glyphicon-thumbs-up"></span> '. $up . '</p></div>';
									echo '<div class="down btn btn-default"><p class="vote" id="'. $id .'" name="down"><span class="glyphicon glyphicon-thumbs-down"></span> '. $down .'</p></div></li>';
									echo '</div>'; // END COL
									echo '<div class="col col-md-3">';
									echo '<ul class="nav nav-pills"><li class="del_wrapper"><button class="submit btn btn-default glyphicon glyphicon-remove del_button" type="submit" id="del-'.$row["id"].'" name="DeleteProject"/></li>';
									echo '<li class="item_'.$row['id'].'" class="edit_wrapper"><button class="submit btn btn-default glyphicon glyphicon-pencil edit_button" type="submit" id="edit-'.$row["id"].'" name="EditProject"/></li>';
									echo '</ul>';
									echo '</div>'; // END COL
									echo '</div>'; // END ROW
									echo '<hr class="item_'.$row['id'].'">';
								}
						    ?>
						</ul>
					</div> <!-- END COL -->
				</div> <!-- END ROW -->
			</div> <!-- END COL -->
		</div> <!-- END ROW -->

		<br><br>

		<div class="row">
			<div class="col col-md-5">
				<form method="post" class="formulier">
					<div class="row">
						<div class="col-md-12">
							<legend>Add Admin</legend>
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

					<div class="row">
						<div class="form-group">
							<label class="control-label col-sm-4 text-right" for="email">Email</label>
							<div class="col-md-8">
								<input class="form-control" type="text" id="email" name="email" placeholder="Email" />
							</div> <!-- END COL -->
						</div> <!-- END FORM-GROUP -->
					</div> <!-- END ROW -->
					<br>
					<div class="row">
						<div class="form-group">
							<label class="control-label col-sm-4 text-right" for="email">Password</label>
							<div class="col-md-8">
								<input class="form-control" type="password" id="password" name="password" placeholder="Password" />
							</div> <!-- END COL -->
						</div> <!-- END FORM-GROUP -->
					</div> <!-- END ROW -->
					<br>
					<div class="row">
						<div class="col-md-4">	
						</div> <!-- END COL -->
						<div class="col-md-8">
							<input class="submit btn btn-default col-md-12" type="submit" value="Add Admin" name="AddAdmin" />
						</div> <!-- END COL -->
					</div> <!-- END ROW -->
				</form>
				<br><br>
			</div> <!-- END COL -->

			<div class="col col-md-1">
			</div> <!-- END COL -->

			<div class="col col-md-6">
				<div class="row">
					<div class="col-md-12">
						<legend>All Admins</legend>
					</div> <!-- END COL -->
				</div> <!-- END ROW -->
				<div class="row">
					<div class="col col-md-12">
						<ul id="responds">
						
						<?php
							
							while($row = $allAcc->fetch(PDO::FETCH_ASSOC)){
								echo '<div class="row"><div class="col col-md-9">';
								echo '<li class="item_'.$row["id"].'">';
								echo $row["email"].'</li>';
								echo '</div>'; // END COL
								echo '<div class="col col-md-3">';
								echo '<ul class="nav nav-pills"><li class="del_wrapper"><button class="submit btn btn-default glyphicon glyphicon-remove del_button" type="submit" id="del-'.$row["id"].'" name="DeleteAdmin"/></li>';
								echo '</div>'; // END COL
								echo '</div>'; // END ROW
								echo '<hr class="item_'.$row['id'].'">';
							}

							// echo '<div class="row"><div class="col col-md-9">';
				   			// echo '<li id="item_'.$row['id'].'">';
							// echo '<div><p><strong>Title:</strong> ' .$row['title'].'</p></div>';
							// echo '<div><p><strong>Description:</strong> ' .$row['description'].'</p></div>';
							// echo '</div>'; // END COL
							// echo '<div class="col col-md-3">';
							// echo '<ul class="nav nav-pills"><li class="del_wrapper"><button class="submit btn btn-default glyphicon glyphicon-remove del_button" type="submit" id="del-'.$row["id"].'" name="DeleteProject"/></li>';
							// echo '<li id="edit_'.$row['id'].'" class="edit_wrapper"><button class="submit btn btn-default glyphicon glyphicon-pencil edit_button" type="submit" id="edit-'.$row["id"].'" name="EditProject"/></li>';
							// echo '</ul>';
							// echo '</div>'; // END COL
							// echo '</div>'; // END ROW
							// echo '<hr id="hr_'.$row['id'].'">';
						?>
						</ul>
						<p>* If you want to edit your own account, go to Profile in the right top corner.</p>
					</div>
				</div>
			</div> <!-- END COL -->
		</div>
	</div> <!-- END CONTAINER-FLUID -->

	<!-- jQuery -->
	<script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>