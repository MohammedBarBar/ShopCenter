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
        $sql = "SELECT * from products where idProducts=$id";
        $result =executeSQLWithResult($sql);    
        echo json_encode( $result->fetch_assoc());

    }
    //get all
    else{
        $sql = "SELECT * from products";
        $result =executeSQLWithResult($sql);    

        while($row = $result->fetch_assoc()) {
            $newArr[] = $row;
        }
        echo json_encode($newArr); // get all Customers in json format.
        $fp = fopen('results.json', 'w');
        fwrite($fp, json_encode($newArr));
        fclose($fp);
}
}


//data structure
// {
//     "ProName":"t-shirt",
//     "price":"20",
//     "image":"asds",
//     "catId":"2"
// }
//Post http://127.0.0.1/first/
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // $data = json_decode(file_get_contents('php://input'), true);
    // echo "my test:". file_get_contents('php://input');

    $data = file_get_contents('php://input');
    $dataObj = json_decode($data);
    $Pname = $dataObj->ProName;
    $price = $dataObj->price;
    $image = $dataObj->image;
    $catName = $dataObj->catName;

    $sql = "INSERT INTO `products` (`ProductsName`, `price`, `Image`, `CategoryId`,`CategorName`) VALUES ('$Pname', '$price', '$image', (SELECT idCategories from shop.categories WHERE categoriesName='$catName'),(SELECT categoriesName from shop.categories WHERE categoriesName='$catName'));";
    // (SELECT idCategories from categories WHERE idCategories='$catId') 
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
    $id=$_GET['id'];
    $Pname = $dataObj->ProName;
    $price = $dataObj->price;
    $image = $dataObj->image;
    $catName = $dataObj->catName;

    $sql = "UPDATE `products` SET `ProductsName` = '$Pname',`price` = '$price',`Image` = '$image',`CategoryId` = (SELECT idCategories from shop.categories WHERE categoriesName='$catName'),`CategorName` = (SELECT categoriesName from shop.categories WHERE categoriesName='$catName')  WHERE `idProducts` = $id;";
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

    $sql = "DELETE from `products`  WHERE `idProducts` = $id;";
    echo executeSQL($sql)?  "true": "false";
}
?>