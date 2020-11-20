<?php 
 ob_start();
 session_start();
 require_once '../dbconnect.php';
 
 // if session is not set this will redirect to login page
 if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 if(isset($_SESSION["user"])){
   header("Location: home.php");
   exit;
 }

if ($_POST) {
   $car_id = $_POST['car_id'];

$sql = "DELETE FROM car WHERE car_id ={$car_id}";
    if($conn->query($sql) === TRUE) {
       echo "<p>Successfully deleted!!</p>";
       echo "<a href='../admin.php'><button type='button'>Back</button></a>";
   } else {
       echo "Error updating record : " . $conn->error;
   }

   $conn->close();
}

?>