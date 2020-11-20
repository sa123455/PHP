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
   
  

if ($_GET['car_id']) {//this is the name of the paremetar car_id
   $car_id = $_GET['car_id'];//$car_id is variable to store the value

   $sql = "SELECT * FROM car WHERE car_id = $car_id" ;
   $result = mysqli_query($conn,$sql);

   $row = $result->fetch_assoc();//bcuz we know it is 1 row

   $conn->close(); 

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
   <title >Edit car</title>

   <style type= "text/css">
       fieldset {
           margin : auto;
           margin-top: 100px;
            width: 50%;
       }

       table  tr th {
           padding-top: 20px;
       }
   </style>

</head>
<body>

<fieldset>
   <legend>Update car</legend>

   <form action="actions/a_update.php"  method="post">
       <table  cellspacing="0" cellpadding= "0">
           <tr>
               <th>model</th>
               <td><input type="text"  name="model" placeholder ="model" value="<?php echo $row['model'] ?>"  /></td>
           </tr>    
           <tr>
               <th>type</th>
               <td><input type= "text" name="type"  placeholder="type" value ="<?php echo $row['type'] ?>" /></td >
           </tr>
           <tr>
               <th>color</th>
               <td><input type ="text" name= "color" placeholder= "color" value= "<?php echo $row['color'] ?>" /></td>
           </tr>
           <tr>
               <th>image</th>
               <td><input type ="text" name= "car_image" placeholder= "image" value= "<?php echo $row['car_image'] ?>" /></td>
           </tr>
           <tr>
           
               <input type= "hidden" name= "car_id" value= "<?php echo $row['car_id']?>" />
               <td><button  type= "submit">Save Changes</button></td>
               <td><a  href= "index.php"><button  type="button">Back</button></a></td>
               <td><a  href= "admin.php"><button  type="button">update more</button></a></td>
           </tr>
       </table>
   </form>

</fieldset>

</body>
</html>

<?php
}
?>
