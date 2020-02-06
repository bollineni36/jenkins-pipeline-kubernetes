<?php 

	
$servername = "localhost";
$username = "konsear";
$password = "Thanks@536";
$dbname = "konsear_db_stage";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
try{
	
$sql = sprintf("SELECT * FROM kon_owner");
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "ID : " . $row["OwnerId"]. "<br/>Name : " . $row["OwnerName"]. "<br/>Email Id : " . $row["OwnerEmailId"]. "<br>";
    }
} else {
    echo "0 results";
}

}
catch(Exception $e)
{
	print_r($e);
}
mysqli_close($conn);
?> 