<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Nejoum AlJazeera</title>
  </head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Car List</h1>
        </div>
		<div>
			<a href="create.php" class="btn btn-primary m-r-1em">Add Car</a>
		</div>
		<br/>
 
 	<?php
		$id=$_GET["id"];
		$data = array();
	 
		$json = json_encode($data);
		
		$url = "http://localhost:3000/cars/".$id;
		$ch = curl_init($url);
		 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($json)
		));
		$response = curl_exec($ch);
		if(curl_errno($ch)) {
			echo "<div class='alert alert-danger'>Unable to update record".curl_error($ch)."</div>";
		} else {
			$updatecar = json_decode($response, true);
			echo "<div class='alert alert-success'>Car status is updated with ID=".$updatecar["id"]."</div>";
		}
		curl_close($ch);
	?>

	<div>
		<a href='index.php' class='btn btn-danger'>Back to car list</a>
	</div>	


         
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 
</body>
</html>
