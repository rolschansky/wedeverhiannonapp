<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US"> 

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title> 
		Visitor Vehicle Registration 
	</title>


	<style>
		.error {color: #FF0000;}
	</style>

	<!-- Include CSS for different screen sizes -->
	<link rel="stylesheet" type="text/css" href="defaultstyle.css">
</head>

<body>

<?php
	
	require 'connectToDatabase.php';

	// Connect to Azure SQL Database
	$conn = ConnectToDabase();

	// Get data for vehicle registration categories
	$tsql="SELECT CATEGORY FROM Registration_Categories ORDER BY CATEGORY ASC";
	$registrationCategories= sqlsrv_query($conn, $tsql);

	// Populate dropdown menu options 
	$options = '';
	while($row = sqlsrv_fetch_array($registrationCategories)) {
		$options .="<option>" . $row['CATEGORY'] . "</option>";
	}

	// Close SQL database connection
	sqlsrv_close ($conn);

	// Get the session data from the previously selected Expense Month, if it exists
	session_start();
	if ( !empty( $_SESSION['prevSelections'] ))
	{ 
		$prevSelections = $_SESSION['prevSelections'];
		unset ( $_SESSION['prevSelections'] );
	}

	// Extract previously-selected Month and Year
	//$prevExpenseMonth= $prevSelections['prevExpenseMonth'];
	//$prevExpenseYear= $prevSelections['prevExpenseYear'];
?>

<div class="intro">

	<h2> Input Registration Form </h2>

	<!-- Display redundant error message on top of webpage if there is an error -->
	<h3> <span class="error"> <?php echo $prevSelections['errorMessage'] ?> </span> </h3>

</div>

<!-- Define web form. 
The array $_POST is populated after the HTTP POST method  value="<?php echo $prevExpenseYear;?>".  
The PHP script insertToDb.php will be executed after the user clicks "Submit"-->
<div class="container">
	<form action="insertToDb.php" method="post">

		<label>Employee Name ():</label>
		<input type="text" step="1" name="employee_name" required><br>
		

		<!-- Text input for year, remembering previously selected year -->
		<label>Start Date (MM-DD-YYYY):</label>
		<input type="text" step="1" name="start_date" required><br>
		
		<label>End Date (MM-DD-YYYY):</label>
		<input type="text" step="1" name="end_date" required><br>
		
		<label>Vehicle Make ():</label>
		<input type="text" step="1" name="vehicle_make" required><br>
		
		<label>Vehicle Model ():</label>
		<input type="text" step="1" name="vehicle_model" required><br>
		
		<label>Licence Plate ():</label>
		<input type="text" step="1" name="licence_plate" required><br>
 

		<button type="submit">Submit</button>
	</form>
</div>

</body>
</html>

<!--<h3> Previous Input (if any) - for verification purposes:</h3>
<p> Registration Day: <?php echo $prevSelections['prevExpenseDay'] ?> </p>
<p> Registration Month: <?php echo $prevSelections['prevExpenseMonth'] ?> </p>
<p> Registration Year: <?php echo $prevSelections['prevExpenseYear'] ?> </p>
<p> Registration Category: <?php echo $prevSelections['prevExpenseCategory'] ?> </p>
<p> Registration Amount: <?php echo $prevSelections['prevExpenseAmount'] ?> </p>
<p> Registration Note: <?php echo $prevSelections['prevExpenseNote'] ?> </p>
<p> <span class="error"> <?php echo $prevSelections['errorMessage'] ?> </span> </p>   



