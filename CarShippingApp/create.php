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
            <h1>Add Car</h1>
        </div>
		<br/>
	<?php
	if($_POST){
		$data = array(
		'Make' => $_POST["Make"],
		'Model' => $_POST["Model"],
		'Year' => $_POST["Year"],
		'VIN' => $_POST["VIN"],
		'Status' => $_POST["Status"],
		);
	 
		$json = json_encode($data);
		
		$url = "http://localhost:3000/cars";
		$ch = curl_init($url);
		 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($json)
		));
		$response = curl_exec($ch);
		if(curl_errno($ch)) {
			echo "<div class='alert alert-danger'>Unable to save record".curl_error($ch)."</div>";
		} else {
			$newcar = json_decode($response, true);
			echo "<div class='alert alert-success'>New car is added with ID=".$newcar["ID"]."</div>";
		}
		curl_close($ch);
	}
	

	?>


		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<table class='table table-hover table-responsive table-bordered' width="600">
				<tr>
					<td>Make</td>
					<td><input type='text' name='Make' class='form-control' /></td>
				</tr>
				<tr>
					<td>Model</td>
					<td><input type='text' name='Model' class='form-control' /></td>
				</tr>
				<tr>
					<td>Year</td>
					<td><input type='text' name='Year' class='form-control' /></td>
				</tr>
				<tr>
					<td>VIN</td>
					<td><input type='text' name='VIN' class='form-control' /></td>
				</tr>
				<tr>
					<td>Status</td>
					<td><input type='text' name='Status' class='form-control' /></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type='submit' value='Save' class='btn btn-primary' />
						<a href='index.php' class='btn btn-danger'>Back to car list</a>
					</td>
				</tr>
			</table>
		</form>

         
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

 
</body>
</html>
