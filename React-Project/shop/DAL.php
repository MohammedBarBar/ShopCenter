<?php
//please replace vars with your DB vars
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "shop";

//create connection to database
function ConnectionToDB(){
    global $servername,$username,$password,$dbname;
    // Create connection
    // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($servername, $username, $password,$dbname);
// $conn = mysqli_connect($servername,$username,$password,$dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//  echo "Connected successfully<br>";

return $conn;
}

//excute sql and return true if success , false if failer
function executeSQLWithResult($sql){
    global $conn; 
    $conn= ConnectionToDB();
    return  $conn->query($sql);
 }

//excute sql and return true if success , false if failer
function executeSQL($sql){
    global $conn; 
    $conn= ConnectionToDB();
    
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        return true;
    } else {
        $conn->close();
        return false;
    //echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>