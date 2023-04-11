<!-- PHP code to establish connection with the localserver -->
<?php
 
// Username is root (root doesn't require a password (I think), so we leave that empty)
$user = 'root';
$password = '';

// Database name
$database = 'test';

// Server is localhost
$servername='localhost';

//New connection to server
$mysqli = new mysqli($servername, $user, $password, $database);

// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}

// SQL query to select data from database
$sql = " SELECT * FROM `student info` ORDER BY Fname ASC ";
$result = $mysqli->query($sql);
$mysqli->close();
?>

<!------------------------------------------------------------------------------------------------------------------------>
<!--Start HTML-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Prospective Student Application</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="MainProjectPage.css">
    <!--Navigation bar start-->
    <nav class="navbar navbar-expand-md fixed-left navbar-dark bg-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="sidebar">
			<ul class="navbar-nav">
                <!--Main page link-->
				<li class="nav-item active">
					<a class="nav-link" href="MainProjectPage.php">Home</a>
				</li>
                <!--Add student link-->
				<li class="nav-item">
					<a class="nav-link" href="AddStudent.php">Add Student</a>
				</li>
                <!--notes link-->
				<li class="nav-item">
					<a class="nav-link" href="Notes.php">Notes</a>
				</li>
                <!--templates link-->
				<li class="nav-item">
					<a class="nav-link" href="#">Templates</a>
				</li>
			</ul>
		</div>
	</nav>
    <!--Navigation bar end-->
</head>
<body class="container-fluid" style="background-color: #58131c;">
	<header>
		<h1><font color="white">Prospective Student Application</font></h1>
	</header>
	<div class="search-container">
        <select name="searchDropdown">
            <!--Dropdown items-->
            <option value="FirstNameDropdown">First Name</option>
            <option value="LastNameDropdown">Last Name</option>
            <option value="MajorDropdown">Major</option>
        </select>
		<input type="text" id="input">
		<button type="button" class ="fa fa-search" id="search-button"></button> 
        <button type = "button" class ="fa fa-filter" id ="filter-button"></button>
	</div>
	<div class="table-container">
		<table class="table table-striped mb-0" style="background-color: white;">
			<thead>
				<tr>
					<th>First Name</th>
                    <th>Last Name</th>
					<th>Major</th>
					<th>Time Added</th>
				</tr>
			</thead>
            <!-- php code to fetch data from rows -->
            <?php
                // loop until end of data
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH ROW OF EVERY COLUMN -->
                <td><?php echo $rows['Fname'];?></td>
                <td><?php echo $rows['Lname'];?></td>
                <td><?php echo $rows['Major'];?></td>
                <td><?php echo $rows['Time'];?></td>
            </tr>
            <?php
                }
            ?>
		</table>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@2.9.3/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
