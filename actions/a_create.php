<?php 
ob_start();
session_start();

// if session is not set this will redirect to login page
if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
 header("Location: index.php");
 exit;
}
if(isset($_SESSION["user"])){
  header("Location: home.php");
  exit;
}


require_once '../dbconnect.php';

if ($_POST) {
   $model = $_POST['model'];
   $type = $_POST['type'];
   $color = $_POST[ 'color'];
   $car_image = $_POST['car_image'];

   $sql = "INSERT INTO car (model, type, color,car_image) VALUES ('$model', '$type', '$color','$car_image')";
    if($conn->query($sql) === TRUE) {
       echo "<p>New Record Successfully Created</p>" ;
       echo "<a href='../create.php'><button type='button'>Back</button></a>";
        echo "<a href='../admin.php'><button type='button'>Home</button></a>";
   } else  {
       echo "Error " . $sql . ' ' . $conn->connect_error;
   }

   $conn->close();
}

?>