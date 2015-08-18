<?php  
	include_once("classes/Projects.class.php");
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
	// $(function() {

	// 	$(".vote").click(function() {
	// 	var id = $(this).attr("id");
	// 	var name = $(this).attr("name");
	// 	var dataString = 'id='+ id ;
	// 	var parent = $(this);

	// 	if(name=='up') {
	// 		$(this).fadeIn(200).html('<img src="images/ajax-loader.gif" align="absmiddle">');
	// 		$.ajax({
	// 			type: "POST",
	// 			url: "up_vote.php",
	// 			data: dataString,
	// 			cache: false,

	// 			success: function(html) {
	// 				parent.html(html);
	// 		  	}  
	// 		});
	// 	} else {
	// 		$(this).fadeIn(200).html('<img src="images/ajax-loader.gif" align="absmiddle">');
	// 		$.ajax({
	// 			type: "POST",
	// 			url: "down_vote.php",
	// 			data: dataString,
	// 			cache: false,

	// 			success: function(html) {
	// 			   parent.html(html);
	// 			}
	// 		});
	// 	}

	// 	return false;
	// 	});
	// });
	</script>
	<script type="text/javascript">
	$(function () {
		
		$('[data-toggle="tooltip"]').tooltip()
		$('#toolleft').tooltip('show')
	})
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
		<div class="row">
			<div class="col-md-8">
				<legend>All Projects</legend>
				<br />
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
				    		echo '<div class="row"><div class="col col-md-10">';
				    		echo '<li id="item_'.$row['id'].'">';
							echo '<div><p><strong>Title:</strong> ' .$row['title'].'</p></div>';
							echo '<div><p><strong>Description:</strong> ' .$row['description'].'</p></div></li>';
							echo '</div>'; // END COL
							echo '<div class="col col-md-2 pull-right">';
							echo '<div id="toolleft" data-toggle="tooltip" data-placement="left" title="Login to vote"><div class="up btn btn-default disabled"><span class="glyphicon glyphicon-thumbs-up"></span> <a href="#" class="vote disabled" id="'. $id . '" name="up">' . $up . '</a></div></div>';
							echo '<div id="toolright" data-toggle="tooltip" data-placement="right" title="Login to vote"><div class="down btn btn-default disabled"><span class="glyphicon glyphicon-thumbs-down"></span> <a href="#" class="vote disabled" id="'. $id .'" name="down">' . $down .'</a></div></div>';
							echo '</div>'; // END COL
							echo '</div>'; // END ROW
							echo '<hr>';
						}
				    ?>
				</ul>
			</div> <!-- END COL -->
		</div> <!-- END ROW -->
	</div> <!-- END CONTAINER -->

</body>
</html>
		