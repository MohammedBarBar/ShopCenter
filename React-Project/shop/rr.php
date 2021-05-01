<?php


header("Access-Control-Allow-Origin: *");
header('content-type: application/json');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-methods: *");


//my DB functions
include "DAL.php";


if($_SERVER["REQUEST_METHOD"] == "GET")
{
    // $data = json_decode(file_get_contents('php://input'), true);
    // echo "my test:". file_get_contents('php://input');

    $data = file_get_contents('php://input');
    $dataObj = json_decode($data);
    $id = $dataObj->idUser;
    $Fname = $dataObj->Fname;
    $Lname = $dataObj->Lname;
    $Email = $dataObj->Email;
    $password = $dataObj->password;
    $city = $dataObj->city;
    $street = $dataObj->street;

    $sql = "INSERT INTO `users` (`idUser`, `FirstName`, `LastName`, `Email`, `password`, `City`, `Street`) VALUES ('$id', '$Fname', '$Lname', '$Email', '$password', '$city', '$street')";
    // echo $sql;
    echo executeSQL($sql)?  "true": "false";
}

?>