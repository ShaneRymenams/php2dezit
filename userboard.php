<?php  
	session_start();
	if(!isset($_SESSION["email"])) {
	    header("location:index.php");
	    exit();
	}
	include_once("classes/Projects.class.php");
	include_once("classes/Users.class.php");
	include_once('ajax/config.php');

	$p = new Project();
	$allProjects = $p->ShowProjects();

	

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
</head>

<body>
	<div class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">FeatureList</a>
			</div> <!-- END NAVBAR-HEADER -->
			<ul class="nav navbar-nav pull-right">
				<li style="border-right:1px solid #e5e5e5;"><p style="margin-top:15px; margin-right:15px;">Howdy, <?php echo $_SESSION["email"];?></p></li>
		    	<li><a href="index.php">Home</a></li>
		    	<li><a href="useraccount.php">Profile</a></li>
		    	<li><a href="logout.php">Logout</a></li>
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
		</div> <!-- END ROW -->
	</div> <!-- END CONTAINER -->

</body>
</html>
		