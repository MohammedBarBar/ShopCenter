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
        $sql = "SELECT * from categories where idCategories=$id";
        $result =executeSQLWithResult($sql);    
        echo json_encode( $result->fetch_assoc());

    }
    //get all
    else{
        $sql = "SELECT * from categories";
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
    $name = $dataObj->cName;
    $img = $dataObj->Image;

    $sql = "SELECT * from categories";
    $result =executeSQLWithResult($sql);    

    while($row = $result->fetch_assoc()) {
        $newArr[] = $row;
    }
    $idNext = count($newArr) + 1;

    $sql = "INSERT INTO `categories` (`categoriesName`,`catImage`) VALUES ('$name','$img')";
    // echo $sql;
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
    $name = $dataObj->cName;
    $img = $dataObj->Image;
    $id=$_GET['id'];


    $sql = "UPDATE `categories` SET `categoriesName` = '$name',`catImage` = '$img' WHERE `idCategories` = $id;";
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

    $sql = "DELETE from `categories`  WHERE `idCategories` = $id;";
    echo executeSQL($sql)?  "true": "false";
}
?>