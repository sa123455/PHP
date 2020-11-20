<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
 header("Location: index.php");
 exit;
}
if(isset($_SESSION["user"])){
	header("Location: home.php");
	exit;
}
// select logged-in users details
$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['admin']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);


$resCar = mysqli_query($conn, "SELECT * FROM car WHERE available = 'yes' ");

?>
<!DOCTYPE html>
<html>
<head>
<script src="https://kit.fontawesome.com/1dd2006b34.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
</head>
<body >
<div class="container-fluid">
<div class="row">

<span class="border rounded-circle p-5 ml-4 text-white bg-dark mt-5"><i class="fas fa-user"></i><p class="">Hi, Administrator</p> <?php echo $userRow['userEmail']; ?> </span>

           <a href="create.php">Create</a>
		  
           
           <a  href="logout.php?logout">Sign Out</a><br><hr>
		   </div>
		   </div>
<br>
           <?php
		    echo "<div class='container'>";
			echo "<div class='row'>";
           if($resCar->num_rows == 0 ){
			echo "No result";
		}elseif($resCar->num_rows == 1){
			$row = $resCar->fetch_assoc();
			echo "<div class='col-4'>";
			echo"<div class='card' style='width: 18rem;'>
			<img src='$row[car_image]' class='card-img-top-fluid' alt='...'>
<div class='card-body'>
<h5 class='card-title'>$row[model]</h5>
<p class='card-text'>$row[type]</p>
<a href='update.php?car_id=".$row["car_id"]."'>Update</a><a href='delete.php?car_id=".$row["car_id"]."'>Delete</a><br>";
echo"</div> </div> </div>";
			#echo $row["model"]. " ". $row["type"]." ".$row["color"]. " ".$row["available"]."<a href='update.php?car_id=".$row["car_id"]."'>Update</a><a href='delete.php?car_id=".$row["car_id"]."'>Delete</a><br>";
		}else {
			$rows = $resCar->fetch_all(MYSQLI_ASSOC);
			foreach ($rows as $value) {

				echo "<div class='col-4'>";
				echo"<div class='card' style='width: 18rem;'>
				<img src='$value[car_image]' class='card-img-top-fluid' alt='...'>
  <div class='card-body'>
    <h5 class='card-title'>$value[model]</h5>
    <p class='card-text'>$value[type]</p>
	<a href='update.php?car_id=".$value["car_id"]."'>Update</a><a href='delete.php?car_id=".$value["car_id"]."'>Delete</a><br>";
	echo"</div> </div> </div>";
	#echo $value["car_id"]. " ----- " .$value["model"]. " ". $value["type"]." ".$value["color"]. " ".$value["available"]."<a href='update.php?car_id=".$value["car_id"]."'>Update</a><a href='delete.php?car_id=".$value["car_id"]."'>Delete</a><br>";
			}
		}
		echo "</div>";
		echo "</div>";
 		?>
		
       		

 
</body>
</html>
<?php ob_end_flush(); ?>