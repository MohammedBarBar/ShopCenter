<?php
//log - basic only
include "log.php";

//CORS
header("Access-Control-Allow-Origin: *");
header('content-type: application/json');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-methods: *");


//my DB functions
include "DAL.php";

//Result [{"id":"14","name":"ttt","tel":"777"},{"id":"16","name":"mmmm","tel":"123"}]
//get all/single
if($_SERVER["REQUEST_METHOD"] == "GET")
{
    //call samp
    //http://127.0.0.1/myshopcrud/APICustomers.php?id=1
    //get single    
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $sql = "SELECT * from users where idUser=$id";
        $result =executeSQLWithResult($sql);    
        echo json_encode( $result->fetch_assoc());

    }
    //get all
    else{
        $sql = "SELECT * from users";
        $result =executeSQLWithResult($sql);    

        while($row = $result->fetch_assoc()) {
            $newArr[] = $row;
        }
        echo json_encode($newArr); // get all Customers in json format.
}
}


//data structure
// {
//     "idUser": "12",
//        "Fname": "mma",
//        "Lname": "msad",
//        "Email": "adsm",
//        "password": "dsad",
//        "city": "sad",
//        "street": "ssa"
// }
//Post http://127.0.0.1/first/
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // $data = json_decode(file_get_contents('php://input'), true);
    // echo "my test:". file_get_contents('php://input');

    $data = file_get_contents('php://input');
    $dataObj = json_decode($data);
    $id = $dataObj->idUser;
    $Fname = $dataObj->Fname;
    $Lname = $dataObj->Lname;
    $Email = $dataObj->Email;
    $pass = $dataObj->password;
    $city = $dataObj->city;
    $street = $dataObj->street;

    $sql = "INSERT INTO `users` (`idUser`, `FirstName`, `LastName`, `Email`, `password`, `City`, `Street`) VALUES ('$id', '$Fname', '$Lname', '$Email', '$pass', '$city', '$street')";
    
    echo executeSQLWithResult($sql)?  "true": "false";
}


//data structure
// {
//     "id":"19",
//     "name":"mmmmmmmmmmmmmmmmmmmmmmm",
//     "tel":"123"
// }

//Put - Update
if ($_SERVER['REQUEST_METHOD'] === 'PUT') { 

    $data = file_get_contents('php://input');
    $dataObj = json_decode( $data);
    $id = $dataObj->idUser;
    $Fname = $dataObj->Fname;
    $Lname = $dataObj->Lname;
    $Email = $dataObj->Email;
    $pass = $dataObj->password;
    $city = $dataObj->city;
    $street = $dataObj->street;

    $sql = "UPDATE `users` SET `FirstName` = '$Fname',`LastName` = '$Lname',`Email` = '$Email',`password` = '$pass',`City` = '$city',`Street` = '$street'  WHERE `idUser` = $id;";
    echo executeSQL($sql)?  "true": "false";
}

//data stucture
// {
//     "id":"18"
// }
//Delete
if($_SERVER["REQUEST_METHOD"] == "DELETE")
{
    $data = file_get_contents('php://input');
    $dataObj = json_decode( file_get_contents('php://input'));
    $id=$_GET['id'];

    $sql = "DELETE from `users`  WHERE `idUser` = $id;";
    echo executeSQL($sql)?  "true": "false";
}
?>