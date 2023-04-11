<!DOCTYPE html>
<html lang="en">
<head>
	<title>Notes App</title>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="styles.css">
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
</head>
<body style="background-color: #58131c;">

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
