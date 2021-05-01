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
        $sql = "SELECT * from cart where idCart =$id";
        $result =executeSQLWithResult($sql);    
        echo json_encode( $result->fetch_assoc());

    }
    //get all
    else{
        $sql = "SELECT * from cart";
        $result =executeSQLWithResult($sql);    

        while($row = $result->fetch_assoc()) {
            $newArr[] = $row;
        }
        echo json_encode($newArr); // get all Customers in json format.
}
}


//data structure
// {
//     "CustomerID": "1",
//     "CustomerName": "eyad",
//     "Address": "jerusalem",
//     "Phone": "555544",
//     "Email": "eyad@mail.com"
// }
//Post http://127.0.0.1/first/
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // $data = json_decode(file_get_contents('php://input'), true);
    // echo "my test:". file_get_contents('php://input');

    $data = file_get_contents('php://input');
    $dataObj = json_decode($data);
    $datee = date('Y-m-d H:i:s');
    // $date = $dataObj->date;
    // $temp = $dataObj->date;
    $userId = $dataObj->idUser;
    $sql = "INSERT INTO `cart` (`date`,`userId` ) VALUES ('$datee',(SELECT idUser from users WHERE idUser='$userId'))";
    //  echo $sql;
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
    $id = $dataObj->id;
    $datee = date('Y-m-d H:i:s');
    $userId = $dataObj->idUser;


    $sql = "UPDATE `cart` SET `date` = '$datee',`userId` = (SELECT idUser from users WHERE idUser='$userId') WHERE `idCart` = $id;";
    echo executeSQL($sql)?  "true": "false";
}

//data stucture
// {
//     "id":"18"
// }
//Delete
// <!-- ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password'; -->
if($_SERVER["REQUEST_METHOD"] == "DELETE")
{
    $data = file_get_contents('php://input');
    $dataObj = json_decode( file_get_contents('php://input'));
    $id=$dataObj->id;

    $sql = "DELETE from `cart`  WHERE `idCart` = $id;";
    echo executeSQL($sql)?  "true": "false";
}
?>
