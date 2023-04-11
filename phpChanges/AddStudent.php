<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add Prospective Student</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="MainProjectPage.css">
    <nav class="navbar navbar-expand-md fixed-left navbar-dark bg-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="sidebar">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="MainProjectPage.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="AddStudent.php">Add Student</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="Notes.php">Notes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Templates</a>
				</li>
			</ul>
		</div>
	</nav>
</head>
<body class="container-fluid" style="background-color: #58131c;">
    <header>
		<h1><font color="white">Add a Student</font></h1>
	</header>
	<form action="dbConnect.php" method="POST">
    <font color="white">
	First Name: <input type="text" id="fname" name="Fname">
    Last Name: <input type="text" id="lname" name="Lname">
    Major: <input type="text" id="major" name="Major">
	time: <input type="text" id="time" name="Time">
    <input type="submit" value="Add Student">
    </font>
	</form>
</body>
</html>
