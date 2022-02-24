<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jatek";



$conn = new mysqli($servername, $username, $password, $dbname); 

$conn -> set_charset("utf8");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}

function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
?>