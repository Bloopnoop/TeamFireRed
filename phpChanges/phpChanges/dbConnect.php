<?php
//header to keep the user at AddStudent.php while the script runs
header("Location: AddStudent.php");

    //Varible input names (connected to AddStudent values) 
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $Major = $_POST['Major'];
    $Time = $_POST['Time'];

    //Database Connection
    // Username is root (root doesn't require a password (I think), so we leave that empty)
    $user = 'root';
    $password = '';

    // Database name
    $database = 'test';

    // Server is localhost
    $servername='localhost';

    //New connection to server
    $conn = new mysqli($servername, $user, $password, $database);
    if($conn->connect_error){
        die('Connection Failed  : '.$conn->connect_error);
    } else {
        $Insert = " INSERT INTO `student info` (Fname, Lname, Major, Time) VALUES (?, ?, ?, ?) ";
        $stmt = $conn->prepare($Insert);
        $stmt->bind_param("ssss", $Fname, $Lname, $Major, $Time);
        $stmt->execute();
        echo "Student added";
        $stmt->close();
        $conn->close();
    }
?>