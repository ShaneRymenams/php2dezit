<?php
//AJAX - Delete Projects bij adminboard.php

//include db configuration file
include_once("config.php");

if(isset($_POST["recordToDelete"]) && strlen($_POST["recordToDelete"])>0 && is_numeric($_POST["recordToDelete"])) {	
	//do we have a delete request? $_POST["recordToDelete"]

	//sanitize post value, PHP filter FILTER_SANITIZE_NUMBER_INT removes all characters except digits, plus and minus sign.
	$idToDelete = filter_var($_POST["recordToDelete"],FILTER_SANITIZE_NUMBER_INT); 
	
	//try deleting record using the record ID we received from POST
	$delete_row = $mysqli->query("DELETE FROM tbladmin WHERE id=".$idToDelete);
	
	$mysqli->close(); //close db connection
} else {
	//Output error
	header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}
?>