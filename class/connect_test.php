<html>
<head>
<title>ThaiCreate.Com</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_clinic";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql1 = "select staffid,pname,fname,lname,user,pass,mode from tb_staff where user='na' and pass='1' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["staffid"]. " - Name: " . $row["fname"]. " " . $row["lname"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
</body>
</html>