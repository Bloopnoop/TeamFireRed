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

//Setting varibles for specific student
$ID = $_POST['Time'];

$sql = " SELECT `Fname`,`Lname`,`Major`, `Time` FROM `student info` WHERE Time=$ID "; 
$result = $mysqli->query($sql);
$mysqli->close();

?>

<!-------------------------------------------------------------------------->
<!--HTML start-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Prospective Student Application</title>
    <link rel="stylesheet" href="styles.css">
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
        <?php
        $rows=$result->fetch_assoc()
        ?>
        <!--Name as a header-->
		<h1><font color="white"><?php echo $rows["Fname"]?> <?php echo $rows["Lname"]?></font></h1>
        <hr>
	</header>
    <!--Grabs student info-->
    <font color="white">
        Age: <?php //echo $rows["Age"]?><br>
        Major: <?php echo $rows["Major"]?><br>
        High School year: <?php //echo $rows["HSYear"]?><br>
        Date Added: <?php //echo $rows["DateAdded"]?><br>
    </font>

<!--Notes-->

    <div class="container">
	<div class="input-wrapper">
		<label for="note-input">Enter a note:</label>
		<textarea id="note-input" rows="8"></textarea>
		<button id="save-button">Save</button>
	</div>

	<div class="notes-wrapper">
		<h2>Saved Notes</h2>
		<div class="notes"></div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
		$(document).ready(function() {
		$('#save-button').on('click', function() {
			var note = $('#note-input').val();
			if (note) {
				var timestamp = new Date().toLocaleString();
				$('.notes').append('<div class="note">' + note + '<br><span class="timestamp">' + timestamp + '</span></div>');
				$('#note-input').val('');
			}
		});
	});
</script>

</body>
</html>