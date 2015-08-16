<?php  
	include_once("classes/Projects.class.php");

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

	//##### Send delete Ajax request to DeleteDates.php #########
	$("body").on("click", "#responds .del_button", function(e) {
		 e.preventDefault();
		 var clickedID = this.id.split('-'); //Split ID string (Split works as PHP explode)
		 var DbNumberID = clickedID[1]; //and get number from array
		 var myData = 'recordToDelete='+ DbNumberID; //build a post data structure
		 
		$('#item_'+DbNumberID).addClass( "sel" ); //change background of this element by adding class
		$(this).hide(); //hide currently clicked delete button
		 
			jQuery.ajax({
			type: "POST", // HTTP method POST or GET
			url: "ajax/DeleteProjects.php", //Where to make Ajax calls
			dataType:"text", // Data type, HTML, json etc.
			data:myData, //Form variables
			success:function(response){
				//on success, hide  element user wants to delete.
				$('#item_'+DbNumberID).fadeOut();
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
				<a class="navbar-nav" href="index.php">FeatureList</a>
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
			<div class="col col-md-4">
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
						<div class="col-md-3">
							<label for="email">Title:</label>
						</div> <!-- END COL -->
						<div class="col-md-9">
							<input type="text" id="title" name="title" placeholder="Title" />
						</div> <!-- END COL -->
					</div> <!-- END ROW -->
					<br>
					<div class="row">
						<div class="col-md-3">
							<label for="email">Description:</label>
						</div> <!-- END COL -->
						<div class="col-md-9">
							<textarea rows="3"  id="description" name="description" placeholder="Description"></textarea>
						</div> <!-- END COL -->
					</div> <!-- END ROW -->

					<div class="row">
						<div class="col-md-3">	
						</div> <!-- END COL -->
						<div class="col-md-9">
							<input class="submit" type="submit" value="Add Project" name="AddProject" />
						</div> <!-- END COL -->
					</div> <!-- END ROW -->
				</form>
			</div> <!-- END COL -->

			<div class="col col-md-1">
			</div> <!-- END COL -->

			<div class="col col-md-6">
				<div class="row">
					<div class="col-md-12">
						<legend>Latest</legend>
						<br />
					</div> <!-- END COL -->
				</div> <!-- END ROW -->

				<div class="row">
					<div class="col-md-12">
						<ul id="responds">
						    <?php  
						    	while($row = $allProjects->fetch(PDO::FETCH_ASSOC)) {
						    		echo '<div class="row"><div class="col col-md-9">';
						    		echo '<li id="item_'.$row['id'].'">';
									echo '<div><p><strong>Title:</strong> ' .$row['title'].'</p></div>';
									echo '<div><p><strong>Description:</strong> ' .$row['description'].'</p></div></li>';
									echo '</div>'; // END COL
									echo '<div class="col col-md-3">';
									echo '<ul class="nav nav-pills"><li class="del_wrapper"><button class="submit glyphicon glyphicon-remove del_button" type="submit" id="del-'.$row["id"].'" name="DeleteProject"/></li>';
									echo '<li class="edit_wrapper"><button class="submit glyphicon glyphicon-pencil edit_button" type="submit" id="edit-'.$row["id"].'" name="EditProject"/></li>';
									echo '</ul>';
									echo '</div>'; // END COL
									echo '</div>'; // END ROW
									echo '<hr>';
								}
						    ?>
						</ul>
					</div> <!-- END COL -->
				</div> <!-- END ROW -->


			</div> <!-- END COL -->
		</div> <!-- END ROW -->
	</div> <!-- END CONTAINER-FLUID -->

	<!-- jQuery -->
	<script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>