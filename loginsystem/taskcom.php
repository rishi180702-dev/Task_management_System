<?php
include_once('includes/config.php');

$sql = "UPDATE `tasks` SET tstatus='Completed' WHERE tid= ".$_GET['tid'];
if ($con->query($sql) === TRUE) {
  echo  "Record updated successfully";
  header("Location:taskcompl.php");
} else {
  echo "Error updating record: " . $con->error();
}


$con->close();
?>
