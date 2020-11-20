<?php
	session_start();
	require_once 'dbconnect.php';

	if(isset($_POST["submit"])){
		$carId = $_GET["id"];
		$userId = $_SESSION["user"];
		$booking_date_start = $_POST["booking_date_start"];
		$booking_date_end = $_POST["booking_date_end"];

		$sql = "INSERT INTO booking (booking_date_start, booking_date_end, fk_user_id, fk_car_id) VALUES ('$booking_date_start','$booking_date_end',$userId,$carId)";

		$sql2 = "UPDATE `car` SET `available`='no' WHERE car_id = $carId";

		if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
            echo "Booking success <br> <a href='home.php'>Back to home page</a><br>";
           
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<!-- <form id="foo">
		
	</form> -->
    <form method="post">
		<input type="date" name="booking_date_start">
		<input type="date" name="booking_date_end">
		<input type="submit" name="submit">

	</form>
	<script>


		 // Variable to hold request

    /*function changeHandler(event,form){
        event.preventDefault();
        var request;
        // Prevent default posting of form - put here to work in case of errors
        //event.preventDefault();
        // Abort any pending request
        if (request) {
            request.abort();
        }
        // setup some local variables
        var $form = $(form);
        // Let's select and cache all the fields

        // Serialize the data in the form
        var serializedData = $form.serialize();
        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        console.log(serializedData);
        $form.prop("disabled", true);
        // Fire off the request to /form.php
        request = $.ajax({
            url: "searchBarBackend.php",
            type: "post",
            data: serializedData
        });
        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR){
            // Log a message to the console
            console.log("Hooray, it worked!");

            document.getElementById("message").innerHTML = response;
        });
        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });
        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
            // Reenable the inputs
            $form.prop("disabled", false);
        });
    }

   // Variable to hold request

   // Bind to the submit event of our form
   //$("#form input").change(changeHandler);
    $(document).ready(function(){

        $("#input").on("keyup",function(){
            changeHandler(event,this);
        })
    });*/

	</script>
</body>
</html>

