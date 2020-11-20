
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
   $model = $_POST['model'];
  $type = $_POST['type'];
   $color = $_POST[ 'color'];
   $car_image = $_POST[ 'car_image'];

   $car_id = $_POST['car_id'];

   $sql = " UPDATE `car` SET `model` = '$model',`type` = '$type',  `color` = '$color',`car_image` = '$car_image' WHERE car_id = $car_id " ;

   if($conn->query($sql) === TRUE) {
    echo "success <br><a href='../admin.php'>Back</a>";
  } else {
    echo "error";
  }
  $conn->close();

  
}

?>