<!DOCTYPE html>
<html lang="en">

<head>

  <style>
    .alert{
      text-align: center;
      margin-top: 100px;
    }
    .succe-alert{
      color: green;
    }
    .failed-alert{
      color: red;
    }
    .para{
      text-align: center;
      margin-top: 20px;
      font-size: 1.5rem;
    }
  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check</title>
</head>
<body>
<?php
session_start();
//database-set up variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbsignuplogin";
$tblname= "tblsignuplogin";

// Create connection
$conn = new mysqli($servername, $username, "", $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, pass FROM $tblname";
$result = $conn->query($sql);

$pageusr= $_POST["userName"];
$pagepass= $_POST["password"];
$flag=1;
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if($row["username"] == $pageusr && $row["pass"] == $pagepass){
      // echo "<h1 class=\"succe-alert alert\">Login Succesfull</h1>";
      $flag= 0;
      header('location:http://localhost/studentManagement/registrationform.php');
    }
    if($row["username"] != $pageusr && $row["pass"] == $pagepass){
 
        $_SESSION["username"]= $_POST["userName"];
        header('location:login.php');
        $flag= 0;
        }
         
      if($row["username"] == $pageusr && $row["pass"] != $pagepass){
  
        // '<script>alert("Incorrect password ")</script>';
        $_SESSION["password"]= $_POST["password"];
        header('location:login.php');
        $flag= 0;
        }
        
  }
  if($flag == 1){
    // echo "<h1 class=\"failed-alert alert\">Login Failed</h1>";  
    $_SESSION["pass"]= $_POST["password"];
    $_SESSION["user"]= $_POST["userName"];
    header('location:login.php');
  }

      
} else {
  echo "0 results";
}
$conn->close();
?>
</body>
</html>