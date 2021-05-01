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
        $sql = "SELECT * from order where idOrder=$id";
        $result =executeSQLWithResult($sql);    
        echo json_encode( $result->fetch_assoc());

    }
    //get all
    else{
        $sql = "SELECT * from shop.order";
        $result =executeSQLWithResult($sql);    

        while($row = $result->fetch_assoc()) {
            $newArr[] = $row;
        }
        echo json_encode($newArr); // get all Customers in json format.
}
}


//data structure
// {
//     "quantity":"3",
//     "price":"20",
//     "city":"asd",
//     "street":"dsad",
//     "creadit":"4563",
//     "cartId":"5"
// }
//Post http://127.0.0.1/first/
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // $data = json_decode(file_get_contents('php://input'), true);
    // echo "my test:". file_get_contents('php://input');

    $data = file_get_contents('php://input');
    $dataObj = json_decode($data);
    $quantity = $dataObj->quantity;
    $price = $dataObj->price;
    $city = $dataObj->city;
    $street = $dataObj->street;
    $creaditCard = $dataObj->creadit;
    $orderDate = date('Y-m-d H:i:s');
    $shipDate = date('Y-m-d H:i:s');
    $cartId = $dataObj->cartId;

    $sql = "INSERT INTO `shop`.`order` (`quantity`, `price`, `city`, `street`,`shipDate`,`orderDate`,`creaditCard`,`CartIDD`) VALUES ('$quantity', '$price', '$city','$street','$shipDate','$orderDate','$creaditCard', (SELECT idCart  from shop.cart WHERE idCart ='$cartId'));";
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
    $id = $dataObj->id;
    $quantity = $dataObj->quantity;
    $price = $dataObj->price;
    $city = $dataObj->city;
    $street = $dataObj->street;
    $creaditCard = $dataObj->creadit;
    $orderDate = date('Y-m-d H:i:s');
    $shipDate = date('Y-m-d H:i:s');
    $cartId = $dataObj->cartId;
    $sql = "UPDATE `shop`.`order` SET `quantity` = '$quantity',`price` = '$price',`city` = '$city',`street` = '$street', `creaditCard` = '$creaditCard',`shipDate`='$shipDate', `orderDate` = '$orderDate',`CartIDD`=(SELECT idCart  from shop.cart WHERE idCart ='$cartId') WHERE `idOrder` = $id;";
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
    $id=$dataObj->id;

    $sql = "DELETE from `order`  WHERE `idOrder` = $id;";
    echo executeSQL($sql)?  "true": "false";
}
?>