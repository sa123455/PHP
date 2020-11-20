<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user' ]) ) {
 header("Location: index.php");
 exit;
}
// select logged-in users details
$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);


$resCar = mysqli_query($conn, "SELECT * FROM car WHERE available = 'yes'");

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<title>Welcome - <?php echo $userRow['userEmail' ]; ?></title>
<style>
/* img {
	width:500px;
	height:400px;
} */
</style>
</head>
<body >
<div class="container">
<div class="row">
<div class="col-6">

           Hi <?php echo $userRow['userEmail' ]; ?>
           
           <a  href="logout.php?logout">Sign Out</a><br><hr>
		   </div>
		   </div>
		   </div>
		   


           <?php
		   echo "<div class='container'>";
		   echo "<div class='row'>";
           if($resCar->num_rows == 0 ){
			echo "Sorry! We have no more available Autos <br>";
			echo "Please Try again later";

		}elseif($resCar->num_rows == 1){
			$row = $resCar->fetch_assoc();
			echo "<div class='col-4'>";
				echo"<div class='card' style='width: 18rem;'>
				<img src='$row[car_image]' class='card-img-top-fluid' alt='...'>
  <div class='card-body'>
    <h5 class='card-title'>$row[model]</h5>
    <p class='card-text'>$row[type]</p>
	<a href='booking.php?id=$row[car_id]'>Booking Now</a><br>";
	echo"</div> </div> </div>";

			#echo "<img src='$row[car_image]'>"." ". $row["model"]. " ". $row["type"]." ".$row["color"]. " ".$row["available"]." <a href='booking.php?id=".$row["car_id"]."'>Booking Now</a><br>";
		}else {
			$rows = $resCar->fetch_all(MYSQLI_ASSOC);
			foreach ($rows as $value) {
				
				echo "<div class='col-4'>";
				echo"<div class='card' style='width: 18rem;'>
				<img src='$value[car_image]' class='card-img-top-fluid' alt='...'>
  <div class='card-body'>
    <h5 class='card-title'>$value[model]</h5>
    <p class='card-text'>$value[type]</p>
	<a href='booking.php?id=$value[car_id]'>Booking Now</a><br>";
	echo"</div> </div> </div>";
	
	

				#echo "<img src='$value[car_image]'>"." " .$value["car_id"]. " ----- " .$value["model"]. " ". $value["type"]." ".$value["color"]. " ".$value["available"]." <a href='booking.php?id=".$value["car_id"]."'>Booking Now</a><br>";
			}
			
		}
		echo "</div>";
		echo "</div>";
		

 		?>
		
       		

		
		   
</body>
</html>
<?php ob_end_flush(); ?>