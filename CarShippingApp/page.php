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
		<div>

		<?php
			$page = $_GET["n"];
			$ppage = $_GET["n"]-1;
			$npage = $_GET["n"]+1;
		
			$url = "http://localhost:3000/cars/".$page;
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($curl);
			curl_close($curl);
			//echo $response;
			$arr = json_decode($response, true);
			//echo $arr;
			$arrlength = count($arr);
		?>	

		<?php	
		echo "<table class='table table-hover table-responsive table-bordered'>";//start table
	 
		//creating our table heading
		echo "<tr>";
			echo "<th>ID</th>";
			echo "<th>Make</th>";
			echo "<th>Model</th>";
			echo "<th>Year</th>";
			echo "<th>VIN</th>";
			echo "<th>Status</th>";
			echo "<th>Action</th>";
		echo "</tr>";
		
		for ($i = 0; $i < $arrlength; $i++) {
		echo "<tr>";
		$car = $arr[$i];
		//echo $car;
		?>
			<td><?php echo $car["ID"];?></td>
			<td><?php echo $car["Make"];?></td>
			<td><?php echo $car["Model"];?></td>
			<td><?php echo $car["Year"];?></td>
			<td><?php echo $car["VIN"];?></td>
			<td><?php echo $car["Status"];?></td>
			
			<td>
				<a href="<?php echo 'update.php?id='.$car["ID"]; ?>" class="btn btn-primary m-r-1em">Update Status</a>
		   </td>
		</tr>
		<?php
		}
		?>
		</div>
		<div>
			<a href='index.php' class='btn btn-primary m-r-1em'>First Page</a>
			<?php 
			if ($page == 1) 
			{
			?>
			<a href="" class="btn btn-primary m-r-1em" disable>Previous</a>
			<?php
			}
			else
			{
			?>
			<a href="<?php echo 'page.php?n='.$ppage;?>" class="btn btn-primary m-r-1em">Previous</a>
			<?php
			}
			?>
			<?php 
			if ($arrlength < 3) 
			{
			?>
			<a href="" class="btn btn-primary m-r-1em" disable>Next</a>
			<?php
			}
			else
			{
			?>
			<a href="<?php echo 'page.php?n='.$npage;?>" class="btn btn-primary m-r-1em">Next</a>
			<?php
			}
			?>

		</div>

         
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 
</body>
</html>
